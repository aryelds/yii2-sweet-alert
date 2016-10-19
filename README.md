yii2-sweet-alert
=================

Simple way to flash sweet alert messages to the screen. This widget is a wrapper by [SweetAlert Plugin](http://t4t5.github.io/sweetalert/)
 
## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install, either run

```
$ php composer.phar require aryelds/yii2-sweet-alert "@dev"
```

or add

```
"aryelds/yii2-sweet-alert": "@dev"
```

to the ```require``` section of your `composer.json` file.

## Usage

### Basic Message

```php
use aryelds\sweetalert\SweetAlert;

echo SweetAlert::widget([
    'options' => [
        'title' => "Here's a message!"
    ]
]);
```

### A title with a text under
```php
use aryelds\sweetalert\SweetAlert;

echo SweetAlert::widget([
    'options' => [
        'title' => "Here's a message!",
        'text' => "It's pretty, isn't it?"
    ]
]);
```

### Success message
```php
use aryelds\sweetalert\SweetAlert;

echo SweetAlert::widget([
    'options' => [
        'title' => "Good Job!",
        'text' => "You clicked the button!",
        'type' => SweetAlert::TYPE_SUCCESS
    ]
]);

```

### Error message
```php
use aryelds\sweetalert\SweetAlert;

echo SweetAlert::widget([
    'options' => [
        'title' => "Error!",
        'text' => "An error happened!",
        'type' => SweetAlert::TYPE_ERROR
    ]
]);

```

### A warning with "confirm" and "cancel" function
```php
use aryelds\sweetalert\SweetAlert;

echo SweetAlert::widget([
    'options' => [
        'title' => "Are you sure?",
        'text' => "You will not be able to recover this imaginary file!",
        'type' => SweetAlert::TYPE_WARNING,
        'showCancelButton' => true,
        'confirmButtonColor' => "#DD6B55",
        'confirmButtonText' => "Yes, delete it!",
        'cancelButtonText' => "No, cancel plx!",
        'closeOnConfirm' => false,
        'closeOnCancel' => false
    ],
    'callbackJs' => new \yii\web\JsExpression(' function(isConfirm) {
        if (isConfirm) { 
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else { 
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    }')
]);

```

### A replacement for the "prompt" function
```php
use aryelds\sweetalert\SweetAlert;

echo SweetAlert::widget([
    'options' => [
        'title' => "An input!",
        'text' => "Write something interesting:",
        'type' => SweetAlert::TYPE_INPUT,
        'showCancelButton' => true,
        'closeOnConfirm' => false,
        'animation' => "slide-from-top",
        'inputPlaceholder' => "Write something"
    ],
    'callbackJs' => new \yii\web\JsExpression(' function(inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") { 
            swal.showInputError("You need to write something!");
            return false
        }
        swal("Nice!", "You wrote: " + inputValue, "success");
    }')
]);

```

### Html Message
```php
use aryelds\sweetalert\SweetAlert;
use yii\bootstrap\Html;

echo SweetAlert::widget([
    'options' => [
        'title' => Html::tag('small', 'HTML Message!', ['style' => 'color: #00008B']),
        'text' => Html::tag('h2', 'Custom Message'),
        'type' => SweetAlert::TYPE_INFO,
        'html' => true
    ]
]);

```

### Using SweetAlert with flash messages

#### Controller Example
```
public function actionPage() {
    $model = new SomeModel();
    
    Yii::$app->getSession()->setFlash('success', [
        'text' => 'My custom text',
        'title' => 'My custom title',
        'type' => 'success',
        'timer' => 3000,
        'showConfirmButton' => false
    ]);

    return $this->render('page', [
        'model' => $model,
    ]);
}
```

#### The View

```php
use aryelds\sweetalert\SweetAlert;

foreach (Yii::$app->session->getAllFlashes() as $message) {
    echo SweetAlert::widget([
        'options' => [
            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
            'text' => (!empty($message['text'])) ? Html::encode($message['text']) : 'Text Not Set!',
            'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_INFO,
            'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
            'showConfirmButton' =>  (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true
        ]
    ]);
}
```
### Using themes

#### You can select one of the following options: 

```php
SweetAlert::THEME_TWITTER
SweetAlert::THEME_GOOGLE
SweetAlert::THEME_FACEBOOK
```

#### Example:

```php
use aryelds\sweetalert\SweetAlert;

echo SweetAlert::widget([
    'options' => [
        'title' => 'Themes!',
        'text' => 'Here\'s the Twitter theme for SweetAlert!',
        'confirmButtonText' => "Cool!",
        'animation' => 'slide-from-top',
        'theme' => SweetAlert::THEME_TWITTER
    ]
]);
```

## For more options visit the plugin page

[SweetAlert](http://t4t5.github.io/sweetalert/)

## License

**yii2-sweet-alert** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.
