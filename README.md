# CRUD for "Medicines"

Проєкт реалізує CRUD для сутності "Medicines" (поля: назва препарату, виробник, термін придатності, ціна) і містить як API-ендпоїнти, так і прості веб-сторінки для управління записами.

## Запуск через Docker

Цей репозиторій містить готовий `docker-compose.yml`. Стек складається з контейнерів: `php` (php-fpm), `nginx` (порт 80) та `postgres`.

Щоб підняти сервіс у фоновому режимі:

```bash
docker-compose up -d
```

Після підняття контейнерів потрібно застосувати міграції (створити таблиці). Виконайте команду всередині php-контейнера:

```bash
# Виконати міграції
docker-compose exec php php artisan migrate
```

Якщо ваш контейнер php має іншу назву у вашій локальній конфігурації, замініть `php` на назву сервісу або скористайтесь `docker exec php4-fpm ...` (зауважте, наш php-контейнер у compose має container_name: `php4-fpm`).

## Доступ до програми

Після запуску через Docker та nginx доступ до веб-інтерфейсу — за адресою:

http://localhost/

Nginx проксує запити до php-fpm, тож вміст готових Blade-сторінок (UI) доступний на вебу. CRUD сторінки для ліків доступні за шляхом:

- Веб UI: http://localhost/medicines
- API: http://localhost/api/medicines

> Примітка: якщо у вас порт 80 зайнятий або ви запускаєте локально без Docker, замініть адресу/порт відповідно (наприклад http://127.0.0.1:8000 для `php artisan serve`).

## Тестування API / E2E

У репозиторії додано зручний файл для ручного тестування HTTP-запитів та скрипт для автоматичного запуску:

- `medicines_crud.http` — файл з послідовністю HTTP-запитів (Create, Index, Show, Update, валідаційні негативні кейси, Delete, Show після видалення). Його можна відкривати у IDE (PhpStorm / IntelliJ) або VS Code з REST Client і виконувати запити по порядку. Перед виконанням замініть `{{ID}}` на id створеного ресурсу або використайте механізм підстановки відповіді вашого клієнта.

- `medicines_crud.sh` — bash-скрипт, який автоматично виконує ту саму послідовність через `curl` і потребує `jq` для обробки JSON. Приклад запуску:

```bash
cd /home/thinkpad/Documents/client-server-mkr
./medicines_crud.sh                # за замовчуванням звертається до http://localhost:8000
# або вказати інший базовий URL, наприклад якщо nginx на localhost:
./medicines_crud.sh http://localhost
```

> Порада: якщо ви використовуєте `medicines_crud.http` у IDE, після виконання запиту створення скопіюйте повернутий `id` і підставте його у `{{ID}}` для наступних запитів.

## Використання веб-сторінок

Окрім API, у проекті є прості Blade-сторінки для CRUD (HTML-формы), тому не обов'язково тестувати лише через API — можна працювати напряму через браузер:

- Сторінка списку: http://localhost/medicines
- Створити: http://localhost/medicines/create
- Подивитись/Редагувати: http://localhost/medicines/{id}

Ці сторінки використовують контролер `App\Http\Controllers\MedicineController`.

## Короткі вказівки з налагодження

- Подивіться логи контейнерів, якщо щось не працює:

```bash
docker-compose logs -f nginx
docker-compose logs -f php
docker-compose logs -f postgres
```

- Якщо міграції не застосовуються, перевірте підключення до БД у файлі `.env` (в `.env` за замовчуванням встановлено `DB_CONNECTION=pgsql` та хост `postgres` — тобто контейнер postgres у docker-compose).

- Щоб вручну потестувати API через terminal, використовуйте curl (приклади є у `medicines_crud.http` у коментарях та у `medicines_crud.sh`).
