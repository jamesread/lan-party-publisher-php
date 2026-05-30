<div align="center">
  <h1>lan-party-publisher-php</h1>

  A PHP library for the <a href="https://github.com/jamesread/lan-party-publishing-standard">LAN Party Publishing Standard</a>, making it easy to publish machine-readable LAN event data.

[![Maturity Badge](https://img.shields.io/badge/maturity-Production-brightgreen)](#none)
[![Discord](https://img.shields.io/discord/846737624960860180?label=Discord%20Server)](https://discord.gg/jhYWWpNJ3v)

</div>

## Standard version compatibility

Library major versions align with the standard major version:

| Library version | Standard version |
|-----------------|------------------|
| v1.x            | [v1](https://github.com/jamesread/lan-party-publishing-standard/blob/main/lan-party-publishing-standard-v1.schema) |
| v2.x            | [v2](https://github.com/jamesread/lan-party-publishing-standard/blob/main/lan-party-publishing-standard-v2.schema) |

Use v1.x of this library when publishing against standard v1. Use v2.x when publishing against standard v2. See the [standard repository](https://github.com/jamesread/lan-party-publishing-standard) for the specification, JSON schemas, and migration notes. See [CHANGELOG.md](CHANGELOG.md) for library release notes.

## Using the PHP Library

```shell
composer require jamesread/lan-party-publisher-php:^2
```

Look at the [examples](examples) to help get you started. After `composer install`, run an example with:

```shell
php examples/basic.php
```

For a full real-world document matching the standard's reference output, see [examples/pixelPit.php](examples/pixelPit.php) (based on [pixel-pit.json](https://github.com/jamesread/lan-party-publishing-standard/blob/main/example-outputs/pixel-pit.json)).
