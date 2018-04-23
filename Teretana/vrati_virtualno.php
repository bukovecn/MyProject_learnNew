<?php

function vrati() {
               include_once './baza.class.php';
               $baza = new Baza();
               $baza->spojiDB();
               $upit = "SELECT * FROM `konfiguracija_sus` WHERE `id`= '1'";
               $rezultat = $baza->selectDB($upit);
               $dohvati = mysqli_fetch_array($rezultat);
               $pomak = $dohvati["pomak_vremena"];
               $vrijeme = date("Y-m-d H:i:s", strtotime("+$pomak hours"));
               return $vrijeme;
            }
function pretvoriDatum($datum) {
		return strtotime($datum);
		}
