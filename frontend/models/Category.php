<?php
	namespace app\models;
	use yii\db\ActiveRecord;

	class Category extends ActiveRecord {

		private $Name;
		private $Description;

		public function rules() {

			return [
            	[['Name','Description'], 'required']
        	];
		}

		public static function tableName() {
			return '{{%category}}';
		}

		public function attributeLabels() {
        
        	return [
            	'categID' => 'Category',
            	'Description' => 'Category Description'
        	];
    	} 
	}
?>