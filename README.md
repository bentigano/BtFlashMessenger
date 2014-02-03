# BtFlashMessenger - ZF2 Flash Messenger Module

Version 1.0 Created by [Benjamin Tigano](http://benjamin-t.com/)

## Introduction

This ZF2 module eases the use of the [ZF2 Flash Messenger](http://framework.zend.com/manual/2.2/en/modules/zend.view.helpers.flash-messenger.html) with the alerts displayed as a [dismissable Bootstrap alert](http://getbootstrap.com/components/#alerts).

## Installation

To install BtFlashMessenger, recursively clone this repository (`git clone
--recursive`) into your ZF2 modules directory or download and extract into
your ZF2 modules directory.

## Enable the module

Once you've installed the module, you need to enable it. You can do this by 
adding it to your `config/application.config.php` file:

```php
<?php
return array(
    'modules' => array(
        'Application',
        'BtFlashMessenger',
    ),
);
```

## Usage

Simply invoke the `fm` controller plugin:

```php
$this->fm('An action occured!'); // defaults to a success alert message
$this->fm('Something cool happened!', 'warning'); // optionally define the type of alert message
```

## License

BtFlashMessenger is released under a New BSD license. See the included LICENSE file.
