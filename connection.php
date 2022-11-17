<?php
   try{
      $pdo=new PDO("mysql:host=localhost;dbname=authentification","root","");
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
?>