<?php 

include_once '../sys/index.php';
$loadClass = new Gestao();
$gestoes = $loadClass->getGestoes();
// echo json_encode($gestoes);
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
    <a id="link-home" class="active" href="" onclick="changeActive('link-home')">Nova Gestão</a>
    <a id="link-about" href="" onclick="changeActive('link-about')">Minhas Gestões</a>
    <a id="link-services" href="" onclick="changeActive('link-services')">Suporte</a>
</div>
    <div id="popup" class="popup">
        <p>Gestão inciada com sucesso!</p>
    </div>
<div class="main-container">

    <div id="gestao">
        <h1>Gestão Inteligente</h1>
        <span style="color:red;" id="error-message"></span>
        <div class="nw-gestao-form">
            <form id="nwGst">
            <input type="hidden" name="rq" value="stNwGst">
            <label for="">Valor do Depósito</label>
            <input type="number" name="vl_dpst_gst" placeholder="BRL">
            <label for="">Data do Depósito (opcional)</label>
            <input type="date" name="dt_dpst">
            <button id="bt-st-nwfrm" type="button" class="form-button">
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