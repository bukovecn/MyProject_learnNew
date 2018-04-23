<!DOCTYPE html>
<html>
    <head>
        <title>Konfiguracija sustava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Konfiguracija sustava" />
        <meta name="kljucne_rijeci" content="teretana, projekt" />
        <meta name="datum_izrade" content="08.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove2.css" />
    </head>
    <body>
        <header class="naslov">
             <div> Konfiguracija sustava </div>
        </header>
<?php
            include('baza.class.php');
            $baza = new Baza();
            $baza->spojiDB();
            
            include("sesija.class.php");
            Sesija::kreirajSesiju();

            if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }
            $korIme =$_SESSION['korisnik'];
            $tip = $_SESSION['tip'];

        if($tip != '1'){
            $ispis = "Samo administrator može pristupiti ovoj stranici!";
            header("Location:prijava.php");
            exit();
        }
        
        //primijeni
        $ispis = "";
        $greska ="";
        $odjava="";
        $table="";
                
            if (isset($_POST["primijeni1"])) {
                if(!empty($_POST["stranice"])){
                    $unos1 = $_POST["stranice"];
                    $sql1="UPDATE `konfiguracija_sus` SET `br_redaka`='$unos1'";
                    $odg1 = $baza->updateDB($sql1);
                    $ispis .= "Broj redaka kod straničenja uspješno postavljen! <br>";
                    
                    $konf= "SELECT * FROM `konfiguracija_sus`";
                    $vrs = $baza->selectDB($konf);
                    if ($vrs->num_rows != 0) {
                    
                    $table.= "<table>
                                    <tr>
                                        <th>Administrator</th>
                                        <th>Broj redaka kod straničenja</th>
                                        <th>Trajanje sesije</th>
                                        <th>Pomak vremena</th>
                                        <th>Neuspješne prijave</th>
                                        <th>Trajanje linka aktivacije</th>
                                        <th>Trajanje tokena</th>
                                    </tr>";

                while($rj = mysqli_fetch_assoc($vrs)){
                   
                        $table.= "<tr>";
                        $table.= "<td>" . $rj['aministrator'] . "</td>";
                        $table.= "<td>" . $rj['br_redaka'] . "</td>";
                        $table.= "<td>" . $rj['trajanje_sesije'] . "</td>";
                        $table.= "<td>" . $rj['pomak_vremena'] . "</td>";
                        $table.= "<td>" . $rj['neuspjesne_prijave'] . "</td>"; 
                        $table.= "<td>" . $rj['trajanje_linka_aktivacije'] . "</td>";
                        $table.= "<td>" . $rj['trajanje_tokena'] . "</td>";
                        $table.= "</tr>";
                        
                    }
                    $table.= "</table>";
                    }
                   
                }else{
                    $greska .= "Niste unjeli broj redaka!<br>";
                } 
            }
            
            if (isset($_POST["primijeni2"])) {
                if(!empty($_POST["sesija"])){
                    $unos2 = $_POST["sesija"];
                    $sql2="UPDATE `konfiguracija_sus` SET `trajanje_sesije`='$unos2'";
                    $odg2 = $baza->updateDB($sql2);
                    $ispis .= "Trajanje sesije uspješno postavljeno! <br>";
                    
                    $konf= "SELECT * FROM `konfiguracija_sus`";
                    $vrs = $baza->selectDB($konf);
                    if ($vrs->num_rows != 0) {
                    
                    $table.= "<table>
                                    <tr>
                                        <th>Administrator</th>
                                        <th>Broj redaka kod straničenja</th>
                                        <th>Trajanje sesije</th>
                                        <th>Pomak vremena</th>
                                        <th>Neuspješne prijave</th>
                                        <th>Trajanje linka aktivacije</th>
                                        <th>Trajanje tokena</th>
                                    </tr>";

                while($rj = mysqli_fetch_assoc($vrs)){
                   
                        $table.= "<tr>";
                        $table.= "<td>" . $rj['aministrator'] . "</td>";
                        $table.= "<td>" . $rj['br_redaka'] . "</td>";
                        $table.= "<td>" . $rj['trajanje_sesije'] . "</td>";
                        $table.= "<td>" . $rj['pomak_vremena'] . "</td>";
                        $table.= "<td>" . $rj['neuspjesne_prijave'] . "</td>"; 
                        $table.= "<td>" . $rj['trajanje_linka_aktivacije'] . "</td>";
                        $table.= "<td>" . $rj['trajanje_tokena'] . "</td>";
                        $table.= "</tr>";
                        
                    }
                    $table.= "</table>";
                    }
                    
                }else{
                    $greska .= "Niste unjeli trajanje sesije!<br>";
                } 
            }
            
            if (isset($_POST["primijeni3"])) {
                if(!empty($_POST["neuspjesne"])){
                    $unos3 = $_POST["neuspjesne"];
                    $sql3="UPDATE `konfiguracija_sus` SET `neuspjesne_prijave`='$unos3'";
                    $odg3 = $baza->updateDB($sql3);
                    $ispis .= "Broj dopuštenih neuspješnih prijava uspješno postavljen! <br>";
                    
                    $konf= "SELECT * FROM `konfiguracija_sus`";
                    $vrs = $baza->selectDB($konf);
                    if ($vrs->num_rows != 0) {
                    
                    $table.= "<table>
                                    <tr>
                                        <th>Administrator</th>
                                        <th>Broj redaka kod straničenja</th>
                                        <th>Trajanje sesije</th>
                                        <th>Pomak vremena</th>
                                        <th>Neuspješne prijave</th>
                                        <th>Trajanje linka aktivacije</th>
                                        <th>Trajanje tokena</th>
                                    </tr>";

                while($rj = mysqli_fetch_assoc($vrs)){
                   
                        $table.= "<tr>";
                        $table.= "<td>" . $rj['aministrator'] . "</td>";
                        $table.= "<td>" . $rj['br_redaka'] . "</td>";
                        $table.= "<td>" . $rj['trajanje_sesije'] . "</td>";
                        $table.= "<td>" . $rj['pomak_vremena'] . "</td>";
                        $table.= "<td>" . $rj['neuspjesne_prijave'] . "</td>"; 
                        $table.= "<td>" . $rj['trajanje_linka_aktivacije'] . "</td>";
                        $table.= "<td>" . $rj['trajanje_tokena'] . "</td>";
                        $table.= "</tr>";
                        
                    }
                    $table.= "</table>";
                    }
                    
                }else{
                    $greska .= "Niste unjeli broj prijava!<br>";
                } 
            }
            
            if (isset($_POST["primijeni4"])) {
                if(!empty($_POST["aktiv_link"])){
                    $unos4 = $_POST["aktiv_link"];
                    $sql4="UPDATE `konfiguracija_sus` SET `trajanje_linka_aktivacije`='$unos4'";
                    $odg4 = $baza->updateDB($sql4);
                    $ispis .= "Trajanje aktivacijskog linka uspješno postavljeno! <br>";
                    
                    $konf= "SELECT * FROM `konfiguracija_sus`";
                    $vrs = $baza->selectDB($konf);
                    if ($vrs->num_rows != 0) {
                    
                    $table.= "<table>
                                    <tr>
                                        <th>Administrator</th>
                                        <th>Broj redaka kod straničenja</th>
                                        <th>Trajanje sesije</th>
                                        <th>Pomak vremena</th>
                                        <th>Neuspješne prijave</th>
                                        <th>Trajanje linka aktivacije</th>
                                        <th>Trajanje tokena</th>
                                    </tr>";

                while($rj = mysqli_fetch_assoc($vrs)){
                   
                        $table.= "<tr>";
                        $table.= "<td>" . $rj['aministrator'] . "</td>";
                        $table.= "<td>" . $rj['br_redaka'] . "</td>";
                        $table.= "<td>" . $rj['trajanje_sesije'] . "</td>";
                        $table.= "<td>" . $rj['pomak_vremena'] . "</td>";
                        $table.= "<td>" . $rj['neuspjesne_prijave'] . "</td>"; 
                        $table.= "<td>" . $rj['trajanje_linka_aktivacije'] . "</td>";
                        $table.= "<td>" . $rj['trajanje_tokena'] . "</td>";
                        $table.= "</tr>";
                        
                    }
                    $table.= "</table>";
                    }
                    
                }else{
                    $greska .= "Niste unjeli trajanje linka!<br>";
                } 
            }
            if (isset($_POST["primijeni5"])) {
                if(!empty($_POST["token"])){
                    $unos5 = $_POST["token"];
                    $sql5="UPDATE `konfiguracija_sus` SET `trajanje_tokena`='$unos5'";
                    $odg5 = $baza->updateDB($sql5);
                    $ispis .= "Trajanje tokena uspješno postavljeno! <br>";
                    
                    $konf= "SELECT * FROM `konfiguracija_sus`";
                    $vrs = $baza->selectDB($konf);
                    if ($vrs->num_rows != 0) {
                    
                    $table.= "<table>
                                    <tr>
                                        <th>Administrator</th>
                                        <th>Broj redaka kod straničenja</th>
                                        <th>Trajanje sesije</th>
                                        <th>Pomak vremena</th>
                                        <th>Neuspješne prijave</th>
                                        <th>Trajanje linka aktivacije</th>
                                        <th>Trajanje tokena</th>
                                    </tr>";

                while($rj = mysqli_fetch_assoc($vrs)){
                   
                        $table.= "<tr>";
                        $table.= "<td>" . $rj['aministrator'] . "</td>";
                        $table.= "<td>" . $rj['br_redaka'] . "</td>";
                        $table.= "<td>" . $rj['trajanje_sesije'] . "</td>";
                        $table.= "<td>" . $rj['pomak_vremena'] . "</td>";
                        $table.= "<td>" . $rj['neuspjesne_prijave'] . "</td>"; 
                        $table.= "<td>" . $rj['trajanje_linka_aktivacije'] . "</td>";
                        $table.= "<td>" . $rj['trajanje_tokena'] . "</td>";
                        $table.= "</tr>";
                        
                    }
                    $table.= "</table>";
                    }
                    
                }else{
                    $greska .= "Niste unjeli trajanje tokena!<br>";
                } 
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
        <h3>Uređivanje konfiguracijskih postavki</h3><br><br>
        <div style="color:red; ">
            <?php
            if(isset($greska)){
                echo $greska;
            }
            ?>
        </div>
        
        <form id="konf" name="konf" method ="POST" action="konfiguracija_sustava.php" >
            <label for ="stranice" class ="padd">Broj redaka kod straničenja: </label>
            <input type="number" name="stranice" id="stranice" >
            <input type="submit" name="primijeni1" id="primijeni1"  class ="gumb1" value="PRIMIJENI"><br>
            <label for ="sesija" class ="padd">Trajanje sesije: </label>
            <input type="time" name="sesija" id="sesija" >
            <input type="submit" name="primijeni2" id="primijeni2" class ="gumb1" value="PRIMIJENI"><br>
            <label for="neuspjesne" class ="padd">Dopušten broj neuspješnih prijava: </label>
            <input type="number" name="neuspjesne" id="neuspjesne" >
            <input type="submit" name="primijeni3" id="primijeni3" class ="gumb1" value="PRIMIJENI"><br>
            <label for ="aktiv_link" class ="padd">Trajanje linka aktivacije: </label>
            <input type="time" name="aktiv_link" id="aktiv_link" >
            <input type="submit" name="primijeni4" id="primijeni4"  class ="gumb1" value="PRIMIJENI"><br>
            <label for ="token" class ="padd">Trajanje tokena za prijavu: </label>
            <input type="time" name="token" id="token" >
            <input type="submit" name="primijeni5" id="primijeni5" class ="gumb1" value="PRIMIJENI"><br>
        </form>   
        
        <section class="omiljeni">
            <?php
            if(isset($ispis)){
                echo $ispis;
            }
            ?>
        </section>
        <section>
            <?php
            if(isset($table)){
                echo $table;
            }
            ?>
        </section>
        <footer id='footer'>
            <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>