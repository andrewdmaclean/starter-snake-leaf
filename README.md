# Battlesnake Leaf PHP Starter Project

An unofficial Battlesnake template written in PHP using the Leaf PHP framework. Get started at [play.battlesnake.com](https://play.battlesnake.com).

This project is a great starting point for anyone wanting to program their first Battlesnake in PHP. It can be run locally or easily deployed to a cloud provider of your choosing. See the [Battlesnake API Docs](https://docs.battlesnake.com/api) for more detail.

## Technologies Used

This project uses [PHP](https://www.php.net/) and [Leaf PHP](https://leafphp.dev/).

## Run Your Battlesnake

Install dependencies using Composer:

```sh
composer install
```

Start your Battlesnake:

```sh
php -S localhost:8000
```

You should see the following output once it is running:

```sh
PHP 7.x.x Development Server started at http://localhost:8000
```

Open [localhost:8000](http://localhost:8000) in your browser and you should see:

```json
{
  "apiversion": "1",
  "author": "",
  "color": "#888888",
  "head": "default",
  "tail": "default"
}
```

## Play a Game Locally

Install the [Battlesnake CLI](https://github.com/BattlesnakeOfficial/rules/tree/main/cli):

- You can [download compiled binaries here](https://github.com/BattlesnakeOfficial/rules/releases)
- Or [install as a Go package](https://github.com/BattlesnakeOfficial/rules/tree/main/cli#installation) (requires Go 1.18 or higher)

Command to run a local game:

```sh
battlesnake play -W 11 -H 11 --name 'PHP Starter Project' --url http://localhost:8000 -g solo --browser
```

## Next Steps

Continue with the [Battlesnake Quickstart Guide](https://docs.battlesnake.com/quickstart) to customize and improve your Battlesnake's behavior.

**Note:** To play games on [play.battlesnake.com](https://play.battlesnake.com), you'll need to deploy your Battlesnake to a live web server or use a port forwarding tool like [ngrok](https://ngrok.com/) to access your server locally.
