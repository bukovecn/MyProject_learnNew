
<!DOCTYPE html>
<html>
    <head>
        <title>Odjava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Odjava" />
        <meta name="kljucne_rijeci" content="projekt_teretana, odjava" />
        <meta name="datum_izrade" content="30.05.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
    </head>
    <body>
        <header class="naslov">
             <div> Odjava</div>
        </header>
        <nav >
            <h2 class="heading" style="background-color: gainsboro;" >Izbornik: </h2>
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
        
        <section class="omiljeni">
            <?php
            include("vrati_virtualno.php");
            include("sesija.class.php");
            Sesija::kreirajSesiju();
                    
                     if (!isset($_SESSION['korisnik'])) {
                        header("Location:prijava.php");
                        exit();
                    }
                    
                    $korIme = $_SESSION["korisnik"];
                    Sesija::obrisiSesiju();

                    echo "Uspješno odjavljen!<br><br><br>";
                    echo "Želite li se ponovno prijaviti? <br>";
                    echo '<a href="prijava.php"> Prijava</a>';
                
                //dnevnik
                       include('baza.class.php');
                        $baza = new Baza();
                        $baza->spojiDB();
                        $korisnik = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korIme'";
                        $dnevnik = $baza->selectDB($korisnik);
                        $id = mysqli_fetch_array($dnevnik);
                        $id_kor = $id["idKorisnik"];
                        //$upit_dn = str_replace("'", "", $sql1);
                        $tip = "Prijava/odjava";
                        $radnja = "Odjava";
                        $datum = vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', null, '$id_kor', '$datum')";
                        $baza->updateDB($unos);
                        $baza->zatvoriDB();
            ?>
        </section>
        <footer id='footer'>
            <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>

