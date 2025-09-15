<?php 
    require_once __DIR__.'/database.php';
    class Matiere {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function create($nom,$coef) {
            $sql = "insert into matiere set cofficient=?,nom=?";
            $params = array($coef,$nom);
            $this->db->prepareSQL($sql,$params);
        }

        public function readone($id) {
            $sql = "select * from matiere where id_matiere=?";
            $params = array($id);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }

        public function read() {
            $sql = "select * from matiere";
            $params = null;
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,false);
        }
 
        public function update($id,$nom,$coef) {
            $sql = "update matiere set cofficient=?,nom=? where id_matiere=?";
            $params = array($id,$coef,$nom,$id);
            $this->db->prepareSQL($sql,$params);
        }

        public function delete($id) {
            $sql = "delete from matiere where id_matiere=?";
            $params = array($id);
            $this->db->prepareSQL($sql,$params);
        }
    }  
?>