<?php
/**
 * @link      https://github.com/aryelds/yii2-sweet-alert
 * @copyright Copyright (c) 2016 Aryel Santos
 * @license   https://github.com/aryelds/yii2-sweet-alert/blob/master/LICENSE
 */

namespace aryelds\sweetalert;

use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Simple way to flash sweet alert messages to the screen.
 *
 * @author Aryel Santos <aryel.ds@gmail.com>
 */
class SweetAlert extends Widget
{
    const TYPE_BASIC = 'basic';
    const TYPE_INFO = 'info';
    const TYPE_INPUT = 'input';
    const TYPE_SUCCESS = 'success';
    const TYPE_ERROR = 'error';
    const TYPE_WARNING = 'warning';

    const THEME_FACEBOOK = 'facebook';
    const THEME_GOOGLE = 'google';
    const THEME_TWITTER = 'twitter';

    /**
     * @var string the title of the modal.
     */
    public $title = 'Your´s message here';

    /**
     * @var string the description of the modal.
     */
    public $text = '';

    /**
     * @var string javascript callBack
     */
    public $callbackJs = '';

    /**
     * @var string the type of the alert to be displayed. One of the `TYPE_` constants.
     *
     * Defaults to `TYPE_BASIC`
     */
    public $type = self::TYPE_BASIC;

    /**
     * Initializes the widget
     */
    public function init()
    {
        parent::init();
        $this->initOptions();
    }

    /**
     * Initializes the widget options.
     * This method sets the default values for various options.
     */
    protected function initOptions()
    {
        $this->registerAssets();
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();

        if (isset($this->options['theme']) && ($theme = $this->options['theme']) != null) {
            SweetAlertAsset::register($view)->addTheme($theme);
        } else {
            SweetAlertAsset::register($view);
        }

        if (count($this->options) > 1) {
            $this->checkTitle();
            $callBackJs = (!empty($this->callbackJs)) ? ",{$this->callbackJs}" : null;
            $js = 'swal(' . Json::encode($this->options) . $callBackJs . ' );';
            $view->registerJs($js, $view::POS_END);
        }
    }

    /**
     * Check if title is empty
     *
     * @throws InvalidConfigException
     */
    public function checkTitle()
    {
        if (ArrayHelper::getValue($this->options, 'title') === null) {
            throw new InvalidConfigException(Yii::t('app', 'The "title" is required.'));
        }
    }
}