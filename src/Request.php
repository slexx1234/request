<?php

namespace Slexx\Request;

use Slexx\Url\Url;
use Slexx\Cookie\Cookie;
use Slexx\Session\Session;
use Slexx\Headers\Headers;

class Request
{
    /**
     * @var Url
     */
    protected $url;

    /**
     * @var Headers
     */
    protected $headers;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var Cookie
     */
    protected $cookie;

    /**
     * @var Params
     */
    protected $params;

    /**
     * @var Arguments
     */
    protected $arguments;

    /**
     *
     */
    public function __construct()
    {
        $url = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
            $url .= 's';
        }
        $url .= '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->url = new Url($url);

        $this->headers = new Headers(http_get_request_headers());
        $this->session = new Session();
        $this->cookie = new Cookie();
        $this->arguments = new Arguments();

        if ($this->isGet()) {
            $this->params = new Params($_GET);
        } else {
            $body = $this->getBody();
            if (is_array($body)) {
                $this->params = new Params($body);
            } else {
                $this->params = new Params([]);
            }
        }
    }

    /**
     * Получение имени метода запроса
     * @return string
     */
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return bool
     */
    public function isGet()
    {
        return $this->getMethod() === 'GET';
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->getMethod() === 'POST';
    }

    /**
     * @return bool
     */
    public function isPut()
    {
        return $this->getMethod() === 'PUT';
    }

    /**
     * @return bool
     */
    public function isDelete()
    {
        return $this->getMethod() === 'DELETE';
    }

    /**
     * @return bool
     */
    public function isHead()
    {
        return $this->getMethod() === 'HEAD';
    }

    /**
     * @return bool
     */
    public function isPatch()
    {
        return $this->getMethod() === 'PATCH';
    }

    /**
     * @return bool
     */
    public function isOptions()
    {
        return $this->getMethod() === 'OPTIONS';
    }

    /**
     * Получение Url текущего запроса
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Получение заголовков текущего запроса
     * @return Headers
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Получение объекта печенек
     * @return Cookie
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * Получение объекта текущей сессии
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Получение аргументов коммандной строки
     * @return Arguments
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Является запрос Ajax запросм?
     * @return bool
     */
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * @return bool
     * @see Request::isAjax()
     */
    public function isXhr()
    {
        return $this->isAjax();
    }

    /**
     * Проверяет является ли текуший запрос совершённым из коммандной строки
     * @return bool
     */
    public function isCLI()
    {
        return in_array(PHP_SAPI, ['cli', 'cli-server']);
    }

    /**
     * Проверяет является ли запрос статичным, не отправленным не
     * через Ajax и не из коммандной строки
     * @return bool
     */
    public function isStatic()
    {
        return !$this->isAjax()
            && !$this->isCli();
    }

    /**
     * Получение тела запроса. Для Content-Type: application/json
     * и Content-Type: application/x-www-form-urlencoded возвращает
     * массивы.
     * @return array|string
     */
    public function getBody()
    {
        $contentType = $this->headers->get('Content-Type');
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
    public function getParams()
    {
        return $this->params;
    }
}
