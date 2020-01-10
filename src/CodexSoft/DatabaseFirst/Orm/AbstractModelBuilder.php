<?php

namespace CodexSoft\DatabaseFirst\Orm;

abstract class AbstractModelBuilder
{

    /** class of model to build */
    protected string $modelClass;

    private \StdClass $model;

    public function __construct()
    {
        $this->model = new $this->modelClass;
    }

    /**
     * @return AbstractModelBuilder
     */
    public static function create()
    {
        return new static;
    }

    public function __call( $name, $arguments )
    {

        if (method_exists($this->model,$name)) {
            $this->model->$name( ...$arguments );
        }

        return $this;
    }

    public function build()
    {
        if (\method_exists($this->model, 'validate')) {
            $this->model->validate();
        }

        return $this->model;
    }

    public function buildIncomplete()
    {
        return $this->model;
    }

}
