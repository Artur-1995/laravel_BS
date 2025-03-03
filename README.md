<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Проекта Laravel

Стек:

-   фреймворк Laravel/Yii2
-   mysql

Разрабока прототипа хостинга изображений.

## 1. Реализована форма для загрузки изображений

Правила для загрузки изображений:

-   в 1 запрос, в одной форме, можно загружать до 5 файлов.
-   название каждого файла транслителируется на английский язык и приводиться к
    нижнему регистру
-   название каждого файла уникальным, и, если файл с таким названием существует,
    новому файлу присваивается уникальное названию
-   все файлы сохраняются в одну директорию
-   в БД вносится информация о загруженных файлах: название файла, дата и время загрузки

## 2. Реализована страница просмотров информации об изображениях.

На странице реализовано:

-   вывод информации о загруженных файлах (название файла, дата и время загрузки)
-   просмотр превью изображения
-   возможность просмотра оригинального изображения
-   сортировка по названию/дате и времени загрузки изображения
-   возможность скачать файл в zip архиве

### 3. Реализован API доступ

-   вывод информации о загруженных файлах в json
    пример:
    "{domain}/api/photos?token={your_token}"
-   получить данные о загруженном файле по id в json
    пример:
    "{domain}/api/photo/{photoId}?token={your_token}"

    domain - домен по которому находится проект
    your_token - ваш токен из личного кабинета
    photoId - идентификатор нужного изображения (id в строке браузера, при просмотре фото)
