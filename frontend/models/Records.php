<?php
	namespace app\models;
	use yii\db\ActiveRecord;

	class Records extends ActiveRecord {

		private $Category;
		private $Name;
		private $Manufacturer;
		private $Quantity;
		private $Unit_price;
		private $Unit;

		public function rules() {

			return[
				[['Category', 'Name', 'Manufacturer', 'Quantity', 'Unit_price','Unit'], 'required'],
				['Name', 'unique','targetClass' => '\app\models\Records', 'message' => 'This product already exist.']

			];
		}

		public static function tableName() {
			return '{{%records}}';
		}

		public function attributeLabels() {
        
        	return [
            	'ID' => 'Product',
            	'Unit_price' => 'Unit Price'
        	];
    	} 
	}
?>