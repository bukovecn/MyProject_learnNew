<!DOCTYPE html>
<html>
    <head>
        <title>Kreiraj vrstu</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="moderator" />
        <meta name="kljucne_rijeci" content="projekt_teretana, vrste_programa" />
        <meta name="datum_izrade" content="13.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove2.css" />
    </head>
        <body>
            <header class="naslov">
             <div> Kreiraj vrste programa</div>
        </header>
            <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        include("baza.class.php");
        $baza = new Baza();
        $baza->spojiDB();
        $odjava="";
        $poruka="";
        
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
        
        if(isset($_POST["dodaj"])){
            if(!empty($_POST["naziv"]) && !empty($_POST["opis"]) && isset($_POST["moderator"])){
                $naziv=$_POST["naziv"];
                $opis=$_POST["opis"];
                $mod=$_POST["moderator"];
            
                $unesi="INSERT INTO `vrsta_programa`(`idVrste_programa`, `naziv`, `opis`, `moderator`) VALUES (null, '$naziv', '$opis', '$mod')";
                $da=$baza->updateDB($unesi);
                $poruka .= "Uspješno ste dodali novu vrstu programa!<br>";
            
            }else{
                $poruka .= "Nisu uneseni svi podaci!<br>";
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
            <br>
            <h3>Popunite podatke za novu vrstu programa:</h3><br><br>
            
            <form id="kreiraj_vrstu" name="kreiraj_vrstu" method ="POST" action="kreirajVrstu.php" class="padd">
            <label for ="naziv" class ="padd">Naziv vrste programa: </label>
            <input type="text" name="naziv" id="naziv" >
            <label for ="opis" class ="padd">Opis: </label>
            <textarea  name="opis" id="opis" ></textarea><br>
            <label for="moderator" class ="padd">Moderator: </label>
            <select id="moderator" name="moderator"  placeholder="--odaberi--">
                <?php
                $upit="SELECT * FROM `korisnik` WHERE `tip_korisnika`='2'";
                $rezultat = $baza->selectDB($upit);
            
                while (list($id, $tip, $ime, $prezime) = $rezultat->fetch_array()) {
                    echo '<option value="' . $id . '">' .$ime . ' ' . $prezime . '</option>';
                    
                }
                ?>
            </select><br><br>
            <span style="padding-left:400px;"></span>
            <input type="submit" id="dodaj" name="dodaj" value="Dodaj" class ="gumb" style="width: 100px;"><br>
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

