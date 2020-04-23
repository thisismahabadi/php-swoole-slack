## Introduction

This is a simple application to interact with Slack which is written in PHP and using Swoole framework.

## Usage

In order to run it, at the first you need to change the token property with yours in the file `BaseModel.php` located in `src` folder.

and then you can run it in root folder by php built-in web server like this:

```bash
php -S localhost:8000
```

or any ports you would like.

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

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.