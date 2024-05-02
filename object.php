<?php
    class First{
        public $first_name='Oyidamola';
        public $lastname="Babalola";
        public $age =34;
        protected $school='SQI';
        protected $email ='oyin@gmail.com';
        public function get(){
            return "Hello code".$this->school;
        }
        public function __construct($first_name, $school){
            // return "My name";
            echo 'My name is '.$first_name, '  and my school is '.$school;
        }
    }
    $first = new First('Victoria', 'SQI');

    // $first->first_name = "lll";
    // echo $first->lastname, $first->age;
    // echo $first->first_name;
    // echo $first->lastname;
    // echo $first->lastname;
    $first->get();
    // echo $first->get();

    class Second extends First{
        public function getname(){
            return 'The name of my school is '.$this->school;
        }
    };
    
    // $second = new Second;
    // // print_r ($second);
    // echo $second->getname();

?>