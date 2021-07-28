<?php
/**
 * User: azam
 * Date: 21/07/21
 * Time: 13:32
 */

namespace api\modules\v1\actions;

use api\modules\v1\resources\Question;
use common\models\Test;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\BaseActiveRecord;
use yii\rest\IndexAction;

class Index extends IndexAction
{
    public $slug;
    /**
     * @throws InvalidConfigException
     */
    public function run($slug = 'qiziqarli')
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }
        $this->slug = $slug;
        return $this->prepareDataProvider();
    }


    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return array[]|object|string[]|ActiveDataProvider|\yii\db\ActiveQueryInterface[]
     * @throws InvalidConfigException
     */
    protected function prepareDataProvider()
    {
        $test = Test::findOne(['slug' => $this->slug]);
        if (!$test)
            $test = Test::findOne(['slug' => 'programming']);


        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }

        /* @var $modelClass BaseActiveRecord */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()
            ->activated()
            ->byTest($test->id)
            ->orderBy('rand()')
            ->limit($test->number_of_question);
        if (!empty($filter)) {
            $query->andWhere($filter);
        }

        return Yii::createObject([
            'class' => ActiveDataProvider::class,
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'params' => $requestParams,
            ],
        ]);
    }
}