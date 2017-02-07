<?php

/**
 * @file
 * Contains \Drupal\Console\Command\Generate\AuthenticationProviderCommand.
 */

namespace Drupal\Console\Command\Generate;

use Drupal\Console\Command\Generate\Questions\AuthenticationProviderQuestions;
use Drupal\Console\Command\Generate\Questions\ConfirmGeneration;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Drupal\Console\Generator\AuthenticationProviderGenerator;
<<<<<<< HEAD
use Drupal\Console\Command\Shared\CommandTrait;
=======
use Drupal\Console\Command\Shared\ConfirmationTrait;
use Drupal\Console\Core\Style\DrupalStyle;
use Drupal\Console\Core\Command\Shared\CommandTrait;
use Drupal\Console\Core\Utils\StringConverter;
use Drupal\Console\Extension\Manager;
>>>>>>> hechoendrupal/master

class AuthenticationProviderCommand extends Command
{
    use CommandTrait;

<<<<<<< HEAD
    /** @var AuthenticationProviderGenerator */
=======
    /**
 * @var Manager
*/
    protected $extensionManager;

    /**
 * @var AuthenticationProviderGenerator
*/
>>>>>>> hechoendrupal/master
    protected $generator;

    /** @var AuthenticationProviderQuestions */
    private $questions;

    /** @var ConfirmGeneration */
    private $confirmation;

    /**
     * AuthenticationProviderCommand constructor.
<<<<<<< HEAD
=======
     *
     * @param Manager                         $extensionManager
>>>>>>> hechoendrupal/master
     * @param AuthenticationProviderGenerator $generator
     * @param AuthenticationProviderQuestions $questions
     * @param ConfirmGeneration $confirmation
     */
    public function __construct(
        AuthenticationProviderGenerator $generator,
        AuthenticationProviderQuestions $questions,
        ConfirmGeneration $confirmation
    ) {
        $this->generator = $generator;
        $this->questions = $questions;
        $this->confirmation = $confirmation;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('generate:authentication:provider')
            ->setDescription($this->trans('commands.generate.authentication.provider.description'))
            ->setHelp($this->trans('commands.generate.authentication.provider.help'))
            ->addOption('module', '', InputOption::VALUE_REQUIRED, $this->trans('commands.common.options.module'))
            ->addOption(
                'class',
                '',
                InputOption::VALUE_OPTIONAL,
                $this->trans('commands.generate.authentication.provider.options.class')
            )
            ->addOption(
                'provider-id',
                '',
                InputOption::VALUE_OPTIONAL,
                $this->trans('commands.generate.authentication.provider.options.provider-id')
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->confirmation->confirm()) {
            return;
        }

        $this->generator->generate(
            $input->getOption('module'),
            $input->getOption('class'),
            $input->getOption('provider-id')
        );
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!($input->getOption('module'))) {
            $input->setOption('module', $this->questions->askForModule());
        }

        if (!($input->getOption('class'))) {
            $input->setOption('class', $this->questions->askForClass());
        }

        if (!($input->getOption('provider-id'))) {
            $input->setOption(
                'provider-id',
                $this->questions->askForProviderId($input)
            );
        }
    }
}
