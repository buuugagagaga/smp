<?php

//todo: Перепроверить
require_once("functions.php");

if (count($database->get_tables()) == 0) {
    $database->query("
CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` varchar(256) CHARACTER SET utf8 NOT NULL,
  `text` varchar(4096) CHARACTER SET utf8 NOT NULL,
  `userId` int(11) NOT NULL,
  `typeId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");
    $database->query("
CREATE TABLE `note_types` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `color` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");
    $database->query("
        INSERT INTO `note_types` (`id`, `name`, `color`) VALUES
    (3, 'IndianRed', 'CD5C5C'),
    (4, 'LightSalmon', 'FFA07A'),
    (5, 'Tomato', 'FF6347'),
    (6, 'LemonChiffon', 'FFFACD'),
    (7, 'DarkKhaki', 'BDB76B'),
    (9, 'Lavender', 'E6E6FA'),
    (10, 'BurlyWood', 'DEB887'),
    (11, 'FloralWhite', 'FFFAF0'),
    (12, 'DarkSeaGreen', '8FBC8F');
    ");
    $database->query("
    CREATE TABLE `shared_notes` (
      `id` int(11) NOT NULL,
      `noteId` int(11) NOT NULL,
      `recipientId` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");
    $database->query("
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

");
    $database->query("
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `typeId` (`typeId`);
");
    $database->query("
ALTER TABLE `note_types`
  ADD PRIMARY KEY (`id`);
");
    $database->query("
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
");
    $database->query("
ALTER TABLE `shared_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noteId` (`noteId`),
  ADD KEY `noteId_2` (`noteId`),
  ADD KEY `recepientId` (`recipientId`);
    ");
    $database->query("
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
");
    $database->query("
ALTER TABLE `note_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
");
    $database->query(
        "
ALTER TABLE `shared_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
");
    $database->query(
        "
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
");
    $database->query("
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`typeId`) REFERENCES `note_types` (`id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
");
    $database->query("
ALTER TABLE `shared_notes`
  ADD CONSTRAINT `shared_notes_ibfk_1` FOREIGN KEY (`noteId`) REFERENCES `notes` (`id`),
  ADD CONSTRAINT `shared_notes_ibfk_2` FOREIGN KEY (`recipientId`) REFERENCES `users` (`id`);
");


    echo "DataBase setup is done";
} else "Cleat database before setup";
