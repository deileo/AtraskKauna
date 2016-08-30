<?php

namespace NFQ\KVKScraperBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Facebook;
use NFQ\KVKScraperBundle\Entity\EventData;
use NFQ\KVKScraperBundle\Entity\FacebookEvent;
use NFQ\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FacebookEventManager {

    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    private $session;

    /**
     * @var Facebook $fb
     */
    private $fb;

    private $fb_helper;

    public function __construct($container, $em, $session)
    {
        $this->container = $container;
        $this->em = $em;
        $this->session = $session;

        $app_id = $this->container->getParameter('kvk_scraper.facebook.app_id');
        $app_secret = $this->container->getParameter('kvk_scraper.facebook.secret');

        $this->fb = new Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => 'v2.5'
        ]);

        $this->fb->setDefaultAccessToken(implode('|', [$app_id, $app_secret]));

        $this->fb_helper = $this->fb->getRedirectLoginHelper();
    }

    public function fetchFacebookEvents()
    {
        $events = $this->em->getRepository('NFQKVKScraperBundle:EventData')->getAllEventsWithFacebookId();

        foreach($events as $eventData) {
            $this->populateFacebookEvent($eventData);
        }

    }

    /**
     * @param EventData $eventData
     * @return string
     */
    public function populateFacebookEvent(EventData $eventData) {
        $facebookEvent = $eventData->getFacebookEvent();

        $fetchFields = [
            'id',
            'place',
            'description',
            'ticket_uri',
            'start_time',
            'end_time',
            'attending_count',
        ];

        try {
            $facebookEventData = $this->fb->get('/' . $facebookEvent->getFacebookEventId(). '/?fields=' . implode(',', $fetchFields));
        } catch(FacebookResponseException $ex){
            return $ex->getMessage();
            // @TODO: Log stack trace.
        }

        $facebookEventData = $facebookEventData->getGraphNode();

        if ($facebookEventData->getField('description')) {
            $facebookEvent->setDescription($facebookEventData->getField('description'));
        }

        if($facebookEventData->getField('ticket_uri')){
            $facebookEvent->setTicketUrl($facebookEventData->getField('ticket_uri'));
        }

        if($facebookEventData->getField('start_time')){
            $facebookEvent->setStartTime($facebookEventData->getField('start_time'));
        }

        if($facebookEventData->getField('end_time')){
            $facebookEvent->setEndTime($facebookEventData->getField('end_time'));
        }

        $facebookEvent->setAttendingCount($facebookEventData->getField('attending_count'));

        if($facebookEventPlace = $facebookEventData->getField('place')) {
            $street = [];

            if($facebookEventPlace->getField('name')){
                $street[] = $facebookEventPlace->getField('name');
            }

            if($facebookEventPlaceLoc = $facebookEventPlace->getField('location')){
                if($facebookEventPlaceLoc->getField('street')){
                    $street[] = $facebookEventPlaceLoc->getField('street');
                }

                if($facebookEventPlaceLoc->getField('latitude') && $facebookEventPlaceLoc->getField('longitude')){
                    $facebookEvent->setLatitude($facebookEventPlaceLoc->getField('latitude'));
                    $facebookEvent->setLongitude($facebookEventPlaceLoc->getField('longitude'));
                }
            }

            $facebookEvent->setStreet(implode(', ', $street));
        }

        $this->em->persist($facebookEvent);
        $this->em->flush();
    }

    public function attendEvent($facebook_event_id){
        /**
         * @var User $user
         */
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $user_access_token = $user->getFacebookAccessToken();

        if( ! $user_access_token) {
            return json_encode([
                'message' => 'Not logged in',
                'success' => false
            ]);
        }

        $this->fb->setDefaultAccessToken($user_access_token);

        $attendResponse = null;

        try {
            $attendResponse = $this->fb->post($facebook_event_id . '/attending');
            //$attendResponse = $this->fb->post($facebook_event_id . '/declined');
        } catch(FacebookResponseException $ex){
            return false;
            // @TODO: Log stack trace.
        }

        $attendResponse = $attendResponse->getGraphNode()->asArray();

        if($attendResponse['success'] === true){
            /**
             * @var FacebookEvent $facebookEvent
             */
            $facebookEvent = $this->container->get('doctrine')->getRepository('NFQKVKScraperBundle:FacebookEvent')
                ->getByFacebookId($facebook_event_id);
            $this->container->get('doctrine')->getRepository('NFQKVKScraperBundle:UserEvent')
                ->goToEvent($user->getId(), $facebookEvent->getEvent()->getId());
        }

        return $attendResponse;

    }

    public function cancelEvent($facebook_event_id)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $user_access_token = $user->getFacebookAccessToken();

        if (!$user_access_token) {
            return json_encode([
                'message' => 'Not logged in',
                'success' => false
            ]);
        }

        $this->fb->setDefaultAccessToken($user_access_token);

        $attendResponse = null;

        try {
            $attendResponse = $this->fb->post($facebook_event_id . '/declined');
        } catch (FacebookResponseException $ex) {
            return false;
            // @TODO: Log stack trace.
        }

        $attendResponse = $attendResponse->getGraphNode()->asArray();

           if($attendResponse['success'] === true){
        /**
         * @var FacebookEvent $facebookEvent
         */
               $facebookEvent = $this->container->get('doctrine')->getRepository('NFQKVKScraperBundle:FacebookEvent')
                   ->getByFacebookId($facebook_event_id);
               $this->container->get('doctrine')->getRepository('NFQKVKScraperBundle:UserEvent')
                   ->deleteAttendedEvent($user->getId(),$facebookEvent->getEvent()->getId());
          }

        return $attendResponse;

    }

}