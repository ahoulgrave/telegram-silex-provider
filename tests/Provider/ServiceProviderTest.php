<?php
namespace Provider;

use PHPUnit\Framework\TestCase;
use Silex\Application;
use Telegram\Bot\Silex\Provider\TelegramServiceProvider;
use Telegram\Bot\Silex\Service\TelegramService;

class ServiceProviderTest extends TestCase
{
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage telegram.bot_api parameter must be set.
     */
    public function testNoConfig()
    {
        $app = new Application();
        $app->register(new TelegramServiceProvider());
        $app['telegram'];
    }

    /**
     * @test
     */
    public function testCommandCount()
    {
        $app = new Application();
        $app->register(new TelegramServiceProvider(), [
            'telegram.bot_api' => 'testapicode'
        ]);
        $this->assertInstanceOf(TelegramService::class, $app['telegram']);
    }
}
