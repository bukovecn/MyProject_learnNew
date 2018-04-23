$(document).ready(function () {
    
    var ispisImePrezime = '';
    var ispisPotvrda = '';
    var ispisKrivoLoz = '';
    var ispisKorIme = '';

    //$("#korisnickoime").attr("disabled", true);
    //$("#potvrdalozinke").attr("disabled", true);
    
    var ime = $("#ime");
    var prezime = $("#prezime");
    var korisnickoime = $("#korisnickoime");
    var duljinaIme = 0;
    var duljinaPrezime = 0;
    var duljinaKorIme = 0;
    var pocetno = new RegExp(/^[A-Z][A-Za-z\-]*/);
    $("#ime, #prezime").blur(function () {
        duljinaIme = $.trim(ime.val()).length;
        duljinaPrezime = $.trim(prezime.val()).length;
        //je li uneseno ime i prezime
        //je li početno slovo veliko
        if ((duljinaIme === 0) || (duljinaPrezime === 0) || !pocetno.test(ime.val()) || !pocetno.test(prezime.val())) {
            $("#korisnickoime").val("");
            $("#ime").css("background-color", "#FFCCCC");
            $("#prezime").css("background-color", "#FFCCCC");
            ispisImePrezime = "Početno slovo imena i prezimena mora biti veliko!";
            $("#ime1").html(ispisImePrezime);
            $("#prezime1").html(ispisImePrezime);
            $("#korisnickoime").attr("disabled", true);
        } else {
            $("#ime1").html("");
            $("#prezime1").html("");
            $("#ime").css("background-color", "");
            $("#prezime").css("background-color", "");
            $("#korisnickoime").removeAttr("disabled");
        }
    });
    
    //provjera korisnicko ime
    $("#korisnickoime").blur(function () {
        duljinaKorIme = $.trim(korisnickoime.val()).length;
        if ((duljinaKorIme  <5 ) || (duljinaKorIme  >15 )) {
             $("#korisnickoime").css("background-color", "#FFCCCC");
             ispisKorIme = "Korisničko ime mora sadržavati 5-15 znakova!";
             $("#korisnickoime1").html(ispisKorIme);
        }
        else {
            $("#korisnickoime1").html("");
            $("#korisnickoime").css("background-color", "");
        }
    });
    
    //provjera lozinke - unesena, format
    var lozinka = $("#lozinka");
    var duljinaLozinke = 0;
    var lozinkaFormat = new RegExp(/^(?=(.*[A-Z]){2,})(?=(.*[a-z]){2,})(?=(.*[0-9]){1,}).{5,15}$/);
    
    $('#lozinka').blur(function () {
        duljinaLozinke = $.trim(lozinka.val()).length;
        if(duljinaLozinke === 0 || !lozinkaFormat.test(lozinka.val())){
           $("#potvrdalozinke").val("");
           $("#lozinka").css("background-color", "#FFCCCC");
           ispisKrivoLoz = "Lozinka  nije unesena ili ne odgovara formatu (bar 2 velika, 2 mala slova i 1 broj te 5-15 znakova)!";
           $("#lozinka1").html(ispisKrivoLoz);
           $("#potvrdalozinke").attr("disabled", true);
        } else {
            $("#lozinka").css("background-color", "");
            $("#lozinka1").html("");
            $("#potvrdalozinke").removeAttr("disabled");
            
        }
        
    });
    
        
    //usporedba lozinke i potvrde 
   $('#potvrdalozinke').blur(function () {
        if($("#potvrdalozinke").val() !== $("#lozinka").val()){
            ispisPotvrda = "Potvrda lozinke se ne podudara sa lozinkom!";
            $("#potvrda1").html(ispisPotvrda);
            $("#potvrdalozinke").css("background-color", "#FFCCCC");
        
        } else {
            $("#potvrda1").html("");
            $("#potvrdalozinke").css("background-color", "");
        }
      
   });   
    
    
 
   //provjera korisnicko je li zauzeto
    zas = true;
    $("#korisnickoime").blur(function () {
        var korIme = $("#korisnickoime").val();
                        
                    $.ajax({
				url: "privatno/korisnici.php",
				type: "POST",
				data: {
					action: "checkUsername",
					username: korIme.val()
				},
				async: false,
				success: function(data) {
					if (data == "true") {
						$("#korisnickoime").css("background-color", "#FFCCCC");
                                                ispisKorIme = "Korisničko ime već zauzeto!";
                                                $("#korisnickoime1").html(ispisKorIme);
						
						zas = false;
					} else {
						$("#korisnickoime1").html("");
                                                $("#korisnickoime").css("background-color", "");
					}
				},
				error: function() {
				}
			});
    });
    
 
	 $('#tablica').dataTable(
                                {
                                    "aaSorting": [[0, "asc"], [1, "asc"], [2, "asc"]],
                                    "bPaginate": true,
                                    "bLengthChange": true,
                                    "bFilter": true,
                                    "bSort": true,
                                    "bInfo": true,
                                    "bAutoWidth": true
                                });

});


