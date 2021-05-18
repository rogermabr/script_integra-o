<?php

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

//dados da conexão com db

$host = "localhost";
$user = "root";
$pass = "123456";
$db = "formulario";

//criando a conexão

$link = mysqli_connect($host, $user, $pass, $db);
if (!$link) {
  	exit;
}

//recebendo o json
$dados = file_get_contents("php://input");

//analisa a string codificada JSON e converte-a em uma variável do PHP
$dadosjson = json_decode($dados,TRUE);


// Corre todo Array da variável e atribui a variável $row 

foreach ($dadosjson["leads"] as $row) {


        // aqui atribui os campos do Json com uma variável do PHP assim fica mais facil na query

        $leads = $dados; //aqui fica o JSON inteiro
        $nome = $row["name"]; // aqui fica separado o nome e assim salvando em outra coluna separadamente.
        $email = $row["email"];
 

        //query INSERT com as variáveis criadas 

        $sql = "INSERT INTO conversao (json_lead, id_conversao, nome, email)VALUES ('$leads',null,'$nome', '$email')";
  
        //rodando a query junto com a conexão do banco e posteriormente finalizando a conexão

        mysqli_query($link,$sql) or die("<br>Erro ao tentar cadastrar registro!!!");
        mysqli_close($link);
    }

    
echo "Cliente cadastrado com sucesso!<br><br>";



?>
