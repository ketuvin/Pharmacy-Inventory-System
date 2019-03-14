<?php
namespace frontend\models;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\User;
use Yii;

class Records extends ActiveRecord {

	public function rules() {

		return[
			['category', 'required'],
			['generic_name', 'required'],
			['manufacturer', 'required'],
			['strength', 'required'],
			['quantity', 'required'],
			['unit_price', 'required'],
			['unit', 'required'],
			['re_stock', 'required'],
			['re_orderqty', 'required']
		];
	}

	public static function tableName() {
		return '{{%records}}';
	}

	public function attributeLabels() {

		return [
			'id' => 'Product',
			'generic_name' => 'Generic Name',
			'unit_price' => 'Unit Price',
			're_stock' => 'Quantity',
			'sku' => 'SKU',
			're_orderqty' => 'Re-Order Quantity'
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

	/**
    * Sends an email with a link, for inventory notification.
    *
    * @return bool whether the email was send
    */
	public function sendEmail($email, $record)
	{
		/* @var $user User */
		$user = User::findOne([
			'status' => User::STATUS_ACTIVE,
			'email' => $email,
		]);

		if (!$user) {
			return false;
		}

		return Yii::$app
		->mailer
		->compose(
			['html' => 'notification-html', 'text' => 'notification-text'],
			['user' => $user, 'record' => $record]
		)
		->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
		->setTo($email)
		->setSubject('Inventory Notification for ' . Yii::$app->name)
		->send();
	}

}
?>