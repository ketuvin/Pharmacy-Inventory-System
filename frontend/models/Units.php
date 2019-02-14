<?php
	namespace app\models;
	use yii\db\ActiveRecord;

	class Units extends ActiveRecord {

		private $Unit_name;

		public function rules() {

			return [
            	[['Unit_name'], 'required']
        	];
		}

		public static function tableName() {
			return '{{%units}}';
		}

		public function attributeLabels() {
        
        	return [
            	'unitID' => 'Unit'
        	];
    	}
	}
?>