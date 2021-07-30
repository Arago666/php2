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
    //добавляем товар в корзину и изменяем count
    let buttons = document.querySelectorAll('.buy');
    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/public/basket/buy', {
                        method: 'POST',
                        headers: new Headers({
                            'Content-Type' : 'application/json'
                        }),
                        body: JSON.stringify({
                            id: id
                        }),


                    });

                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;
                }
            )();
        })
    });
</script>