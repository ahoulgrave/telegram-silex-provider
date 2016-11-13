<?php
use Silex\Application;
use Telegram\Bot\Silex\Command\ApplicationAwareCommand;
use Telegram\Bot\Silex\Provider\TelegramControllerProvider;
use Telegram\Bot\Silex\Provider\TelegramServiceProvider;

require_once __DIR__ . '/../vendor/autoload.php';

class MyCommand extends ApplicationAwareCommand
{
    /**
     * @inheritdoc
     */
    protected $name = 'hello';

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $app = $this->getApplication();
        $update = $this->getUpdate();
    }
}

$app = new Application();
$app->register(new TelegramServiceProvider(), [
    'telegram.bot_api' => '<test>',
    'telegram.commands' => [
        MyCommand::class
    ]
]);

$app->mount('/telegram', new TelegramControllerProvider());
