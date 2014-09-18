Eye4webZfcUserWarnings
==========
[![Build Status](https://travis-ci.org/Eye4web/Eye4webZfcUserWarnings.svg?branch=master)](https://travis-ci.org/Eye4web/Eye4webZfcUserWarnings)
[![Latest Stable Version](https://poser.pugx.org/eye4web/eye4web-zfc-user-Warnings/v/stable.svg)](https://packagist.org/packages/eye4web/eye4web-zfc-user-warnings)
[![Latest Unstable Version](https://poser.pugx.org/eye4web/eye4web-zfc-user-Warnings/v/unstable.svg)](https://packagist.org/packages/eye4web/eye4web-zfc-user-warnings)
[![Code Climate](https://codeclimate.com/github/Eye4web/Eye4webZfcUserWarnings/badges/gpa.svg)](https://codeclimate.com/github/Eye4web/Eye4webZfcUserWarnings)
[![Test Coverage](https://codeclimate.com/github/Eye4web/Eye4webZfcUserWarnings/badges/coverage.svg)](https://codeclimate.com/github/Eye4web/Eye4webZfcUserWarnings)
[![Total Downloads](https://poser.pugx.org/eye4web/eye4web-zfc-user-Warnings/downloads.svg)](https://packagist.org/packages/eye4web/eye4web-zfc-user-warnings)
[![License](https://poser.pugx.org/eye4web/eye4web-zfc-user-Warnings/license.svg)](https://packagist.org/packages/eye4web/eye4web-zfc-user-warnings)

Introduction
==========
This module will allow you to give your users warnings.

Installation
------------
#### With composer

1. Add this project composer.json:

    ```json
    "require": {
        "eye4web/eye4web-zfc-user-Warnings": "dev-master"
    }
    ```

2. Now tell composer to download the module by running the command:

    ```bash
    php composer.phar update
    ```

3. Enable it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'Eye4web\ZfcUser\Warnings'
        ),
        // ...
    );
    ```
