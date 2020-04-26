## Introduction

This is a simple mvc application to interact with Slack which is written in PHP and using Swoole framework.

## Please Note

Make sure that you've already installed swoole. you can use [this link](https://www.swoole.co.uk/) to do it.

## Usage

In order to run it, at the first you need to change the token property with yours in the file `BaseModel.php` located in `src/Models` folder.

and then you can run it in root folder by php built-in web server like this:

```bash
php -S localhost:8000
```

or any ports you would like.

and to use a real-time sending and replying to messages, be sure to open their sockets with these commands from root folder:

```bash
php src/Sockets/SendMessage.php
php src/Sockets/ReplyMessage.php
php src/Sockets/DeleteMessage.php
```

If you freaked out why you should to run all of these commands, you can also easily run them in [supervisor](http://supervisord.org/) without running each seprately by putting them in supervisor configuration.

The responses are API like and here the views are seprated and also you can use it in your usecases or you can extend it with your own codes.

Also the project is MVC like and as you can see the layers are seprated into model, view and controller logics located in `src`.

## Provided Features and Routes

- Tokens and Authentication
- Sending message

```bash
[url]/messages/send?channel=[put-channel-id-here]&text=[put-text-here]
```

- Replying to messages and creating threads

```bash
[url]/messages/reply?channel=[put-channel-id-here]&text=[put-text-here]&thread_ts=[put-message-ts-here]
```

- Deleting a message

```bash
[url]/messages/delete?channel=[put-channel-id-here]&ts=[put-message-ts-here]
```

- Getting a list of channels

```bash
[url]/
[url]/channels
```

- Getting a channel's info

```bash
[url]/channels/info?channel=[put-channel-id-here]
```

- Joining a channel

```bash
[url]/channels/join?name=[put-channel-name-here]
```

- Leaving a channel

```bash
[url]/messages/leave?channel=[put-channel-id-here]
```

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
