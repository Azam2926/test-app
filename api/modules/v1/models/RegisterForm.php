<?php
/**
 * User: azam
 * Date: 24/07/21
 * Time: 12:40
 */

namespace api\modules\v1\models;


use api\modules\v1\resources\User;
use Yii;
use yii\base\Exception;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;

    public $user = null;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat'], 'required'],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
            [
                'username', 'unique',
                'targetClass' => 'api\modules\v1\resources\User',
                'message' => 'This username has already been taken.',
            ],
        ];
    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            $user->access_token = Yii::$app->security->generateRandomString(255);
            if ($user->save()) {
                $this->user = $user;
                $auth = Yii::$app->authManager;
                $auth->assign($auth->getRole(User::ROLE_USER), $user->getId());
                return Yii::$app->user->login($user);
            }
        }

        return false;
    }

}