<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    private $fullname;
    private $username;
    private $password;
    private $password_repeat;
    private $email;
    private $gender;
    private $address;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['fullname', 'required'],
            ['fullname', 'string', 'min' => 2, 'max' => 255],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['gender', 'required'],
            ['address', 'required'],
        ];
    }

    public function attributeLabels() {
        return [
            'fullname' => 'Full name',
            'password_repeat' => 'Confirm Password',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->fullname = $this->fullname;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->gender = $this->gender;
        $user->address = $this->address;
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
