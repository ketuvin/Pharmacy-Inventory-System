<?php
namespace common\models;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use Yii;

class Withdrawals extends ActiveRecord {

	public function rules() {

		return [
			[['remarks'], 'required']
		];
	}

	public static function tableName() {
		return '{{%withdrawals}}';
	}

	public function attributeLabels() {

		return [
			'pull_outno' => 'Pull-out No.',
			'created_date' => 'Created Date',
			'withdrawby_user' => 'Withdrawn By',
			'stock_withdrawn' => 'Amount of Stock Withdrawn',
			'product_name' => 'Generic Name',
			'sku' => 'SKU'
		];
	}

	public function search($params)
	{
		if (Yii::$app->user->identity->role == 20) {
			$query = Withdrawals::find();

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
			$query = Withdrawals::find()->where(['withdrawby_user' => $user]);

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