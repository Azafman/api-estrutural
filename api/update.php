<?php
require('../config.php');

if(strtolower($_SERVER['REQUEST_METHOD']) === 'put') {
    
    parse_str(file_get_contents('php://input'), $input);
    $id = $input['id'] ?? null;
    $title = $input['title'] ?? null;
    $body = $input['body'] ?? null;//de alguma forma pega os parametros na url

    if($id && $title && $body) {
        $sql = $pdo->prepare('SELECT * FROM notes WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $pdo->prepare('UPDATE notes SET title = :title, body = :body WHERE id = :id');
            $sql->bindValue(':id', $id);
            $sql->bindValue(':title', $title);
            $sql->bindValue(':body', $body);
            $sql->execute();

            $array['result'] = [
                'id' => $id,
                'title' =>$title,
                'body' => $body,
            ];
        } else {
            $array['error'] = 'Id inválido, inexistente.';    
        }
    } else {
        $array['error'] = 'Não foram enviados todas as informações suficientes';
    }

} else {
    $array['error'] = 'Método não permitido. (somente PUT)';   
}

require('../return.php');