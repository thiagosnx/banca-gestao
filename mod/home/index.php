<?php 
include_once '../../environment/database.php';
include_once '../../environment/conexao.php';
include_once '../sys/functions/index.php';
$loadClass = new Gestao();
$gestoes = $loadClass->getGestoes();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Gestão Inteligente</title>

</head>
<body>
<div class="navbar">
        <a class="active" href="#home">Home</a>
        <a href="#about">Sobre</a>
        <a href="#services">Serviços</a>
        <a href="#contact">Contato</a>
</div>
    <div id="popup" class="popup">
        <p>Gestão inciada com sucesso!</p>
    </div>
<div class="main-container">

    <div id="gestao">
        <h1>Nova Gestão</h1>
        <div class="nw-gestao-form">
            <form id="nwGst">
            <label for="">Valor do Depósito</label>
            <input type="number" name="vl_dpst" placeholder="BRL">
            <label for="">Data do Depósito (opcional)</label>
            <input type="date" name="description">
            <button type="button" class="form-button">
                Iniciar nova gestão
            </button>
            </form>
        </div>
        <div id="gsts">
            <div class="gst">
            <p class="gst-description">
            </p>
           
            
            </div>
        </div>
    </div>
</div>
    <script src="script.js"></script>
</body>
</html>