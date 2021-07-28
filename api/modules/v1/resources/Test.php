<?php

namespace api\modules\v1\resources;


/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Test extends \common\models\Test
{
    public function fields(): array
    {
        return ['id', 'title', 'content', 'slug', 'number_of_question'];
    }
}
