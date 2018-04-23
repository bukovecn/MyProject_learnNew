<<!DOCTYPE html>
<html>
    <head>
        <title>Kupnja kupona</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Kupnja" />
        <meta name="kljucne_rijeci" content="projekt_teretana, kupnja" />
        <meta name="datum_izrade" content="12.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
    </head>
        <body>
            <header class="naslov">
             <div> Kupnja kupona </div>
        </header>
            <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        include("baza.class.php");
        $baza = new Baza();
        $baza->spojiDB();
        $poruka ="";
        $poruka1 ="";
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
        
        $odabrani_kupon=$_GET['kupon'];
        
        $dobavi="SELECT `naziv`, `potrebno_bodova` FROM `kupon` WHERE `idKupon`='$odabrani_kupon'";
        $kup = $baza->selectDB($dobavi);
        $kupim= mysqli_fetch_array($kup);
        $potrebno =$kupim["potrebno_bodova"];
        $imam="SELECT `trenutno` FROM `evidencija_bodova` WHERE `korisnik`='$id'";
        $rj=$baza->selectDB($imam);
        $rjj= mysqli_fetch_array($rj);
        $bodovi=$rjj["trenutno"];
        
        if($bodovi >= $potrebno){
        $umanji="UPDATE `evidencija_bodova` SET `trenutno`=(`trenutno`-'$potrebno') WHERE `korisnik`='$id'";
        $izv=$baza->updateDB($umanji);
        
        $sad="SELECT `trenutno` FROM `evidencija_bodova` WHERE `korisnik`='$id'";
        $vr=$baza->selectDB($sad);
        $tr= mysqli_fetch_array($vr);
        $novi=$tr["trenutno"];
        
        $kod_kupnja=date("Y-m-d H:i:s");
        $kod= sha1($kod_kupnja);
        
        //kupnja dodana
        $kos="SELECT `id`, `korisnik`, `kupon` FROM `kosarica_privremeno` WHERE `korisnik`='$id' and `kupon`='$odabrani_kupon' ";
        $up=$baza->selectDB($kos);
        $my= mysqli_fetch_array($up);
        $id_kosara=$my["id"]; //id košarice u kojoj smo kupili
        
        $dat=vrati();
        $ins="INSERT INTO `kupnja_kupon`(`idKupnje`, `datum`, `kosarica`, `kod`) VALUES (null, '$dat', '$id_kosara', '$kod')";
        $izvr=$baza->updateDB($ins);
        

        $poruka .= "Uspješno ste obavili kupnju kupona!<br>";
        $poruka .= "Vaš kod za kupljeni kupon je: " . $kod ." <br> (Kupon možete koristiti uz predočenje tog koda u teretani!)  ";
        $poruka .= "Novo stanje bodova: <br>";
        $poruka1 .= $novi;
        

        //makni iz košarice
        $makni=" DELETE FROM `kosarica_privremeno` WHERE `korisnik`='$id' and `kupon`='$odabrani_kupon' ";
        $izvrsi=$baza->updateDB($makni);
        
            //dnevnik

                        $upit_dn = str_replace("'", "", $ins);
                        $tip = "Ostale radnje";
                        $radnja = "Kupnja kupona";
                        $datum = vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', '$upit_dn', '$id', '$datum')";
                        $baza->updateDB($unos);
                        
       }
        else{
            $poruka .= "Imate premalo bodova za kupnju!<br>";
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
            <div class="omiljeni">
                <?php
                    if(isset($poruka)){
                        echo $poruka;
                    }
                ?>
            </div> 
            <div class="omiljeni" style="color: green">
                <?php
                    if(isset($poruka1)){
                        echo $poruka1;
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
                        echo '<li class="li"><a href="kosarica.php">Moja kosarica</a></li>';
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
