# JBuilderBundle [![Build Status](https://travis-ci.org/dakatsuka/JBuilderBundle.svg?branch=master)](https://travis-ci.org/dakatsuka/JBuilderBundle)

Symfony2/Symfony3 Bundle for JBuilder

## Installation

Add this lines to your composer.json:

```json
{
    "require": {
        "jbuilder/jbuilder-bundle": "~1.0"
    }
}
```

And then execute:

```bash
$ php composer.phar install
```

And import a JBuilderBundle to AppKernel.php:

```php
$bundles = array(
    new JBuilder\JBuilderBundle\JBuilderJBuilderBundle(),
);
```

## Usage

Insert the following code to controller:

```php
public function indexAction()
{
    $posts = $this->getDoctrine()->getRepository('Acme\BlogBundle\Entity\Post')->findAll();

    return $this->get('jbuilder')->render('AcmeBlogBundle:Post:index.json.php', array('posts' => $posts));
}
```

src/Acme/BlogBundle/Resources/views/Post/index.json.php:

```php
$json->buildArray($posts, function($json, $post) {
    $json->id    = $post->getId();
    $json->title = $post->getTitle();
});
```

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request

## Copyright

Copyright (C) 2016 Dai Akatsuka, released under the MIT License.
