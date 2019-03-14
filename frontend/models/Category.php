<?php
	namespace frontend\models;
	use yii\db\ActiveRecord;
	use yii\data\ActiveDataProvider;

	class Category extends ActiveRecord {

		public function rules() {

			return [
            	[['category','description'], 'required'],
        	];
		}

		public static function tableName() {
			return '{{%category}}';
		}

		public function attributeLabels() {
        
        	return [
            	'categ_id' => 'Category',
            	'description' => 'Category Description'
        	];
    	}

    	public function search($params)
		{
			$query = Category::find();

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