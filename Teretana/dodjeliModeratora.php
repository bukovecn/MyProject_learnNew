<!DOCTYPE html>
<html>
    <head>
        <title>Dodjela moderatora</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="moderator" />
        <meta name="kljucne_rijeci" content="projekt_teretana, moderator" />
        <meta name="datum_izrade" content="13.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove2.css" />
    </head>
        <body>
            <header class="naslov">
             <div> Dodijeli moderatora</div>
        </header>
            <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        include("baza.class.php");
        $baza = new Baza();
        $baza->spojiDB();
        $odjava="";
        
        if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }
    
            $korisnickoIme = $_SESSION['korisnik'];
            $tip_kor = $_SESSION['tip'];
            
        if($tip_kor != '1'){
            $ispis = "Samo administrator može pristupiti ovoj stranici!";
            header("Location:prijava.php");
            exit();
        }
        
            $svi="SELECT * FROM `korisnik`";
            $rez = $baza->selectDB($svi);
            $tip = '';
            $poruka="";
            
            if ($rez->num_rows != 0) {
            $table="";
            $table.= "<table>
                            <tr>
                                <th>ID korisnika</th>
                                <th>Tip korisnika</th>
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>Korisnicko ime</th>
                            </tr>";
            
        while($rj = mysqli_fetch_assoc($rez)){
            if($rj['tip_korisnika'] == '1'){
                $tip = 'adminstrator';
            }
            else if($rj['tip_korisnika'] == '2'){
                   $tip = 'moderator';
               }
            else if($rj['tip_korisnika'] == '3'){
                   $tip = 'registrirani';
               }
            else{
                   $tip = 'neregistrirani';
            }
        
                $table.= "<tr>";
                $table.= "<td>" . $rj['idKorisnik'] . "</td>";
                $table.= "<td>" . $tip . "</td>";
                $table.= "<td>" . $rj['ime'] . "</td>";
                $table.= "<td>" . $rj['prezime'] . "</td>";
                $table.= "<td>" . $rj['korisnicko_ime'] . "</td>";
                $table.= "</tr>";
            }
            $table.= "</table>";
            }
            
            
            //odabir
            if(isset($_POST["moderator"])){
                if(isset($_POST["odaberi"])){
                    $moderator=$_POST["moderator"];
                    
                    $update="UPDATE `korisnik` SET `tip_korisnika`='2' WHERE `idKorisnik`='$moderator'";
                    $ok=$baza->updateDB($update);
                    
                    $poruka .="<br><br>Moderator uspješno dodijeljen!<br>";
                    
                }
            }
            
            //ukini
            if(isset($_POST["ukinut"])){
                if(isset($_POST["ukini"])){
                    $ukinut=$_POST["ukinut"];
                    
                    $update="UPDATE `korisnik` SET `tip_korisnika`='3' WHERE `idKorisnik`='$ukinut'";
                    $ok=$baza->updateDB($update);
                    
                    $poruka .="<br><br>Ukinuli ste odabranog moderatora! Sada je samo obični korisnik.<br>";
                    
                }
            }
        ?>
        <div class="odjava">
             <?php
           if (isset($_SESSION['korisnik'])) {
                        $odjava .= "Bok, $korisnickoIme! ". '<a href=odjava.php>Odjava</a>';
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
            
            <div class="padd">
                <h3> Svi korisnici:</h3>
                <?php
                if(isset($table)){
                    echo $table;
                }
                ?>
            </div>
            <form name="moderatori" action="dodjeliModeratora.php" method="POST" class ="pocetna_frm ">
            <select  name="moderator" class ="pocetna_select">    
                   <?php

            $upit="SELECT * FROM `korisnik` WHERE `tip_korisnika` != '1' and `status_racuna`='aktivan'";
            $rezultat = $baza->selectDB($upit);
            
            while (list($id, $tip, $ime, $prezime) = $rezultat->fetch_array()) {
                    echo '<option value="' . $id . '">' .$ime . ' ' . $prezime . '</option>';
                    
                }

            ?>
        </select>
                <input type="submit" id="odaberi" name="odaberi" value="Odaberi" class ="gumb1"><br><br>
                <span>ili ukinite moderatora: </span><br><br>
        <select  name="ukinut" class ="pocetna_select">    
                   <?php

            $upit2="SELECT * FROM `korisnik` WHERE `tip_korisnika`='2'";
            $rezultat2 = $baza->selectDB($upit2);
            
            while (list($id, $tip, $ime, $prezime) = $rezultat2->fetch_array()) {
                    echo '<option value="' . $id . '">' .$ime . ' ' . $prezime . '</option>';
                    
                }

            ?>
        </select>
        <input type="submit" id="ukini" name="ukini" value="Ukini" class ="gumb1"><br><br>
        </form>
        
            <div class="padd">
                <?php
                if(isset($poruka)){
                    echo $poruka;
                }
                ?>
            </div>
        <footer id='footer'>
            <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>
