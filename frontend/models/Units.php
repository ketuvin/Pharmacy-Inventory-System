<?php
	namespace frontend\models;
	use yii\db\ActiveRecord;
	use yii\data\ActiveDataProvider;

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

    	public function search($params)
	{
		$query = Units::find();

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