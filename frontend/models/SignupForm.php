<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use borales\extensions\phoneInput\PhoneInputValidator;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $fullname;
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $mobile;
    public $gender;
    public $nationality;
    public $address;

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

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message' => 'Password do not match.'],
            ['mobile', 'string'],
            [['mobile'], PhoneInputValidator::className()],
            ['mobile', 'required'],
            ['gender', 'required'],
            ['nationality', 'required'],
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
        $user->mobile = $this->mobile;
        $user->gender = $this->gender;
        $user->nationality = $this->nationality;
        $user->address = $this->address;
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
