<?if ($auth):?>
    Добро пожаловать <?=$username?> <a href="/public/auth/logout/">[Выход]</a>
<?else:?>
<form action="/public/auth/login/" method="post">
    <input type="text" name="login" placeholder="Логин">
    <input type="text" name="pass" placeholder="Пароль">
    <input type="submit" name="submit" value="Войти">
</form>
<?endif;?><br>

<a href="/public/">Главная</a>
<a href="/public/product/catalog">Каталог</a>
<a href="/public/basket">Корзина <span id="count"><?=$count?></span></a>
<br>