<?php

    class Usuario {

        private $CatCodigo;
        private $CatNome;
        private $CatGrupo;
        private $CatSubGrupo;

        public function getCatCodigo(){
            return $this->CatCodigo;
                        //coluna da tabela CatCodigo
        }

        public function setCatCodigo($value){
            $this->CatCodigo = $value;
                    //coluna da tabela CatCodigo
        }

        public function getCatNome(){
            return $this->CatNome;
        }

        public function setCatNome($value){
            $this->CatNome = $value;
        }

        public function getCatGrupo(){
            return $this->CatGrupo;
        }

        public function setCatGrupo($value){
            $this->CatGrupo = $value;
        }

        public function getCatSubGrupo(){
            return $this->CatSubGrupo;
        }

        public function setCatSubGrupo($value){
            $this->CatSubGrupo = $value;
        }

        public function loadbyCod($id){
            
            $sql = new SqL();
            
            $results = $sql->select("SELECT * FROM categorias WHERE CatCodigo = :ID", array(":ID"=>$id));


            if (count($results) > 0) {

                $this->setDado($results[0]);

            }

        }
        public static function getList(){
           
            $sql = new SqL();

            return $sql->select("SELECT * FROM categorias ORDER BY CatCodigo");

        }

        public static function search($CatGrupo){
           
            $sql = new SqL();

            return $sql->select("SELECT * FROM categorias WHERE CatGrupo LIKE :SEARCH ORDER BY CatCodigo", array(
                ':SEARCH'=>"%".$CatGrupo."%"
            ));

        }

        public function searchCadastro($CatGrupo, $CatSubGrupo){

            $sql = new SqL();
            
            $results = $sql->select("SELECT * FROM categorias WHERE CatGrupo =  :CATGRUPO AND  CatSubGrupo = :CATSUBGRUPO", array(
                ":CATGRUPO"=>$CatGrupo,
                "CATSUBGRUPO"=>$CatSubGrupo
            ));


            if (count($results) > 0) {
                
                $this->setDado($results[0]);

            } else {

                throw new Exception("Cadastro inválido");                

            }

        }

        public function setDado($dado){

            $this->setCatCodigo($dado['CatCodigo']);
            $this->setCatNome($dado['CatNome']);
            $this->setCatGrupo($dado['CatGrupo']);
            $this->setCatSubGrupo($dado['CatSubGrupo']);

        }

        public function insert(){

            $sql = new SqL();

            $results = $sql->select("CALL sp_categorias_insert(:CATNOME, :CATGRUPO, :CATSUBGRUPO)", array(
                ':CATNOME'=>$this->getCatNome(),
                ':CATGRUPO'=>$this->getCatGrupo(),
                ':CATSUBGRUPO'=>$this->getCatSubGrupo()
            ));

            if (count($results) > 0){

                $this->setDado($results[0]);
            }


        }

        public function update($CatNome, $CatGrupo, $CatSubGrupo){

            $this->setCatNome($CatNome);
            $this->setCatGrupo($CatGrupo);
            $this->setCatSubGrupo($CatSubGrupo);

            $sql = new SqL();

            $sql->query("UPDATE categorias SET CatNome = :CATNOME, CatGrupo = :CATGRUPO, CatSubGrupo = :CATSUBGRUPO WHERE CatCodigo = :CATCODIGO", array(

                ':CATNOME'=>$this->getCatNome(),
                ':CATGRUPO'=>$this->getCatGrupo(),
                ':CATSUBGRUPO'=>$this->getCatSubGrupo(),
                ':CATCODIGO'=>$this->getCatCodigo()          

            ));
        }

        public function delete(){

            $sql = new SqL();

            $sql->query("DELETE FROM categorias WHERE CatCodigo = :CATCODIGO", array(

                ':CATCODIGO'=>$this->getCatCodigo()

            ));

            $this->setCatCodigo(0);
            $this->setCatNome("");
            $this->setCatGrupo("");
            $this->setCatSubGrupo("");       

        }

        public function __construct($CatNome = "", $CatGrupo = "", $CatSubGrupo = ""){

            $this->setCatNome($CatNome);
            $this->setCatGrupo($CatGrupo);
            $this->setCatSubGrupo($CatSubGrupo);
        }

        public function __toString(){
            
            return json_encode(array("CatCodigo"=>$this->getCatCodigo(),
            "CatNome"=>$this->getCatNome(),
            "CatGrupo"=>$this->getCatGrupo(),
            "CatSubGrupo"=>$this->getCatSubGrupo()));
            
        }

    }


?>
