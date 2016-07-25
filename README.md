# Tecnocen Yii2 Bootstrap Year Calendar

[![Latest Stable Version](https://poser.pugx.org/tecnocen/yii2-bootstrap-year-calendar/v/stable)](https://packagist.org/packages/tecnocen/yii2-bootstrap-year-calendar) [![Total Downloads](https://poser.pugx.org/tecnocen/yii2-bootstrap-year-calendar/downloads)](https://packagist.org/packages/tecnocen/yii2-bootstrap-year-calendar) [![Latest Unstable Version](https://poser.pugx.org/tecnocen/yii2-bootstrap-year-calendar/v/unstable)](https://packagist.org/packages/tecnocen/yii2-bootstrap-year-calendar) [![License](https://poser.pugx.org/tecnocen/yii2-bootstrap-year-calendar/license)](https://packagist.org/packages/tecnocen/yii2-bootstrap-year-calendar)

Extra utilities for REST in yii2

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
composer require --prefer-dist "faryshta/yii2-rest-extras:*"
```

or add

```
"faryshta/yii2-rest-extras": "*"
```

to the `require` section of your `composer.json` file.

## Usage

### Options Action

The options action class `faryshta\rest\actions\Options` returns the same
headers as `yii\rest\ActionOptions` and it also returns a body with a
deconstructed description of the model.

This action is meant to be used in the `actions()` method on a controller

```php
use faryshta\rest\actions\Options;

public function actions()
{
    return [
        'options' => [
            'class' => Options::className(),
            'modelClas' => $this->modelClass,
            'extraData' => function ($model) {
                // array with the extra data you want to return.
            },
        ]
    ]
}
```

## License

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.
