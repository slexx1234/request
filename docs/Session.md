# Slexx\Request\Session

## Оглавление

* [Slexx\Request\Request](https://github.com/slexx1234/request/blob/master/docs/Request.md)
* Slexx\Request\Session
* [Slexx\Request\Cookie](https://github.com/slexx1234/request/blob/master/docs/Cookie.md)
* [Slexx\Request\Params](https://github.com/slexx1234/request/blob/master/docs/Params.md)

## Методы
### Session::isStarted()

Проверяет была ли стартована сессия

**Возвращает:** `bool`

### Session::start()

Старт сессии, вызывать этот метод на прямую не нужно, в случае
необходимости старт сессии будет произведён автоматически

**Возвращает:** `void`

### Session::destroy()

Завершение сессии

**Возвращает:** `void`

### Session::all()

**Возвращает:** `array`

### Session::count()

**Возвращает:** `int`

### Session::clear()

Очистка сессии

**Возвращает:** `void`

### Session::get($key)

Получение переменной сессии

**Аргументы:**

| Имя    | Тип             | Описание              |
| ------ | --------------- | --------------------- |
| `$key` | `int`, `string` | Имя переменной сессии |

**Возвращает:** `mixed`

### Session::has($key)

Проверка существования переменной сессии

**Аргументы:**

| Имя    | Тип             | Описание              |
| ------ | --------------- | --------------------- |
| `$key` | `int`, `string` | Имя переменной сессии |

**Возвращает:** `bool`

### Session::set($key, $value)

Установка переменной сессии

**Аргументы:**

| Имя      | Тип             | Описание              |
| -------- | --------------- | --------------------- |
| `$key`   | `int`, `string` | Имя переменной сессии |
| `$value` | `mixed`         | Значение переменной   |

**Возвращает:** `void`

### Session::remove($key)

Удаление переменной сессии

**Аргументы:**

| Имя      | Тип             | Описание              |
| -------- | --------------- | --------------------- |
| `$key`   | `int`, `string` | Имя переменной сессии |

**Возвращает:** `void`

### Session::flash($key, $value = null)

Флэш сообщение, если не указывать второй параметр то значение переменной сессии
будет возвращено, а сама перемменная будет удалена, в противном случае будет
установленна переменная сессии

**Аргументы:**

| Имя      | Тип             | Описание              |
| -------- | --------------- | --------------------- |
| `$key`   | `int`, `string` | Имя переменной сессии |
| `$value` | `mixed`         | Значение переменной   |

**Возвращает:** `mixed`

**Пример:**

```php
var_dump(Session::has('foo')); // -> false
Session::flash('foo', 'bar');
var_dump(Session::has('foo')); // -> true
var_dump(Session::flash('foo')); // -> 'bar'
var_dump(Session::has('foo')); // -> false
```

