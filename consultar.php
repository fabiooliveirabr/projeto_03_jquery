<?php
include "conexao.php";
$cod = $_POST['cod'];
$sql = "SELECT * FROM tb_movimentacoes
        WHERE cod_rastreio LIKE '$cod'";
$consultar = $pdo->prepare($sql);
try{
    $consultar->execute();
    if($consultar->rowCount()>=1){
        $resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultado as $item){
            $tipo = $item['tipo_movimentacao'];
            $data_movim = $item['data_hora_movi'];
            $origem = $item['origem'];
            $destino = $item['destino'];
        
            //Converter data para o formato brasileiro
            $somente_data = date("d/m/Y", strtotime($data_movim));
            $somente_hora = date("H:i:s", strtotime($data_movim));

            echo "
                    <div class='atualizacao'>
                        <span class='tipo'>$tipo</span> <br>
                        <span class='data_hora'>
                            $somente_data às $somente_hora
                        </span> <br>
                        <span class='locais'>
                            $origem → $destino
                        </span> <br> 
                    </div>
            ";

        }
    }else{
        echo "Nada encontrado!";
    }
}catch(PDOException $erro){
    echo "Falha ao consultar!";
}

?>