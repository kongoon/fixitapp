<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;

$this->title = 'สรุปข้อมูลประจำเดือน';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?=$this->title?></h1>

<?= ChartJs::widget([
    'type' => 'bar',
    'options' => [
        
        'height' => 100,
        'width' => 400
    ],
    'clientOptions' => [
        'scales' => [
            'yAxes' => [
                'ticks' => [
                    'min' => 0,
                    'stepSize' => 1
                ]
            ]
        ]
    ],
    'data' => [
        'labels' => ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
        'datasets' => $datasets
    ]
]);
?>
<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'y',
            'label' => 'ปี'
        ],
        [
            'attribute' => 'm01',
            'label' => 'มกราคม'
        ],
        [
            'attribute' => 'm02',
            'label' => 'กุมภาพันธ์'
        ],
        [
            'attribute' => 'm03',
            'label' => 'มีนาคม'
        ],
        [
            'attribute' => 'm04',
            'label' => 'เมษายน'
        ],
        [
            'attribute' => 'm05',
            'label' => 'พฤษภาคม'
        ],
        [
            'attribute' => 'm06',
            'label' => 'มิถุนายน'
        ],
        [
            'attribute' => 'm07',
            'label' => 'กรกฏาคม'
        ],
        [
            'attribute' => 'm08',
            'label' => 'สิงหาคม'
        ],
        [
            'attribute' => 'm09',
            'label' => 'กันยายน'
        ],
        [
            'attribute' => 'm10',
            'label' => 'ตุลาคม'
        ],
        [
            'attribute' => 'm11',
            'label' => 'พฤศจิกายน'
        ],
        [
            'attribute' => 'm12',
            'label' => 'ธันวาคม'
        ]
    ]
])?>