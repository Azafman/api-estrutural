<?php
require('../config.php');

if(strtolower($_SERVER['REQUEST_METHOD']) === 'get') {

    $id = filter_input(INPUT_GET, 'id');

    if($id) {
        $sql = $pdo->prepare('SELECT * FROM notes WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $resultOfReq = $sql->fetch(PDO::FETCH_ASSOC);//lembre-se sempre, toda resposta de requisição de dados à um bd, retorna um array, como por exemplo esse a seguir: 
            //             Array
            // (
            //     [id] => 2
            //     [title] => Em busca de Deus
            //     [body] => dsckjndjn  dlcjndjcnhjn lkjdn ljndcjc
            // )

            $array['result'] = [
                'id' =>  $resultOfReq['id'],
                'title' =>  $resultOfReq['title'],
                'body' =>  $resultOfReq['body'],
            ];
        } else {
            $array['error'] = 'ID inexistente! Tente novamente.';           
        }
        
    }

} else {
    $array['error'] = 'Método não permitido. (somente GET)';   
}

require('../return.php');