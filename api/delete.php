<?php 
require("../config.php");

if(strtolower($_SERVER['REQUEST_METHOD']) === 'delete') {
    parse_str(file_get_contents('php://input'), $input);//só sei que funciona e substitui o "filter_input(input_post)"
    
    $id = $input['id'] ?? null;
    
    if($id) {        
        $sql = $pdo->prepare('SELECT * FROM notes WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() === 1) {
            $sqlTWo = $pdo->prepare('DELETE FROM notes WHERE id = :id');
            $sqlTwo->bindValue(':id', $id);
            $sqlTwo ->execute();

            $array['result'] = [
                'msg' => 'Id deletado com sucesso!'
            ];
        } else {
            $array['error'] = 'Id inexistente.';
        }
    } else {
        $array['error'] = 'Id não informado';
    }
} else {
    $array['error'] = 'Método não permitido. (somente delete)';
}

require("../return.php");
?>