<?php 
    require_once __DIR__.'/database.php';
    class Etudiant {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function create($nom,$prenom,$sexe,$matricule,$age,$photo,$id_classe) {
            $sql = "insert into eleve set nom=?,prenom=?,sexe=?,age=?,matricule=?,photo=?,id_classe=?";
            $params = array($nom,$prenom,$sexe,$age,$matricule,$photo,$id_classe);
            $this->db->prepareSQL($sql,$params);
        }

        public function getlastid() {
            $sql = "select id_etudiant from eleve order by id_etudiant desc limit 1";
            $params = null;
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }  

        public function readuser($id_classe) {
            $sql = "select nom,prenom ,AVG(note) from eleve inner join suivre using(id_etudiant)
            where id_classe=? group by id_etudiant order by AVG(note) desc";
            $params = array($id_classe);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,false);
        }

        public function readone($id) {
            $sql = "select * from eleve where id_etudiant=?";
            $params = array($id);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }

        public function read() {
            $sql = "select * from eleve";
            $params = null;
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,false);
        }
 
        public function update($id,$nom,$prenom,$sexe,$matricule,$age,$photo,$id_classe) {
            $sql = "update eleve set nom=?,prenom=?,sexe=?,age=?,matricule=?,photo=?,id_classe=? where id_etudiant=?";
            $params = array($nom,$prenom,$sexe,$age,$matricule,$photo,$id_classe,$id);
            $this->db->prepareSQL($sql,$params);
        }

        public function delete($id) {
            $sql = "delete from eleve where id_etudiant=?";
            $params = array($id);
            $this->db->prepareSQL($sql,$params);
            
        }

        public function Connexion($nom,$mat) {
            $sql = "select * from eleve where nom=? and matricule=? limit 1";
            $params = array($nom,$mat);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }

    }  
?>