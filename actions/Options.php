<?php

namespace faryshta\rest\actions;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class Options extends \yii\rest\ActionOptions
{
    /**
     * @var string class for the model.
     */
    public $modelClass;

    /**
     * @var string the scenario to be assigned to the new model before it is
     * decomposed.
     */
    public $scenario = Model::SCENARIO_DEFAULT;

    /**
     * @var callable function to include more data to the response.
     *
     * It must have signature:
     *
     * ```php
     * function (Model $model): array;
     * ```
     */
    public $extraData;

    /**
     * @inheritdoc
     */
    public function run($id = nul)
    {
        parent::run($id);
        $modelClass = $this->modelClass();
        $model = new $modelClass(['scenario' => $this->scenario]);

        return ArrayHelper::merge([
            'fields' => $this->fields($model),
            'extraFields' => $this->extraFields(),
        ], $this->extraData($model));
    }

    /**
     * Return the description for the fields.
     *
     * @param Model $model
     * @return array
     */
    protected function fields(Model $model)
    {
        $fields = [];
        foreach ($model->fields() as $field) {
            $fields[] = [
                'name' => $field,
                'label' => $model->getAttributeLabel($field),
            ];
        }

        return $fields;
    }

    /**
     * Returns a list of the extra fields with their expand.
     *
     * @param Model $model
     * @return array
     */
    protected function extraFields($model)
    {
        $extraFields = [];
        foreach ($model->extraFields() as $field) {
            $relation = $model->getRelation($field);
            $extraFields[] = [
                'name' => $field,
                'class' => $relation->modelClass,
                'link' => $relation->link,
            ];
        }
        return $extraFields;
    }

    /**
     * Returns the extra data to be used as response.
     *
     * @param Model $model
     * @return array
     */
    protected function extraData(Model $model)
    {
        if ($this->extraData !== null) {
            return call_user_func($this->extraData, $model);
        }
        return [];
    }
}
