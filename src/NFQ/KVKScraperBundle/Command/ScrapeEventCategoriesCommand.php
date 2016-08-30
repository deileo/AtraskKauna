<?php

namespace NFQ\KVKScraperBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScrapeEventCategoriesCommand extends ContainerAwareCommand {

    protected function configure(){
        $this
            ->setName('kvk:scrape:categories')
            ->setDescription('Scrape KVK event categories');
    }

    protected function execute(InputInterface $input, OutputInterface $output){

        $KVKScraper = $this->getContainer()->get('kvk_scraper');

        $scrapedEventCategories = $KVKScraper->scrapeEventCategories();

        $outputText = 'Category scrape failed.';

        if(($countScraped = count($scrapedEventCategories)) > 0){
            $outputText = "Scraped ($countScraped) categories";
        }

        $output->writeln($outputText);

    }

}