<?php
use dosamigos\chartjs\ChartJs;
$labels = [];
foreach ($data['labels'] as $value) {
    $labels[] = $value;
}
$dataSet = [];
foreach ($data['data'] as $name => $value) {
    $nokey = [];
    foreach ($value as $item) {
        $nokey[] = $item;
    }
    $color = array_shift($data['colors']);
    $dataSet[] = [
        'label' => $name,
        'fill' => false,
        'backgroundColor' => $color,
        'borderColor' => $color,
        'pointBackgroundColor' => $color,
        'pointBorderColor' => $color,
        'pointHoverBackgroundColor' => $color,
        'pointHoverBorderColor' => $color,
        'data' => $nokey
    ];
}
?>
<?=  ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 100,
    ],
    'data' => [
        'labels' => $labels,
        'datasets' => $dataSet,
    ]
]); ?>
