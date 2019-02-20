<?php
namespace app\models;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class Records extends ActiveRecord {

	private $Category;
	private $Name;
	private $Manufacturer;
	private $Quantity;
	private $Unit_price;
	private $Unit;
	private $Re_stock;
	public function rules() {

		return[
			['Category', 'required'],
			['Name', 'required'],
			['Name', 'unique', 'targetClass' => '\app\models\Records', 'message' => 'This product already exist.'],
			['Manufacturer', 'required'],
			['Quantity', 'required'],
			['Unit_price', 'required'],
			['Unit', 'required'],
			['Re_stock', 'required'],
		];
	}

	public static function tableName() {
		return '{{%records}}';
	}

	public function attributeLabels() {

		return [
			'ID' => 'Product',
			'Unit_price' => 'Unit Price',
			'Re_stock' => 'Quantity'
		];
	}

	public function removeRestock() {
		$this->Re_stock = 0;
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