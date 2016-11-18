<?php
namespace Telegram\Bot\Silex\Test\Provider;

use Silex\Application;
use Silex\WebTestCase;
use Telegram\Bot\Silex\Provider\TelegramControllerProvider;
use Telegram\Bot\Silex\Provider\TelegramServiceProvider;

class ControllerProviderTest extends WebTestCase
{
    /**
     * @inheritdoc
     */
    public function createApplication()
    {
        $app = new Application();
        $app->register(new TelegramServiceProvider(), [
            'telegram.bot_api' => 'telegramtestapi'
        ]);
        $app->mount('/telegram-webhook', new TelegramControllerProvider());
        return $app;
    }

    /**
     * @test
     */
    public function testRoute() {
        $client = $this->createClient();
        $client->request('POST', '/telegram-webhook/');
        $this->assertTrue($client->getResponse()->isOk());
    }
}
