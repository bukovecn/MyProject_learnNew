<!DOCTYPE html>
<html>
    <head>
        <title>Uredi kupone</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="O kuponu" />
        <meta name="kljucne_rijeci" content="projekt_teretana, kupon" />
        <meta name="datum_izrade" content="12.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove2.css" />
    </head>
        <body>
            <header class="naslov">
             <div> Uredi kupone</div>
        </header>
            <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        include("baza.class.php");
        $baza = new Baza();
        $baza->spojiDB();
        
        if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }
        
         $korIme = $_SESSION['korisnik'];
            $tip = $_SESSION['tip'];
            
        if($tip != '1'){
            $ispis = "Samo administrator može pristupiti ovoj stranici!";
            header("Location:prijava.php");
            exit();
        }
        $poruka="";
        $greska="";
        $odjava="";
         //izmijeni odabrani
        if(isset($_POST["spremi"]) && !empty($_POST["id"]) ){
                //$greska .= "Sada popunite podatke dolje za izmjenu.";
                $broj=$_POST["id"];
            
                if(!empty($_POST["naziv"]) && !empty($_POST["detaljnije"]) && !empty($_POST["od"]) && !empty($_POST["do"]) && !empty($_POST["potrebno"]) && !empty($_POST["pdf"]) && !empty($_POST["slika"]) && !empty($_POST["video"])){
                $naziv=$_POST["naziv"];
                $detaljnije=$_POST["detaljnije"];
                $od=$_POST["od"];
                $do=$_POST["do"];
                $potrebno=$_POST["potrebno"];
                $pdf=$_POST["pdf"];
                $slika=$_POST["slika"];
                $video=$_POST["video"];
                
               
                    $spremi ="UPDATE `kupon` SET `naziv`='$naziv', `detaljnije`='$detaljnije', `vrijedi_od`='$od', `vrijedi_do`='$do', `potrebno_bodova`='$potrebno', `dokument`='$pdf', `slika_url`='$slika', `video`='$video' WHERE `idKupon`='$broj'";
                    $up=$baza->updateDB($spremi);
                    $poruka .= "Uspješno izmijenjen kupon!";
                    
                }
            else{
                $poruka .= "Niste popunili sva polja!<br>";
            } 
            }
            
            
            //dodaj novi
            if(empty($_POST["id"])&&  isset($_POST["spremi"])){
                //$greska .= "Sada popunite podatke za dodavanje novog programa.";
               if(!empty($_POST["naziv"]) && !empty($_POST["detaljnije"]) && !empty($_POST["od"]) && !empty($_POST["do"]) && !empty($_POST["potrebno"]) && !empty($_POST["pdf"]) && !empty($_POST["slika"]) && !empty($_POST["video"])){
                $naziv=$_POST["naziv"];
                $detaljnije=$_POST["detaljnije"];
                $od=$_POST["od"];
                $do=$_POST["do"];
                $potrebno=$_POST["potrebno"];
                $pdf=$_POST["pdf"];
                $slika=$_POST["slika"];
                $video=$_POST["video"];
                
                    $spremi ="INSERT INTO `kupon`(`idKupon`, `naziv`, `detaljnije`, `vrijedi_od`, `vrijedi_do`, `potrebno_bodova`, `dokument`, `slika_url`, `video`) VALUES (null, '$naziv','$detaljnije','$od','$do','$potrebno', '$pdf', '$slika', '$video')";
                    $up=$baza->updateDB($spremi);
                    $poruka .= "Uspješno dodan kupon!";
                    
                }
                else{
                    $poruka .= "Niste popunili sva polja!<br>";
                } 
            
            }
        
        
        ?>
    <div class="odjava">
             <?php
           if (isset($_SESSION['korisnik'])) {
                        $odjava .= "Bok, $korIme! ". '<a href=odjava.php>Odjava</a>';
                        }
            if(isset($odjava)){
                echo $odjava;
            }
            ?>
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
        
        
        <form id="uredi_kupone" name="uredi_kupone" method ="POST" action="kuponi_uredi.php" >
            <label for ="id" class ="padd" style="padding-left: 150px;">Unesite broj kupona kojeg želite izmijeniti: </label>
            <input type="number" name="id" id="id" >
            <span> i unesite podatke dolje.</span>
                

            
            <div style="color:red; ">
                <?php
                if(isset($greska)){
                    echo $greska;
                }
                ?>
            </div><br><br><br>
            <div><h3>Ili dodajte novi upisivanjem podataka ovdje: </h3></div>
            <label for ="naziv" class ="padd">Naziv kupona: </label>
            <input type="text" name="naziv" id="naziv" ><br>
            <label for="detaljnije" class ="padd">Detaljnije: </label>
            <input type="text" name="detaljnije" id="detaljnije" ><br>
            <label for ="od" class="padd">Vrijedi od: </label>
            <input txpe="date" name="od" id="od" ><br>
            <label for ="do" class ="padd">Vrijedi do: </label>
            <input type="date" name="do" id="do" ><br>
            <label for ="potrebno" class ="padd">Potrebno bodova: </label>
            <input type="number" name="potrebno" id="potrebno"><br>
            <label for ="pdf" class ="padd">Pdf dokument (url): </label>
            <input type="text" name="pdf" id="pdf"><br>
            <label for ="slika" class ="padd">Slika kupona (url): </label>
            <input type="text" name="slika" id="slika"><br>
            <label for ="video" class ="padd">Video (url): </label>
            <input type="text" name="video" id="video"><br><br>
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


