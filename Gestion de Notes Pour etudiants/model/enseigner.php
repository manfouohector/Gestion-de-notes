<?php 
    require_once __DIR__.'/database.php';
    class Enseigner {
        private $db;
        private $jointure = "
            select * ,group_concat(matiere.nom,',')
            from enseigner 
            inner join matiere
            using(id_matiere)
            right join classe
            using(id_classe) 
            group by id_classe
        ";

        public function __construct() {
            $this->db = new Database();
        }

        public function create($id_classe,$id_matiere) {
            foreach ($id_matiere as $id) {
                foreach ($id_classe as $classe) {
                    $sql = "insert into enseigner set id_matiere=?,id_classe=?";
                    $params = array($id,$classe);
                    $this->db->prepareSQL($sql,$params);
                }
            }
        }

        public function read() {
            $sql = $this->jointure;
            $params = null;
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,false);
        }

        public function readMatieres($id_classe) {
            $sql = "select enseigner.id_matiere 
            from enseigner 
            inner join matiere
            using(id_matiere)
            inner join classe
            using(id_classe) where id_classe=?";
            $params = array($id_classe);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,false);
        }

        public function countenseignant() {
            $sql = "select count(*) as ens from proffeseur";
            $params = null;
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }

        public function countclasse() {
            $sql = "select count(*) as cla from classe";
            $params = null;
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }

        public function counteleve() {
            $sql = "select count(*) as el from eleve";
            $params = null;
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->Getdatas($req,true);
        }
    }  

?>