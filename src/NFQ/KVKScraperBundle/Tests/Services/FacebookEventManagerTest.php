<?php
/**
 * Created by PhpStorm.
 * User: deile
 * Date: 2015-12-03
 * Time: 17:43
 */

class FacebookEventManagerTest extends PHPUnit_Framework_TestCase {
    /*
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
        } catch(\Facebook\Exceptions\FacebookResponseException $ex){
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

                if($facebookEventPlaceLoc->getField('latitude') AND $facebookEventPlaceLoc->getField('longitude')){
                    $facebookEvent->setLatitude($facebookEventPlaceLoc->getField('latitude'));
                    $facebookEvent->setLongitude($facebookEventPlaceLoc->getField('longitude'));
                }
            }

            $facebookEvent->setStreet(implode(', ', $street));
        }

        $this->em->persist($facebookEvent);
        $this->em->flush($facebookEvent);
    }
    */


}
