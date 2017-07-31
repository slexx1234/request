<?php

namespace Slexx\Request;

class Cookie
{
    /**
     * Получение всех cookie
     * @return array
     */
    public static function all()
    {
        return $_COOKIE;
    }

    /**
     * @return int
     */
    public static function count()
    {
        return count(static::all());
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function has($key)
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        return static::has($key) ? $_COOKIE[$key] : null;
    }

    /**
     * Установка новой печеньки
     * @param string $key - Имя печеньки
     * @param string $value - Значение
     * @param array [$options]
     * @param int|string [$options['expire']] - Время жизни, по учмолчанию 30 дней. По умолчанию обрабатывается функцией strtotime.
     * @param string [$options['path']] - Директория для которой будет доступна печенька
     * @param string [$options['domain']] - Поддомен для которого будет доступна печенька
     * @param bool [$options['secure']] - Указывает на то что печеньки от клеента следует передовать только по HTTPS
     * @param bool [$options['httponly']] - Если установить true, то печеньки не будут доступны скриптовым языкам таким как javascript
     * @return void
     */
    public static function set($key, $value, $options = [])
    {
        $options = array_merge([
            'expire'   => null,
            'path'     => '',
            'domain'   => '',
            'secure'   => false,
            'httponly' => false
        ], $options);

        if (is_string($options['expire'])) {
            $expire = strtotime($options['expire']);
        } else if (!is_int($options['expire'])) {
            $expire = time() + 60 * 60 * 24 * 30;
        } else {
            $expire = $options['expire'];
        }

        setcookie(
            $key,
            $value,
            $expire,
            $options['path'],
            $options['domain'],
            $options['secure'],
            $options['httponly']
        );
    }

    /**
     * Удаляет печеньку
     * @param string $key - Имя печеньки
     * @return void
     */
    public static function remove($key)
    {
        static::set($key, null, [
            'expire' => time() - 3600
        ]);
    }
}
