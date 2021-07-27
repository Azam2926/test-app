<?php

namespace api\modules\v1\resources;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class User extends \common\models\User
{
    public function fields(): array
    {
        return ['id', 'username', 'access_token'];
    }

    public function extraFields(): array
    {
        return ['userProfile'];
    }
}
