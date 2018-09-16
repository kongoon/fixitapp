<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;

$this->title = 'สรุปข้อมูลประจำเดือน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
              <h3 class="box-title">Direct Chat</h3>

              <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="3 New Messages">3</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                  <i class="fa fa-comments"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
    <div class="box-body">
        <h1><?= $this->title ?></h1>

        <?=
        ChartJs::widget([
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
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'y',
                    'label' => 'ปี'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm01',
                    'label' => 'มกราคม'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm02',
                    'label' => 'กุมภาพันธ์'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm03',
                    'label' => 'มีนาคม'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm04',
                    'label' => 'เมษายน'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm05',
                    'label' => 'พฤษภาคม'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm06',
                    'label' => 'มิถุนายน'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm07',
                    'label' => 'กรกฏาคม'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm08',
                    'label' => 'สิงหาคม'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm09',
                    'label' => 'กันยายน'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm10',
                    'label' => 'ตุลาคม'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm11',
                    'label' => 'พฤศจิกายน'
                ],
                [
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'attribute' => 'm12',
                    'label' => 'ธันวาคม'
                ]
            ]
        ])
        ?>
    </div>
</div>