
<!DOCTYPE html>
<html>
    <head>
        <title>Aktivacija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Aktivacija" />
        <meta name="kljucne_rijeci" content="teretana, projekt" />
        <meta name="datum_izrade" content="06.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
    </head>
    <body>
        <?php
            include("vrati_virtualno.php");
            include("sesija.class.php");
            Sesija::kreirajSesiju();
            $odjava="";
            if (isset($_GET["activate"])) {
                $kod = $_GET["activate"];
                $ispis = "";
                
                include("baza.class.php");
                $bp = new Baza();
                $bp->spojiDB();
                $sql = "SELECT * FROM `korisnik` WHERE `aktivacijski_link`='$kod'";
                $dohvati = $bp->selectDB($sql);
                $rj = mysqli_fetch_array($dohvati);
                $ime = $rj["korisnicko_ime"];
                $cookieAktivacija = "Aktivacijski_link_" . $ime;
                                
                if (!empty($rj)) {
                    if ($rj["status_racuna"] == 'nije aktiviran') {
                        //if(isset($_COOKIE[$cookieAktivacija])){ 
                            $ispis .= "Vaš korisnički račun je uspješno aktiviran! <br>";
                            $ispis .= "<a href=prijava.php>Prijava</a>";
                            $upit_novi = "UPDATE `korisnik` SET `status_racuna`='aktivan'  WHERE `korisnicko_ime`='$ime'";
                            $akt = $bp->updateDB($upit_novi);
                            $datum_sad = vrati();
                            $upit_dat = "UPDATE `korisnik` SET `datum_registriranja`='$datum_sad'  WHERE `korisnicko_ime`='$ime'";
                            $akt1 = $bp->updateDB($upit_dat);
                            
                            //produži kuki
                            $dat_reg =  $rj["datum_registriranja"];
                            $vrijednostKolacica = "Da";
                            $mjesec = 30 * 24;
                            $vrijedi = strtotime( "+$mjesec hours", pretvoriDatum( $dat_reg ) );
                            setcookie('uvjeti_koristenja', $vrijednostKolacica, $vrijedi , "/"); //mjesec dana od reg.
                            //echo "Uvjeti korištenja kolačića produljeni za mjesec dana od datuma registracije!<br>";
                            
                            //dnevnik
                        $korisnik = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`= '$ime'";
                        $dnevnik = $bp->selectDB($korisnik);
                        $id = mysqli_fetch_array($dnevnik);
                        $id_kor = $id["idKorisnik"];
                        $upit_dn = str_replace("'", "", $upit_novi);
                        $tip = "Ostale radnje";
                        $radnja = "Aktivacija";
                        $datum = vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', '$upit_dn', '$id_kor', '$datum')";
                        $bp->updateDB($unos);
                        
                       /* }else{
                            $ispis .= "Aktivacijski link Vam je istekao! <br> Ponovno se registrirajte!<br>";
                            $delete = "DELETE FROM `korisnik` WHERE `aktivacijski_link`='$kod'";
                            $akt2 = $bp->updateDB($delete);
                        }*/
                    }
                else {
                        $ispis .= "Taj korisnički račun je već aktiviran! <br>";
                        $ispis .= "<a href=prijava.php>Prijava</a>";
                        $bp->zatvoriDB();
                        }
                    
                    }
                    $bp->zatvoriDB();
            }
            
            ?>
        <header>
            <div class="naslov"> Aktivacija</div>
        </header>
         <div class="odjava">
             <?php
           if (isset($_SESSION['korisnik'])) {
               $korIme = $_SESSION['korisnik'];
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
                    <li><a href="otkljucavanje_korisnika.php">Otkljucavanje korisnika</a></li>
                    <li><a href="blokiranje_korisnika.php">Blokiranje korisnika</a></li>
                     <li><a href="postavi_vrijeme.php">Postavljanje vremena</a></li>
                    <li><a href="vrijeme.php">Virtualno vrijeme sustava</a></li>
                    <li><a href="dnevnik.php">Dnevnik rada</a></li>
                    <li><a href="konfiguracija_sustava.php">Konfiguracija sustava</a></li>
                    <li><a href="privatno/korisnici.php">Korisnici</a></li>
            </ul>
        </nav>
        <section >
           <?php
            if(isset($ispis)){
                echo $ispis;
            }
            
            if(isset($ispis1)){
                echo $ispis1;
            }
           ?>
        </section>
        <footer id='footer' style="top:0;">
            <nav class='nav_horiz'>
                <?php
                if(isset($_SESSION["korisnik"])){
                    include("baza.class.php");
                    $bp = new Baza();
                    $korisnik = $_SESSION["korisnik"];
                    $bp->spojiDB();
                    $kor = "SELECT * FROM `korisnik` WHERE `korisnicko_ime` = '$korisnik'";
                        $vr = $bp->selectDB($kor);
                        $rj = mysqli_fetch_array($vr);
                        $korisnik_id = $rj["idKorisnik"];
                    $postoji = "SELECT * FROM `prijava` WHERE `korisnik` = '$korisnik_id'";
                    $ima = $bp->selectDB($postoji);
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