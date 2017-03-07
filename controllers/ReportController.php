<?php

namespace app\controllers;

use kartik\mpdf\Pdf;

class ReportController extends \yii\web\Controller {
    
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionSfr() {

        // set response header
        \yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        \yii::$app->response->headers->add('Content-Type', 'application/pdf');
        
        
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_privacy');

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_LETTER,
            // set filename
            'filename' => 'sfr',
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // set margins
            'marginLeft' => 5,
            'marginRight' => 5,
            'marginBottom' => 5,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Schedule For Releasing'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['Schedule For Releasing'. ' - '. date('M/d/Y')],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

}
