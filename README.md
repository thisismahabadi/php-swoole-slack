## Introduction

This is a simple application to interact with Slack which is written in PHP and using Swoole framework.

## Please Note

Make sure that you've already installed swoole. you can use [this link](https://www.swoole.co.uk/) to do it.

## Usage

In order to run it, at the first you need to change the token property with yours in the file `BaseModel.php` located in `src` folder.

and then you can run it in root folder by php built-in web server like this:

```bash
php -S localhost:8000
```

or any ports you would like.

and to use a real-time sending and replying to messages, be sure to open their sockets with these commands from root folder:

```bash
php src/sockets/SendMessage.php
php src/sockets/ReplyMessage.php
php src/sockets/DeleteMessage.php
```

if you freaked out what is the reason to run these commands, you can also easily run them in [supervisor](http://supervisord.org/) without running each seprately by putting them in supervisor configuration.

## Provided Features

- Tokens and Authentication
- Sending message
- Replying to messages and creating threads
- Deleting a message
- Getting a list of channels
- Getting a channel's info
- Joining a channel
- Leaving a channel

### It also looks like this:

- Channels List

![Channels List](/doc/images/channels-list.png)

- Channel Messages

![Channel Messages](/doc/images/channel-messages.png)

- Real-Time Messaging

<p align="center">
    <img src="/doc/gifs/real-time-messaging.gif" alt="real-time-messaging" />
</p>

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.
