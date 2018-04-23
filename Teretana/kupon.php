<!DOCTYPE html>
<html>
    <head>
        <title>O_kuponu</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="O kuponu" />
        <meta name="kljucne_rijeci" content="projekt_teretana, kupon" />
        <meta name="datum_izrade" content="12.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
    </head>
        <body>
            <header class="naslov">
             <div> O kuponu</div>
        </header>
            <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        include("baza.class.php");
        $baza = new Baza();
        $baza->spojiDB();
        $odjava="";
        $kupon_info="";
        $spremljeno="";
        
        
        if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }
        $korIme = $_SESSION['korisnik'];
        
        $kor="SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korIme'";
        $vrati = $baza->selectDB($kor);
        $odg = mysqli_fetch_array($vrati);
        $id = $odg["idKorisnik"];
        
        $kupon=$_GET['kupon'];

        $ostalo = "SELECT `naziv`, `detaljnije`, `vrijedi_od`, `vrijedi_do`, `potrebno_bodova`, `dokument`, `video` FROM `kupon` WHERE `idKupon`='$kupon'";
        $rj=$baza->selectDB($ostalo);
        
        while($rez= mysqli_fetch_array($rj)){
            $kupon_info .= "Naziv kupona: " . $rez["naziv"] . "<br>";
            $kupon_info .= "Detaljnije: " . $rez["detaljnije"] . "<br>";
            $kupon_info .= "Vrijedi od: " . $rez["vrijedi_od"] . " do: " .$rez["vrijedi_do"]. "<br>";
            $kupon_info .= "Potrebno bodova: " . $rez["potrebno_bodova"] . "<br><br>";
            $kupon_info .= "<iframe width='640' height='390' src='" . $rez['video']. "' frameborder='0' allowFullScreen></iframe><br>";
            $kupon_info.= "<a href='" . $rez['video']. "' target=_blank>Video</a>";
            $kupon_info .="    <a href='" . $rez['dokument'] . "' target=_blank>Pdf dokument</a><br><br>";
        }

        if(isset($_POST["kupi"])){
            $provjera = "SELECT `korisnik`,`kupon` FROM `kosarica_privremeno` WHERE `korisnik`='$id' and `kupon`='$kupon'";
            $ima = $baza->selectDB($provjera);
            $rez = mysqli_fetch_array($ima);
         if(empty($rez)){
            $spremljeno .= "Kupon dodan u košaricu!";
            $dodaj = "INSERT INTO `kosarica_privremeno`(`id`, `korisnik`, `kupon`) VALUES (null, '$id', '$kupon')";
            $redi = $baza->updateDB($dodaj);
            
            //daj 30 bodova
            $daj_bod="UPDATE `evidencija_bodova` SET `trenutno` = (`trenutno`+ '30') WHERE `korisnik`='$id'";
            $baza->updateDB($daj_bod);
            
        }else{
             $spremljeno .= "Taj kupon se već nalazi u vašoj košarici! Možete ga koristi.";
        }
        }
        /*if(isset($_POST["kupi"])){
            $prog_id = "SELECT p.`idProgram` FROM `program` p JOIN `kupon_program` kp ON p.`idProgram`=kp.`program` WHERE kp.`kupon` = '$kupon'";
            $pp=$baza->selectDB($prog_id);
        }*/
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
            <h3 class='omiljeni'>Detalji o kuponu</h3>
            <div style='padding-left: 20%; font-style: italic'>
                <?php
                echo $kupon_info;
                ?>
                <form id="kosarica" method="POST" style="border-color: powderblue;">
            <input type="submit" name="kupi" id="kupi" class="gumb"  value="Dodaj u košaricu" style="width: 170px; background-color: salmon ">
            </form>
            </div>
            <div class="omiljeni">
                <?php
                echo $spremljeno;
                echo '<br>Vašu košaricu možete pregledati ' . '<a href="kosarica.php">ovdje</a>';
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
                        echo '<li class="li"><a href="kosarica.php">Moja kosarica</a></li>';
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

