<?php
/**
 * Created by PhpStorm.
 * User: yacmed
 * Date: 16/12/2015
 * Time: 10:26
 */
    class Role {
        private $id;
        private $libelle;
        private $flag;

        public function __construct(){
            $this->id = 0;
            $this->libelle = "";
            $this->flag = 1;
        }

        /**
         * @return mixed
         */
        public function getId(){
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id){
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getLibelle(){
            return $this->libelle;
        }

        /**
         * @param mixed $libelle
         */
        public function setLibelle($libelle){
            $this->libelle = $libelle;
        }

        /**
         * @return mixed
         */
        public function getFlag(){
            return $this->flag;
        }

        /**
         * @param mixed $flag
         */
        public function setFlag($flag){
            $this->flag = $flag;
        }

    }
?>