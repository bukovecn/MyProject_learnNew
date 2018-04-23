
<!DOCTYPE html>
<html>
    <head>
        <title>Registracija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Registracija" />
        <meta name="kljucne_rijeci" content="projekt_teretana, registracija" />
        <meta name="datum_izrade" content="27.05.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="stylesheet" type="text/css" href="css/nikbukove.css" />
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>     
        <script type="text/javascript" src="js/nikbukove_jquery.js"></script>
        
    </head>
    <body>
        <?php
        include("vrati_virtualno.php");
        include("sesija.class.php");
        Sesija::kreirajSesiju();
        $odjava="";
        if (isset($_POST["submit"])) {
                    include("baza.class.php");
                    $bazap = new Baza();
                    $bazap->spojiDB();
                    
                    $provjera = "([!,(,),{,},#,/,\,])";
                    $lozinka_reg = "/^(?=(.*[A-Z]){2,})(?=(.*[a-z]){2,})(?=(.*[0-9]){1,}).{5,15}$/";
                    $email_reg = "/^\w+@\w+\.\w+$/";
                    $ime = $_POST["ime"];
                    $prezime = $_POST["prezime"];
                    $korisnickoime = $_POST["korisnickoime"];
                    $email = $_POST["email"];
                    $lozinka = $_POST["lozinka"];
                    $potvrdalozinke = $_POST["potvrdalozinke"];
                    $captcha=$_POST['g-recaptcha-response'];
                    
                    $cookieAktivacija = "Aktivacijski_link_" . $korisnickoime;
                     
                    
                    //ime
                    if($ime == ''){
                        $greskaIme = "Ime nije uneseno! <br>";
                    }
                    else{
                        if (preg_match($provjera, $ime)) {
                            $greskaIme1 = "Ime ne smije sadrzavati specijalne znakove! <br>";
                        }
                    }
                    
                    
                    //prezime
                    if($prezime == ''){
                        $greskaPrezime = "Prezime nije uneseno! <br>";
                    }else{
                        if (preg_match($provjera, $prezime)) {
                            $greskaPrezime1 = "Prezime ne smije sadrzavati specijalne znakove! <br>";
                        }
                    }
                    
                    //korisnicko ime
                    if($korisnickoime == ''){
                        $greskaKorIme = "Korisnicko ime nije uneseno! <br>";
                    }
                    else{
                        if (preg_match($provjera, $korisnickoime)) {
                            $greskaKorIme1 = "Korisnicko ime ne smije sadržavati specijalne znakove! <br>";
                        }
                    }
                    //email
                    if($email == ''){
                        $greskaEmail = "Email nije unesen! <br>";
                    }
                    else{
                        if (!preg_match_all($email_reg, $email)) {
                            $greskaEmail2 = "Email mora biti formata nesto@nesto.nesto! <br>";
                        }
                    }
                    

                    //lozinka
                    if($lozinka == ''){
                        $greskaLozinka = "Lozinka nije unesena! <br>";
                    }
                    else{
                        if (preg_match($provjera, $lozinka)) {
                            $greskaLozinka1 = "Lozinka ne smije sadrzavati specijalne znakove! <br>";
                        }
                    else{
                        if (!preg_match($lozinka_reg, $lozinka)) {
                            $greskaLozinka2 = "Lozinka mora sadržavati barem 2 velika, 2 mala slova, 1 broj i imati 5-15 znakova! <br>";
                        }
                    }
                    }
                    
                    //potvrda lozinke
                    if($potvrdalozinke == ''){
                        $greskaPotvrda = "Potvrda lozinke nije unesena! <br>";
                    }
                    else{
                        if (preg_match($provjera, $potvrdalozinke)) {
                            $greskaPotvrda1 = "Potvrda lozinke ne smije sadrzavati specijalne znakove! <br>";
                        }
                    else{
                        if($potvrdalozinke !== $lozinka){
                            $greskaPotvrda2 = "Potvrda lozinke i lozinka se razlikuju! <br>";
                        }
                    }
                    }
                    //provjera jel zauzeto korisnicko ime i email
                    
                    $rezultat = $bazap->selectDB(" SELECT * FROM `korisnik` WHERE `korisnicko_ime`='$korisnickoime' or `e-mail`='$email'");
                    $red = mysqli_fetch_array($rezultat);
                    if ($bazap->pogreskaDB()) {
                        echo "Problem kod upita na bazu!<br>";
                    }
                    if ($red["korisnicko_ime"] || $red["e-mail"]) {
                        $greskaKorEmail = "Korisničko ime ili email već postoji u bazi! <br>";
                        
                    }
                    
                    
                    //provjera jel prošlo re-captchu
                    if(empty($captcha)){
                        $greskaCaptcha = "Captcha nije označeno! <br>";
                    }
                  
                    //upis u bazu
                    if (!isset($greskaIme) && !isset($greskaIme1) && !isset($greskaPrezime) && !isset($greskaPrezime1) &&
                        !isset($greskaKorIme) && !isset($greskaKorIme1) && !isset($greskaEmail) && 
                        !isset($greskaEmail2) && !isset($greskaKorEmail) && !isset($greskaLozinka) && !isset($greskaLozinka1) && !isset($greskaLozinka2) && 
                        !isset($greskaPotvrda) && !isset($greskaPotvrda1) && !isset($greskaPotvrda2) && !isset($greskaCaptcha)) {
                        
                        $salt = sha1(time());
                        $kriptirana = sha1($salt . "--" . $lozinka);
                        
                        $saltAktivacija = sha1(time());
                        $kod = sha1($saltAktivacija . $korisnickoime);
                        
                        $dvaKoraka = $_POST["2Kor"];
                        $upitic = "INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,'3','$ime', '$prezime', '$email', '$korisnickoime',  '$lozinka', '$potvrdalozinke', '$kriptirana', '$kod', null, '$dvaKoraka', null, 'nije aktiviran', '0')";
                        $unesi = $bazap->updateDB($upitic); 
                        
                        $vrijeme = "SELECT * FROM `konfiguracija_sus` WHERE `aministrator`= 1";
                        $vraca = $bazap->selectDB($vrijeme);
                        $vr = mysqli_fetch_array($vraca);
                        $trajanje_akt = $vr["trajanje_linka_aktivacije"];
                        
                        
                        //echo "Slanje maila!";
                        $mjesto = "/WebDiP/2016_projekti/WebDiP2016x019/";
                        $email_za = $email;
                        $email_od = "From: WebDiP_nikbukove@foi.hr";
                        $email_subject = "Aktivacijski link";
                        $link = "http://$_SERVER[HTTP_HOST]".$mjesto."aktivacija.php?activate=".$kod;
                        $email_body = "Za aktivaciju odaberite link: " . $link . " Link vrijedi " . $trajanje_akt . "sati.";

                       // echo $email_body;
                        if (mail($email_za, $email_subject, $email_body, $email_od)) {
                            echo("Poruka poslana na: '$email_za' !");
                            $vrijeme = "SELECT * FROM `konfiguracija_sus` WHERE `aministrator`= 1";
                            $vraca = $bazap->selectDB($vrijeme);
                            $vr = mysqli_fetch_array($vraca);
                            $trajanje_akt = $vr["trajanje_linka_aktivacije"];
                            
                            
                            if (!isset($_COOKIE[$cookieAktivacija])){
                                $aktivacijaVrijednost = "Link za korisnika ". $korisnickoime ;
                                $akt_pocinje = vrati();
                                $AktivacijaIstjece = (vrati() + 18000);
                                setcookie($cookieAktivacija, $aktivacijaVrijednost, $AktivacijaIstjece, "/");
                                //echo "Aktivacijski link spremljen u kolačić i traje " .$trajanje_akt. " sati!";
                            }
                          
                            //dnevnik
                        $korisnik = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`= '$korisnickoime'";
                        $dnevnik = $bazap->selectDB($korisnik);
                        $id = mysqli_fetch_array($dnevnik);
                        $id_kor = $id["idKorisnik"];
                        $upit = "INSERT INTO `korisnik`(`idKorisnik`, `tip_korisnika`, `ime`, `prezime`, `e-mail`, `korisnicko_ime`, `lozinka`, `potvrda_lozinke`, `kriptirana_lozinka`, `aktivacijski_link`, `datum_registriranja`, `prijava_2_koraka`, `token`, `status_racuna`, `broj_neuspjesnih_prijava`) VALUES (null,'3','$ime', '$prezime', '$email', '$korisnickoime',  '$lozinka', '$potvrdalozinke', '$kriptirana', '$kod', null, '$dvaKoraka', null, 'nije aktiviran', '0')";
                        $upit_dn = str_replace("'", "", $upit);
                        $tip = "Registracija";
                        $datum = vrati();
                        $unos = "INSERT INTO `dnevnik_rada`(`id`, `tip_akcije`, `radnja`, `upit`, `korisnik_id`, `datum_i_vrijeme`) VALUES (null, '$tip', '$tip', '$upit_dn', '$id_kor', '$datum')";
                        $bazap->updateDB($unos);
                        
                        //10 bodova za reg.
                        $daj_bod="INSERT INTO `evidencija_bodova`(`korisnik`, `trenutno`, `datum`) VALUES ('$id_kor', `trenutno`+ '10', '$datum' )";
                        $bazap->updateDB($daj_bod);
                        
                        } else {
                            echo("Problem kod slanja poruke na: '$email_za' !");
                        }
                        
                       
                    }
                    
                    $bazap->zatvoriDB();
        }
        ?>


        <header>
            <div class="naslov">Registracija</div>
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
        <section class="sadrzaj">
            <div id="greska_registracija">
            <?php
                if (isset($greskaIme)) {
                    echo $greskaIme;
                }
                else if (isset($greskaIme1)) {
                        echo $greskaIme1;
                    }
               
                if (isset($greskaPrezime)) {
                    echo $greskaPrezime;
                }
                else if (isset($greskaPrezime1)) {
                        echo $greskaPrezime1;
                    }
                
                if (isset($greskaKorIme)) {
                    echo $greskaKorIme;
                }
                else if (isset($greskaKorIme1)) {
                        echo $greskaKorIme1;
                    }
                
                if (isset($greskaEmail)) {
                    echo $greskaEmail;
                }
                else if(isset($greskaEmail2)) {
                            echo $greskaEmail2;
                    }
                    
                if (isset($greskaKorEmail)) {
                    echo $greskaKorEmail;
                }
                
                    
                if (isset($greskaLozinka)) {
                    echo $greskaLozinka;
                }
                else if (isset($greskaLozinka1)) {
                        echo $greskaLozinka1;
                    }
                else if(isset($greskaLozinka2)) {
                            echo $greskaLozinka2;
                        }
                    
                if (isset($greskaPotvrda)) {
                    echo $greskaPotvrda;
                } 
                else if (isset($greskaPotvrda1)) {
                        echo $greskaPotvrda1;
                    }
                else if (isset($greskaPotvrda2)) {
                        echo $greskaPotvrda2;
                    }
                
                if(isset($greskaCaptcha)){
                    echo $greskaCaptcha;
                }
                
                ?>
            </div>
            <h3 class="heading">Popunite registracijski obrazac:</h3>
            <form id="registracija" method="post" name="registracija" action="registracija.php" novalidate>
                <label for="ime">Ime: </label>
                <input type="text" id="ime" name="ime" size="20" maxlength="15" >
                    <?php
                    if (isset($greskaIme) || isset($greskaIme1)) {
                        echo '<label style="color:red;font-size:20px;">!</label>';
                    }
                    ?>
                <label id="ime1" class="upozorenja1"></label><br>
                <label for="prezime">Prezime: </label>
                <input type="text" id="prezime" name="prezime" size="20" >
                    <?php
                    if (isset($greskaPrezime) || isset($greskaPrezime1)) {
                        echo '<label style="color:red;font-size:20px;">!</label>';
                    }
                    ?>
                <label id="prezime1" class="upozorenja1"></label><br>
                <label for="korisnickoime">Korisničko ime: </label>
                <input type="text" id="korisnickoime" name="korisnickoime" required="required">
                    <?php
                    if (isset($greskaKorIme) || isset($greskaKorIme1) || isset($greskaKorEmail)) {
                        echo '<label style="color:red;font-size:20px;">!</label>';
                    }
                    ?>
                <label id="korisnickoime1" class="upozorenja1"></label><br>
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" size="20" required="required">
                    <?php
                    if (isset($greskaEmail) || isset($greskaEmail2) || isset($greskaKorEmail)) {
                        echo '<label style="color:red;font-size:20px;">!</label>';
                    }
                    ?><br>
                <label for="lozinka">Lozinka: </label>
                <input type="password" id="lozinka" name="lozinka" size="15" required="required">
                <?php
                    if (isset($greskaLozinka) || isset($greskaLozinka1) || isset($greskaLozinka2)) {
                        echo '<label style="color:red;font-size:20px;">!</label>';
                    }
                    ?>
                <label id="lozinka1" class="upozorenja1"></label><br>
                <label for="potvrdalozinke">Potvrda lozinke: </label>
                <input type="password" id="potvrdalozinke" name="potvrdalozinke" size="15" required="required">
                <?php
                    if (isset($greskaPotvrda) || isset($greskaPotvrda1) || isset($greskaPotvrda2)) {
                        echo '<label style="color:red;font-size:20px;">!</label>';
                    }
                    ?>
                <label id="potvrda1" class="upozorenja1"></label><br>
                <label for="2korakaDa">Prijava u 2 koraka ?</label><br>
                <input type="radio" id="2korakaDa" name="2Kor" value="da" />Da <br>
                <input type="radio" id="2korakaNe" name="2Kor" value="ne" checked="checked"/>Ne<br>
                <div class="g-recaptcha" data-sitekey="6Lc-zx8UAAAAAGg_vU8qalIH6R8vPrKmhJMbq6fq">
                </div><br>

                <input id= "submit" type="submit" name="submit" value=" Pošalji " class="gumb"><br>
            </form>
        </section>
       <footer id="footer" style="position: relative; top:650px;">
            <p>Autor stranice: Nikolina Bukovec </p><br>
            <p style="font-style: italic">Za sve potrebne informacije obratite se na: nikbukove@foi.hr</p>
        </footer>
    </body>
</html>


