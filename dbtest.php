<?php
    require_once("database.php");
    echo "Database class test <br>";
    $db = DataBase::getDB();
    $query = "SELECT * FROM `users` WHERE `id` = {?}";
    $table = $db->selectRow($query, array(1)); // Запрос явно должен вывести таблицу, поэтому вызываем метод select()

    echo $table["email"]."<br>";
    echo $table["password"];
?>