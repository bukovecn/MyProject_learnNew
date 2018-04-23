<?php
            include('baza.class.php');
            $baza = new Baza();
            
            include("sesija.class.php");
            Sesija::kreirajSesiju();
            $table = "";

            if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }
    
            $korisnickoIme = $_SESSION['korisnik'];
            $tip = $_SESSION['tip'];
            
        if($tip != '1'){
            $ispis = "Samo administrator može pristupiti ovoj stranici!";
            header("Location:prijava.php");
            exit();
        }
            if (isset($_POST["korisnici"])){ 
                    if(isset($_POST["potvrda"])) {
                    $kor = $_POST["korisnici"];
                    
                    if (!empty($_POST["datum_od"]) && (!empty($_POST["datum_do"]))) {
                        $baza->spojiDB();
                        
                        $dat_od = $_POST["datum_od"];
                        $dat_do = $_POST["datum_do"];
                                                
                        $datumOd = date("Y-m-d 00:00:00", strtotime($dat_od));
                        $datumDo = date("Y-m-d 23:59:59", strtotime($dat_do));
                       // echo $datumOd, $datumDo;
                        
                        $upit1 = "SELECT * FROM `dnevnik_rada` WHERE `korisnik_id`='$kor' AND `datum_i_vrijeme` between '$datumOd' and '$datumDo'";
                        $odg1 = $baza->selectDB($upit1);
                        
                    if ($odg1->num_rows != 0 ) {
                    
                    $table.= "<table id='tablica'>
                                    <tr>
                                        <th>Tip akcije</th>
                                        <th>Radnja</th>
                                        <th>Upit</th>
                                        <th>Korisnik</th>
                                        <th>Datum i vrijeme</th>
                                    </tr>";
                    
                while($rj = mysqli_fetch_assoc($odg1)){
                        $table.= "<tr>";
                        $table.= "<td>" . $rj['tip_akcije'] . "</td>";
                        $table.= "<td>" . $rj['radnja'] . "</td>";
                        $table.= "<td>" . $rj['upit'] . "</td>";
                        $table.= "<td>" . $rj['korisnik_id'] . "</td>";
                        $table.= "<td>" . $rj['datum_i_vrijeme'] . "</td>";
                        $table.= "</tr>";
                    }
                    $table.= "</table>";
                    }
                    $baza->zatvoriDB();
                    }
                
                else{
                    $baza->spojiDB();
                    $upit2 = "SELECT * FROM `dnevnik_rada` WHERE `korisnik_id`='$kor'";
                    $odg2 = $baza->selectDB($upit2);
                    
                    if ($odg2->num_rows != 0) {
                    
                    $table.= "<table id='tablica'>
                                    <tr>
                                        <th>Tip akcije</th>
                                        <th>Radnja</th>
                                        <th>Upit</th>
                                        <th>Korisnik</th>
                                        <th>Datum i vrijeme</th>
                                    </tr>";
                    
                while($rj = mysqli_fetch_assoc($odg2)){
                        $table.= "<tr>";
                        $table.= "<td>" . $rj['tip_akcije'] . "</td>";
                        $table.= "<td>" . $rj['radnja'] . "</td>";
                        $table.= "<td>" . $rj['upit'] . "</td>";
                        $table.= "<td>" . $rj['korisnik_id'] . "</td>";
                        $table.= "<td>" . $rj['datum_i_vrijeme'] . "</td>";
                        $table.= "</tr>";
                    }
                    $table.= "</table>";
                    }
                    $baza->zatvoriDB();
              }
            }
            }
            if(isset($_POST["svi_korisnici"])) {
                    if (!empty($_POST["datum_od"]) && (!empty($_POST["datum_do"]))) {
                        $baza->spojiDB();
                        $dat_od = $_POST["datum_od"];
                        $dat_do = $_POST["datum_do"];
                                                
                        $datumOd = date("Y-m-d 00:00:00", strtotime($dat_od));
                        $datumDo = date("Y-m-d 23:59:59", strtotime($dat_do));
                        
                        $upit3 = "SELECT * FROM `dnevnik_rada` WHERE `datum_i_vrijeme` between '$datumOd' and '$datumDo'";
                        $odg3 = $baza->selectDB($upit3);
                    
                        if ($odg3->num_rows != 0) {
                    
                        $table.= "<table id='tablica'>
                                        <tr>
                                            <th>Tip akcije</th>
                                            <th>Radnja</th>
                                            <th>Upit</th>
                                            <th>Korisnik</th>
                                            <th>Datum i vrijeme</th>
                                        </tr>";

                    while($rj = mysqli_fetch_assoc($odg3)){
                            $table.= "<tr>";
                            $table.= "<td>" . $rj['tip_akcije'] . "</td>";
                            $table.= "<td>" . $rj['radnja'] . "</td>";
                            $table.= "<td>" . $rj['upit'] . "</td>";
                            $table.= "<td>" . $rj['korisnik_id'] . "</td>";
                            $table.= "<td>" . $rj['datum_i_vrijeme'] . "</td>";
                            $table.= "</tr>";
                        }
                        $table.= "</table>";
                        }
                        $baza->zatvoriDB();
                    }
                else{
                    $baza->spojiDB();
                    $upit4 = "SELECT * FROM `dnevnik_rada` ORDER BY 6";
                    $odg4 = $baza->selectDB($upit4);
                    
                    if ($odg4->num_rows != 0) {
                    
                    $table.= "<table id='tablica'>
                                    <tr>
                                        <th>Tip akcije</th>
                                        <th>Radnja</th>
                                        <th>Upit</th>
                                        <th>Korisnik</th>
                                        <th>Datum i vrijeme</th>
                                    </tr>";
                    
                while($rj = mysqli_fetch_assoc($odg4)){
                        $table.= "<tr>";
                        $table.= "<td>" . $rj['tip_akcije'] . "</td>";
                        $table.= "<td>" . $rj['radnja'] . "</td>";
                        $table.= "<td>" . $rj['upit'] . "</td>";
                        $table.= "<td>" . $rj['korisnik_id'] . "</td>";
                        $table.= "<td>" . $rj['datum_i_vrijeme'] . "</td>";
                        $table.= "</tr>";
                    }
                    $table.= "</table>";
                    }
                    $baza->zatvoriDB();
                }
            }

        ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dnevnik rada sustava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Dnevnik rada sustava" />
        <meta name="kljucne_rijeci" content="teretana, projekt" />
        <meta name="datum_izrade" content="05.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" media="screen" type="text/css" href="css/nikbukove2.css">
        <link rel="stylesheet" media="screen" type="text/css" href=https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script> 
        <script type="text/javascript" src="js/nikbukove_jquery.js"></script>
        
    </head>
    <body>
        <header class="naslov">
             <div> Dnevnik rada sustava </div>
        </header>
          
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
        
        <div style="margin-left: 70px; color: darkred;">
            
        </div>
                <h1>Dnevnik aktivnosti korisnika</h1>
                <form name="pretraga_kor" id="pretraga_kor"  method="POST"  action="dnevnik.php" style="border-color:silver">
                    <span> Odaberite određenog korisnika: <span style="padding-left:400px;">ili</span><span style="padding-left:270px;"> Sve korisnike: </span> <br>
            <select name="korisnici" class ="pocetna_select" style ="width: 400px">
           <?php
            $baza->spojiDB();
                $upit_kor = "SELECT * FROM `korisnik` ORDER BY `prezime`";
                $podaci_kor = $baza->selectDB($upit_kor);
                while (list($id, $tip, $ime, $prezime, $email, $korisnicko) = $podaci_kor->fetch_array()) {
                    echo '<option value="'. $id .'">' . 'Ime: ' . $ime . ' Prezime: ' . $prezime . " Korisničko ime: " . $korisnicko . '</option>';
                }
                $baza->zatvoriDB();
            ?>
            </select>
            <input type="submit" name="potvrda" id="potvrda" value="ODABERI" class="gumb1">
            <span style="padding-left:450px;"></span>
            <input type="submit" name="svi_korisnici" id="svi_korisnici" value="Svi korisnici" class="gumb1"> <br><br>
            <label style="padding-left:350px;">* Želite li pretragu i po datumu?</label>
            <label>Od: </label>
            <input type="date" name="datum_od" id="datum_od" > 
            <label>Do: </label>
            <input type="date" name="datum_do" id="datum_do" > <br><br><br>
        </form>   
        
        <table id="tablica">
             <?php echo $table ?>
        </table>
        <footer id='footer'>
            <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>