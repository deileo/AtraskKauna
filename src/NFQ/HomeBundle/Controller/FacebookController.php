<?php

namespace NFQ\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class FacebookController extends Controller
{

    public function attendEventAction($facebook_event_id){

        return new JsonResponse($this->get('facebook_event_manager')->attendEvent($facebook_event_id));

    }

    public function cancelEventAction($facebook_event_id)
    {
        return new JsonResponse($this->get('facebook_event_manager')->cancelEvent($facebook_event_id));
    }
}
