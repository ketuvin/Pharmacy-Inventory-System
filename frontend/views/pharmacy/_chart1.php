<?php
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;

	foreach($diagram as $values) {
	    $name[] = $values['name'];
	    $quantity[] = $values['quantity'];
	    $category[] = $values['category'];
	}
	Pjax::begin();
	echo Highcharts::widget([
	    'scripts' => [
	       'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
	       'modules/exporting', // adds Exporting button/menu to chart
	       // 'themes/grid-light'        // applies global 'grid' theme to all charts
	    ],
	    'options' => [
	        'title' => ['text' => 'Products with least stock Available'],
	        'xAxis' => [
	            // 'type' => 'category'
	            'categories' => [$category[0],$category[1],$category[2],$category[3],$category[4]]
	        ],
	        'yAxis' => [
	            'title' => ['text' => 'Stock']
	        ],
	        'chart' => [
	            'type' => 'column'
	        ],
	        'series' => [
	            ['name' => $name[0], 'data' => [(int)$quantity[0]]],
	            ['name' => $name[1], 'data' => [0,(int)$quantity[1]]],
	            ['name' => $name[2], 'data' => [0,0,(int)$quantity[2]]],
	            ['name' => $name[3], 'data' => [0,0,0,(int)$quantity[3]]],
	            ['name' => $name[4], 'data' => [0,0,0,0,(int)$quantity[4]]]
	        ]
	   ]
	]);
	Pjax::end();
?>