<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

После установки тестового проекта на локальном сервере необходимо выполнить команду

<p>composer update</p>

База данных test находится в коренвом каталоге проекта в папке DB.

Если необходимо выполнить установку БД через миграции, то

php yii migrate

Поскольку установлено расширение сохранения переводов служебных сообщений 
https://github.com/zelenin/yii2-i18n-module

для корректной работы необходимо также выполнить команду 

php yii migrate –migrationPath=@Zelenin/yii/modules/I18n/migrations

*ВАЖНО* При установке БД через миграции необходимо откорректировать в PHPMyAdmin все значения текстовых полей, в данном случае поля text таблицы articles (сменить VARCHAR на TEXT). Иначе будет ошибка добавления текстов статей блога.

Мультиязычность.

1. Количество языков неограниченно.
2. URL сайта представлены как ЧПУ и SEO оптимизированы. Ссылки вида:
example.com/en/mypage
example.com/ru/mypage
example.com/uk/mypage
3. Минимальные изменения в работе с фреймворком. Ресурс по ссылке example.com/mypage должен отдаваться на языке, установленным по умолчанию. Правила роутинга не изменяются в зависимости от количества языков.
Хранение языков
Таблица lang. 

Авторизация.

Стандартная (из коробки).
Изменена авторизация с имени юзера на мейл. Сделано модальное окно авторизации + Facebook.
Сделал на расширении yii2-authclient.
На практике обычно пользуюсь 
http://www.amigodev.com/article/yii2/yii2-user-socials

Своего боевого хоста не имею. Поэтому код и айдишники сайта необходимо добавить.

При сокрытии админки возможно сделать авторизацию по username. 
Админку только под админа на тестовом задании не закрывал (в жизни это не допустимо и решается обычно RBAC).

На https://github.com/NeroSys/API_testing есть реализация не только прав админа, но и прав комментирования и апдейта статей блога.


Картинки.

Реализована простая щагрузка картинок, которые не удаляются из папок upload при удалении из БД.
В проектах это недопустимо. Но в тестовом задании этого не было, поэтому не заморачивался. 
Кроппер реализован простой.

Все ЧПУ ссылки и СЕО под мета-теги тоже реализовал.
