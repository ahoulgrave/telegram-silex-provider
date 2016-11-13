<?php
namespace Telegram\Bot\Silex\Command;

use Silex\Application;
use Telegram\Bot\Commands\Command;

abstract class ApplicationAwareCommand extends Command
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
