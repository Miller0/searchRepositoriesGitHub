<?php

use system\App;

$title="Главная"; // название формы
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php");
?>

<div id="page-content">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <h1 class="font-weight-light mt-4 text-white">Сервис по поиску репозиториев github</h1>
                <p class="lead text-white-50">
                    Сервис по поиску репозиториев github с наиболее высоким рейтингом. Пользователи этого сервиса
                    имеют возможность сохранять понравившиеся репозитории. Пользователь через API сервиса может иметь
                    возможность получать свои сохраненные записи.
                </p>
            </div>
        </div>
    </div>
</div>



<?php
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php");
?>
