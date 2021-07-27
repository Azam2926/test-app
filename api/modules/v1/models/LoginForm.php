<?php
/**
 * User: azam
 * Date: 24/07/21
 * Time: 12:40
 */

namespace api\modules\v1\models;


use api\modules\v1\resources\User;
use backend\models\LoginForm as Form;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Form
{
    protected $permission = 'loginToApp';

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        if ($this->user === false) {
            $this->user = User::findByUsername($this->username);
        }

        return $this->user;
    }
}