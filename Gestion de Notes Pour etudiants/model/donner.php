<?php 
    require_once __DIR__.'/database.php';
    class Donner {
        private $db;
        private $jointure = "
            select *,group_concat(matiere.nom,',') 
            from donner 
            inner join matiere
            using(id_matiere)
            right join proffeseur
            using(id_proffeseur) 
            group by id_proffeseur
        ";

        public function __construct() {
            $this->db = new Database();
        }

        public function create($id_proffeseur,$id_matiere) {
            foreach ($id_matiere as $id) {
                foreach ($id_proffeseur as $proffeseur) {
                    $sql = "insert into donner set id_matiere=?,id_proffeseur=?";
                    $params = array($id,$proffeseur);
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
    }  

?>