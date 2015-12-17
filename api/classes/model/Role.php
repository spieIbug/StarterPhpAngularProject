<?php
/**
 * Created by PhpStorm.
 * Classe model pour les roles utilisateur
 * User: yacmed
 * Date: 16/12/2015
 * Time: 10:26
 */
    class Role implements \JsonSerializable{
        private $id;
        private $libelle;
        private $flag;

        /**
         * Role constructor.
         */
        public function __construct() {
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

        /**
         * Specify data which should be serialized to JSON
         * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
         * @return mixed data which can be serialized by <b>json_encode</b>,
         * which is a value of any type other than a resource.
         * @since 5.4.0
         */
        function jsonSerialize() {
            $vars = get_object_vars($this);
            return $vars;
        }
    }