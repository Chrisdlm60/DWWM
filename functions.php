<?php
session_start();
include "config.php";

function module_header($title){
    echo <<<EOT
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <link rel="stylesheet" href="css/style.css">
                <title>$title</title>
            </head>
            <body>
                <nav class="navtop">
                    <div class="menu">
                        <div class="menu-child">
                            <a href="index.php" class="menullink">Homepage</a>
                            
                            <a href="music.php" class="menullink" hidden>Musique</a>
                            <a href="film.php" class="menullink">Film</a>
                            <a href="book.php" class="menullink" hidden>Book</a>
                        </div>
                    </div>
                </nav>
        
    EOT;
}

function module_footer(){
    echo <<<EOT
        </body>
        </html>
    EOT;
}