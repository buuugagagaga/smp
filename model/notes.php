<?php
require_once "database.php";
$database = DataBase::getDB();

class Notes
{

    public static function createNote($title, $text, $userId)
    {
        global $database;
        $database->query(
            "INSERT INTO `notes` (`id`, `title`, `text`, `userId`, `typeId`, `date`) VALUES (NULL, {?}, {?}, {?}, {?}, {?});",
            array($title, $text, $userId, self::getRandomNoteTypeId(), date("Y-m-d H:i:s"))
        );
    }

    public static function changeNote($noteId, $title, $text, $typeId)
    {
        global $database;
        $database->query("
        UPDATE `notes` SET `title` = {?}, `text` = {?}, `typeId` = {?} WHERE `notes`.`id` = {?};
        ",
            array($title, $text, $typeId, $noteId)
        );
    }

    public static function deleteNote($noteId)
    {
        global $database;
        $database->query("
        UPDATE `notes` SET `deleted` = 1 WHERE `notes`.`id` = {?};
        ",
            array($noteId)
        );
    }

    public static function getRandomNoteTypeId()
    {
        global $database;
        $types = $database->select("SELECT * FROM note_types");
        return $types[rand(0, count($types) - 1)]["id"];
    }

    public static function getAllUserNotes($userId)
    {
        global $database;
        $result = $database->select("SELECT * FROM notes WHERE userId = {?}", array($userId));
        return $result;
    }

    public static function getNoteTypeColor($noteTypeId)
    {
        global $database;
        return $database->selectCell("SELECT name FROM note_types WHERE id = {?}", array($noteTypeId));
    }

    public static function shareNote($noteId, $recipientId)
    {
        global $database;
        $authorId = $database->selectCell("SELECT userId FROM notes WHERE id = {?}", array($noteId));

        if (!self::checkNoteAlreadyShared($noteId, $recipientId))
            if ($recipientId != $authorId)
                $database->query(
                    "INSERT INTO `shared_notes` (`id`, `noteId`, `recipientId`) VALUES (NULL, {?}, {?})",
                    array($noteId, $recipientId)
                );
            else return false;
    }

    private static function checkNoteAlreadyShared($noteId, $recipientId)
    {
        global $database;
        $sharedNoteId = $database->selectCell("SELECT id FROM shared_notes WHERE noteId = {?} AND recipientId = {?}",
            array($noteId, $recipientId)
        );
        if ($sharedNoteId != null)
            return true;
        return false;
    }

    public static function getSharedNotes($userId){
        global $database;
        $ids = self::getSharedNotesIds($userId);
        $result = array();
        foreach($ids as $id){
            $result[] = $database->selectRow("SELECT * FROM notes WHERE id = {?}",
                array($id["id"]));
        }
        return $result;

    }
    private static function getSharedNotesIds($userId){
        global $database;
        $result = $database->select("SELECT id FROM shared_notes WHERE recipientId = {?}",
            array($userId));
        return $result;
    }
}