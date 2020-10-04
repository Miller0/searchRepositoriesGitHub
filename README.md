Описание задачи
Создать сервис по поиску репозиториев github с наиболее высоким рейтингом. Пользователи этого сервиса должен иметь возможность сохранять понравившиеся репозитории. Пользователь через API сервиса должен иметь возможность получать свои сохраненные записи.


Для работы с репозиториями использовать следующий URL: https://api.github.com/search/repositories
Описание API GitHub: https://developer.github.com/v3/search/#search-repositories

Описание функционала

Создать функционал поиска репозиториев с наиболее высоким рейтингом по ключевому слову и/или языку программирования. Отобразить результат в браузере, в таблице, которая имеет следующие столбцы:
Название (full_name)
Описание (description)
Язык (language)
Рейтинг (stargazers_count)
Дата обновления (created_at)
Дата создания (updated_at).

Название репозитория в таблице должно вести на страницу этого репозитория на github (в новой вкладке браузера).

Должна быть возможность фильтровать информацию в таблице по следующим параметрам:
названию репозитория
языку кода
рейтингу
дате обновления
дате создания.

Пользователь должен иметь возможность сохранять информацию о репозитории. Далее необходимо разработать функционал личной страницы пользователя, где пользователь может:
просматривать список (такая же таблица как в пункте 1.) сохраненных репозиториев
фильтровать этот список (см пункт 3.)
удалять сохраненные репозитории.

Создать функционал API для получения списка сохраненных репозиториев пользователя.

Пользователь A не должен иметь возможность видеть и проводить операции над сохраненными репозиториями пользователя B и наоборот (актуально для API и остального функционала).

Правила выполнения задачи
использовать версию php 7+
не использовать фреймворки или библиотеки
покрытие кода тестами не обязательно
использовать базу данных MariaDB (MySQL)
в ответе GitHub API, игнорировать поля total_count и incomplete_results