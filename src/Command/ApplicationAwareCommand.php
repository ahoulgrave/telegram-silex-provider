<?php
namespace Telegram\Bot\Silex\Command;

use Silex\Application;
use Telegram\Bot\Commands\Command as TelegramCommand;

abstract class ApplicationAwareCommand extends TelegramCommand
{
    /**
     * @var Application
     */
    protected $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }
}
