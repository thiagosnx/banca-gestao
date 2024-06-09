<?php
include_once '../../environment/database.php';
include_once '../../environment/conexao.php';


class Gestao {
    function genId(){
        $ts = date('dmYhis');
        return $ts;
    }

    function getGestoes(){
        $sql = 'select * from gst';
        $db = new Database("bancagestao");
        $res = $db->DbGetFull($sql);
        $dados = $res['result'];
        echo json_encode($dados);
    }

    function setNewGestao(){
        $ID_GST = $this->genId();
        $VL_DPST_GST = $_POST['vl_dpst_gst'];
        $sql = "insert into gst (
            ID_GST, VL_DPST_GST, DT_GST_INC
            ) values (
            '$ID_GST','$VL_DPST_GST', NOW())";
        $db = new Database("bancagestao");
        $res = $db->DbInsert($sql);
        echo json_encode($res);
    }
}

if(isset($_POST['rq'])){
    session_start();
    include_once '../../environment/database.php';
    include_once '../../environment/conexao.php';
    $loadClass = new Gestao();

    $request = $_POST['rq'];

    switch($request){
        case 'getGst':
            $loadClass->getGestoes();
            break;
        case 'stNwGst':
            $loadClass->setNewGestao();
            break;
        
    }
}


