# Telegram PHP SDK Silex Service Provider

A Silex service provider to integrate the Telegram PHP SDK with Silex

### <a name="requirements">Requirements</a>

 - [Silex 2+](http://silex.sensiolabs.org/)
 - [Telegram Bot API PHP SDK](https://telegram-bot-sdk.readme.io/)

### <a name="installation">Installation</a>

```
composer require ahoulgrave/silex-tg-service-provider dev-master
```

### <a name="usage">Usage</a>

```php
<?php
use Telegram\Bot\Silex\Provider\TelegramServiceProvider;

$app = new Silex\Application();

$app->register(new TelegramServiceProvider(), [
    'telegram.bot_api' => '<Your bot api token>',
    'telegram.commands' => [
        \My\Telegram\Command\AwesomeCommand::class,
    ]
]);
```

### <a name="webhook">Webhook</a>

If your are using a webhook to fetch the updates, you can register the Controller Provider to handle the request for you.

```php
$app->mount('/telegram-web-hook', new TelegramControllerProvider());
```

Now, when telegram sends you the updates,  the controller will look for the right command and handle it.

### <a name="commands">Commands</a>

You can extend the `Telegram\Bot\Silex\ApplicationAwareCommand` class, so your command can access the container.

For example:

```php
<?php
namespace My\Telegram\Command;

use Telegram\Bot\Silex\ApplicationAwareCommand;

class AwesomeCommand extends ApplicationAwareCommand
{
    /**
     * @inheritdoc
     */
    protected $name = 'start';

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $update = $this->getUpdate();
        $app = $this->getApplication();
        $app['monolog']->info($update->getMessage()->getText());
        $this->replyWithMessage(['text' => 'Hi there!']);
    }
}

```

Remember to register all of your commands (see [Usage](#usage))

[Read this for more details on the commands system](https://telegram-bot-sdk.readme.io/docs/commands-system)

### <a name="more-information">More information</a>

 - [Telegram Bot API](https://core.telegram.org/bots/api)
 - [Telegram Bot API PHP SDK Documentation](https://telegram-bot-sdk.readme.io/)
 - [Silex Service Providers Documentation](http://silex.sensiolabs.org/doc/master/providers.html)

### <a name="license">License</a>

(The MIT License)

Copyright (C) 2016 by [Agustin Houlgrave](mailto:a.houlgrave@gmail.com)
