<?php
    session_start();

    if(!isset($_SESSION['udaneDodanieKonta'])){
        
    }else{
        unset($_SESSION['udaneDodanieKonta']);
        echo '<script>alert("Udane dodanie konta")</script>';

    }


?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css">
</head>
    
<body id="body">
    <div class="global-container" id="global-container">
        <h2>Witaj na stronie</br>
        Wpisz znane Ci dane kontaktu:</h2></br>

        <div class="input-box">
            <label>Imię:</label> <input type="text" name="imie" id="imie"/> </br>
        </div>
        <div class="input-box">
            <label>Nazwisko:</label> <input type="text" name="nazwisko" id="nazwisko"/></br>
        </div>
        <div class="input-box">
            <label>Numer telefonu: </label><input type="text" name="nrTelefonu" id="nrTelefonu"/></br>
        </div>
            <input type="submit" value="Dodaj nowy kontak" class="btn" onclick="loadDoc2()">
            <input type="submit" value="Sprawdź kontakt" class="btn" onclick="loadDoc()">
        </div>
  </div>
    <div class="pileczki-button">
      <form action="pileczki.html">
        <input type="submit" value="Przejdz do pileczek" class="btn">
      </form>
    </div>



<script>

function loadDoc2() {
  const xhttp = new XMLHttpRequest();
  let data = {
    imie: document.getElementById("imie").value,
    nazwisko: document.getElementById("nazwisko").value,
    nrTelefonu: document.getElementById("nrTelefonu").value
  };
  //console.log (JSON.stringify(data))
  xhttp.onload = function() {
    document.getElementById("global-container").innerHTML = this.responseText;
  };
  xhttp.open("POST", "add.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(JSON.stringify(data));
}


function loadDoc() {
  const xhttp = new XMLHttpRequest();
  let data = {
    imie: document.getElementById("imie").value,
    nazwisko: document.getElementById("nazwisko").value,
    nrTelefonu: document.getElementById("nrTelefonu").value
  };
  //console.log (JSON.stringify(data))
  xhttp.onload = function() {
    document.getElementById("global-container").innerHTML = this.responseText;
  };
  xhttp.open("POST", "contacts.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(JSON.stringify(data));
}

function loadDoc3() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("body").innerHTML =
    this.responseText;
  }
    xhttp.open("GET", "index.php");
    xhttp.send();
}

</script>
<?php


?>



</body>

</html>