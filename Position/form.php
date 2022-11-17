<?php
    if(isset($_POST['envoi']))
    {   
        header('location: contact.html');
        
        $nom = $_POST['nom']; // required
        $mail = $_POST['mail'];
        $age = $_POST['age'];
        $object = $_POST['object'];
        $message = $_POST['message'];
        
    }
    
?>