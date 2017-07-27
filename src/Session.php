<?php

namespace Slexx\Request;

class Session
{
    /**
     * Стартовала ли сессия?
     * @return bool
     */
    public static function isStarted()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    /**
     * Старт сессии
     * @return void
     */
    public static function start()
    {
        if (!static::isStarted()) {
            session_start();
        }
    }

    /**
     * Завершение сессии
     * @return void
     */
    public static function destroy()
    {
        if (static::isStarted()) {
            session_destroy();
        }
    }

    /**
     * @return mixed
     */
    public static function all()
    {
        static::start();
        return $_SESSION;
    }

    /**
     * @return int
     */
    public static function count()
    {
        return count(static::all());
    }

    /**
     * Очистка сессии
     * @return void
     */
    public static function clear()
    {
        static::start();
        $_SESSION = [];
    }

    /**
     * Получение переменной сессии
     * @param string|int $key
     * @return mixed
     */
    public static function get($key)
    {
        return static::has($key) ? $_SESSION[$key] : null;
    }

    /**
     * Проверка существования переменной сессии
     * @param string|int $key
     * @return bool
     */
    public static function has($key)
    {
        static::start();
        return isset($_SESSION[$key]);
    }

    /**
     * Установка переменной сессии
     * @param string|int $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        static::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Удаление переменной сессии
     * @param string|int $key
     * @return void
     */
    public static function remove($key)
    {
        static::start();
        unset($_SESSION[$key]);
    }

    /**
     * Флэш сообщение, если не указывать второй параметр то значение переменной сессии
     * будет возвращено, а сама перемменная будет удалена, в противном случае будет
     * установленна переменная сессии
     * @param string|int $key
     * @param mixed $value
     * @return mixed
     */
    public static function flash($key, $value = null)
    {
        if ($value === null) {
            $result = static::get($key);
            static::remove($key);
            return $result;
        } else {
            static::set($key, $value);
        }
    }
}
