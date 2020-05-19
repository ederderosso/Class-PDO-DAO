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
                $row = $results[0];

                $this->setCatCodigo($row['CatCodigo']);
                $this->setCatNome($row['CatNome']);
                $this->setCatGrupo($row['CatGrupo']);
                $this->setCatSubGrupo($row['CatSubGrupo']);

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
                $row = $results[0];

                $this->setCatCodigo($row['CatCodigo']);
                $this->setCatNome($row['CatNome']);
                $this->setCatGrupo($row['CatGrupo']);
                $this->setCatSubGrupo($row['CatSubGrupo']);

            } else {

                throw new Exception("Cadastro inválido");                

            }

        }

        public function __toString(){
            
            return json_encode(array("CatCodigo"=>$this->getCatCodigo(),
            "CatNome"=>$this->getCatNome(),
            "CatGrupo"=>$this->getCatGrupo(),
            "CatSubGrupo"=>$this->getCatSubGrupo()));
            
        }

    }


?>
