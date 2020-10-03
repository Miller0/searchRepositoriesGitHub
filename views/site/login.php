<?php
$title="Форма авторизации";
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php");
?>

<div id="page-content">
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <!-- Форма авторизации -->
                <h2>Форма авторизации</h2>
                <? if (isset($errors) && !empty($errors)) : ?>
                    <div style="color: red; "><?= array_shift($errors) ?></div>
                    <hr>
                <? endif; ?>
                <form action="./login" method="post">
                    <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" required><br>
                    <input type="password" class="form-control" name="password" id="pass" placeholder="Введите пароль" required><br>
                    <button class="btn btn-success" name="do_login" type="submit">Авторизоваться</button>
                </form>
                <br>
                <p>Если вы еще не зарегистрированы, тогда нажмите <a href="/site/signup">здесь</a>.</p>
                <p>Вернуться на <a href="/">главную</a>.</p>
            </div>
        </div>

    </div>
</div>





<?php
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php");
?>
