
<!DOCTYPE html>
<html>
    <head>
        <title>Početna stranica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Početna stranica" />
        <meta name="kljucne_rijeci" content="teretana, projekt" />
        <meta name="datum_izrade" content="03.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
    </head>
    <body>
        <header class="naslov">
             <div> Dobrodošli!</div>
        </header>
        
        <?php
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        
        $imeKolacica = "uvjeti_koristenja";
        if (!isset($_COOKIE[$imeKolacica])) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Morate prihvatiti uvjete korištenja kako bi mogli koristiti stranicu!")';
                    echo '</script>';
                    
                    $vrijednostKolacica = 'Da';
                    setcookie($imeKolacica, $vrijednostKolacica, (time() + 24 *3 * 60 * 60), "/"); //vrijedi 3 dana   
                }
        else {
                //echo "Uvjeti korištenja prihvaćeni! <br>";
                }
        
                
        //odarana vrsta programa - ispis info o programu

            include("baza.class.php");
            $baza = new Baza();
            $baza->spojiDB();
            $table="";
            $ispis1 ="";
            $odjava = "";
            
            
            if (isset($_POST["odaberi"])) {
                if (isset($_POST["odabir"])) {
                    if (!isset($_SESSION['korisnik']) || (empty($_SESSION['korisnik']))) {
                        $ispis1.= "<br><br>Da bi mogli pregledavati i sudjelovati na svim programima, prijaviti se " . '<a href=prijava.php>ovdje</a>' ."!<br>";
                        }
                    $ispis = "";
                    $odabrana_vrsta = $_POST["odabir"];
                    
                    $vrsta="SELECT * FROM `vrsta_programa` WHERE `idVrste_programa`='$odabrana_vrsta'";
                    $vrs = $baza->selectDB($vrsta);
                    $vrs_vraca = mysqli_fetch_array($vrs);
                    $naziv_vrste = $vrs_vraca['naziv'];
                    $ispis .= "Odabrana vrsta programa: " . $naziv_vrste . " <br>";
                    $ispis .=" O vrsti programa: " . $vrs_vraca['opis'] . "<br>";
                    $trener_id = $vrs_vraca['moderator'];
                    $trener = "SELECT * FROM `korisnik` WHERE `idKorisnik`='$trener_id'";
                    $sql = $baza->selectDB($trener);
                    $sql_res = mysqli_fetch_array($sql);
                    $trener_za_vrstu = $sql_res['ime'] ." " . $sql_res['prezime'];
                    $ispis .=" Trener: " . $trener_za_vrstu ."<br><br>";
                    
                    
                    $upit = "SELECT DISTINCT `naziv`, `opis_programa` FROM `program` WHERE `vrsta_programa`='$odabrana_vrsta' ORDER BY `slobodno` ASC LIMIT 3";
                    //$upit = "SELECT DISTINCT p.`naziv`, p.`opis_programa`, t.`broj_polaznika` FROM `program` as p JOIN `termin_vjezbi` as t on p.`idProgram`=t.`program` JOIN `evidencija_dolazaka` as e on e.`termin`=t.`idTermin` WHERE `vrsta_programa`='$odabrana_vrsta' limit 3";
                    $odg = $baza->selectDB($upit);
                    
                    if ($odg->num_rows != 0) {
                    
                    $table.= "<table>
                                    <tr>
                                        <th>Naziv</th>
                                        <th>Opis</th>
                                        
                                        
                                    </tr>";
                    $ispis .= "3 programa sa najviše dolazaka: ";
                    if(isset($_SESSION["korisnik"])){
                        $ispis .= '<a href = "programi.php" ><input type="submit" value="VIDI SVE PROGRAME" name="vidi_sve" class ="vidi_sve_btn"/></a><br><br>';
                    }
                        while($rj = mysqli_fetch_assoc($odg)){
                        $table.= "<tr>";
                        $table.= "<td>" . $rj['naziv'] . "</td>";
                        $table.= "<td>" . $rj['opis_programa'] . "</td>";
                        $table.= "</tr>";
                    }
                    $table.= "</table>";
                    }
                }
            }
                
        ?>
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
        <nav >
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
        </nav>
        
            <h2 class="omiljeni">
                Popis vrsta programa teretane
            </h2>
        <section class = "heading" style="margin-left: 10px">
            <br>
            Izdvojili smo vrste programa koji se trenutno izvode u teretani.<br>
            Odabirom pojedine vrste infomirajte se o programima koji pripadaju toj vrsti.<br><br>
            Odaberite vrstu iz padajućeg izbornika: <br>
            
        </section>
        <form name="Odabir" action="index.php" method="POST" class ="pocetna_frm ">
            <select  name="odabir" class ="pocetna_select">    
                   <?php

            
            $upit="SELECT * FROM `vrsta_programa`";
            $rezultat = $baza->selectDB($upit);
            
            while (list($id, $naziv, $opis, $moderator) = $rezultat->fetch_array()) {
                    echo '<option value="' . $id . '">' .$id . ' ' . $naziv . '</option>';
                    
                }

            ?>
        </select>
        <input type="submit" id="odaberi" name="odaberi" value="Odaberi" class ="gumb">
        </form>
       
        <div style="margin-left: 70px; color: darkred;">
            <?php
                
                if(isset($ispis)){
                    echo $ispis;
                }

        ?>
            </div>
        <section>
             <?=$table;?>
            
        </section>
        <div style="margin-left: 70px; color: darkred;">
        <?php
                if(isset($ispis1)){
                    echo $ispis1;
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

