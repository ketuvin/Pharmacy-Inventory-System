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
				['Category', 'required'],
				['Name', 'required'],
				['Name', 'unique', 'targetClass' => '\app\models\Records', 'message' => 'This product already exist.'],
				['Manufacturer', 'required'],
				['Quantity', 'required'],
				['Unit_price', 'required'],
				['Unit', 'required'],
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

    	public function removeRestock() {
    		$this->Re_stock = 0;
    	} 
	}
?>