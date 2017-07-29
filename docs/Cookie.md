# Slexx\Request\Cookie

## Оглавление

* [Slexx\Request\Request](https://github.com/slexx1234/request/blob/master/docs/Request.md)
* [Slexx\Request\Session](https://github.com/slexx1234/request/blob/master/docs/Session.md)
* Slexx\Request\Cookie
* [Slexx\Request\Params](https://github.com/slexx1234/request/blob/master/docs/Params.md)

## Методы

### Cookie::all()

Получение всех печенек

**Возвращает:** `array`

### Cookie::count()

Подсщёт колличества печенек

**Возвращает:** `int`

### Cookie::has($key)

Проверка существования печеньки

**Возвращает:** `bool`

### Cookie::get($key)

Получение печеньки

**Аргументы:**

| Имя    | Тип      | Описание     |
| ------ | -------- | ------------ |
| `$key` | `string` | Имя печеньки |

**Возвращает:** `mixed`

### Cookie::set($key, $value, $options)

Устанавливает значение печеньки

| Имя                    | Тип             | Описание                                                                                   |
| ---------------------- | --------------- | ------------------------------------------------------------------------------------------ |
| `$key`                 | `string`        | Имя печеньки                                                                               |
| `$value`               | `string`        | Значение печеньки                                                                          |
| `$options`             | `array`         | Настройки печеньки                                                                         |
| `$options['expire']`   | `int`, `string` | Время жизни, по учмолчанию 30 дней. По умолчанию обрабатывается функцией strtotime.        |
| `$options['path']`     | `string`        | Директория для которой будет доступна печенька                                             |
| `$options['domain']`   | `string`        | Поддомен для которого будет доступна печенька                                              |
| `$options['secure']`   | `bool`          | Указывает на то что печеньки от клеента следует передовать только по HTTPS                 |
| `$options['httponly']` | `bool`          | Если установить true, то печеньки не будут доступны скриптовым языкам таким как javascript |

**Возвращает:** `void`

### Cookie::remove($key)

Удаляеет печеньку

**Аргументы:**

| Имя    | Тип      | Описание     |
| ------ | -------- | ------------ |
| `$key` | `string` | Имя печеньки |

**Возвращает:** `void`
