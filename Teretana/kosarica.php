<!DOCTYPE html>
<html>
    <head>
        <title>Moja košarica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Kosarica" />
        <meta name="kljucne_rijeci" content="projekt_teretana, kosarica" />
        <meta name="datum_izrade" content="12.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
    </head>
        <body>
            <header class="naslov">
             <div> Vaša košarica </div>
        </header>
            <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        include("baza.class.php");
        $baza = new Baza();
        $baza->spojiDB();
        $kosara ="";
        $odjava="";
        
        if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }
        $korIme = $_SESSION['korisnik'];
        
        $kor="SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korIme'";
        $vrati = $baza->selectDB($kor);
        $odg = mysqli_fetch_array($vrati);
        $id = $odg["idKorisnik"];
        
        $prikaz="SELECT k.`naziv`, k.`slika_url`, kp.`kupon` FROM `kupon` k JOIN `kosarica_privremeno` kp ON k.`idKupon`=kp.`kupon` WHERE kp.`korisnik`='$id'";
        $vraca = $baza->selectDB($prikaz);
        
         while($rez= mysqli_fetch_array($vraca)){
            $kosara .= $rez["naziv"] . "  <a href='kosarica.php?kupon=". $rez["kupon"] ."'><img src='" . $rez['slika_url'] . "' width=300 height=250></a>";
            $kosara .="   <a href='kupnja.php?kupon=" . $rez["kupon"] . "'><input type='submit' name='potrosi' id='potrosi' class='gumb1' value='Kupi kupon'></a><br><br>";
            
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
            <h3>Vaši kuponi na raspolaganju: </h3>
            <div class="omiljeni">
                
                <?php
                if(isset($kosara)){
                    echo $kosara;
                }
                    ?>
                
            </div>
             <footer id='footer'>
                <nav class='nav_horiz'>
                <?php
                if(isset($_SESSION["korisnik"])){
                    $korisnik = $_SESSION["korisnik"];
                    $baza->spojiDB();
                    $kor = "SELECT * FROM `korisnik` WHERE `korisnicko_ime` = '$korisnik'";
                        $vr = $baza->selectDB($kor);
                        $rj = mysqli_fetch_array($vr);
                        $korisnik_id = $rj["idKorisnik"];
                    $postoji = "SELECT * FROM `prijava` WHERE `korisnik` = '$korisnik_id'";
                    $ima = $baza->selectDB($postoji);
                    $da= mysqli_fetch_array($ima);
            
                    if(!empty($da)){
                        echo '<ul class="ul">';
                        echo '<li class="li"><a href="evidencija_dolazaka.php" >Evidencija dolazaka</a></li>';
                        echo '<li class="li"><a href="Bodovi_i_kuponi.php" >Bodovi i kuponi</a></li>';
                        echo '<li class="li"><a href="programi.php" >Programi</a></li>';
                        echo '</ul>';
                    }
                }
                 ?>
                </nav>  
            <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>


