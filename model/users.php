<?php


require_once "database.php";
$database = DataBase::getDB();

class Users
{

    public static function createUser($email, $password)
    {
        if (!self::isAlreadyRegistered($email)) {
            global $database;
            $password = md5($password);
            $database->query(
                "INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, {?}, {?});",
                array($email, $password)
            );
            return true;
        } else {
            return false;
        }
    }

    public static function isAlreadyRegistered($email)
    {
        global $database;
        $user = $database->selectRow("SELECT * FROM `users` WHERE `email` = {?}", array($email));
        if ($user["email"] == $email)
            return true;
        return false;
    }
    public static function checkIdIsToken($id)
    {
        global $database;
        $user = $database->selectRow("SELECT * FROM `users` WHERE `id` = {?}", array($id));
        if ($user["id"] == $id)
            return true;
        return false;
    }

    public static function checkUserEmailAndPassword($email, $password)
    {
        if (self::isAlreadyRegistered($email)) {
            $password = md5($password);
            if (self::checkUserPassword($email, $password))
                return true;
            return false;
        } else return false;
    }

    public static function getUserId($email)
    {
        if (self::isAlreadyRegistered($email)) {
            global $database;
            return $database->selectCell("SELECT id FROM users WHERE email={?};", array($email));
        }
        return false;
    }

    public static function getUserEmail($id)
    {
        global $database;

        return $database->selectCell("SELECT email FROM users WHERE id={?};", array($id));
    }

    private static function checkUserPassword($email, $password)
    {
        global $database;
        $user = $database->selectRow("SELECT * FROM `users` WHERE `email` = {?}", array($email));
        if ($user["password"] == $password)
            return true;
        return false;
    }
}
