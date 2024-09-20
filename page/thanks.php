
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="../js/override.js" defer></script>
</head>
<body>
<?php

if(isset($_POST['submit'])) {


    include "../modules/core/db_connect.php"; // Ensure database connection is included
    session_start();

    $name = $_POST['name'];

    var_dump($_POST['name']);
    
    foreach ($_SESSION['temp_reserved_chair'] as $value) {
        $chair_num = $value['num'];
        $chair_row = $value['row'];
        $type = $value['type'];

        if($value['name'] == $name) {

            $sqli_prepare = $con->prepare("DELETE FROM `temporary_reserved_chairs` WHERE chair_number = ? AND chair_row = ? AND movie_name = ? LIMIT 1");
            $sqli_prepare->bind_param('iis', $chair_num, $chair_row, $name);
        
            if (!$sqli_prepare->execute()) {
                
            } else {
                // Also remove it from the session if it exists
                foreach ($_SESSION['temp_reserved_chair'] as $key => $valueTwo) {
                    if ($valueTwo['num'] == $chair_num && $valueTwo['row'] == $chair_row && $valueTwo['name'] == $name) {
                        unset($_SESSION['temp_reserved_chair'][$key]);
                    }
                }
            }

            $sqli_prepare = $con->prepare("INSERT INTO `reserved_chairs` (chair_number, chair_row, type, movie_name) VALUES (?, ?, ?, ?);");
            $sqli_prepare->bind_param('iiss', $value['num'], $value['row'], $value['type'], $name);

            if (!$sqli_prepare->execute()) {
                
            } else {
                $last_inserted_id = $sqli_prepare->insert_id;
            }
        }
    }
} else {
    echo "error test";
}
   
?>

        <div id="bestellingBedankt" class="container-fluid fixed-top vh-100 vw-100 p-0" style="display: block;">
            <div class="w-100 h-100 bg-white d-flex flex-column justify-content-center align-items-center">
                <div class="w-25">
                    <button type="button" class="btn-close mt-4 ms-4" onclick="closeBestellingBedankt()"></button>
                </div>
                <div class="w-25 d-flex flex-column">
                    <p class="fs-4 w-100 text-center m-0">-- Bedankt voor uw bestelling --</p>
                    <p class="fs-5 w-100 text-center">-- In uw mail vind u de Tickets --</p>
                </div>
            </div>
        </div>

</body>
</html>