<?php

namespace Slexx\Request;

use Slexx\Url\Url;
use Slexx\Headers\Headers;

class Request
{
    /**
     * @var Url
     */
    protected static $url = null;

    /**
     * @var Headers
     */
    protected static $headers = null;

    /**
     * @var Params
     */
    protected static $params;

    /**
     * Получение имени метода запроса
     * @return string
     */
    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return bool
     */
    public static function isGet()
    {
        return static::getMethod() === 'GET';
    }

    /**
     * @return bool
     */
    public static function isPost()
    {
        return static::getMethod() === 'POST';
    }

    /**
     * @return bool
     */
    public static function isPut()
    {
        return static::getMethod() === 'PUT';
    }

    /**
     * @return bool
     */
    public static function isDelete()
    {
        return static::getMethod() === 'DELETE';
    }

    /**
     * @return bool
     */
    public static function isHead()
    {
        return static::getMethod() === 'HEAD';
    }

    /**
     * @return bool
     */
    public static function isPatch()
    {
        return static::getMethod() === 'PATCH';
    }

    /**
     * @return bool
     */
    public static function isOptions()
    {
        return static::getMethod() === 'OPTIONS';
    }

    /**
     * Получение Url текущего запроса
     * @return Url|null
     */
    public static function getUrl()
    {
        if (static::isCLI()) {
            return null;
        }

        if (static::$url === null) {
            $url = 'http';
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
                $url .= 's';
            }
            $url .= '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            static::$url = new Url($url);
        }

        return static::$url;
    }

    /**
     * Получение заголовков текущего запроса
     * @return Headers
     */
    public static function getHeaders()
    {
        if (static::isCLI()) {
            return null;
        }

        if (static::$headers === null) {
            static::$headers = new Headers(getallheaders());
        }

        return static::$headers;
    }

    /**
     * Является запрос Ajax запросм?
     * @return bool
     */
    public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * @return bool
     * @see Request::isAjax()
     */
    public static function isXhr()
    {
        return static::isAjax();
    }

    /**
     * Проверяет является ли текуший запрос совершённым из коммандной строки
     * @return bool
     */
    public static function isCLI()
    {
        return in_array(PHP_SAPI, ['cli', 'cli-server']);
    }

    /**
     * Проверяет является ли запрос статичным, не отправленным не
     * через Ajax и не из коммандной строки
     * @return bool
     */
    public static function isSync()
    {
        return !static::isAjax()
            && !static::isCli();
    }

    /**
     * Получение тела запроса. Для Content-Type: application/json
     * и Content-Type: application/x-www-form-urlencoded возвращает
     * массивы.
     * @return array|string
     */
    public static function getBody()
    {
        $contentType = static::getHeader('Content-Type');
        $body = file_get_contents('php://input');

        if (mb_substr($contentType,'application/x-www-form-urlencoded') === 0) {
            parse_str($body, $data);
            return $data;
        } else if (mb_substr($contentType, 'application/json') === 0) {
            return json_decode($body, true);
        } else {
            return $body;
        }
    }

    /**
     * Получение параметров запроса
     * @return Params
     */
    public static function getParams()
    {
        if (static::isCLI()) {
            return null;
        }

        if (static::$params === null) {
            if (static::isGet()) {
                static::$params = new Params($_GET);
            } else {
                $body = static::getBody();
                if (is_array($body)) {
                    static::$params = new Params(array_merge($_GET, $body));
                } else {
                    static::$params = new Params($_GET);
                }
            }
        }

        return static::$params;
    }

    /**
     * Получение параметра запроса
     * @param string $key
     * @return mixed
     */
    public static function getParam($key)
    {
        return static::getParams()->get($key);
    }

    /**
     * Получает заголовак
     * @param string $name
     * @return string|null
     */
    public static function getHeader($name)
    {
        return static::getHeaders()->get($name);
    }

    /**
     * Проверяет существования заголовка
     * @param string $name
     * @return bool
     */
    public static function hasHeader($name)
    {
        return static::getHeaders()->has($name);
    }
}
