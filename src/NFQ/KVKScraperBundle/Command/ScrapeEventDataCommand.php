<?php

namespace NFQ\KVKScraperBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScrapeEventDataCommand extends ContainerAwareCommand {

    protected function configure(){
        $this
            ->setName('kvk:scrape:events')
            ->setDescription('Scrape KVK event data by category');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $KVKScraper = $this->getContainer()->get('kvk_scraper');

        $outputText = '';
        $eventCategories = $this->getContainer()->get('doctrine')->getRepository('NFQKVKScraperBundle:EventCategory')->findAll();

        foreach($eventCategories as $eventCategory){

            $scrapedEventsData = $KVKScraper->scrapeEventDataByCategory($eventCategory);

            $outputText .= "Scraped (".count($scrapedEventsData).") events from category\n";

        }

        $output->writeln($outputText);

    }

}