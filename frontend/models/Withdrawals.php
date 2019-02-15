<?php
	namespace app\models;
	use yii\db\ActiveRecord;

	class Withdrawals extends ActiveRecord {

		private $Pull_outNo;
		private $Remarks;
		private $Created_Date;

		public function rules() {

			return [
            	[['Remarks'], 'required']
        	];
		}

		public static function tableName() {
			return '{{%withdrawals}}';
		}

		public function attributeLabels() {
        
        	return [
            	'Pull_outNo' => 'Pull-out No.',
            	'Created_Date' => 'Created Date'
        	];
    	} 
	}
?>