<?php 
    class Database {
        private $dns;
        private $userName;
        private $userPass;
        private $pdo;

        public function __construct() {
            $this->dns = "mysql:host=localhost;dbname=note;charset=utf8";
            $this->userName = "root";
            $this->userPass = "";
        }

        public function ConnectToDB() {
            if($this->pdo == null) {
                try {
                    $this->pdo = new PDO($this->dns,$this->userName,$this->userPass);
                }
                catch(EXception $ex) {
                    die("erreur" . $ex->getMessage());
                }
            }
            return $this->pdo;
        }

        public function prepareSQL($sql,$params = null) {
            $req = $this->ConnectToDB()->prepare($sql);
            if($params == null) {
                $req->execute();
            } else {
                $req->execute($params);
            }
            return $req;
        }

        public function Getdatas($req,$one=true) {
            $datas = null;
            if($one == true) {
                $datas = $req->fetch();
            } else {
                $datas = $req->fetchAll();
            }
            return $datas;
        }
    }