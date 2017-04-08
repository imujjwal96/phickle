<?php

namespace Phickle\Core\Framework;

class Model
{
    private static $models;
    private $list = [

    ];
    private $namespace = 'Phickle\Models\\';

    public function __construct()
    {
        foreach ($this->list as $model) {
            $model = $this->namespace . $model;
            self::$models[$model] = new $model;
        }
    }

    /**
     * @param $model string
     * @return Object | bool
     */
    public function get($model)
    {
        if (!in_array($model, $this->list)) {
            return false;
        }

        $model = $this->namespace . $model;
        if (!self::$models[$model]) {
            self::$models[$model] = new $model;
        }
        return self::$models[$model];
    }
}