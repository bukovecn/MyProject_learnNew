
<!DOCTYPE html>
<html>
    <head>
        <title>Korisnici</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Korisnici" />
        <meta name="kljucne_rijeci" content="projekt_teretana, korisnici" />
        <meta name="datum_izrade" content="27.05.17." />
        <meta name="autor" content="Nikolina Bukovec" />
        <link rel="icon" 
              href="slike/ikona.png" 
              type="image/gif" sizes="16x16">
        <link rel="stylesheet" type="text/css" href="../css/nikbukove.css" />
    </head>
        <body>
            <?php

            include_once '../baza.class.php';
            $baza = new Baza();
            $baza->spojiDB();
            $upit="SELECT * FROM `korisnik`";
            $rezultat = $baza->selectDB($upit);
            $tip = '';
            
            if ($rezultat->num_rows != 0) {
            $table="";
            $table.= "<table>
                            <tr>
                                <th>Tip korisnika</th>
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>Korisnicko ime</th>
                                <th>Lozinka</th>
                            </tr>";
            
        while($rj = mysqli_fetch_assoc($rezultat)){
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
                $table.= "<td>" . $tip . "</td>";
                $table.= "<td>" . $rj['ime'] . "</td>";
                $table.= "<td>" . $rj['prezime'] . "</td>";
                $table.= "<td>" . $rj['korisnicko_ime'] . "</td>";
                $table.= "<td>" . $rj['lozinka'] . "</td>";
                $table.= "</tr>";
            }
            $table.= "</table>";
            }

            ?>
            <header class="naslov">
                    <div> Korisnici </div>
            </header>
        <nav >
            <h2 class="heading" style="background-color: gainsboro;" >Izbornik: </h2>
            <ul>
                    <li><a href="../dokumentacija.html" >Dokumentacija</a></li>
                    <li><a href="../o_autoru.html" >O autoru</a></li>
                    <li><a href="../index.php" >Početna stranica</a></li>
                    <li><a href="../registracija.php" >Registracija</a></li>
                    <li><a href="../prijava.php">Prijava</a></li>
                    <li><a href="../statistika.php">Statistika aplikacije</a></li>
                    <li><a href="../otkljucavanje.php">Otkljucavanje računa</a></li>
                    <li><a href="../dnevnik.php">Dnevnik rada</a></li>
                    <li><a href="../postaviVrijeme.php">Postavi vrijeme</a></li>
                </ul>
        </nav>
        
        <section>
             <?=$table ?>
        </section>
        <footer id='footer'>
            <p>Vrijeme izrade početne stranice: 1 sat </p>
            <figure>
                <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2016_projekti/WebDiP2016x019/korisnici.html">
                    <img src="../slike/HTML5.png" width="100" alt="HTML 5 validator" />
                </a>
                <figcaption>HTML 5 validator</figcaption>
            </figure>
            <figure>
                <a href="https://jigsaw.w3.org/css-validator/check?uri=http://barka.foi.hr/WebDiP/2016/zadaca_01/nikbukove/nikbukove.css">
                <img src="../slike/CSS3.png" width="100" alt="CSS 3 validator" />
                </a>
                <figcaption>CSS 3 validator</figcaption>
            </figure>
        </footer>
    </body>
</html>
