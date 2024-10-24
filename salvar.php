<?php

session_start();

if (!isset($_SESSION['empresas'])) {
    $_SESSION['empresas'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_codigo = $_POST['codigo'];
    $_nomeempresa = $_POST['nomeempresa'];
    $_nomeFantazia = $_POST['nomefantazia'];
    $_tipoLogadouro  = $_POST['tipolougradoro'];
    $_cnpj = $_POST['cnpj'];
    $_data = $_POST['data'];
    $_tipoComplemento = $_POST['tipocomplemento'];
    $_complemento = $_POST['complemento'];
    $_lougradoro = $_POST['lougradoro'];
    $_cep = $_POST['cep'];
    $_pais = $_POST['pais'];
    $_estado = $_POST['estado'];
    $_cidade = $_POST['cidade'];
    $_celular = $_POST['celular'];
    $_telefone = $_POST['telefone'];
    $_fax = $_POST['fax'];
    $_email1 = $_POST['email1'];
    $_email2 = $_POST['email2'];

    $_dataFormatada = date("d/m/Y", strtotime($_data));
}



$_empresasSalvas = [
    ["Codigo:", $_codigo],
    ["Nome da Empresa:",  $_nomeempresa],
    ["Nome Fantazia:",  $_nomeFantazia],
    ["Tipo de Lougadouro:", $_tipoLogadouro],
    ["Cnpj: ",  $_cnpj],
    ["Data ", $_dataFormatada],
    ["Tipo de Complemento",$_tipoComplemento],
    ["Complemento",$_complemento],
    ["Logradouro",$_lougradoro],
    ["cep",$_cep],
    ["pais",$_pais],
    ["estado",$_estado],
    ["cidade",$_cidade],
    ["Celular:",$_celular],
    ["Telefone:",$_telefone],
    ["Fax: ",$_fax],
    ["Email 1: ",$_email1],
    ["Email 12: ",$_email2]
];

$caminho = "./empresas";

$arquivo = fopen("./empresas", "a+"); 

if ($arquivo) {


    if (filesize($caminho) === 0) {
        fwrite($arquivo, "Dados, Descrições\n"); 
    } 

    foreach ($_empresasSalvas as $linha) {
        
        $conteudoLinha =  implode(',',$linha) . "\n";
        
        fwrite($arquivo, $conteudoLinha); 
    }
    fclose($arquivo); 

} else {
    echo "Não foi possível abrir o arquivo.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas Cadastradas</title>
    <style>
        button {
            width: 200px;
            background-color: #28a745; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            padding: 10px 20px; 
            font-size: 16px; 
            cursor: pointer; 
            transition: background-color 0.3s, transform 0.2s; 
            margin: auto;
        }

        button:hover {
            background-color: #218838; 
            transform: translateY(-2px); 
        }

        
        table {
            border-collapse: collapse;
            width: 100%;
            width: 500px;
            height: 500px;
            background-color:#f4f4f4 ;
            margin: auto;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        
        th {
            writing-mode: vertical-lr;
           
            transform: rotate(180deg);
            
            text-align: center;
            vertical-align: middle;
        }

       
        td {
            height: 50px;
        }
        body{
        display: flex;
        flex-direction: column;
        text-align: center;
        }
    </style>
</head>

<body>

    <h1>Empresas Cadastrada</h1>
    <div id="tabela-container"></div>

    <script>
        // Função para converter o conteúdo do arquivo .txt em uma tabela HTML
        function exibirConteudoComoTabela(conteudo) {
            const linhas = conteudo.split('\n'); // Separar o conteúdo por linhas
            const tabela = document.createElement('table');
            const tbody = document.createElement('tbody');

            // Para cada linha no arquivo .txt, criamos uma linha na tabela
            linhas.forEach(linha => {
                const colunas = linha.split(','); // Separar as colunas por vírgula
                const tr = document.createElement('tr');

                // Para cada valor na coluna, criamos uma célula
                colunas.forEach(coluna => {
                    const td = document.createElement('td');
                    td.textContent = coluna.trim(); // Remover espaços em branco
                    tr.appendChild(td);
                });

                tbody.appendChild(tr);
            });

            tabela.appendChild(tbody);
            document.getElementById('tabela-container').appendChild(tabela);
        }

        // Carregar o arquivo .txt e exibir como tabela
        fetch('./empresas')
            .then(response => response.text())
            .then(texto => exibirConteudoComoTabela(texto))
            .catch(error => console.error('Erro ao carregar o arquivo:', error));

            function voltar(){
                window.location.href="form.html"
            }
    </script>
    <br>
<button onclick="voltar()" >Voltar ao cadastramento</button>
</body>

</html>