<?php

    class Connection

    {
			
            private $host_name="localhost";
              private $user_name="root";
              private $password="";
              private $data_base="wedding_web";

            //private $user_name="zuruhvqw_wedding";
            //private $password="we2016web";
		    //private $data_base="zuruhvqw_wedding_web";
           
			


            public function get_connection()

            {

                    $connection=mysqli_connect($this->host_name, $this->user_name, $this->password,$this->data_base) or die("Cannot connect to Server due to ".mysqli_error());

                 //   mysqli_select_db($this->data_base, $connection) or die("Cannot connect to Database due to ".mysqli_error());

                    

                    return $connection;

            }

            

    }

?>