<?php
	namespace app\models;
	use yii\db\ActiveRecord;

	class Records extends ActiveRecord {

		private $Category;
		private $Name;
		private $Brand;
		private $Quantity;

		public function rules() {

			return[
				[['Category', 'Name', 'Brand', 'Quantity'], 'required']
			];
		}

		public static function tableName() {
			return '{{%records}}';
		}

		public function attributeLabels() {
        
        	return [
            	'ID' => 'Product'
        	];
    	} 
	}
?>