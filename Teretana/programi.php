<!DOCTYPE html>
<html>
    <head>
        <title>Programi vježbanja</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Programi vjezbanja" />
        <meta name="kljucne_rijeci" content="projekt_teretana, programi_vjezbanja" />
        <meta name="datum_izrade" content="04.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
        <script type="text/javascript" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>  
        <script type="text/javascript" src="js/nikbukove_jquery.js"></script>
    </head>
    <body>
        <header class="naslov">
             <div> Programi vježbanja</div>
        </header>
        
        <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
            include("baza.class.php");
            $baza = new Baza();
            $baza->spojiDB();
            
             if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }
            $korIme = $_SESSION['korisnik'];
            $table = "";
            $ispis = "";
            $ispis1 = "";
            $klik = "";
            $odjava="";
            $uredi ="";
                    $prog= "SELECT * FROM `program` ORDER BY 3";
                    $vrs = $baza->selectDB($prog);

                    if ($vrs->num_rows != 0) {
                    
                    $table.= "<table>
                                    <tr>
                                        <th>Vrsta programa</th>
                                        <th>Naziv</th>
                                        <th>Opis</th>
                                        <th>Broj mjesta</th>
                                        <th>Slobodno</th>
                                    </tr>";

                while($rj = mysqli_fetch_assoc($vrs)){
                   
                        $table.= "<tr>";
                        $table.= "<td>" . $rj['vrsta_programa'] . "</td>";
                        $table.= "<td>" . $rj['naziv'] . "</td>";
                        $table.= "<td>" . $rj['opis_programa'] . "</td>";
                        $table.= "<td>" . $rj['broj_mjesta'] . "</td>";
                        $table.= "<td>" . $rj['slobodno'] . "</td>"; 
                        $table.= "</tr>";
                        
                    }
                    $table.= "</table>";
                    }
                   

        ?>
        <div class="odjava">
             <?php
           if (isset($_SESSION['korisnik'])) {
                        $odjava .= "Bok, $korIme! ".'<a href=odjava.php>Odjava</a>';
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
                </ul>
        </nav>
        
        <section class="padd">
             <?=$table;?>
        </section>
        <section style="padding-left:400px; ">        
        <?php
        if(isset($_SESSION["tip"]) && ($_SESSION["tip"]=='1' )){
           $klik .= '<a href= "kreirajVrstu.php" ><input type="submit" value="Kreiraj vrstu" name="kreiraj_vrstu" class ="gumb1"/></a>';
           $klik .= '     <a href= "programi_uredi.php" ><input type="submit" value="Uredi programe" name="dodaj_prog" class ="gumb1"/></a>';
           $uredi .= '    <a href= "kuponi_uredi.php" ><input type="submit" value="Uredi kupone" name="uredi_kupone" class ="gumb1"/></a>';
           $uredi .= '    <a href= "dodjeliModeratora.php" ><input type="submit" value="Dodjeli moderatora" name="dodjela_moderatora" class="gumb1"/></a>';
            }
        ?>
       <?php
            if(isset($klik)){
                    echo $klik;
            }
            if(isset($uredi)){
                echo $uredi;
                }
            ?>
        </section>
            <span class = "opisslike"><br>* Želite li se prijaviti na neki od dostupnih programa? </span> <br>
        <form name="prijavi_program" method="POST" class ="pocetna_frm " style = "border-color: bisque;">
            <select  name="odabir_prog" class ="pocetna_select" value="Odaberite program...">  
        <?php
            $upit1="SELECT * FROM `program` WHERE `slobodno` != 0 ORDER BY 1";
            $rezultat1 = $baza->selectDB($upit1);
            
            while (list($id, $vrsta, $naziv, $opis, $broj_mj, $slobodno) = $rezultat1->fetch_array()) {
                    echo '<option value="' . $naziv . '">' .$id . ' ' . $naziv . '</option>';
                    
                }
            
            
        ?>
         </select>
        <input type="submit" id="prijavi_pr" name="prijavi_pr" value="Prijavi se" class ="gumb1" style="width: 100px;"><br>            
        </form>

        <div class = "omiljeni">
        <?php
            
           if(isset($_POST["odabir_prog"])){
               
                if(isset($_POST["prijavi_pr"])){
                    $odabrani = $_POST["odabir_prog"];
                        
                        $korisnik = $_SESSION["korisnik"];
                        $kor = "SELECT * FROM `korisnik` WHERE `korisnicko_ime` = '$korisnik'";
                        $vr = $baza->selectDB($kor);
                        $rj = mysqli_fetch_array($vr);
                        $korisnik_id = $rj["idKorisnik"];
                        $program = "SELECT * FROM `program` WHERE `naziv` = '$odabrani'";
                        $vraca = $baza->selectDB($program);
                        $rje = mysqli_fetch_array($vraca);
                        $program_id = $rje["idProgram"];
                        $slobodno = $rje["slobodno"];
                        
                        $upit="SELECT * FROM `prijava` where `korisnik`='$korisnik_id' and `program`='$program_id'";
                        $provjeri = $baza->selectDB($upit);
                        $pr = mysqli_fetch_array($provjeri);
                       if(empty($pr)){
                        $datum = vrati();
                        $prijava = "INSERT INTO `prijava`(`idPrijave`, `datum`, `korisnik`, `program`) VALUES (null, '$datum','$korisnik_id','$program_id')";
                        $rez = $baza->updateDB($prijava);
                        $ispis .= "Čestitamo! Uspješno ste se prijavili za odabrani program!<br>";   
                        $ispis .= "Vaš program je '$odabrani' !<br><br>";
                        $ispis1 .= 'Svoje dolaske možete pratiti na <a href ="evidencija_dolazaka.php">ovdje</a>.';
                        
                        //daj 20 bodova
                        $daj_bod="UPDATE `evidencija_bodova` SET `trenutno` = (`trenutno`+ '20') WHERE `korisnik`='$korisnik_id'";
                        $baza->updateDB($daj_bod);
                        
                        //slobodne smanji
                        $slob = ($slobodno - 1);
                        $smanji = "UPDATE `program` SET `slobodno`='$slob' WHERE `idProgram`='$program_id'";
                        $izvrsi = $baza->updateDB($smanji);
                        //dnevnik
                        $upit_dn = str_replace("'", "", $prijava);
                        $tip = "Ostale radnje";
                        $radnja = "Prijava na program";
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', '$upit_dn', '$korisnik_id', '$datum')";
                        $baza->updateDB($unos);
                       }else{
                           $ispis .= "Već sudjelujete na tom programu! Možete upisati neki drugi! <br>";
                       }
                        
                        
                    }
               }   
                
            if(isset($ispis)){
                    echo $ispis;
                }
            ?>
        </div>
        <div class = "opisslike" style="padding-left: 400px ">
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




