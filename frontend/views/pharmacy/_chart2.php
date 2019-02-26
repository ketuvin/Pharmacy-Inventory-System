<?php
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;

$product_name = [];
$current_stock = [];
$category = [];
$categories = [];
$pnames = [];

    foreach($diagram1 as $values1) {
        $product_name[] = $values1['product_name'];
        $current_stock[] = $values1['current_stock'];
        $category[] = $values1['category'];
    }
    for($counter=0;$counter < sizeof($product_name);$counter++) {
        $categories[] = $category[$counter];
        if($counter == 0) {
            $pnames[] = ['name' => $product_name[$counter], 'data' => [(int)$current_stock[$counter]]];
        }elseif($counter == 1) {
            $pnames[] = ['name' => $product_name[$counter], 'data' => [0,(int)$current_stock[$counter]]];
        }elseif($counter == 2) {
            $pnames[] = ['name' => $product_name[$counter], 'data' => [0,0,(int)$current_stock[$counter]]];
        }elseif($counter == 3) {
            $pnames[] = ['name' => $product_name[$counter], 'data' => [0,0,0,(int)$current_stock[$counter]]];
        }else {
            $pnames[] = ['name' => $product_name[$counter], 'data' => [0,0,0,0,(int)$current_stock[$counter]]];
        }
    }
    Pjax::begin();
    echo Highcharts::widget([
        'scripts' => [
           'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
           'modules/exporting', // adds Exporting button/menu to chart
           // 'themes/grid-light'        // applies global 'grid' theme to all charts
        ],
        'options' => [
            'title' => ['text' => 'Products recently Replenished'],
             'xAxis' => [
            //     // 'type' => 'category'
                'categories' => $categories
            ],
            'yAxis' => [
                'title' => ['text' => 'Stock']
            ],
            'chart' => [
                'type' => 'column'
            ],
            'series' => $pnames
            // [
            //     ['name' => $product_name[0], 'data' => [(int)$current_stock[0]]],
            //     ['name' => $product_name[1], 'data' => [0,(int)$current_stock[1]]],
            //     ['name' => $product_name[2], 'data' => [0,0,(int)$current_stock[2]]],
            //     ['name' => $product_name[3], 'data' => [0,0,0,(int)$current_stock[3]]],
            //     ['name' => $product_name[4], 'data' => [0,0,0,0,(int)$current_stock[4]]]
            // ]
       ]
   ]);
    Pjax::end();
?>