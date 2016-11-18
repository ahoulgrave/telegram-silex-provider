<?php
namespace Telegram\Bot\Silex\Test\Command;

use PHPUnit\Framework\TestCase;
use Silex\Application;
use Telegram\Bot\Api;
use Telegram\Bot\Silex\Provider\TelegramServiceProvider;

class ApplicationAwareCommandTest extends TestCase
{
    /**
     * @test
     */
    public function testAppInjection()
    {
        $app = new Application();
        $app->register(new TelegramServiceProvider(), [
            'telegram.bot_api' => 'testbotapi',
            'telegram.commands' => [
                TestCommand::class
            ]
        ]);
        /* @var $api Api */
        $api = $app['telegram'];
        foreach ($api->getCommands() as $command) {
            $this->assertInstanceOf(Application::class, $command->getApplication());
        }
    }
}
