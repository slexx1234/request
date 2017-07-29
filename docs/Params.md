# Slexx\Request\Params

## Оглавление

* [Slexx\Request\Request](https://github.com/slexx1234/request/blob/master/docs/Request.md)
* [Slexx\Request\Session](https://github.com/slexx1234/request/blob/master/docs/Session.md)
* [Slexx\Request\Cookie](https://github.com/slexx1234/request/blob/master/docs/Cookie.md)
* Slexx\Request\Params

## Методы

### Params->__construct($params)

**Аргументы:**

| Имя       | Тип     | Описание                  |
| --------- | ------- | ------------------------- |
| `$params` | `array` | Массив параметров запроса |

### Params->all()

Получение всех переменных

**Возвращает:** `array`

### Params->getIterator()

Позволяет перебирать параметры в цикле `foreach`

**Возвращает:** `ArrayIterator`

### Params->count()

Подсщет колличества переменных

**Возвращает:** `int`

### Params->has($key)

Проверка существования переменной запроса

**Аргументы:**

| Имя    | Тип      | Описание      |
| ------ | -------- | ------------- |
| `$key` | `string` | Имя параметра |

**Возвращает:** `bool`

### Params->get($key)

Получение переменной запроса

**Аргументы:**

| Имя    | Тип      | Описание      |
| ------ | -------- | ------------- |
| `$key` | `string` | Имя параметра |

**Возвращает:** `mixed`

### Params->toArray()

**Возвращает:** `array`

### Params->__toString()

**Возвращает:** `string`
