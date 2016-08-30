<?php

namespace NFQ\KVKScraperBundle\Services;

use Goutte\Client;
use NFQ\KVKScraperBundle\Entity\EventCategory;
use NFQ\KVKScraperBundle\Entity\EventData;
use NFQ\KVKScraperBundle\Entity\FacebookEvent;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DomCrawler\Crawler;


class KVKScraper {

    private $container;

    private $mainUrl = 'http://renginiai.kasvyksta.lt/kaunas';

    /**
     * @param ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function scrapeEventCategories()
    {

        $crawler = (new Client())->request('GET', $this->mainUrl);

        $eventCategories = $crawler->filter('.accordion-content .types li a')->each(function (Crawler $node) {
            $eventCategory = new EventCategory();
            $eventCategory->setCategoryName(trim($node->text()));
            $eventCategory->setCategoryUrl('http://renginiai.kasvyksta.lt'.$node->attr('href'));

            return $eventCategory;
        });

        $this->container->get('doctrine')->getRepository('NFQKVKScraperBundle:EventCategory')
            ->saveCategories($eventCategories);

        return $eventCategories;

    }

    /**
     * @param EventCategory $category
     * @return array
     */
    public function scrapeEventDataByCategory($category)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $crawler = (new Client())->request('GET', $category->getCategoryUrl());

        $eventsData = $crawler->filter('.block-wrap .block-body a')->each(function(Crawler $node) use ($category, $em) {
            if($node->first()->attr('itemprop')) {
                $eventData = new EventData();

                $eventData->setEventCategory($category);
                $eventData->setEventUrl('http://renginiai.kasvyksta.lt'.$node->first()->attr('href'));

                $eventData = $this->getAllEventData($eventData);
                $facebookEvent = $eventData->getFacebookEvent();
                if($facebookEvent) {
                    if($facebookEvent->getfacebookEventId()) {
                        $em->persist($eventData);
                    }
                }
                return $eventData;
            }

        });

        $em->flush();

        return $eventsData;
    }

    /**
     * @param EventData $eventData
     * @return EventData
     */
    public function getAllEventData($eventData){

        $crawler = (new Client())->request('GET', $eventData->getEventUrl());

        $eventData->setEventName($crawler->filter('.page-title')->text());
        $count = $crawler->filter('.info-facebook')->count();


        if($count > 0){

            preg_match_all("/https:\/\/www.facebook.com\/events\/([0-9]+)\/?.*?/", $crawler->filter('.info-facebook .info-text')->html(), $matches);
            if (isset($matches[1]) AND count($matches[1]) > 0) {
                $facebookEventId = reset($matches[1]);
                $facebookEvent = new FacebookEvent();
                $facebookEvent->setFacebookEventId($facebookEventId);
                $eventData->setFacebookEvent($facebookEvent);
                // @TODO: add additional fields to scraper.
            }
        }

        $eventData->setEventImageUrl('http://renginiai.kasvyksta.lt'.$crawler->filter('.main-gallery .thumbnail a.fancybox')->first()->attr('href'));
        return $eventData;
    }

}