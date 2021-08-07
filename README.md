# SPA - Блог. Realworld Clone.

## Laravel 8, Vue 3, Bootstrap 5

### Установка

- $ composer install
- $ php artisan migrate
- $ php artisan db:seed
- $ [OR] php artisan migrate:refresh --seed

### Для разработки фронтэнда

- $ cd resources/frontend/app
- $ прописать имя прокси сервера в vue.config.js 
(например http:/laravel.test. На котором ведётся разработка. Для избежания CORS)
- $ В файле resources/frontend/app/src/api/axios.js указать домен сервера разработки
- $ npm i
- $ npm run serve

### Собрать фронт

- $ npm run build

###### Пароли в сидах


## О проекте 
Этот репозиторий используется как примеры реализации. Некоторые вещи избыточны, некоторые в разработке.
При некоторой доработке можно использовать в продакшене. На сервере используется Laravel 8, пакет для авторизации
Sanctum, для примера реализованно добавление лайков через очередь. На фронте Vue 3, Vuex, Vue-router, Bootstrap 5.
Ларавэлевский mix не используется, без него удобней для верстальщика. 
