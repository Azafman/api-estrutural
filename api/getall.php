<?php 
require('../config.php');

if(strtolower($_SERVER['REQUEST_METHOD']) === 'get') {
    
    $sql = $pdo->query('SELECT * FROM notes');

    if($sql->rowCount() > 0) {
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $note) {
            array_push($array['result'], [
                'id' => $note['id'],
                'title' => $note['title'],
            ]);
        }
    }
} else {
    $array['error'] = 'Método não permitido. (somente GET)';   
}


require('../return.php');
?>