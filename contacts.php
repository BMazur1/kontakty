<?php
header('Content-Type: application/json');
session_start();
    // if (!isset($_POST['imie'])){
    //     header('Location: index.php');
    //     exit();
    // }



    $obj = json_decode(file_get_contents('php://input'), true);
    // $imie = $obj['imie'];
    // $nazwisko = $obj['nazwisko'];
    // $nrTelefonu = $obj['nrTelefonu'];

    // echo $imie;
    require_once("connect.php");

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
    if($connection->connect_errno!=0){
       echo "Error:".$connection->connect_errno;
    }else{
        if(strlen($obj['imie'])>0){
            $imie = $obj['imie'];
            $nazwisko = "0";
            $nrTelefonu = "a";
        }elseif(strlen($obj['nazwisko'])>0){
            $imie = "0";
            $nazwisko = $obj['nazwisko'];
            $nrTelefonu = "a";
        }elseif(strlen($obj['nrTelefonu'])>0){
            $imie = "0";
            $nazwisko = "0";
            $nrTelefonu = $obj['nrTelefonu'];
        }else{
            $imie = "0";
            $nazwisko = "0";
            $nrTelefonu = "a";
            
        }
        $sql = "SELECT * FROM mojekontakty WHERE (db_imie LIKE '%$imie%') 
        OR (db_nazwisko LIKE '%$nazwisko%') 
        OR (db_numerTelefonu LIKE '%$nrTelefonu%')";

        if ($result = @$connection->query($sql)){
            $ile_kontaktow = $result->num_rows;
            if($ile_kontaktow>0){
                for($i=0; $i < $ile_kontaktow; $i++){
                $wiersz = $result->fetch_assoc();
                $db_imie = $wiersz['db_imie'];
                $db_nazwisko = $wiersz['db_nazwisko'];
                $db_nrTelefonu = $wiersz['db_numerTelefonu'];
                //echo print_r($wiersz);
                $j=$i+1;
                echo '<div class="result">';
                echo $j.'. ';
                echo 'Imię: <div class="red-result">'.$db_imie.'</div>';
                echo 'Nazwisko: <div class="red-result">'.$db_nazwisko.'</div>';
                echo 'Numer telefonu: <div class="red-result">'.$db_nrTelefonu.'</div></br>';
                echo '</div>';
                }
                echo '<input type="submit" value="Powrót" class="btn" onclick="loadDoc3()">';


                $result->close();


            }else{
                echo "Podany kontak nie istnieje</br>";
                echo "Spróbuj jescze raz!</br>";
                echo '<input type="submit" value="Spróbuj jeszcze raz" class="btn" onclick="loadDoc3()">';

            }
        }

        $connection->close();
    }

    

?>
<script>

</script>


