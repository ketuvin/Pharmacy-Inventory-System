<?php
	namespace app\models;
	use yii\db\ActiveRecord;

	class Records extends ActiveRecord {

		private $ID;
		private $Category;
		private $Name;
		private $Brand;
		private $Quantity;

		public function rules() {

			return[
				[['ID', 'Category', 'Name', 'Brand', 'Quantity'], 'required']
			];
		}

		public function attributeLabels() {
        
        	return [
            	'ID' => 'Product ID'
        	];
    	} 
	}
?>