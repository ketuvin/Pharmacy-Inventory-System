<?php
namespace common\models;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use Yii;

class Deposits extends ActiveRecord {

	public function rules() {

		return [
		];
	}

	public static function tableName() {
		return '{{%deposits}}';
	}

	public function attributeLabels() {

		return [
			'depositno' => 'Deposit No.',
			'created_date' => 'Created Date',
			'depositedby_user' => 'Deposited By',
			'stock_deposited' => 'Amount of Stock Deposited',
			'product_name' => 'Generic Name',
			'current_stock' => 'Current Stock',
			'sku' => 'SKU'
		];
	}

	public function search($params)
	{
		if (Yii::$app->user->identity->role == 20) {
			$query = Deposits::find();

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

		} else {
			$user = Yii::$app->user->identity->fullname . ' (' . Yii::$app->user->identity->username . ')';
			$query = Deposits::find()->where(['depositedby_user' => $user]);

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
}
?>