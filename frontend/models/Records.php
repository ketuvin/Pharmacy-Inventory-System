<?php
namespace frontend\models;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class Records extends ActiveRecord {

	public function rules() {

		return[
			['category', 'required'],
			['name', 'required'],
			['name', 'unique', 'targetClass' => '\frontend\models\Records', 'message' => 'This product already exist.'],
			['manufacturer', 'required'],
			['quantity', 'required'],
			['unit_price', 'required'],
			['unit', 'required'],
			['re_stock', 'required'],
		];
	}

	public static function tableName() {
		return '{{%records}}';
	}

	public function attributeLabels() {

		return [
			'id' => 'Product',
			'unit_price' => 'Unit Price',
			're_stock' => 'Quantity'
		];
	}

	public function removeRestock() {
		$this->re_stock = 0;
	}

	public function search($params)
	{
		$query = Records::find();

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