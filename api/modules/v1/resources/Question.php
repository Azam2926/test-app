<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Question extends \common\models\Question implements Linkable
{
    public function fields(): array
    {
        return ['id', 'content', 'type'];
    }

    public function extraFields(): array
    {
        return ['questionAnswers']; // TODO: Change the autogenerated stub
    }

    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks(): array
    {
        return [
            Link::REL_SELF => Url::to(['question/view', 'id' => $this->id], true)
        ];
    }
}
