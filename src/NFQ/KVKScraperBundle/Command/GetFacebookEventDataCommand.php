<?php

namespace NFQ\KVKScraperBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetFacebookEventDataCommand extends ContainerAwareCommand {

    protected function configure()
    {

        $this
            ->setName('kvk:facebook:events')
            ->setDescription('Get Facebook events according to KVK scraped event data');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->getContainer()->get('facebook_event_manager')->fetchFacebookEvents();

        $outputText = 'Facebook event data fetched';

        $output->writeln($outputText);

    }

}