<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>contact</title>
    </head>
    <body>
        <?php
            $passe = 'MatClo1315';
            $hote="localhost";
            $dbname="contacts";
            $user='root';
            $pass = '';
            use PHPMailer\PHPMailer\PHPMailer;
            $pdo = new PDO('mysql:host='.$hote.';dbname='.$dbname.';charset=utf8',$user,$pass);

            require 'vendor/autoload.php';

            $mail = new PHPMailer;
            // Vérification des champs
            if(!empty($_POST['email']) && !empty($_POST['Nom']) && !empty($_POST['Prenom']) && !empty($_POST['Phone']) && !empty($_POST['Adresse']) && !empty($_POST['Objet']) && !empty($_POST['Msg'])){
                // Récupération des champs de saisi
                $email = $_POST['email'];
                $nom = $_POST['Nom'];
                $prenom = $_POST['Prenom'];
                $phone = $_POST['Phone'];
                $adresse = $_POST['Adresse'];
                $objet = $_POST['Objet'];
                $msg = $_POST['Msg'];
                //$file = $_FILES['file'];
           
                // Vérification de la syntaxe du mail
                $point = strpos($email, ".");
                $aroba = strpos($email, "@");
                
                // On informe l'utilisateur qu'il manque un caractére
                if ($point === false)
                    echo 'Votre email doit comporter un point.';
                else if ($aroba === false)
                    echo 'Votre email doit comporter un arobase.';
                else
                    echo 'Votre email est : ' . $email;                                             // Si toutes les vérifications sont ok
            }
            
            //Server settings                                           
            $mail->isSMTP();                                                                        // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                                                   // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                                               // Enable SMTP authentication
            $mail->Username   = 'chrisdlm.jeu@gmail.com';                                           // SMTP username
            $mail->Password   = $passe;                                                             // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                                     // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                                                // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
            //Recipients
                if(!empty($nom) && !empty($prenom)){
                    $mail->setFrom($email, $nom.' '.$prenom);                                       // Origine du mail
                
                    $mail->addAddress('delmotte.christophe@hotmail.fr','Chris Dlm');                // Destinataire 
                    $mail->addAddress($email, $nom.' '.$prenom);                                    // Second destinataire
  
                    // Content
                    $mail->isHTML(true);                                                            // On précise que le mail est au format HTML
                    $mail->addEmbeddedImage('img/layout_set_logo.jpg','mon-image','logo.jpg');      // Préparation de l'image
                    //$mail->addAttachment($file);                                                    // Préparation de la pièce jointe
                    // Set email format to HTML
                    $mail->Subject = $objet;                                                        // Objet du mail
                    if(!empty($phone) && !empty($adresse) && !empty($msg))
                    {
                        //$decode = utf8_decode($msg); 
                        $message = utf8_decode("<!DOCTYPE html>
                                    <html>
                                        <body>
                                            
                                            <img src='cid:mon-image'> <br><br>
                                            <h1>Laon</h1>
                                            <h3>Merci $nom $prenom pour votre message</h3><br>
                                            Nous allons prendre connaissance de votre message et nous reviendrons vers vous dans les plus bref délais.<br>
                                            Vous avez renseigné vos coordonnées:<br>
                                            Mail : $email<br>
                                            Telephone : $phone<br>
                                            Adresse : $adresse<br>
                                            Votre message : $msg
                                        </body>
                                    </html>");
                                
                        $mail->Body = <<< EOT
                            $message
                        EOT;                                                            // Corps du mail
                        
                        // Sauvegarde en base de données
                        $stmt = $pdo->prepare("INSERT INTO contact (mail,nom,prenom,phone,adresse,objet,message) VALUES (:mail,:nom,:prenom,:phone,:adresse,:objet,:message)");

                        $stmt->bindValue(':mail',$email);                                               // Construction valeur email
                        $stmt->bindValue(':nom',$nom);                                                  // Construction valeur nom
                        $stmt->bindValue(':prenom',$prenom);                                            // Construction valeur prenom
                        $stmt->bindValue(':phone',$phone);                                              // Construction valeur phone
                        $stmt->bindValue(':adresse',$adresse);                                          // Construction valeur adresse
                        $stmt->bindValue(':objet',$objet);                                              // Construction valeur objet
                        $stmt->bindValue(':message',$msg);                                              // Construction valeur message

                        $stmt->execute();

                        //envois du mail
                        $mail->send();
                        echo ' Message has been sent';
                    }
                    else
                        echo "Vous n'avez pas renseigné un ou plusieurs champs du formulaire.";
                } 
            
        ?>
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Contacter-nous
        </button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel">Fiche contact</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group"><label for="inputEmail4">Votre email : </label><input type="text" name="email" class="form-control"></div>
                                <div class="form-row">
                                    <div class="form-group col-md-6"><label for="inputName">Nom : </label><input type="text" name="Nom" class="form-control"></div>
                                    <div class="form-group col-md-6"><label for="inputName">Prenom : </label><input type="text" name="Prenom" class="form-control"></div>
                                </div>
                                <div class="form-group"><label for="Phone">Téléphone : </label><input type="text" name="Phone" class="form-control"></div>
                                <div class="form-group"><label for="Adresse">Adresse : </label><input type="text" name="Adresse" class="form-control"></div>
                                <div class="form-group"><label for="Objet">Objet :</label><input type="text" name="Objet" class="form-control"></div>
                                <div class="form-group"><label for="Msg">Message : </label><textarea type="text" name="Msg" class="form-control"></textarea></div>
                                <!-- <div class="form-group"><label for="piece">Pièce jointe : </label><input type="file" name="file" id="file"></div> -->
                                <input type="submit" value="Envoyer" class="btn btn-primary btn-lg" name="submit">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>