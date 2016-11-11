<?php
/**
 * @file
 * Contains \Drupal\Console\Test\Command\GeneratorControllerCommandTest.
 */

namespace Drupal\Console\Test\Command\Generate;

use Drupal\Console\Test\Builders\a as an;
use Drupal\Console\Command\Generate\ControllerCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Drupal\Core\Routing\RouteProvider;
use Drupal\Console\Utils\StringConverter;
use Drupal\Console\Utils\Validator;
use Drupal\Console\Utils\ChainQueue;
use Drupal\Core\Database\Connection;
use Drupal\Console\Test\DataProvider\ControllerDataProviderTrait;

class ControllerCommandTest extends GenerateCommandTest
{
    use ControllerDataProviderTrait;

    /**
     * Controller generator test
     *
     * @param $module
     * @param $class_name
     * @param $routes
     * @param $test
     * @param $services
     *
     * @dataProvider commandData
     */
    public function testGenerateController(
        $module,
        $class_name,
        $routes,
        $test,
        $services
    ) {
        $manager = an::extensionManager();
        $generator = an::ControllerGenerator();
        $con = an::Connection();
        $command = new ControllerCommand(
          $manager,
          $generator->reveal(),
          new StringConverter(),
          new Validator($manager),
          new RouteProvider($con,),
          new ChainQueue()
        );

        $commandTester = new CommandTester($command);

        $code = $commandTester->execute(
            [
                '--module'            => $module,
                '--class'             => $class_name,
                '--routes'            => $routes,
                '--test'              => $test,
                '--services'          => $services,
            ],
            ['interactive' => false]
        );

        $this->assertEquals(0, $code);
    }
}
