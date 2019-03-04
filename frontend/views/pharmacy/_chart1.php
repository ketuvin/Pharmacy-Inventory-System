<?php
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;

$name = [];
$quantity = [];
$category = [];
$categories = [];
$names = [];

	foreach($diagram as $values) {
	    $name[] = $values['generic_name'];
	    $quantity[] = $values['quantity'];
	    $category[] = $values['category'];
	}
	if(count($name) <= 5) {
		for($counter=0; $counter < sizeof($name);$counter++){
			$categories[] = $category[$counter];
			if($counter == 0) {
				$names[] = ['name' => $name[$counter], 'data' => [(int)$quantity[$counter]]];
			}elseif($counter == 1) {
				$names[] = ['name' => $name[$counter], 'data' => [0,(int)$quantity[$counter]]];
			}elseif($counter == 2) {
				$names[] = ['name' => $name[$counter], 'data' => [0,0,(int)$quantity[$counter]]];
			}elseif($counter == 3) {
				$names[] = ['name' => $name[$counter], 'data' => [0,0,0,(int)$quantity[$counter]]];
			}else {
				$names[] = ['name' => $name[$counter], 'data' => [0,0,0,0,(int)$quantity[$counter]]];
			}
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
	        'title' => ['text' => 'Products with least stock Available'],
	        'xAxis' => [
	            // 'type' => 'category'
	            'categories' => $categories
	        ],
	        'yAxis' => [
	            'title' => ['text' => 'Stock']
	        ],
	        'chart' => [
	            'type' => 'column'
	        ],
	        'series' => $names
	        // [
	        //     ['name' => $name[0], 'data' => [(int)$quantity[0]]],
	        //     ['name' => $name[1], 'data' => [0,(int)$quantity[1]]],
	        //     ['name' => $name[2], 'data' => [0,0,(int)$quantity[2]]],
	        //     ['name' => $name[3], 'data' => [0,0,0,(int)$quantity[3]]],
	        //     ['name' => $name[4], 'data' => [0,0,0,0,(int)$quantity[4]]]
	        // ]
	   ]
	]);
	Pjax::end();
?>