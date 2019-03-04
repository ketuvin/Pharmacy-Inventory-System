<?php
	namespace frontend\models;
	use yii\db\ActiveRecord;
	use yii\data\ActiveDataProvider;

	class Voided extends ActiveRecord {

		public function rules() {

			return [
            	[['product_name','category','remarks','manufacturer'], 'required'],
        	];
		}

		public static function tableName() {
			return '{{%voided}}';
		}

		public function attributeLabels() {
        
        	return [
            	'voidno' => 'Void No.',
            	'product_name' => 'Generic Name',
            	'unit_price' => 'Unit Price'
        	];
    	}

    	public function search($params)
		{
			$query = Voided::find();

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