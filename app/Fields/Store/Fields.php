<?php

namespace App\Fields\Store;

class Fields
{
    /**
     * @var
     */
    protected $name;

    /**
     * @var
     */
    protected $rules;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function make($name)
    {
        $class = get_called_class();
        return new $class($name);
    }

    /**
     * @param $object
     * @param $data
     * @return void
     */
    public function fill($object, $data)
    {
        $object->{$this->getName()} = $data[$this->getName()];
    }

    /**
     * @param $name
     * @return $this
     */
    function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * @param $rules
     * @return $this
     */
    function setRules($rules)
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * @return mixed
     */
    function getRules()
    {
        return $this->rules;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'text';
    }
}
