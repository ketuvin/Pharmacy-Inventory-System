<?php
	namespace frontend\models;
	use yii\db\ActiveRecord;
	use yii\data\ActiveDataProvider;
	use \kossmoss\PostgresqlArrayField\PostgresqlArrayFieldBehavior;

	class Reports extends ActiveRecord {

		public function rules() {

			return [
				
        	];
		}

		public function behaviors() {
			return [
				[
					'class' => PostgresqlArrayFieldBehavior::className(),
					'arrayFieldName' => 'generic_name', // model's field to attach behavior
					'onEmptySaveNull' => true // if set to false, empty array will be saved as empty PostreSQL array '{}' (default: true)
				]
			];
		}

		public static function tableName() {
			return '{{%reports}}';
		}

		public function attributeLabels() {
        
        	return [
            	'report_no' => 'Report No.',
            	'created_date' => 'Created Date',
            	'generic_name' => 'Generic Name'
        	];
    	}

    	public function search($params)
	{
		$query = Reports::find();

       // add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
           // uncomment the following line if you do not want to return any records when validation fails
           // $query->where('0=1');
			return $dataProvider;
		}

		return $dataProvider;
	}
	}
?>