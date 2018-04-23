<!DOCTYPE html>
<html>
    <head>
        <title>Bodovi i kuponi</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Bodovi i kuponi" />
        <meta name="kljucne_rijeci" content="projekt_teretana, bodovi, kuponi" />
        <meta name="datum_izrade" content="10.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
    </head>
        <body>
            <header class="naslov">
             <div> Bodovi i kuponi</div>
        </header>
            <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        include("baza.class.php");
        $baza = new Baza();
        $baza->spojiDB();
        $table ="";
        $odjava="";
        $info="";
        $info1="";
        
        if (!isset($_SESSION['korisnik'])) {
                header("Location:prijava.php");
                exit();
            }
        $korIme = $_SESSION['korisnik'];
        
        $kor="SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korIme'";
        $vrati = $baza->selectDB($kor);
        $odg = mysqli_fetch_array($vrati);
        $id = $odg["idKorisnik"];
        
            $upit="SELECT `trenutno`, `datum`  FROM `evidencija_bodova` WHERE `korisnik`='$id'";
            $rezultat = $baza->selectDB($upit);
            
            
            if ($rezultat->num_rows != 0) {
            $table="";
            $table.= "<table>
                            <tr>
                                <th>Ostvareni trenutni bodovi</th>
                                <th>Zadnja promjena na datum</th>
                            </tr>";
            
        while($rj = mysqli_fetch_assoc($rezultat)){

                $table.= "<tr>";
                $table.= "<td>" . $rj['trenutno'] . "</td>";
                $table.= "<td>" . $rj['datum'] . "</td>";
 
            }
            $table.= "</table>";
            }
            
           
    ?>
            <?php
                //kuponi za odabrani program
            if (isset($_POST["moj_program"])) {
                if (isset($_POST["moj"])) {
                    $odabrani_moj = $_POST["moj_program"];
                    
                    $trenutni = "SELECT * FROM `evidencija_bodova` WHERE `korisnik`='$id'";
                    $vrati = $baza->selectDB($trenutni);
                    $ima = mysqli_fetch_array($vrati);
                    $bodovi = $ima["trenutno"];
                    
                    $kuponi_naz = "SELECT k.`idKupon`, k.`slika_url`, k.`video`, k.`dokument` FROM `kupon` k JOIN `kupon_program` kp ON kp.`kupon`=k.`idKupon` JOIN `prijava` pr ON kp.`program`=pr.`program` WHERE pr.`korisnik`='$id' and kp.`program`='$odabrani_moj' and k.`potrebno_bodova` <= '$bodovi'";
                    $rj= $baza->selectDB($kuponi_naz);

                    while($rez = mysqli_fetch_array($rj)){
                          $info1.= "<a href='kupon.php?kupon=". $rez['idKupon'] ."'><img src='" . $rez['slika_url'] . "' width=300 height=250></a><br><br>";
                          
                    }
               
            }
            }
                $baza->zatvoriDB();
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
             <h3 class = "omiljeni">Sakupljeni bodovi: </h3><br>
        <section id="bodovi">
             <?=$table ?>
        </section>
             <br><br>
             <h3 class = "omiljeni">Aktivni kuponi na raspolaganju: </h3><br><br>
             <div>Odaberite za koji od svojih programa želite vidjeti kupone: </div>
             <form name="Program_kupon" action="Bodovi_i_kuponi.php" method="POST">
                 <select  name="moj_program">
                     <?php
                $baza->spojiDB();

                $prog = "SELECT p.`idProgram`, p.`naziv`, pr.`program` FROM `program` p JOIN `prijava` pr ON p.`idProgram`=pr.`program` WHERE pr.`korisnik`='$id'";
                $rez= $baza->selectDB($prog);

                while (list($id, $naziv, $program) = $rez->fetch_array()) {
                    echo '<option value="' . $id . '">' . $naziv .  '</option>';
                }
                ?>
             </select>
                 <input type="submit" id="moj" name="moj" value="Odaberi" class="gumb1">
             </form>
        <br><br>
        <section class='omiljeni'>
            <?php
            if(isset($info)){
                echo $info;
                
            }
           ?>
        </section>
        <div style="padding-left:45%; font-size: 10px;">
            <?php
            if(isset($info1)){
                echo $info1;
            }?>
               
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


