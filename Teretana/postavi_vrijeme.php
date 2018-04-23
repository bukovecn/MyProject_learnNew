<!DOCTYPE html>
<html>
    <head>
        <title>Postavljanje vremena</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Postavljanje vremena" />
        <meta name="kljucne_rijeci" content="teretana, projekt" />
        <meta name="datum_izrade" content="10.06.17." />
        <meta name="autor" content="Nikolina Bukovec" /> 
        <link rel="stylesheet" type="text/css" href="css/nikbukove2.css" />
    </head>
    <body>
        <header class="naslov">
             <div> Postavljanje vremena </div>
        </header>
        <?php

        $ispis = "";
        include('sesija.class.php');
        Sesija::kreirajSesiju();
        
        if (!isset($_SESSION["korisnik"])) {
            $ispis.= "Morate biti prijavljeni!";
            header("Location:prijava.php");
            exit();
        }
        
        $korisnickoIme = $_SESSION['korisnik'];
        $tip = $_SESSION['tip'];
        if($tip != '1'){
            $ispis = "Samo administrator može pristupiti ovoj stranici!";
        } else {
            header("Location:http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html ");
        }
                
    ?>
    <nav>
            <h2 class="heading" style="background-color: gainsboro;" >Izbornik: </h2>
            <ul>
                   <li><a href="dokumentacija.html" >Dokumentacija</a></li>
                    <li><a href="o_autoru.html" >O autoru</a></li>
                    <li><a href="index.php" >Početna stranica</a></li>
                    <li><a href="registracija.php" >Registracija</a></li>
                    <li><a href="prijava.php">Prijava</a></li>
                    <li><a href="otkljucavanje_korisnika.php">Otkljucavanje korisnika</a></li>
                    <li><a href="blokiranje_korisnika.php">Blokiranje korisnika</a></li>
                     <li><a href="postavi_vrijeme.php">Postavljanje vremena</a></li>
                    <li><a href="vrijeme.php">Virtualno vrijeme sustava</a></li>
                    <li><a href="dnevnik.php">Dnevnik rada</a></li>
                    <li><a href="konfiguracija_sustava.php">Konfiguracija sustava</a></li>
                    <li><a href="privatno/korisnici.php">Korisnici</a></li>
                </ul>
        </nav>
        
        <div style="margin-left: 70px; color: darkred;">
            <?php
                
                if(isset($ispis)){
                    echo $ispis;
                }

        ?>
        </div>
        
        <footer id='footer'>
            <p>Vrijeme izrade početne stranice: 1 sat </p>
            <figure>
                <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2016_projekti/WebDiP2016x019/index.html"">
                    <img src="slike/HTML5.png" width="100" alt="HTML 5 validator" />
                </a>
                <figcaption>HTML 5 validator</figcaption>
            </figure>
            <figure>
                <a href="https://jigsaw.w3.org/css-validator/check?uri=http://barka.foi.hr/WebDiP/2016/zadaca_01/nikbukove/nikbukove.css">
                <img src="slike/CSS3.png" width="100" alt="CSS 3 validator" />
                </a>
                <figcaption>CSS 3 validator</figcaption>
            </figure>
        </footer>
    </body>
</html>

