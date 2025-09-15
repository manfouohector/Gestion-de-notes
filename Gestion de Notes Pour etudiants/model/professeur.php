<?php 
    require_once __DIR__.'/database.php';
    class Prof {
        private $db;
        public function __construct() {
            $this->db = new Database();
        }

        public function create($nom,$prenom,$sexe,$matricule,$age,$photo) {
            $sql = "insert into proffeseur set photo=?,nom=?,prenom=?,mat=?,sexe=?,age=?";
            $params = array($photo,$nom,$prenom,$matricule,$sexe,$age);
            $this->db->prepareSQL($sql,$params);
        }

        public function readone($id) {
            $sql = "select * from proffeseur where id_proffeseur=?";
            $params = array($id);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }

        public function read() {
            $sql = "select * from proffeseur";
            $params = null;
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,false);
        }
 
        public function update($id,$nom,$prenom,$sexe,$matricule,$age,$photo) {
            $sql = "update proffeseur set photo=?,nom=?,prenom=?,mat=?,sexe=?,age=? where id_proffeseur=?";
            $params = array($photo,$nom,$prenom,$matricule,$sexe,$age,$id);
            $this->db->prepareSQL($sql,$params);
        }

        public function delete($id) {
            $sql = "delete from proffeseur where id_proffeseur=?";
            $params = array($id);
            $this->db->prepareSQL($sql,$params);  
        }

        public function Connexion($nom,$mat) {
            $sql = "select * from proffeseur where nom=? and mat=? limit 1";
            $params = array($nom,$mat);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }

    }  
?>