<?php
namespace Telegram\Bot\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Telegram\Bot\Silex\Service\TelegramService;

class TelegramServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $app['telegram'] = function () use ($app) {
            if (!isset($app['telegram.bot_api'])) {
                throw new \Exception('telegram.bot_api parameter must be set.');
            }
            $botApi = new TelegramService($app, $app['telegram.bot_api']);
            if (
                isset($app['telegram.commands'])
                && is_array($app['telegram.commands'])
            ) {
                foreach ($app['telegram.commands'] as $command) {
                    $botApi->addCommand($command);
                }
            }
            return $botApi;
        };
    }
}
