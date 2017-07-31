# Slexx\Request\Request

## Оглавление

* Slexx\Request\Request
* [Slexx\Request\Session](https://github.com/slexx1234/request/blob/master/docs/Session.md)
* [Slexx\Request\Cookie](https://github.com/slexx1234/request/blob/master/docs/Cookie.md)
* [Slexx\Request\Params](https://github.com/slexx1234/request/blob/master/docs/Params.md)

## Методы
### Request::getMethod()

Получение имени метода запроса

**Возвращает:** `string`

### Request::isGet()

**Возвращает:** `bool`

### Request::isPost()

**Возвращает:** `bool`

### Request::isPut()

**Возвращает:** `bool`

### Request::isDelete()

**Возвращает:** `bool`

### Request::isHead()

**Возвращает:** `bool`

### Request::isPatch()

**Возвращает:** `bool`

### Request::isOptions()

**Возвращает:** `bool`

### Request::getUrl()

Получение Url текущего запроса

**Возвращает:** [Url](https://github.com/slexx1234/url/blob/master/docs/Url.md), `null`

### Request::getHeaders()

Получение заголовков текущего запроса

**Возвращает:** [Headers](https://github.com/slexx1234/headers), `null`

### Request::isAjax()

Является запрос Ajax запросм?

**Возвращает:** `bool`

### Request::isXhr()

**Возвращает:** `bool`

### Request::isCLI()

Проверяет является ли текуший запрос совершённым из коммандной строки

**Возвращает:** `bool`

### Request::isSync()

Проверяет является ли запрос статичным, не отправленным не
через Ajax и не из коммандной строки

**Возвращает:** `bool`

### Request::getBody()

Получение тела запроса. Для Content-Type: application/json
и Content-Type: application/x-www-form-urlencoded возвращает
массивы.

**Возвращает:** `array`, `string`

### Request::getParams()

Получение параметров запроса

**Возвращает:** [Params](https://github.com/slexx1234/request/blob/master/docs/Params.md), `null`

### Request::getHeader($name)

Получает заголовак

**Аргументы:**

| Имя     | Тип      | Описание      |
| ------- | -------- | ------------- |
| `$name` | `string` | Имя заголовка |

**Возвращает:** `string`, `null`

### Request::hasHeader($name)

Проверяет существование заголовка

**Аргументы:**

| Имя     | Тип      | Описание      |
| ------- | -------- | ------------- |
| `$name` | `string` | Имя заголовка |

**Возвращает:** `bool`
