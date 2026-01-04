<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klienci</title>
</head>
<body>
    <? if(isset($clients)):?>
    <? foreach($clients as $client): ?>
    <div class="clientField">
        Imie: <?= htmlspecialchars($client["name"])?> <br>
        Numer telefonu: <?= htmlspecialchars($client["phoneNumber"])?> <br> 
        Miasto: <?= htmlspecialchars($client["city"]) ?>
    </div>
    <form action="/clientInfo" method="get">
        <button type="submit">Pokaż szczegóły</button>
    </form>
    <? endforeach ?>
    <hr>
    <?endif?>

    <form action="/clientsAll" method="get">
        <button type="submit">Pokaż listę wszyskich klientów</button>
    </form>

    <form action="/createClient" method="post">
        <input type="text" name="name">
        <input type="text" name="phoneNumber">
        <input type="text" name="city">

        <button type="submit">Utwórz</button>
    </form>
    
</body>
</html>