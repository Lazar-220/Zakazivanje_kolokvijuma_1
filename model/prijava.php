<?php
    class Prijava{
        public $id;
        public $predmet;
        public $katedra;
        public $sala;
        public $datum;
        
        public function __construct($id=null,$predmet=null,$katedra=null,$sala=null,$datum=null){
            $this->id=$id;
            $this->predmet=$predmet;
            $this->katedra=$katedra;
            $this->sala=$sala;
            $this->datum=$datum;
        }

        public static function getAll(mysqli $conn){
            $sql="SELECT * FROM prijave";
            return $conn->query($sql);
        }

        public static function getById(mysqli $conn,$id){
            $sql="SELECT * FROM prijave WHERE id=$id";
            $rezultat= $conn->query($sql);
            $red=$rezultat->fetch_assoc();
            return $red;
        }

        public static function deleteById(mysqli $conn,$id){

            $sql="DELETE FROM prijave WHERE id=$id";                    //id=$this->id
            return $conn->query($sql);
        }

        public static function add(mysqli $conn, Prijava $prijava){

            $sql="INSERT INTO prijave(predmet, katedra, sala, datum) VALUES('$prijava->predmet','$prijava->katedra','$prijava->sala','$prijava->datum')";

            return $conn->query($sql);
        }

        public static function update(mysqli $conn, Prijava $prijava){

            $sql="UPDATE prijave SET predmet=$prijava->predmet, katedra=$prijava->katedra, sala=$prijava->sala, datum=$prijava->datum WHERE id=$prijava->id";

            return $conn->query($sql);
        }
    }
?>