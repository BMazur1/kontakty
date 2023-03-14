<?php
    session_start();

$obj = json_decode(file_get_contents('php://input'), true);

    if(isset($obj['imie'])){
        $walid = true;
        //sprawdzam imie
        $imie = $obj['imie'];
        if((strlen($imie)<3)||(strlen($imie)>30)){
            $walid = false;
            $_SESSION['e_imie'] = "Imie musi posiadać od 3 do 30 znaków!";
        }
        if(ctype_alpha($imie)==false){/*nie wiem jak w tym miejsu ustawić 
            żeby czytało też polskie znaki tj. żąćść ect...*/
            $walid = false;
            $_SESSION['e_imie'] = "Imię musi składać się tylko z liter aflabetu!";
        }

        $nazwisko = $obj['nazwisko'];
        if((strlen($nazwisko)<3)||(strlen($nazwisko)>30)){
            $walid = false;
            $_SESSION['e_nazwisko'] = "Nazwisko musi posiadac od 3 do 30 znaków!";
        }
        if(ctype_alpha($nazwisko)==false){ /*nie wiem jak w tym miejsu ustawić 
            żeby czytało też polskie znaki tj. żąćść ect...*/
            $walid = false;
            $_SESSION['e_nazwisko'] = "Nazwisko musi składać się tylko z liter alfabetu!";
        }

        $nrTelefonu = $obj['nrTelefonu'];
        if((strlen($nrTelefonu)!=9)){
            $walid = false;
            $_SESSION['e_nrTelefonu'] = "Numer telefonu musi posiadac 9 znaków!";
        }
        if(ctype_alpha($nrTelefonu)==true){
            $walid = false;
            $_SESSION['e_nrTelefonu'] = "Numer telefonu musi składać się tylko z cyfr!";
        }

        require_once('connect.php');
        mysqli_report(MYSQLI_REPORT_STRICT);

        try{
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }else{
                $result = $connection->query("SELECT id FROM mojekontakty WHERE db_numerTelefonu = '$nrTelefonu'");
                if (!$result) throw new Exception($connection->error);

                $ile_takich_numerow = $result->num_rows;
                if($ile_takich_numerow>0){
                    $walid = false;
                    $_SESSION['e_nrTelefonu'] = "Istnieje juz kontakt o takim numerze telefonu!";
                }
                if($walid==true){
                    if($connection->query("INSERT INTO mojekontakty VALUES (NULL, '$imie', '$nazwisko', '$nrTelefonu') ")){
                        $_SESSION['udaneDodanieKonta']=true;
                       echo "Udane dodanie kontaktu";
                       // header('Location: index.php');
                    }else{
                        throw new Exception($connection->error);
                    }
                }

                $connection->close();
            }
        }
        catch(Exception $e){
            echo "Błąd serwera! Przepraszamy za utrudnienia.</br>";
            echo '</br>'.$e;
        }
        
    }

?>
    <h2>Książka telefoniczna </br>
    Dodaj nowy kontakt: </h2></br>
        
    <form method="post">
        <div class="input-box">
        <label>Imię: </label><input type="text" name="imie"/> </br>
        <?php
            if(isset($_SESSION['e_imie'])){
                echo '<div class = "error">'.$_SESSION['e_imie'].'</div>';
                unset($_SESSION['e_imie']);
            }
        ?>
        </div>
        <div class="input-box">
        <label>Nazwisko: </label><input type="text" name="nazwisko"/></br>
        <?php
            if(isset($_SESSION['e_nazwisko'])){
                echo '<div class = "error">'.$_SESSION['e_nazwisko'].'</div>';
                unset($_SESSION['e_nazwisko']);
            }
        ?>
        </div>
        <div class="input-box">
        <label>Numer telefonu: </label><input type="text" name="nrTelefonu"/></br>
        <?php
            if(isset($_SESSION['e_nrTelefonu'])){
                echo '<div class = "error">'.$_SESSION['e_nrTelefonu'].'</div>';
                unset($_SESSION['e_nrTelefonu']);
            }
        ?>
        </div>
        <input type="submit" value="Dodaj nowy kontak" class="btn">
        
    </form>
    <input type="submit" value="Powrót do strony głównej" class="btn" onclick="loadDoc3()">
    </div>



