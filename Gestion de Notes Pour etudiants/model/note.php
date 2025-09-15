<?php 
    require_once __DIR__.'/database.php';
    class Note {
        private $db;
        private $jointure = "
            select * 
            from suivre
            inner join matiere
            using(id_matiere)
            right join eleve
            using(id_etudiant) 
        ";

        public function __construct() {
            $this->db = new Database();
        }
            
        public function create($id_etudiant,$id_matiere,$note) {
            $sql = "insert into suivre set id_etudiant=?,id_matiere=?,note=?";
            $params = array($id_etudiant,$id_matiere,$note);
            $this->db->prepareSQL($sql,$params);
        }

        public function read($id_matiere,$id_classe) {
            $sql = "$this->jointure where id_matiere=? and id_classe=?";
            $params = array($id_matiere,$id_classe);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,false);
        }

        public function readone($id_matiere,$id_classe) {
            $sql = "  select note 
            from suivre
            inner join matiere
            using(id_matiere)
            inner join eleve
            using(id_etudiant)  where id_matiere=? and id_etudiant=?";
            $params = array($id_matiere,$id_classe);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }

        public function update($id_etudiant,$id_matiere,$note) {
            $sql = "update suivre set note=? where id_etudiant=? and id_matiere=?";
            $params = array($note,$id_etudiant,$id_matiere);
            $this->db->prepareSQL($sql,$params);
        }
    }  
?>