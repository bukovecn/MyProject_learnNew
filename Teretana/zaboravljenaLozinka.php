
<!DOCTYPE html>
<html>
    <head>
        <title>Zaboravili ste lozinku?</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Zaboravljena lozinka" />
        <meta name="kljucne_rijeci" content="projekt_teretana, lozinka" />
        <meta name="datum_izrade" content="09.06.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
    </head>
    <body>
        <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        $odjava="";
        
           
        if (isset($_POST["zabLoz"])) {
            include './baza.class.php';
            $baza = new Baza();
            $baza->spojiDB();
            $korisnicko = $_POST["korisnicko"];
            $ispis = '';
            
            if($korisnicko == ''){
                $ispis .= "Niste unjeli korisničko ime!";
            }
            else{
                $upit="SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korisnicko'";
                $vrati = $baza->selectDB($upit);
                $odg = mysqli_fetch_array($vrati);
                
                if($korisnicko == $odg["korisnicko_ime"]){
                    //$ispis.= "Vaša lozinka je poslana na mail: " . $odg["e-mail"] . "<br>" ;

                    $email_to =$odg["e-mail"];

                    $duljina = rand(5,15);
                    $random = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 5, $duljina);
                    //echo $random;

                    $lozinka1=$random;
                    //$ispis.= "Lozinka:" . $lozinka1."<br>";
                    $email_from = "From: WebDiP_nikbukove@foi.hr";
                    $email_subject = "Lozinka";
                    $email_body = "Nova lozinka za prijavu je:" . $lozinka1 ;
                    $sql2="UPDATE `korisnik` SET `lozinka`='$lozinka1' WHERE `korisnicko_ime`='$korisnicko'";
                    $izv = $baza->updateDB($sql2);
                    $sql3 = "UPDATE `korisnik` SET `potvrda_lozinke`='$lozinka1' WHERE `korisnicko_ime`='$korisnicko'";
                    $izv3 = $baza->updateDB($sql3);

                    if (mail($email_to, $email_subject, $email_body, $email_from)) {
                        $ispis.= "Poslana poruka na: '$email_to'! <br>";
                    } else {
                        $ispis.= "Problem kod slanja na: '$email_to'! <br>";
                    }
                    //dnevnik
                        $korisnik = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korisnicko'";
                        $dnevnik = $baza->selectDB($korisnik);
                        $id = mysqli_fetch_array($dnevnik);
                        $id_kor = $id["idKorisnik"];
                        $upit_dn = str_replace("'", "", $sql2);
                        $tip = "Ostale radnje";
                        $radnja = "Zaboravljena lozinka";
                        $datum =  vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', $upit_dn, '$id_kor', '$datum')";
                        $baza->updateDB($unos);

             $baza->zatvoriDB();
            }
            else {
                $ispis.= "Ne postoji korisnik s tim korisničkim imenom!<br>";
                }
            }
        }
            ?>
        <header class="naslov">
             <div> Zaboravili ste lozinku? </div>
        </header>
        <div class="odjava">
             <?php
           if (isset($_SESSION['korisnik'])) {
               $korIme = $_SESSION['korisnik']; 
                        $odjava .= "Bok, $korIme! ".'<a href=odjava.php>Odjava</a>';
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
        
        <section>
            <?php
                    if(isset($ispis)){
                        echo $ispis;
                        }
                  ?>
        </section>
            <form id="zaboravljenaLoz" method="post" name="zaboravljenaLoz" action="zaboravljenaLozinka.php" novalidate="">
                <label for="korisnicko">Unesite korisničko ime: </label>
                <input type="text" id="korisnicko" name="korisnicko" size="20" maxlength="15" >
                <input type="submit" id="zabLoz" name="zabLoz" value="Nova lozinka">
            </form>

        <footer id='footer'>
            <p>Vrijeme izrade početne stranice: 1 sat </p>
            <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>



