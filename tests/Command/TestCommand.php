<?php
namespace Telegram\Bot\Silex\Test\Command;

use Telegram\Bot\Silex\Command\ApplicationAwareCommand;

class TestCommand extends ApplicationAwareCommand
{
    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        return;
    }
}
