<?php
// connecting to database
$conn = mysqli_connect("localhost", "virtuarteuser", "virtuartepassword", "virtuarte") or die("Database Error");

// getting user message through ajax
// $getMesg = mysqli_real_escape_string($conn, $_POST['text']);

//checking user query to database query
$texto = strtolower($_POST['text']);
if($texto == "sair" || $texto == "Sair"){
    echo "Recomeçando";
}
else{
    if($_POST['nivel'] == 1){
        $texto = strtolower($_POST['text']);
        if(trim($texto) != '' && trim($texto) != null){
            if($texto == 'oi' || $texto == 'olá' || $texto == 'bom dia' || $texto == 'boa tarde' || $texto == 'boa noite'){
                echo "<p class='text-break'>Que estado você pretende visitar?</p>";
            }else{
                echo "Desculpe, não consegui te entender";
            }
        }
        else{
            echo "Hmm, acho que não entendi";
        }
    }
    if($_POST['nivel'] == 2){
        $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    
        if(trim($estado) != '' && trim($estado) != null){
            $check_data = "SELECT nome FROM estado WHERE nome LIKE '%$estado%'";
    
            $run_query = mysqli_query($conn, $check_data) or die("Error");
    
            if(mysqli_num_rows($run_query) > 0){
                echo "<p class='text-break'>Que cidade você pretende visitar?</p>";
            }else{
                echo "Desculpe, não encontrei informações relacionadas";
            }
        }
        else{
            echo "Hmm, acho que não entendi";
        }
    }
    // if($_POST['nivel'] == 3){
    //     echo "Olá, eu sou o Vitu! Em que posso te ajudar?";
    // }
    if($_POST['nivel'] == 3){
        $estado = mysqli_real_escape_string($conn, $_POST['estado']);
        $cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
    
        if(trim($cidade) != '' && trim($cidade) != null){
        $check_data = "SELECT nome FROM cidade WHERE nome LIKE '%$cidade%'";
    
        $run_query = mysqli_query($conn, $check_data) or die("Error");
    
            if(mysqli_num_rows($run_query) > 0){
                $check_data = "SELECT user.nome, user.id_usuario
                FROM usuario user
                LEFT JOIN organizacao org
                ON user.id_usuario = org.fk_usuario_id_usuario
                LEFT JOIN endereco adr
                ON adr.id_endereco = org.fk_endereco_id_endereco
                LEFT JOIN bairro br
                ON br.id_bairro = adr.fk_bairro_id_bairro
                LEFT JOIN cidade city
                ON city.id_cidade = br.fk_cidade_id_cidade
                LEFT JOIN estado uf
                ON uf.id_estado = city.fk_estado_id_estado
                WHERE uf.nome LIKE '%$estado%'
                AND city.nome LIKE '%$cidade%'
                LIMIT 5";
    
                $run_query = mysqli_query($conn, $check_data) or die("Error");
    
                if(mysqli_num_rows($run_query) > 0){
                    // //fetching replay from the database according to the user query
                    // $fetch_data = mysqli_fetch_assoc($run_query);
                    // //storing replay to a varible which we'll send to ajax
                    // $replay = $fetch_data['nome'];
    
                    echo "<p class='text-break'>Dê uma olhada nessas dicas</p>";
    
                    $cont = 0;
    
                    foreach($run_query as $place){
                        $cont++;
                        // <p class="text-break">'+ '<a href="#" class="text-white" onclick="window.location.reload()">Recomeçar</a>' +'</p>
                        $replay = "<p class='text-break'><a href='/user/profile/".$place['id_usuario']."' class='text-white'>".$cont.". ".$place['nome']."</a></p>";
                        echo $replay;
                    }
                    // echo $replay;
                }else{
                    echo "Desculpe, não tenho nenhuma sugestão para esse local";
                }
            }else{
                echo "Desculpe, não encontrei informações relacionadas";
            }
        }
        else{
            echo "Hmm, acho que não entendi";
        }
        
    }
    if($_POST['nivel'] == 4){
        $texto = strtolower($_POST['text']);
        if($texto == 'obrigada' || $texto == 'obrigada, vitu' || $texto == 'obrigada vitu' || $texto == 'obrigado' || $texto == 'obrigado, vitu' || $texto == 'obrigado vitu' || $texto == 'valeu' || $texto == 'valeu, vitu' || $texto == 'valeu vitu'){
            echo "Foi um prazer te ajudar =D";
        }else{
            echo "Desculpe, não consegui te entender";
        }
    }
}


// $check_data = "SELECT nome FROM usuario WHERE email LIKE '%$getMesg%'";
// $run_query = mysqli_query($conn, $check_data) or die("Error");

// if user query matched to database query we'll show the reply otherwise it go to else statement
// if(mysqli_num_rows($run_query) > 0){
//     //fetching replay from the database according to the user query
//     $fetch_data = mysqli_fetch_assoc($run_query);
//     //storing replay to a varible which we'll send to ajax
//     $replay = $fetch_data['nome'];
//     echo $replay;
// }else{
//     echo "Desculpe, não consegui te entender";
// }

?>