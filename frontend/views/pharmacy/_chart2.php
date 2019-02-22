<?php
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;


    foreach($products as $product) {
        $names[] = $product['name'];
        $categories[] = $product['category'];
    }
    foreach($diagram1 as $values1) {
        $product_name[] = $values1['product_name'];
        $current_stock[] = $values1['current_stock'];
    }
    for($counter=0;$counter < sizeof($names);$counter++) {
        if($names[$counter] == $product_name[0]){
            $category1[] = $categories[$counter]; 
        }if($names[$counter] == $product_name[1]){
            $category1[] = $categories[$counter]; 
        }if($names[$counter] == $product_name[2]){
            $category1[] = $categories[$counter]; 
        }if($names[$counter] == $product_name[3]){
            $category1[] = $categories[$counter]; 
        }if($names[$counter] == $product_name[4]){
            $category1[] = $categories[$counter]; 
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
                'categories' => [$category1[0],$category1[1],$category1[2],$category1[3],$category1[4]]
            ],
            'yAxis' => [
                'title' => ['text' => 'Stock']
            ],
            'chart' => [
                'type' => 'column'
            ],
            'series' => [
                ['name' => $product_name[0], 'data' => [(int)$current_stock[0]]],
                ['name' => $product_name[1], 'data' => [0,(int)$current_stock[1]]],
                ['name' => $product_name[2], 'data' => [0,0,(int)$current_stock[2]]],
                ['name' => $product_name[3], 'data' => [0,0,0,(int)$current_stock[3]]],
                ['name' => $product_name[4], 'data' => [0,0,0,0,(int)$current_stock[4]]]
            ]
       ]
   ]);
    Pjax::end();
?>