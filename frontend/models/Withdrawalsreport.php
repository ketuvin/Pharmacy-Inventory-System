<?php
	namespace frontend\models;
	use yii\db\ActiveRecord;
	use yii\data\ActiveDataProvider;

	class Withdrawalsreport extends ActiveRecord {

		public function rules() {

			return [
				
        	];
		}

		public static function tableName() {
			return '{{%withdrawalsreport}}';
		}

		public function attributeLabels() {
        
        	return [
            	'withdraw_reportno' => 'Report No.',
            	'created_date' => 'Created Date'
        	];
    	}

    	public function search($params)
	{
		$query = Withdrawalsreport::find();

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