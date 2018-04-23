<!DOCTYPE html>
<html>
    <head>
        <title>Evidencija dolazaka</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Evidencija dolazaka" />
        <meta name="kljucne_rijeci" content="projekt_teretana, evidencija_dolazaka" />
        <meta name="datum_izrade" content="10.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"/> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>  
        <script type="text/javascript" src="js/nikbukove_jquery.js"></script>
    </head>
    <body>
        <header class="naslov">
             <div> Evidencija dolazaka</div>
        </header>
        <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        include("baza.class.php");
        $baza = new Baza();
        $baza->spojiDB();
        $odjava="";
        $table="";
        
        if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }
        $korIme = $_SESSION['korisnik'];
        
        $kor="SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korIme'";
        $vrati = $baza->selectDB($kor);
        $odg = mysqli_fetch_array($vrati);
        $id = $odg["idKorisnik"];
        
            $upit="SELECT e.`opis`, t.`dan_u_tjednu`, t.`mjesec`, t.`datum`, t.`vrijeme` FROM `evidencija_dolazaka` as e JOIN `termin_vjezbi` as t ON t.`idTermin`=e.`termin` WHERE e.`korisnik`='$id'";
            $rezultat = $baza->selectDB($upit);
            
            
            if ($rezultat->num_rows != 0) {
            $table="";
            $table.= "<table>
                            <tr>
                                <th>Opis napredovanja</th>
                                <th>Dan u tjednu</th>
                                <th>Mjesec</th>
                                <th>Datum</th>
                                <th>Vrijeme</th>
                            </tr>";
            
        while($rj = mysqli_fetch_assoc($rezultat)){

                $table.= "<tr>";
                $table.= "<td>" . $rj['opis'] . "</td>";
                $table.= "<td>" . $rj['dan_u_tjednu'] . "</td>";
                $table.= "<td>" . $rj['mjesec'] . "</td>";
                $table.= "<td>" . $rj['datum'] . "</td>";
                $table.= "<td>" . $rj['vrijeme'] . "</td>";
                $table.= "</tr>";
            }
            $table.= "</table>";
            }

           
    ?>
        <div class="odjava">
             <?php
           if (isset($_SESSION['korisnik'])) {
                        $odjava .= "Bok, $korIme! ".  '<a href=odjava.php>Odjava</a>';
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
        <h3>Ovdje možete pratiti vlastitu evidenciju dolazaka i napretka: </h3><br>
        <table id="tablica">
             <?=$table ?>
        </table>
        <br><br>
        <div> Skupljene bodove možete pogledati <a href="Bodovi_i_kuponi.php">ovdje.</a><br>
  
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
