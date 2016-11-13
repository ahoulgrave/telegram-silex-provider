<?php
namespace Telegram\Bot\Silex\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class TelegramControllerProvider implements ControllerProviderInterface
{
    /**
     * @inheritdoc
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];
        $controllers->post('/', function() use ($app) {
            $app['telegram']->commandsHandler(true);
            return new Response();
        });
        return $controllers;
    }
}
