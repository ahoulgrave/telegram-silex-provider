<?php
namespace Telegram\Bot\Silex\Service;

use Pimple\Container;
use Telegram\Bot\Api;

class TelegramService extends Api
{
    /**
     * @var Container
     */
    private $app;

    public function __construct(Container $app, $token = null, $async = false, $http_client_handler = null)
    {
        parent::__construct($token, $async, $http_client_handler);
        $this->app = $app;
    }

    /**
     * @param string $command
     * @return \Telegram\Bot\Commands\CommandBus
     */
    public function addCommand($command)
    {
        return parent::addCommand(new $command($this->app));
    }
}
