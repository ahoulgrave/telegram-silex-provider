<?php
namespace Telegram\Bot\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Application;
use Telegram\Bot\Api;

class TelegramServiceProvider implements ServiceProviderInterface, BootableProviderInterface
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
            $botApi = new Api($app['telegram.bot_api']);
            if (
                isset($app['telegram.commands'])
                && is_array($app['telegram.commands'])
            ) {
                foreach ($app['telegram.commands'] as $command) {
                    $botApi->addCommand(new $command($app));
                }
            }
            $app['telegram.controller_path'] = isset($app['telegram.controller_path']) ? $app['telegram.controller_path'] : '/telegram';
            return $botApi;
        };
    }

    /**
     * @inheritdoc
     */
    public function boot(Application $app)
    {
        if ($app['telegram.controller_path']) {
            $app->mount($app['telegram.controller_path'], new TelegramControllerProvider());
        }
    }
}
