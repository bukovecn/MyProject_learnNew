
<!DOCTYPE html>
<html>
    <head>
        <title>Virtualno vrijeme sustava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Virtualno vrijeme" />
        <meta name="kljucne_rijeci" content="teretana, projekt" />
        <meta name="datum_izrade" content="10.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove2.css" />
    </head>
    <body>
        <header class="naslov">
             <div> Virtualno vrijeme sustava </div>
        </header>
        <?php
        include("vrati_virtualno.php");
        include('baza.class.php');
        $baza = new Baza();
        $baza->spojiDB();
        include('sesija.class.php');
        Sesija::kreirajSesiju();
        $odjava="";
        if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }
    
            $korisnickoIme = $_SESSION['korisnik'];
            $kor = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korisnickoIme'";
            $odg = $baza->selectDB($kor);
            $odg_vraca = mysqli_fetch_array($odg);
            $kor_id = $odg_vraca["idKorisnik"];
            
            $tip = $_SESSION['tip'];

        if($tip != '1'){
            $ispis = "Samo administrator može pristupiti ovoj stranici!";
            header("Location:prijava.php");
            exit();
        }
     
        
        $url = "http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=xml";
        if (!($fp = fopen($url, 'r'))) {
            echo "Nije moguće otvoriti url: " . $url;
            exit();
        }

        // XML data
        $xml_string = fread($fp, 10000);
        fclose($fp);

        // create a DOM object from the XML data
        $domdoc = new DOMDocument;
        $domdoc->loadXML($xml_string);

        $params = $domdoc->getElementsByTagName('brojSati');
        $sati = 0;

        if ($params != NULL) {
            $sati = $params->item(0)->nodeValue;
        }
        ?>
        <div class="odjava">
             <?php
           if (isset($_SESSION['korisnik'])) {
                        $odjava .= '<a href=odjava.php>Odjava</a>';
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
        
        <div style="margin-left: 70px; color: darkred;">
            <?php
            $vrijeme_servera = time();
            $vrijeme_sustava = $vrijeme_servera + ($sati * 60 * 60);
            //echo $sati;
            
            echo "Stvarno vrijeme servera: " . date('d.m.Y H:i:s', $vrijeme_servera) . "<br>";
            echo "Virtualno vrijeme sustava: " . date('d.m.Y H:i:s', $vrijeme_sustava) . "<br>";
            if(1==1){
            $upit_vrijeme = "UPDATE `konfiguracija_sus` SET `pomak_vremena` ='$sati' WHERE `id`= '1'";
            $baza->updateDB($upit_vrijeme);
            
            //dnevnik
                        $korisnik = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korisnickoIme'";
                        $dnevnik = $baza->selectDB($korisnik);
                        $id = mysqli_fetch_array($dnevnik);
                        $id_kor = $id["idKorisnik"];
                        $upit_dn = str_replace("'", "", $upit_vrijeme);
                        $tip = "Ostale radnje";
                        $radnja = "Pomak vremena";
                        $datum =  vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', $upit_dn, '$id_kor', '$datum')";
                        $baza->updateDB($unos);
            
            }
            
            $baza->zatvoriDB();
            ?>
        </div>
        
        <footer id='footer'>
            <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>
