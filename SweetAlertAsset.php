<?php
/**
 * @link      https://github.com/aryelds/yii2-sweet-alert
 * @copyright Copyright (c) 2016 Aryel Santos
 * @license   https://github.com/aryelds/yii2-sweet-alert/blob/master/LICENSE
 */

namespace aryelds\sweetalert;

use yii\web\AssetBundle;

/**
 * Asset bundle for Sweet Alert
 *
 * @author Aryel Santos <aryel.ds@gmail.com>
 */

class SweetAlertAsset extends AssetBundle
{
    /**
     * @var string the directory that contains the source asset files.
     */
    public $sourcePath = '@bower/sweetalert';

    /**
     * @var array list of JavaScript files.
     */
    public $js = [
        'dist/sweetalert.min.js',
    ];

    /**
     * @var array list of CSS files.
     */
    public $css = [
        'dist/sweetalert.css'
    ];

    /**
     * Adds a Sweet Alert theme CSS file
     *
     * @param string $theme the theme name
     *
     * @return object instance
     */
    public function addTheme($theme)
    {
        $this->css[] = "themes/{$theme}/{$theme}.css";
        return $this;
    }
}