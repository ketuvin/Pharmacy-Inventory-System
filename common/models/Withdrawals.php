<?php
namespace common\models;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class Withdrawals extends ActiveRecord {

	private $Pull_outNo;
	private $Remarks;
	private $Created_Date;
	private $Product_name;
	private $withdrawby_user;
	private $stock_withdrawn;

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
			'Created_Date' => 'Created Date',
			'withdrawby_user' => 'Withdrawn By',
			'stock_withdrawn' => 'Amount of Stock Withdrawn'
		];
	}

	public function search($params)
	{
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
	} 
}
?>