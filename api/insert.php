<?php
require('../config.php');
if(strtolower($_SERVER['REQUEST_METHOD']) === 'post') {

    $title = filter_input(INPUT_POST, 'title');
    $body = filter_input(INPUT_POST, 'body');

    if($title && $body) {

        $sql = $pdo->prepare('INSERT INTO notes (title, body) VALUES (:title, :body)');
        $sql->bindValue(':title', $title);
        $sql->bindValue(':body', $body);
        $sql->execute();

        $id = $pdo->lastInsertId();//get the last id insert

        $array['result'] = [
            'id' => $id,
            'title' => $title,
            'body' => $body
        ];
    } else {
        $array['error'] = 'Title e/ou body vazios. Preencha-os corretamente.';       
    }
} else {
    $array['error'] = 'Método não permitido. (somente POST)';   
}
require('../return.php');