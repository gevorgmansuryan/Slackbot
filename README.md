# Slackbot

for sending messages to Slack using Slack Incoming WebHook

example:

```php
<?php
$slackBot = new Gevman\SlackBot\IncomingBot('YOUR_SLACK_HOOK_URL');
$slackBot->send('Hello')->withTitle('Good morning')->to('general');

```