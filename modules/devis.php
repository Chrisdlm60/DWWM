<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="themes/tech/assets/css/theme.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
            background-color: rgba(0, 0, 0, 0.808);
        }

        h1,
        h2 {
            text-align: center;
            font-size: 4em;
        }

        h1 {
            color: black;
        }

        h2 {
            color: rgb(209, 209, 209);
            font-size: 1.8em;
        }

        small {
            color: white;
        }

        form {
            width: 50%;
            margin-left: 25%;
            padding: 15px 30px 15px 20px;
            border: 8px ridge rgba(255, 255, 255, 0.6);
            border-radius: 10px;
        }

        .form-control,
        label,
        #submit,
        #choix {
            margin: 5px
        }

        .form-control,
        #submit,
        #choix {
            border-radius: 5px;
            box-shadow: 6px 6px 3px black;
        }

        label {
            color: rgba(240, 255, 255, 0.822);
        }

        button#submit {
            border: none;
            color: rgba(0, 0, 0, 0.911);
            background-color: rgb(236, 236, 236)
        }

        #submit:hover,
        #submit:after {
            background-color: black;
            color: whitesmoke;
            box-shadow: 6px 6px 7px white;
        }
    </style>
</head>


<header>
    <h1>VapEnjoy</h1>
</header>

<h2>Demandez votre devis</h2>
<!-- Formulaire de demande de devis -->
<form action="" method="post">
    <div class="row">
        <div class="col">
            <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom.." required>
        </div>
        <div class="col">
            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prenom.." required>
        </div>
    </div>
    <div class="form-group">
        <label for="societe">Societe : </label>
        <input type="text" class="form-control" name="societe" id="societe" placeholder="Societe.." required>
    </div>
    <div class="form-group">
        <label for="adresse">Adresse : </label>
        <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse.." required>
    </div>
    <div class="form-group">
        <label for="phone">Telephone : </label>
        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Telephone.." pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" required>
        <small>Format : 0303033330</small>
    </div>
    <div class="form-group">
        <label for="mail">Mail :</label>
        <input type="email" class="form-control" name="mail" id="mail" placeholder="Mail.." required>
    </div>
    <div class="form-group">
        <label for="Installation">Installation sur : </label>
        <select class="form-control" name="choix" id="choix" required>
            <option selected>Choix...</option>
            <option value="droit">Mur Droit</option>
            <option value="angle">Angle mur</option>
        </select>
    </div>
    <div class="form-group">
        <label for="bouteille">Nombre de bouteilles :</label>
        <input type="number" class="form-control" name="bouteille" id="bouteille" min="1" placeholder="Nombre de bouteilles souhaitées.." required>
    </div>
    <div class="form-group">
        <label for="saveur">Nombre de saveurs :</label>
        <input type="number" class="form-control" name="saveurs" id="saveurs" min="1" placeholder="Nombre de saveurs souhaitées.." required>
    </div>
    <button id="submit" name="submit" type="submit" class="btn btn-primary">Envoyer</button>
    <small>Vous recevrez un mail récapitulatif de votre devis</small>
</form>

<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

// $passe = '';                                                     // Mot de passe de la boîte pro à cacher ailleurs

// Attente de validation d'envois
if (isset($_POST['submit'])) {

    $mail = new PHPMailer;                                       // Initialisation de la classe PHPMailer

    // Instanciation de variables aux valeurs du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $societe = $_POST['societe'];
    $adresse = $_POST['adresse'];
    $email = $_POST['mail'];
    $phone = $_POST['phone'];
    $install = $_POST['choix'];
    $bouteille = $_POST['bouteille'];
    $saveurs = $_POST['saveurs'];

    if ($install == 'droit')
        $install = 'Mur droit';
    else
        $install = 'Angle de mur';

    //Server settings                                           
    $mail->isSMTP();                                              // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                         // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                     // Enable SMTP authentication
    $mail->Username   = 'vincent.witczak@gmail.com';                 // SMTP username
    $mail->Password   = "Poil250Poil2501712!!";                                   // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                      // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Construction Mail
    $mail->setFrom('vincent.witczak@gmail.com');                     // Expéditeur
    $mail->addBCC('');                                            // Destinataire caché (mail pro)
    $mail->addAddress($email, $nom . ' ' . $prenom);              // Destinataire 
    $mail->isHTML(true);
    // $mail->addEmbeddedImage('');                               // Ajout image au mail

    $mail->Subject = 'Demande de devis';
    $message = utf8_decode("<!DOCTYPE html>
                                            <html>
                                                
                                                <style>
                                                    h1, h3 {
                                                        text-align: center;
                                                    }
                                                    table {
                                                        border: 2px solid black;
                                                        border-collapse: collapse;
                                                        width: 100%;
                                                        
                                                    }
                                                    td, tr {
                                                        border: 1px solid black;
                                                        width: 50%;
                                                        text-align: center;
                                                    }
                                                    thead {
                                                        font-size: 1.5em;
                                                        font-weight: bold 2px;
                                                    }
                                                    tr{
                                                        height: 50px;
                                                    }
                                                </style>
                                                <body>
                                                    
                                                    <h1>VapEnjoy</h1>
                                                    <h3>Merci $nom $prenom</h3><br>
                                                    Vous avez demandé : 
                                                    <br>
                                                    <br>
                                                    <table>
                                                        <thead>
                                                            <td>Intitulé </td>
                                                            <td>Nombre </td>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Installation : $install</td>
                                                                <td>1</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Bouteilles</td>
                                                                <td>$bouteille</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Saveurs</td>
                                                                <td>$saveurs</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <br>
                                                    <br>
                                                    Vos coordonnées sont : <br>
                                                    <ul>
                                                        <li>$email</li>
                                                        <li>$adresse</li>
                                                        <li>$phone</li>
                                                    </ul>
                                                    <br>
                                                    Nous allons prendre connaissance de votre demande et nous reviendrons vers vous dans les plus bref délais.<br>
                                                    
                                                </body>
                                            </html>");

    $mail->Body = <<< EOT
                        $message
                    EOT;

    $mail->send();
}
?>