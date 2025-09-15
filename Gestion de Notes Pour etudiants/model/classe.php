<?php 
    require_once __DIR__.'/database.php';
    class Classe {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function create($nom) {
            $sql = "insert into classe set nom=?";
            $params = array($nom);
            $this->db->prepareSQL($sql,$params);
        }

        public function readone($id) {
            $sql = "select * from classe where id_classe=?";
            $params = array($id);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }

        public function read() {
            $sql = "select * from classe";
            $params = null;
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,false);
        }
 
        public function update($id,$nom) {
            $sql = "update classe set nom=? where id_classe=?";
            $params = array($nom,$id);
            $this->db->prepareSQL($sql,$params);
        }

        public function delete($id) {
            $sql = "delete from classe where id_classe=?";
            $params = array($id);
            $this->db->prepareSQL($sql,$params);
            
        }

    }  
?>