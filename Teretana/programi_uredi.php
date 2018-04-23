<?php
            include('baza.class.php');
            $baza = new Baza();
            $baza->spojiDB();
            
            include("sesija.class.php");
            Sesija::kreirajSesiju();

            if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }

            $tip = $_SESSION['tip'];

        if($tip != '1'){
            $ispis = "Samo administrator može pristupiti ovoj stranici!";
            header("Location:prijava.php");
            exit();
        }

         $greska ="";
         $poruka ="";
         //izmijeni odabrani
        if(isset($_POST["spremi"]) && !empty($_POST["redni"]) ){
                //$greska .= "Sada popunite podatke dolje za izmjenu.";
                $broj=$_POST["redni"];
            
                if(!empty($_POST["vrsta"]) && !empty($_POST["naziv"]) && !empty($_POST["opis"]) && !empty($_POST["mjesta"]) && !empty($_POST["slobodno"])){
                $vrsta=$_POST["vrsta"];
                $naziv=$_POST["naziv"];
                $opis=$_POST["opis"];
                $br_mjesta=$_POST["mjesta"];
                $slobodno=$_POST["slobodno"];
                
               
                    $spremi ="UPDATE `program` SET `vrsta_programa`='$vrsta', `naziv`='$naziv', `opis_programa`='$opis', `broj_mjesta`='$br_mjesta', `slobodno`='$slobodno' WHERE `idProgram`='$broj'";
                    $up=$baza->updateDB($spremi);
                    $poruka .= "Uspješno izmijenjen program!";
                    
                }
            else{
                $poruka .= "Niste popunili sva polja!<br>";
            } 
            }
            
            
            //dodaj novi
            if(empty($_POST["redni"])&&  isset($_POST["spremi"])){
                //$greska .= "Sada popunite podatke za dodavanje novog programa.";
                if(!empty($_POST["vrsta"]) && !empty($_POST["naziv"]) && !empty($_POST["opis"]) && !empty($_POST["mjesta"]) && !empty($_POST["slobodno"])){
                $vrsta=$_POST["vrsta"];
                $naziv=$_POST["naziv"];
                $opis=$_POST["opis"];
                $br_mjesta=$_POST["mjesta"];
                $slobodno=$_POST["slobodno"];
                
                    $spremi ="INSERT INTO `program`(`idProgram`, `vrsta_programa`, `naziv`, `opis_programa`, `broj_mjesta`, `slobodno`) VALUES (null,'$vrsta','$naziv','$opis','$br_mjesta','$slobodno')";
                    $up=$baza->updateDB($spremi);
                    $poruka .= "Uspješno dodan program!";
                    
                }
                else{
                    $poruka .= "Niste popunili sva polja!<br>";
                } 
            
            }
            
            /*obrisi odabrani
            if(!empty($_POST["redni"]) && isset($_POST["ob"])){
                $broj=$_POST["redni"];
                $delete ="DELETE FROM `program` WHERE `idProgram`='$broj'";
                $up=$baza->updateDB($delete);
                $poruka .= "Program je obrisan!";
            }
            */
            ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dodaj/izmijeni programe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Dodaj/izmijeni programe" />
        <meta name="kljucne_rijeci" content="projekt, teretana" />
        <meta name="datum_izrade" content="10.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove2.css" />
    </head>
    <body>
        <header class="naslov">
             <div> Dodaj/izmijeni programe </div>
        </header>
          
        </div>
        <nav>
            
            <ul>
                    <li><a href="dokumentacija.html" >Dokumentacija</a></li>
                    <li><a href="o_autoru.html" >O autoru</a></li>
                    <li><a href="index.php" >Početna stranica</a></li>
                    <li><a href="registracija.php" >Registracija</a></li>
                    <li><a href="prijava.php">Prijava</a></li>
                    <li><a href="aktivacija.php">Aktivacija</a></li>
                    <li><a href="otkljucavanje_korisnika.php">Otkljucavanje korisnika</a></li>
                    <li><a href="blokiranje_korisnika.php">Blokiranje korisnika</a></li>
                    <li><a href="postavi_vrijeme.php">Postavljanje vremena</a></li>
                    <li><a href="vrijeme.php">Virtualno vrijeme sustava</a></li>
                    <li><a href="dnevnik.php">Dnevnik rada</a></li>
                    <li><a href="konfiguracija_sustava.php">Konfiguracija sustava</a></li>
                    <li><a href="privatno/korisnici.php">Korisnici</a></li>
                </ul>
        </nav>
        <h3>Uredi podatke za: </h3><br><br>
        
        
        <form id="uredi" name="uredi" method ="POST" action="programi_uredi.php" >
            <label for ="redni" class ="padd" style="padding-left: 150px;">Unesite redni broj programa kojeg želite izmijeniti: </label>
            <input type="number" name="redni" id="redni" >
            <!--<input type="submit" name="ob" id="ob" value ="Obrisi">-->
            
            
            
            <div style="color:red; ">
                <?php
                if(isset($greska)){
                    echo $greska;
                }
                ?>
            </div><br><br><br>
            <div><h3>Ili dodaj novi upisivanjem podataka ovdje: </h3></div>
            <label for ="vrsta" class ="padd">Vrsta programa: </label>
            <input type="text" name="vrsta" id="vrsta" ><br>
            <label for="naziv" class ="padd">Naziv programa: </label>
            <input type="text" name="naziv" id="naziv" ><br>
            <label for ="opis" class ="padd">Opis programa: </label>
            <textarea name="opis" id="opis"></textarea><br>
            <label for ="mjesta" class ="padd">Broj mjesta: </label>
            <input type="number" name="mjesta" id="mjesta" ><br>
            <label for ="slobodno" class ="padd">Slobodno: </label>
            <input type="number" name="slobodno" id="slobodno"><br><br>
            <span style="padding-left:400px;"></span><input type="submit" id="spremi" name="spremi" value="Spremi" class ="gumb" style="width: 100px;"><br>
        </form>  
       
        
        <section class="omiljeni">
            <?php
            if(isset($poruka)){
                echo $poruka;
            }
                ?>
        </section>
        <footer id='footer'>
            <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>

