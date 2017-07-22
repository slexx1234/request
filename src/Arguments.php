<?php

namespace Slexx\Request;

class Arguments implements \Countable, \IteratorAggregate
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     *
     */
    public function __construct()
    {
        if (isset($argv) && $argv !== null) {
            $args = $argv;
            array_splice($args, 0, 1);
            $data = [];
            for($i = 0; $i < count($args); $i++) {
                $arg = $args[$i];
                if ($arg[0] === '-') {
                    if (strpos($arg, '=') !== false) {
                        $parts = explode('=', $arg, 2);
                        $data[$parts[0]] = end($parts);
                    } else if (isset($args[$i + 1]) && $args[$i + 1][0] !== '-') {
                        $data[$arg] = $args[$i + 1];
                        $i++;
                    } else {
                        $data[$arg] = true;
                    }
                } else {
                    $data[$arg] = true;
                }
            }
            $this->data = $data;
        }
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->all());
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->has($key) ? $this->data[$key] : null;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $result = '';
        foreach($this->data as $name => $value) {
            if ($value === true) {
                $result .= $name . ' ';
            } else {
                $result .= $name . '=' . $value . ' ';
            }
        }
        return $result;
    }
}

