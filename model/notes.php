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
    public static function restoreNote($noteId)
    {
        global $database;
        $database->query("
        UPDATE `notes` SET `deleted` = 0 WHERE `notes`.`id` = {?};
        ",
            array($noteId)
        );
    }
    public static function clearDeletedNote($noteId)
    {
        global $database;
        $database->query("
        DELETE FROM `notes` WHERE `notes`.`id` = {?};
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
    public static function getAllNoteTypes()
    {
        global $database;
        return $database->select("SELECT * FROM note_types");
    }
    public static function getAllUserNotes($userId)
    {
        global $database;
        $result = $database->select("SELECT * FROM notes WHERE userId = {?} ORDER BY id DESC", array($userId));
        return $result;
    }
    public static function getNoteById($noteId)
    {
        global $database;
        $result = $database->select("SELECT * FROM notes WHERE id = {?}", array($noteId));
        return $result;
    }
    public static function getNoteTypeColor($noteTypeId)
    {
        global $database;
        return $database->selectCell("SELECT name FROM note_types WHERE id = {?}", array($noteTypeId));
    }

    public static function filterNotesByDate($notes, $dateString){
        global $database;
        $result = array();
        $date = DateTime::createFromFormat('j F, Y', $dateString);
        foreach($notes as $note){
            $noteDate = DateTime::createFromFormat("Y-m-d H:i:s", $note["date"]);
        
            if($date->format("Y-m-d") == $noteDate->format("Y-m-d"))
                $result[] = $note;
        }
        return $result;
    }


    public static function shareNote($noteId, $recipientId)
    {
        global $database;
        $authorId = $database->selectCell("SELECT userId FROM notes WHERE id = {?}", array($noteId));

        if (!self::checkNoteAlreadyShared($noteId, $recipientId))
            if ($recipientId != $authorId && Users::checkIdIsToken($recipientId))
                $database->query(
                    "INSERT INTO `shared_notes` (`id`, `noteId`, `recipientId`) VALUES (NULL, {?}, {?})",
                    array($noteId, $recipientId)
                );
            else return false;
        return true;
    }
    public static function checkNoteAlreadyShared($noteId, $recipientId)
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
                array($id["noteId"]));
        }
        return $result;

    }
    private static function getSharedNotesIds($userId){
        global $database;
        $result = $database->select("SELECT noteId FROM shared_notes WHERE recipientId = {?}",
            array($userId));
        return $result;
    }
    public static function getRecipientsIds($noteId){
        global $database;
        $result = $database->select("SELECT recipientId FROM shared_notes WHERE noteId = {?}",
            array($noteId));
        return $result;
    }
    public static function dismissRecipient($noteId, $recipientId){
        global $database;
        $database->query("
        DELETE FROM shared_notes WHERE noteId = {?} AND recipientId = {?};
        ",
            array($noteId, $recipientId)
        );
    }
}