<?php

$host='localhost';
$user='root';
$pass='';
$bdd='project';

try{
    return $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $bdd . ';charset=utf8', $user, $pass);
}
catch (Exception $e){
    exit('Failed to connection');
}
