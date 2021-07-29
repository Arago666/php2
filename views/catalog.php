<h2>Каталог</h2>
<?
foreach ($catalog as $item): ?>
    <h2><a href="/public/product/card/?id=<?=$item['id']?>"><?= $item['name'] ?></a></h2>

    <p><?=$item['description']?></p>
    <p>Цена: <?=$item['price']?> </p>
    <button data-id="<?=$item['id']?>" class="buy">Купить</button>
<hr>
<? endforeach;?>

<a href="/public/product/catalog/?page=<?=$page?>">Далее</a>

<script>
    let buttons = document.querySelectorAll('.buy');
    buttons.forEach((elem) => {});
</script>