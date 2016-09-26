<?php
/**
 * Command to add a Oauth Client to be able to generate tokens for authentication via FOSOAuthServerBundle
 */
namespace ApiBundle\Console\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OauthClientCommand extends ContainerAwareCommand {
  protected function configure() {
    $this
      ->setName('oauth:client:create')
      ->setDescription('Create a new oauth client using FOSOAuthServerBundle')
      ->addOption('redirect-uri', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Sets the redirect uri. Use multiple times to set multiple uris.', null)
      ->addOption('grant-type', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Set allowed grant type. Use multiple times to set multiple grant types', null)
      ->setHelp("The <info>%command.name%</info>command creates a new client.<info>php %command.full_name% [--redirect-uri=...] [--grant-type=...] name</info>");
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
    $client = $clientManager->createClient();
    $client->setRedirectUris($input->getOption('redirect-uri'));
    $client->setAllowedGrantTypes($input->getOption('grant-type'));
    $clientManager->updateClient($client);
    $output->writeln(
      sprintf(
        'Added a new client with public id <info>%s</info>, secret <info>%s</info>',
        $client->getPublicId(),
        $client->getSecret()
      )
    );
  }
}
