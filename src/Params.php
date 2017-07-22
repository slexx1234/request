<?php

namespace Slexx\Request;

class Params implements \Countable, \IteratorAggregate
{
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param array $params - Переменные запроса
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Получение всех переменных
     * @return array
     */
    public function all()
    {
        return $this->params;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * Подсщет колличества переменных
     * @return int
     */
    public function count()
    {
        return count($this->all());
    }

    /**
     * Проверка существования переменной запроса
     * @param string $key - Имя переменной
     * @return bool
     */
    public function has($key)
    {
        return isset($this->params[$key]);
    }

    /**
     * Получение переменной запроса
     * @param string $key - Имя переменной
     * @return mixed
     */
    public function get($key)
    {
        return $this->has($key) ? $this->params[$key] : null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->all();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return http_build_query($this->all());
    }
}

