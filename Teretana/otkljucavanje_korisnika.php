<!DOCTYPE html>

    <?php
    include("vrati_virtualno.php");
    include("sesija.class.php");
    Sesija::kreirajSesiju();
    $odjava="";
            include("baza.class.php");
            $bp = new Baza();
            
             if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }

            $tip = $_SESSION['tip'];
            $korIme = $_SESSION['korisnik'];

        if($tip != '1'){
            $ispis = "Samo administrator može pristupiti ovoj stranici!";
            header("Location:prijava.php");
            exit();
        }

            if (isset($_POST["posalji"])) {
                if (isset($_POST["zakljucani"])) {
                    $bp->spojiDB();
                    $ispis = "";
                    $korisnik_ispis = "";

                    $zaklj_kor = $_POST["zakljucani"];
                        $korisnik_ispis .= "Zaključani korisnik: " . $zaklj_kor . " <br><br>";
                    $upit = "UPDATE `korisnik` SET `broj_neuspjesnih_prijava`='0'  WHERE `korisnicko_ime`='$zaklj_kor' and `status_racuna`='zakljucan'";
                    $odg = $bp->updateDB($upit);
                    $upit2 = "UPDATE `korisnik` SET `status_racuna`='aktivan'  WHERE `korisnicko_ime`='$zaklj_kor'";
                    $odg2 = $bp->updateDB($upit2);
                    $ispis .= "Korisnik " . $zaklj_kor . " je sada otključan! <br>";
                    
                    //dnevnik
                        $korisnik = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`= '$zaklj_kor'";
                        $dnevnik = $bp->selectDB($korisnik);
                        $id = mysqli_fetch_array($dnevnik);
                        $id_kor = $id["idKorisnik"];
                        $upit_dn = str_replace("'", "", $upit2);
                        $tip = "Ostale radnje";
                        $radnja = "Otključan";
                        $datum = vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', '$upit_dn', '$id_kor', '$datum')";
                        $bp->updateDB($unos);
                    $bp->zatvoriDB();
                }
            }
    ?>
<html>
    <head>
        <title>Otkljucavanje korisnika</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Otkljucavanje korisnika" />
        <meta name="kljucne_rijeci" content="projekt_teretana, otkljucavanje_korisnika" />
        <meta name="datum_izrade" content="30.05.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove2.css" />
        <script type="text/javascript" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>  
        <script type="text/javascript" src="js/nikbukove_jquery.js"></script>
    </head>
    <body>
        
        <header class="naslov">
            <div>
                Otključavanje korisnika
            </div>
        </header>
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
        <div>
            <?php
                if(isset($korisnik_ispis)){
                    echo $korisnik_ispis;
                }
                if(isset($ispis)){
                    echo $ispis;
                }
            ?>
        </div>
        <form name="Otkljucaj" action="otkljucavanje_korisnika.php" method="POST">
            <select  name="zakljucani">
            <?php
                $bp->spojiDB();
                $prijave = "SELECT * FROM `konfiguracija_sus` WHERE `aministrator`=1";
                $rez= $bp->selectDB($prijave);
                $neuspjesne = mysqli_fetch_array($rez);
                $broj = $neuspjesne["neuspjesne_prijave"];
                
                $upit = "SELECT * FROM `korisnik` WHERE `broj_neuspjesnih_prijava` ='$broj' or `status_racuna`='blokiran'";
                $odg = $bp->selectDB($upit);

                while (list($id, $tip, $ime, $prezime, $email, $korisnicko) = $odg->fetch_array()) {
                    echo '<option value="' . $korisnicko . '">' . 'Ime: ' . $ime . ' Prezime: ' . $prezime . " Korisničko ime: " . $korisnicko . '</option>';
                }

                $bp->zatvoriDB();
                ?>
            </select>
        <input type="submit" id="posalji" name="posalji" value="Otkljucaj">
        </form>
        <footer id='footer' style="top:0;">
            <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>

