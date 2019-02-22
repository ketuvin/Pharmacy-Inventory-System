<?php
	namespace frontend\models;
	use yii\db\ActiveRecord;

	class Units extends ActiveRecord {

		public function rules() {

			return [
            	['unit_name', 'required'],
            	['unit_name', 'unique', 'targetClass' => '\frontend\models\Units', 'message' => 'This unit already exist.'],
            	['unit_name', 'filter', 'filter'=>'strtolower']
        	];
		}

		public static function tableName() {
			return '{{%units}}';
		}

		public function attributeLabels() {
        
        	return [
            	'unit_id' => 'Unit'
        	];
    	}
	}
?>