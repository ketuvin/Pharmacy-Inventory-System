<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
use borales\extensions\phoneInput\PhoneInputValidator;
use Yii;
/**
 * Signup form
 */
class AdduserForm extends Model
{
    public $fullname;
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $role = 10;
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
        // if (!$this->validate()) {
        //     return null;
        // }
        
        $user = new User();
        $user->fullname = $this->fullname;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword(Yii::$app->security->generateRandomString());
        $user->role = $this->role;
        $user->mobile = $this->mobile;
        $user->gender = $this->gender;
        $user->nationality = $this->nationality;
        $user->address = $this->address;
        $user->generateAuthKey();
        $user->generateConfirmationToken();
        
        return $user->save(false) ? $user : null;
    }
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->confirmation_token)) {
            $user->generateConfirmationToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'confirmationToken-html', 'text' => 'confirmationToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Confirmation link for ' . Yii::$app->name)
            ->send();
    }
}
