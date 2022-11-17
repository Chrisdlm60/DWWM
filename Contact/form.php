<?php
    if(isset($_POST['envoi']))
    {   
       // header('location: contact.html');
        
        $nom = $_POST['nom']; // required
        $mail = $_POST['mail'];
        $age = $_POST['age'];
        $object = $_POST['object'];
        $message = $_POST['message'];
    }
?>

<html>
    <head>

    </head>
    <body>
        <h1>Formulaire bien envoyé !</h1>

        <div>
            Merci d'avoir pris le temps.
            Voici un petit récapitulatif de votre formulaire:
        </div>
        <br>
        <div>
            Ton nom est: <?php print("$_POST['nom']"); ?>
            <br>
            <br>
            Ton email: <?php echo 'Email : ' .$_POST['mail'].; ?>
            <br>
            <br>
            Tu as :<?php echo 'Age : ' .$_POST['age'].; ?> ans 
            <br>
            <br>
            L'objet de ton message est: <?php echo 'Objet :' .$_POST['object']. ?>
            <br>
            <br>
            Le contenu de ton message est: 
            <br>
            <?php echo 'Message : ' .$_POST['message'].; ?>
        </div> 
    </body>
</html>