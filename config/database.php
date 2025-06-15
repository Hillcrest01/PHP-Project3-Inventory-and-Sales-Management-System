<?php
$hostname = 'Localhost';
$dbuser = 'root';
$dbname = 'unifie';
$dbpassword = 'Kulundeng.Jamach.1';

//the order given in the mysqli_connect arguments should be followed.
$conn = mysqli_connect($hostname,$dbuser,$dbpassword, $dbname, );

if(!$conn){
    die("Something went wrong with the connection");
}

?>