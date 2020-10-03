<?php
$title = "Регистрация";
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php");
?>

<div id="page-content">
    <div class="container text-center">

        <div class="row">
            <div class="col">
                <!-- Форма регистрации -->
                <h2>Форма регистрации</h2>
                <? if (isset($errors) && !empty($errors)) : ?>
                    <div style="color: red; "><?= array_shift($errors) ?></div>
                    <hr>
                <? endif; ?>
                <form action="./signup" method="post">
                    <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"><br>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Введите Email"><br>
                    <input type="text" class="form-control" name="surName" id="name" placeholder="Введите имя" required><br>
                    <input type="text" class="form-control" name="lastName" id="family" placeholder="Введите фамилию"
                           required><br>
                    <input type="password" class="form-control" name="password" id="password"
                           placeholder="Введите пароль"><br>
                    <input type="password" class="form-control" name="passwordRepeat" id="passwordRepeat"
                           placeholder="Повторите пароль"><br>
                    <button class="btn btn-success" name="doSignup" type="submit">Зарегистрировать</button>
                </form>
                <br>
                <p>Если вы зарегистрированы, тогда нажмите <a href="/site/login">здесь</a>.</p>
                <p>Вернуться на <a href="/">главную</a>.</p>
            </div>
        </div>

    </div>
</div>


<?php
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php");
?>
