<h2>Корзина</h2>
<? if(!is_null($products)):  ?>
    <? foreach ($products as $item): ?>
        <div>
            <h2><?= $item['name'] ?></h2>
            <p>Описание: <?=$item['description']?></p>
            <p>Цена: <?=$item['price']?> </p>
            <button>Удалить</button>
            <hr>
        </div>

    <? endforeach;?>
<? else: ?>
    Корзина пуста
<? endif; ?>
