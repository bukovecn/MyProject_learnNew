<!DOCTYPE html>
<html>
    <head>
        <title>Prijava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Prijava" />
        <meta name="kljucne_rijeci" content="projekt_teretana, prijava" />
        <meta name="datum_izrade" content="29.05.17." />
        <meta name="autor" content="Nikolina Bukovec" /> 
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
    </head>
    <body>
        
        <?php 
        
        //https
        if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
        $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        header("Location: $url");
        exit();
        }
        
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        $odjava="";
if (isset($_POST["posalji"])) {
    
    $korIme = $_POST["korisnickoime"];
    $lozinka = $_POST["lozinka"];
    $token = $_POST["token"];
    $ispis = "";
    $korisnickoIme = "";
    $cookieNaziv = $korIme;
    $cookieToken = "Token";
    $TokenVrijednost = "Token za korisničko ime: " . $korIme;
        
    include './baza.class.php';
    $baza = new Baza();
    $baza->spojiDB();
    $upit="SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korIme'";
    $vrati = $baza->selectDB($upit);
    $odg = mysqli_fetch_array($vrati);
        $tip = $odg["tip_korisnika"];
        $broj_prijava =$odg["broj_neuspjesnih_prijava"];
        $status = $odg["status_racuna"];
        //$zapamti = $odg[zapamtime];
        
    $prijave = "SELECT * FROM `konfiguracija_sus` WHERE `aministrator`=1";
                $rez= $baza->selectDB($prijave);
                $neuspjesne = mysqli_fetch_array($rez);
                $broj = $neuspjesne["neuspjesne_prijave"];
        
    if (empty($korIme) || empty($lozinka)) {
            $ispis .= "Unesite korisnicko ime i lozinku! <br>";
        } 
    else if(empty($odg)){
        $ispis.="Korisnik pod tim korisnickim imenom ne postoji!";
    }
    else if($status != 'aktivan'){
        $ispis.="Korisnik pod tim korisnickim imenom nije aktivirao korisnički račun!";
    }
        
    else if(!empty($korIme) && $odg["korisnicko_ime"]==$korIme && $odg["lozinka"]==$lozinka && $odg["broj_neuspjesnih_prijava"] < $broj){ 
        
            if($odg["prijava_2_koraka"]=="ne"){
                $ispis = "Uspješno prijavljeni! <br>"; 
                
                
                $sql1="UPDATE `korisnik` SET `broj_neuspjesnih_prijava`='0'  WHERE `korisnicko_ime`='$korIme'";
                $izvrsi = $baza->updateDB($sql1);
                 
                //prijavljeni korisnik - pamti kor. ime
                
                if (!isset($_COOKIE[$cookieNaziv])) {
                    //echo "Kreiram kolačić pod nazivom " . $cookieNaziv . " !<br>";

                    $vrijediDo = (vrati() + 30* 24 * 60 * 60);
                    $vrijednost =$korIme;
                    setcookie($cookieNaziv, $vrijednost, $vrijediDo, "/");
                    
                } else {
                    //echo "Dobrodošli natrag, " . $cookieNaziv . "! <br>";
                }
                 
                 
                //kreiranje sesije za prijavljenog kor.
                Sesija::kreirajKorisnika($korIme, $tip);
               // echo "Dobrodošao korisniče, $korIme !";
                
                
                
                //dnevnik
                        $korisnik = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korIme'";
                        $dnevnik = $baza->selectDB($korisnik);
                        $id = mysqli_fetch_array($dnevnik);
                        $id_kor = $id["idKorisnik"];
                        //$upit_dn = str_replace("'", "", $sql1);
                        $tip = "Prijava/odjava";
                        $radnja = "Prijava";
                        $datum = vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', null, '$id_kor', '$datum')";
                        $baza->updateDB($unos);
                        
                        //daj 10 bodova
                        $daj_bod="UPDATE `evidencija_bodova` SET `trenutno` = (`trenutno`+ '10') WHERE `korisnik`='$id_kor'";
                        $baza->updateDB($daj_bod);
            }
            else if($odg["prijava_2_koraka"]=="da" && $token==$odg["token"] && !empty($token)){
                
               // if (isset($_COOKIE[$cookieToken])){
                    $ispis.= "Uspješno prijavljeni! <br>";
                    

                    if (!isset($_COOKIE[$cookieNaziv])) {
                        //echo "Kreiram kolačić pod nazivom " . $cookieNaziv . " !<br>";

                    $vrijediDo = (vrati() + 24 * 60 * 60);
                    $vrijednost = "Korisnik: ". $korIme ;
                    setcookie($cookieNaziv, $vrijednost, $vrijediDo, "/");
                    
                    
                }   
                    
                    Sesija::kreirajKorisnika($korIme, $tip);
                   // echo "Dobrodošao korisniče, $korIme !";
                   
                    //dnevnik
                        $korisnik = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`= '$korIme'";
                        $dnevnik = $baza->selectDB($korisnik);
                        $id = mysqli_fetch_array($dnevnik);
                        $id_kor = $id["idKorisnik"];
                        //$upit_dn = str_replace("'", "", $sql1);
                        $tip = "Prijava/odjava";
                        $radnja = "Prijava";
                        $datum = vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', null, '$id_kor', '$datum')";
                        $baza->updateDB($unos);
                        
                        //daj 10 bodova
                        $daj_bod="UPDATE `evidencija_bodova` SET `trenutno` = (`trenutno`+ '10') WHERE `korisnik`='$id_kor'";
                        $baza->updateDB($daj_bod);
               /* }
                else{
                    echo "Token za korisničko ime: " . $korIme . " više ne vrijedi! <br>";
                    echo "Ponovno se prijavite! <br>";
                }*/
              
            }
            else{
                $sql2="UPDATE `korisnik` SET `broj_neuspjesnih_prijava`='0'  WHERE `korisnicko_ime`='$korIme'";
                $izv = $baza->updateDB($sql2);
                $ispis.= "Token je poslan. <br>" ;
                
                $email_to =$odg["e-mail"];
                $token1=date("Y-m-d H:i:s");
                $token1= sha1($token1);
                //$ispis.= "Token:" . $token1."<br>";
                $email_from = "From: WebDiP_nikbukove@foi.hr";
                $email_subject = "Token";
                $email_body = "Za prijavu unesite:" . $token1 ;
                $sql2="UPDATE `korisnik` SET `token`='$token1' WHERE `korisnicko_ime`='$korIme'";
                $izv = $baza->updateDB($sql2);
                
                //token vrijedi 5 min
                
                /*if (!isset($_COOKIE[$cookieToken])){
                    $TokenVrijednost = "Token za korisničko ime: " . $korIme;
                    $vrijeme = "SELECT * FROM `konfiguracija_sus` WHERE `aministrator`= 1";
                            $vraca = $baza->selectDB($vrijeme);
                            $vr = mysqli_fetch_array($vraca);
                            $trajanje_token = $vr["trajanje_tokena"];
                    $TokenIstjece = (vrati() + 300);
                    setcookie($cookieToken, $TokenVrijednost, $TokenIstjece, "/");
                    echo "Token spremljen u kolačić i traje 5 min";
                }*/
                
            
                if (mail($email_to, $email_subject, $email_body, $email_from)) {
                    $ispis.= "Poslana poruka na: '$email_to'! <br>";
                } else {
                    $ispis.= "Problem kod slanja na: '$email_to'! <br>";
                }
            }
        }
        else if (!empty($korIme) && $odg["korisnicko_ime"]==$korIme && $odg["broj_neuspjesnih_prijava"] < $broj){
            $broj=$odg["broj_neuspjesnih_prijava"];
            $broj2=intval($broj)+1;
            $ispis.= "Pogrešno prijavljivanje " . $broj2 . "<br>";
          
            $sql2="UPDATE `korisnik` SET `broj_neuspjesnih_prijava`='$broj2'  WHERE `korisnicko_ime`='$korIme'";
            $izv = $baza->updateDB($sql2);
            //dnevnik
                        $korisnik = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`= '$korIme'";
                        $dnevnik = $baza->selectDB($korisnik);
                        $id = mysqli_fetch_array($dnevnik);
                        $id_kor = $id["idKorisnik"];
                        //$upit_dn = str_replace("'", "", $sql1);
                        $tip = "Prijava/odjava";
                        $radnja = "Neuspješna prijava";
                        $datum = vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', null, '$id_kor', '$datum')";
                        $baza->updateDB($unos);
        }
        
         else {
             $broj=$odg["broj_neuspjesnih_prijava"];
             $ispis.= "Imate pogrešnu prijavu " . $odg["broj_neuspjesnih_prijava"] . " puta. Račun vam je zaključan! <br>";
             $zaklj = "UPDATE `korisnik` SET `status_racuna`='zakljucan'  WHERE `korisnicko_ime`='$korIme'"; 
             $zakljucaj = $baza->updateDB($zaklj);
             
             //dnevnik
                        $korisnik = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`= '$korIme'";
                        $dnevnik = $baza->selectDB($korisnik);
                        $id = mysqli_fetch_array($dnevnik);
                        $id_kor = $id["idKorisnik"];
                        $upit_dn = str_replace("'", "", $zaklj);
                        $tip = "Ostale radnje";
                        $radnja = "Zaključan";
                        $datum = vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$radnja', '$upit_dn', '$id_kor', '$datum')";
                        $baza->updateDB($unos);
        }
        $baza->zatvoriDB();
    }
    ?>

        <header class="naslov">
             <div> Prijava
             </div>
        </header>
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
            <div>
                <?php
                    if(isset($ispis)){
                        echo $ispis;
                        }
                  ?>
            </div>
            <h3 class="heading" >Popunite prijavni obrazac:</h3>
            <form id="prijava" method="post" name="prijava" action="prijava.php" novalidate="">
                <label for="korisnickoime">Korisničko ime: </label>
                <input type="text" id="korisnickoime" name="korisnickoime" size="20" maxlength="15" value="<?php if(isset($_POST["zapamti"]) && (isset($cookieNaziv))){
                echo $cookieNaziv;} ?>"><br>
                <label for="lozinka">Lozinka: </label>
                <input type="password" id="lozinka" name="lozinka" size="15" ><br>
                <a href="zaboravljenaLozinka.php" >Zaboravili ste lozinku? </a><br>
                <label id="token" for="token">Token:</label>
                <input type="text" id="token" name="token"  placeholder="Unesite token...(samo za prijavu u 2 koraka )" style="width: 300px"><br>
                <label for="zapamti">Zapamti me: </label><br>
                <input type="radio" id="zapamti" name="zapamti" value="DA"> DA <br>
                <input type="submit" name="posalji" id="posalji" value=" Prijavi se " class="gumb"><br>
                <a href="registracija.html" >Registriraj se</a>
            </form>
                    
        </section>
        <footer id='footer' style="top:0;">
           <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>

