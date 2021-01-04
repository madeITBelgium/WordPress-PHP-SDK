# WordPress API PHP SDK
# PHP VAT Library
[![Build Status](https://travis-ci.org/madeITBelgium/WordPress-PHP-SDK.svg?branch=master)](https://travis-ci.org/madeITBelgium/WordPress-PHP-SDK)
[![Coverage Status](https://coveralls.io/repos/github/madeITBelgium/WordPress-PHP-SDK/badge.svg?branch=master)](https://coveralls.io/github/madeITBelgium/WordPress-PHP-SDK?branch=master)
[![Latest Stable Version](https://poser.pugx.org/madeITBelgium/WordPress-PHP-SDK/v/stable.svg)](https://packagist.org/packages/madeITBelgium/WordPress-PHP-SDK)
[![Latest Unstable Version](https://poser.pugx.org/madeITBelgium/WordPress-PHP-SDK/v/unstable.svg)](https://packagist.org/packages/madeITBelgium/WordPress-PHP-SDK)
[![Total Downloads](https://poser.pugx.org/madeITBelgium/WordPress-PHP-SDK/d/total.svg)](https://packagist.org/packages/madeITBelgium/WordPress-PHP-SDK)
[![License](https://poser.pugx.org/madeITBelgium/WordPress-PHP-SDK/license.svg)](https://packagist.org/packages/madeITBelgium/WordPress-PHP-SDK)

# Installation

Require this package in your `composer.json` and update composer.

```php
"madeitbelgium/wordpress-php-sdk": "^1.1"
```
Or
```php
composer require madeitbelgium/wordpress-php-sdk
```

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

```php
MadeITBelgium\WordPress\WordPressServiceProvider::class,
```

You can use the facade for shorter code. Add this to your aliases:

```php
'WP' => MadeITBelgium\WordPress\WordPressFacade::class,
```

# Documentation
## Authentication
To use authenticated requests you have to sign in to the WordPress website to generate a JWT token. WordPress doesn't support this by default, you have to install a JWT compatible plugin. This package is tested with: https://nl.wordpress.org/plugins/jwt-authentication-for-wp-rest-api/
```php
use MadeITBelgium\WordPress\WordPressFacade as WordPress;
$token = WordPress::login($request->get('email'), $request->get('password'));
// {'token': '...'}
```
Now you can save the `$token->token` to your database.
```
use MadeITBelgium\WordPress\WordPressFacade as WordPress;
WordPress::setAccessToken($token);
```

## Interact with objects
### User
WordPress Rest API documentation: https://developer.wordpress.org/rest-api/reference/users/

```
use MadeITBelgium\WordPress\WordPressFacade as WordPress;
$users = WordPress::user()->list();
$result = WordPress::user()->create($data);
$user = WordPress::user()->get($id);
$result = WordPress::user()->update($id, $data);
$result = WordPress::user()->delete($id);
```

### Post
WordPress Rest API documentation: https://developer.wordpress.org/rest-api/reference/posts/

```
use MadeITBelgium\WordPress\WordPressFacade as WordPress;
$users = WordPress::post()->list();
$result = WordPress::post()->create($data);
$user = WordPress::post()->get($id);
$result = WordPress::post()->update($id, $data);
$result = WordPress::post()->delete($id);
```

### Post from custom post type

WordPress Rest API documentation: https://developer.wordpress.org/rest-api/reference/posts/

```
use MadeITBelgium\WordPress\WordPressFacade as WordPress;
$users = WordPress::customPost('custom_post_type')->list();
$result = WordPress::customPost('custom_post_type')->create($data);
$user = WordPress::customPost('custom_post_type')->get($id);
$result = WordPress::customPost('custom_post_type')->update($id, $data);
$result = WordPress::customPost('custom_post_type')->delete($id);
```

### Tags

WordPress Rest API documentation: https://developer.wordpress.org/rest-api/reference/tags/

```
use MadeITBelgium\WordPress\WordPressFacade as WordPress;
$users = WordPress::tag()->list();
$result = WordPress::tag()->create($data);
$user = WordPress::tag()->get($id);
$result = WordPress::tag()->update($id, $data);
$result = WordPress::tag()->delete($id);
```

### Create new post
```
$data = [
    'title' => 'title',
    'parent' => 0,
    'slug' => Str::slug('title', '-'),
    'content' => 'content',
];
$post = WordPress::post()->create($data);
// {'id': ...}
```

### Uploading media
```
use Illuminate\Support\Facades\Storage;
use MadeITBelgium\WordPress\WordPressFacade as WordPress;

$media = WordPress::postCall('/wp-json/wp/v2/media', [
    'multipart' => [
        [
            'name' => 'file',
            'contents' => Storage::disk('local')->get($fileLocation),
            'filename' => 'filename.jpg',
        ],
        [
            'name' => 'title',
            'contents' => 'Title of attachment',
        ],
        [
            'name' => 'alt_text',
            'contents' => 'Alt text',
        ],
    ],
]);
```


## Execute any request
Read more about the WordPress rest API: https://developer.wordpress.org/rest-api/
### Get
```
$url = "";
$result = WordPress::getCall('/wp-json'.$url);
```

### Put
```
$result = WordPress::putCall('/wp-json'.$url, $data);
```

### Post
```
$result = WordPress::postCall('/wp-json'.$url, $data);
```

### Delete
```
$result = WordPress::deleteCall('/wp-json'.$url);
```


The complete documentation can be found at: [https://www.tpweb.org/my-projects/wordpress-php-sdk/](https://www.tpweb.org/my-projects/wordpress-php-sdk/)

# Support

Support github or mail: tjebbe.lievens@madeit.be

# Contributing

Please try to follow the psr-2 coding style guide. http://www.php-fig.org/psr/psr-2/

# License

This package is licensed under LGPL. You are free to use it in personal and commercial projects. The code can be forked and modified, but the original copyright author should always be included!
