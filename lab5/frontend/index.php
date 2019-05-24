<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="style.css">
<html>
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №5</title>
</head>
<body>
<main>
<h1>Лабораторная работа №5</h1>

<fieldset id="fieldset1">

    <legend>Клиенты</legend>

    <form action="http://localhost/ProPr/lab5/backend/clients.php" enctype="multipart/form-data" method="GET">
        <fieldset>
            <label>ID клиента</label><input type="text" name="id_sel">
            <input type="submit" value="Найти" name="SelectClient">
        </fieldset>
    </form>

    <form action="http://localhost/ProPr/lab5/backend/clients.php" enctype="multipart/form-data" method="POST">
        <fieldset>
            <label>ФИО</label><input type="text" enctype="multipart/form-data" name="name_ins">
            <input type="submit" value="Добавить" name="InsertClient">
        </fieldset>
    </form>

    <form action="http://localhost/ProPr/lab5/backend/clients.php" enctype="multipart/form-data" method="GET">
        <fieldset>
            <label>ID клиента</label><input type="text" name="id_del">
            <input type="submit" value="Удалить" name="DeleteClient">
        </fieldset>
    </form>

    <form action="http://localhost/ProPr/lab5/backend/clients.php" enctype="multipart/form-data" method="POST">
        <fieldset>
            <label>ID клиента</label><input type="text" name="id_upd">
            <label>ФИО</label><input type="text" name="name_upd">
            <input type="submit" value="Обновить" name="UpdateClient">
        </fieldset>
    </form>
</fieldset>

<fieldset id="fieldset2">

    <legend>Заявки</legend>

    <form action="http://localhost/ProPr/lab5/backend/requests.php" method="GET">
        <fieldset>
            <label>ID заявки</label><input type="text" name="id_sel">
            <input type="submit" value="Заявка" name="SelectRequest">
        </fieldset>
    </form>

    <form action="http://localhost/ProPr/lab5/backend/requests.php" method="POST">
        <fieldset>
            <label>ID клиента</label><input type="text" name="id_ins">
            <input type="submit" value="Добавить" name="InsertRequest">
        </fieldset>
    </form>

    <form action="http://localhost/ProPr/lab5/backend/requests.php" method="GET">
        <fieldset>
            <label>ID заявки</label><input type="text" name="id_del">
            <input type="submit" value="Удалить" name="DeleteRequest">
        </fieldset>
    </form>

    <form action="http://localhost/ProPr/lab5/backend/requests.php" method="POST">
        <fieldset>
            <label>ID заявки</label><input type="text" name="id_rqst_upd">
            <label>ID клиента</label><input type="text" name="id_clnt_upd">
            <input type="submit" value="Обновить" name="UpdateRequest">
        </fieldset>
    </form>

</fieldset>

<fieldset id="fieldset3">

    <legend>Услуги</legend>

    <form action="http://localhost/ProPr/lab5/backend/services.php" method="GET">
        <fieldset>
            <label>ID услуги</label><input type="text" name="id_sel">
            <input type="submit" value="Услуга" name="SelectService">
        </fieldset>
    </form>

    <form action="http://localhost/ProPr/lab5/backend/services.php" method="POST">
        <fieldset>
            <label>Название</label><input type="text" name="name_ins">
            <label>Цена</label><input type="text" name="price_ins">
            <input type="submit" value="Добавить" name="InsertService">
        </fieldset>
    </form>

    <form action="http://localhost/ProPr/lab5/backend/services.php" method="GET">
        <fieldset>
            <label>ID услуги</label><input type="text" name="id_del">
            <input type="submit" value="Удалить" name="DeleteService">
        </fieldset>
    </form>

    <form action="http://localhost/ProPr/lab5/backend/services.php" method="POST">
        <fieldset>
            <label>ID услуги</label><input type="text" name="id_upd">
            <label>Название</label><input type="text" name="name_upd">
            <label>Цена</label><input type="text" name="price_upd">
            <input type="submit" value="Обновить" name="UpdateService">
        </fieldset>
    </form>

</fieldset>
</main>
</body>
</html>