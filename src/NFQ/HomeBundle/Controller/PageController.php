<?php

namespace NFQ\HomeBundle\Controller;

use NFQ\KVKScraperBundle\Entity\FacebookEvent;
use NFQ\KVKScraperBundle\Entity\UserEvent;
use NFQ\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class PageController extends Controller
{

    public function indexAction()
    {
        $events = $this->getDoctrine()->getRepository('NFQKVKScraperBundle:EventData')->getAllEventsWithFacebookId();

        $categories = $this->getCategories();

        return $this->render('NFQHomeBundle:Page:index.html.twig', compact('events', 'categories'));
    }

    public function categoriesAction($categoryId)
    {
        $categories = $this->getCategories();
        $category = $this->getDoctrine()
            ->getRepository('NFQKVKScraperBundle:EventCategory')
            ->getCategoryWithFacebookEvent($categoryId);

        return $this->render('NFQHomeBundle:Page:categories.html.twig', compact('category', 'categories'));
    }

    public function ClosestAction($time)
    {
        $categories = $this->getCategories();
        $today = date("Y-m-d");
        if($time == 'today') {
            $events = $this->getDoctrine()->getRepository('NFQKVKScraperBundle:EventData')->getTodaysEvents($today);
        }else if($time == 'week'){
            $date = date("Y-m-d",strtotime("+1 week"));
            $events= $this->getDoctrine()->getRepository('NFQKVKScraperBundle:EventData')->getWeeksEvents($date,$today);
        }

        return $this->render('NFQHomeBundle:Page:closest.html.twig', compact('events','categories'));
    }

    public function EventInfoAction($facebookEventId)
    {
        $categories = $this->getCategories();
        /**
         * @var FacebookEvent $facebookEvent
         */
        $facebookEvent = $this->getDoctrine()->getRepository('NFQKVKScraperBundle:FacebookEvent')->findOneByFacebookEventId($facebookEventId);

        $event_id = $facebookEvent->getEvent()->getId();
        $is_current_user_going = false;
        $user = $this->getUser();

        if($user){
            /**
             * @var User $user
             */
            $user_id = $user->getId();
            $is_current_user_going = $this->getDoctrine()->getRepository('NFQKVKScraperBundle:UserEvent')
                ->isUserGoingToEvent($user_id, $event_id);
        }

        return $this->render('NFQHomeBundle:Page:EventInfo.html.twig', [
            'Event' => $facebookEvent,
            'categories' => $categories,
            'facebookEventId' => $facebookEventId,
            'isCurrentUserGoing' => $is_current_user_going
        ]);
    }

    private function getCategories()
    {
        return $this->getDoctrine()->getRepository('NFQKVKScraperBundle:EventCategory')->findAll();
    }

}
