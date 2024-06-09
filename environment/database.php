<?php
include_once 'conexao.php';

class Database extends Conexao {

    public $erro = "";

    function __construct($schema = 0){

        if(!is_numeric($schema)){$schema = 0;}

        $hostName = $this->server[$schema];
        $username = $this->user[$schema];
        $password = $this->pass[$schema];
        $database = $this->database[$schema];

		$this->connection = new mysqli($hostName, $username, $password, $database);
		$this->connection->set_charset("utf8");
		if (mysqli_connect_errno()) {
			printf("Mensagem de erro: %s\n", mysqli_connect_error());
			exit();
		}
	}

    function DbGetOne($csql) {
        $rt = array();
        if ($r1 = $this->connection->query($csql)) {
            $row = mysqli_fetch_assoc($r1);
            $res[0] = Array();
            $nc = [];
            if (count($row) > 0) {
                foreach ($row as $k => $v) {
                    $res[0][$k] = $v;
                    $nc[0] = $k;
                }
            }
            $rt = array(
                'sucesso' => true,
                'ncol' => $nc,
                'result' => $res
            );
        } else {
            $rt = array(
                'sucesso' => false,
                'message' => $this->erro = "Error retrieving stored procedure result set:%d (%s) %s: " . mysqli_errno($this->connection) ." -- ". mysqli_sqlstate($this->connection) ." -- ". mysqli_error($this->connection)
            );
        }
        $this->connection->close();
        return $rt;
    }

    function DbGetFull($csql) {
        $res = Array();
        if ($r1 = $this->connection->query($csql)) {
            $l = 0;
            $c = 0;
            $nc = [];
            while ($row = $r1->fetch_object()) {
                $res[$l] = Array();
                $c = 0;
                foreach ($row as $k => $v) {
                    if($l == 0){
                        $nc[$c] = $k;
                    }
                    $res[$l][$k] = $v;
                    $c++;
                }
                $l++;
            }
            $rt = array(
                'sucesso' => true,
                'cols' => $c,
                'ncol' => $nc,
                'rows' => $l,
                'result' => $res
            );
        } else {
            $rt = array(
                'sucesso' => false,
                'cols' => 0,
                'ncol' => 0,
                'rows' => 0,
                'message' => $this->erro = "Erro ao executar a Consulta: " . mysqli_errno($this->connection) ." -- ". mysqli_sqlstate($this->connection) ." -- ". mysqli_error($this->connection)
            );
        }
        $this->connection->close();
        return $rt;
    }

    function DbInsert($csql, $id = false, $producao = 1) {
        $rt = "";
        if ($this->connection->query($csql)){
            $rt = array('sucesso' => true);

            if($id){
                //'id' => $this->connection->insert_id
                $rt['id'] = mysqli_insert_id($this->connection);
            }

        } else {
            $rt = array(
                'sucesso' => false,
                'message' => $this->erro = "Erro ao executar a Query: " . mysqli_errno($this->connection) ." -- ". mysqli_sqlstate($this->connection) ." -- ". mysqli_error($this->connection)
            );
        }

        if($producao == 0){$rt['query'] = $csql;}

        return $rt;
        $this->connection->close();
    }

    function DbUpdate($csql, $producao = 1) {
        $rt = "";
        if ($this->connection->query($csql)){
            $rt = array('sucesso' => true);
        } else {
            $rt = array(
                'sucesso' => false,
                'message' => $this->erro = "Erro ao executar a Query: " . mysqli_errno($this->connection) ." -- ". mysqli_sqlstate($this->connection) ." -- ". mysqli_error($this->connection)
            );
        }

        if($producao == 0){$rt['query'] = $csql;}

        return $rt;
        $this->connection->close();
    }

    function DbDelete($csql, $producao = 1) {

		$rt = "";
        if ($this->connection->query($csql)){
            $rt = array(
                'sucesso' => true,
            );
        } else {
            $rt = array(
                'sucesso' => false,
                'message' => $this->erro = "Erro ao executar a Query: " . mysqli_errno($this->connection) ." -- ". mysqli_sqlstate($this->connection) ." -- ". mysqli_error($this->connection)
            );
        }
        if($producao == 0){$rt['query'] = $csql;}

        return $rt;
        $this->connection->close();
	}

    function DbCall($csql, $producao = 1) {

		$rt = "";
        if ($this->connection->query("Call ".$csql.";")){
            $rt = array(
                'sucesso' => true,
            );
        } else {
            $rt = array(
                'sucesso' => false,
                'message' => $this->erro = "Erro ao executar a Query: " . mysqli_errno($this->connection) ." -- ". mysqli_sqlstate($this->connection) ." -- ". mysqli_error($this->connection)
            );
        }
        if($producao == 0){$rt['query'] = $csql;}

        return $rt;
        $this->connection->close();
	}

    function DbGetAll($csql) {
        $res = Array();
        if ($r1 = $this->connection->query($csql)) {
            $i = 0;
            while ($row = $r1->fetch_object()) {
                $res[$i] = Array();
                foreach ($row as $k => $v) {
                    $res[$i][$k] = $v;
                }
                $i++;
            }
        } else {
            $this->erro = "Error retrieving stored procedure result set: \n" . mysqli_errno($this->connection) ." -- ". mysqli_sqlstate($this->connection) ." -- ". mysqli_error($this->connection);
            $this->connection->close();
        }
        return $res;
    }

    function DbQuery($csql) {

		if ($this->connection->query($csql)) {
            //$this->connection->execute($csql);
			return true;
		} else {
			//$this->erro = "<p>Error performing Query: \n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
			return "Erro: ".mysqli_errno($this->connection)." ----- ".mysqli_sqlstate($this->connection)." ----- ".mysqli_error($this->connection);
		}
		$this->connection->close();
	}
}
?>