<?php
include_once '../../environment/database.php';
include_once '../../environment/conexao.php';


class Gestao {
    public function genId(){
        $ts = time();
        return $ts;
    }

    public function getGestoes(){
        $sql = 'select g.ID_GST
        , g.VL_DPST_GST
        , g.DT_GST_INC
        , g.DT_GST_FIM
        , g.RSTD_GST
        , g.VL_RSTD_GST from gst g';
        $db = new Database("bancagestao");
        $res = $db->DbGetFull($sql);
        $gestoes = $res['result'];
        return $gestoes;
    }

    public function getGestaoById(){
        $ID_GST = $_GET['id'];
        $sql = "select 
        g.ID_GST
        , g.VL_DPST_GST
        , g.DT_GST_INC
        , g.DT_GST_FIM
        , g.RSTD_GST
        , g.VL_RSTD_GST from gst g where ID_GST = '$ID_GST'";
        $db = new Database("bancagestao");
        $resp = $db->dbGetOne($sql);
        $gestao = $resp['result'];
        return $gestao;
    }

    public function setNewGestao(){
        $ID_GST = $this->genId();
        $VL_DPST_GST = $_POST['vl_dpst_gst'];
        $sql = "insert into gst (
            ID_GST
            , VL_DPST_GST
            , DT_GST_INC
            ) values (
            '$ID_GST','$VL_DPST_GST', NOW())";
        $db = new Database("bancagestao");
        $res = $db->DbInsert($sql);
        echo json_encode($res);
    }

    public function setNewTransacao(){
        $ID_TRNC = $this->genId();
        $ID_GST = $_POST['id_gst'];
        $TIP_TRNC = $_POST['tip_trnc'];
        $VL_TRNC = $_POST['vl_trnc'];
        $DT_TRNC = $_POST['dt_trnc'];
        $ODD_APST = $_POST['odd_apst'];
        $RSTD_APST = $_POST['rstd_apst'];
        $RTRN_APST = $_POST['rtrn_apst'];

        $sql = "insert into trnc (
        ID_TRNC
        , ID_GST
        , TIP_TRNC
        , VL_TRNC
        , DT_TRNC
        , ODD_APST
        , RSTD_APST
        , RTRN_APST
        )
        values ( 
        '$ID_TRNC', '$ID_GST', '$TIP_TRNC', '$VL_TRNC', '$DT_TRNC', '$ODD_APST', '$RSTD_APST', '$RTRN_APST'
        )";
    }
}

$loadClass = new Gestao();
$loadClass->getGestoes();

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
        case 'stNwTrnc':
            $loadClass->setNewTransacao();
            break;
    }
}


