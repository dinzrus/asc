<?php

namespace app\views\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class HelloWidget extends Widget {
    
    public $message;
    
    public function init() {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello Russel';
        }
    }

    public function run() {
        return Html::encode($this->message);
    }

}
