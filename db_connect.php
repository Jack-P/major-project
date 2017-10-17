<?php

  $DBhost = "localhost";
  $DBuser = "root"; //B00662595 or root
  $DBpass = ""; //v3yb6hpU
  $DBname = "b00662595";


  $DBcon = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);

    if ($DBcon->connect_errno) {
        die("ERROR : -> ".$DBcon->connect_error);
    }
