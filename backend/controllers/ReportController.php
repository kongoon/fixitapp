<?php

namespace backend\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use kartik\mpdf\Pdf;
use Mpdf\Mpdf;


class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReport1()
    {
        $data = Yii::$app->db->createCommand("
            SELECT YEAR(FROM_UNIXTIME(repair_at)) AS y,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 1, 1, 0)) AS m01,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 2, 1, 0)) AS m02,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 3, 1, 0)) AS m03,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 4, 1, 0)) AS m04,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 5, 1, 0)) AS m05,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 6, 1, 0)) AS m06,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 7, 1, 0)) AS m07,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 8, 1, 0)) AS m08,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 9, 1, 0)) AS m09,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 10, 1, 0)) AS m10,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 11, 1, 0)) AS m11,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 12, 1, 0)) AS m12
            FROM job
            WHERE job_status_id = 3
            GROUP BY YEAR(FROM_UNIXTIME(repair_at))
            ORDER BY y DESC
        ")->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data
        ]);
        
        $datasets = [];
        $colors = ['180,180,200', '0,150,200', '100,0,200', '100,0,0', '100,200,0'];
       
        foreach($data as $d){
            $r = rand(0, 4);
            $datasets[] = [
                'label' => $d['y'],
                'backgroundColor' => 'rgba('.$colors[$r].',0.2)',
                'borderColor' => 'rgba('.$colors[$r].',1)',
                'pointBackgroundColor' => 'rgba('.$colors[$r].',1)',
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => 'rgba('.$colors[$r].',1)',
                'data' => [
                    $d['m01'], 
                    $d['m02'], 
                    $d['m03'], 
                    $d['m04'], 
                    $d['m05'], 
                    $d['m06'], 
                    $d['m07'], 
                    $d['m08'], 
                    $d['m09'], 
                    $d['m10'], 
                    $d['m11'], 
                    $d['m12']
                ]
            ];
        }
        return $this->render('report1', [
            'dataProvider' => $dataProvider,
            'datasets' => $datasets
        ]);
    }
    
    public function actionReport1Pdf()
    {
        $content = $this->renderPartial('_pdf');
    
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@web/css/kv-mpdf-bootstrap.css',
            // any css to be embedded if required
            'cssInline' => '.pdf-body{font-family: Garuda;}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
         return $pdf->render(); 
    }
    
    public function actionReport1Pdf2()
    {
        $data = Yii::$app->db->createCommand("
            SELECT YEAR(FROM_UNIXTIME(repair_at)) AS y,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 1, 1, 0)) AS m01,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 2, 1, 0)) AS m02,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 3, 1, 0)) AS m03,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 4, 1, 0)) AS m04,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 5, 1, 0)) AS m05,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 6, 1, 0)) AS m06,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 7, 1, 0)) AS m07,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 8, 1, 0)) AS m08,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 9, 1, 0)) AS m09,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 10, 1, 0)) AS m10,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 11, 1, 0)) AS m11,
            SUM(IF(MONTH(FROM_UNIXTIME(repair_at)) = 12, 1, 0)) AS m12
            FROM job
            WHERE job_status_id = 3
            GROUP BY YEAR(FROM_UNIXTIME(repair_at))
            ORDER BY y DESC
        ")->queryAll();
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => false
        ]);
        
        $content = $this->renderPartial('_pdf', [
            'dataProvider' => $dataProvider
        ]);
        
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'orientation' => 'L',
            'fontDir' => array_merge($fontDirs, [
                Yii::getAlias('@webroot').'/fonts',
            ]),
            'fontdata' => $fontData + [
                'thsarabun' => [
                    'R' => 'THSarabunNew.ttf',
                    //'I' => 'THSarabunNew Italic.ttf',
                    //'B' => 'THSarabunNew Bold.ttf',
                ]
            ],
            'default_font' => 'thsarabun'
        ]);
        
        $style = file_get_contents(Yii::getAlias('@webroot').'/css/kv-mpdf-bootstrap.css');
        $mpdf->SetHTMLFooter('{PAGENO} จาก {nbpg}');
        $mpdf->WriteHTML($style, 1);
        $mpdf->WriteHTML($content, 2);
        
        $mpdf->AddPage('P','',1,'','off');
        $mpdf->SetHTMLFooter('{PAGENO} จาก {nbpg}');
        $mpdf->WriteHTML($style, 1);
        $mpdf->WriteHTML($content, 2);
        
        $mpdf->AddPage('L','',1,'','off');
        $mpdf->SetHTMLFooter('{PAGENO} จาก {nbpg}');
        $mpdf->WriteHTML($style, 1);
        $mpdf->WriteHTML($content, 2);
        
        $mpdf->Output();
    }

    public function actionReport2()
    {
         
        
        
        return $this->render('report2');
    }

    public function actionReport3()
    {
        return $this->render('report3');
    }

}
