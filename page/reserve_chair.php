<?php
    session_start();
    if(!isset($_SESSION['temp_reserved_chair'])) {
        $_SESSION['temp_reserved_chair'] = [];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="../js/reserve_chair.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/cursor.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>

    
    
<div id="chairs" class="container m-0 p-0 vh-100 vw-100">

<?php
     include "../modules/core/db_connect.php";

    $total_rows = 10;
    $total_chairs = 111;
    $current_chair = 0;
    $chair_reserved = [];
    $delete_chair = [];
    $selected_chair = array();

    foreach ($_SESSION['temp_reserved_chair'] as $key => $value) {
        $temp_chair = $value['number'] . $value['row'];
        array_push($selected_chair, $temp_chair);
   }

        $sqli_prepare = $con->prepare("SELECT id, chair_number, chair_row, date_chair_reserved FROM temporary_reserved_chairs");
        $sqli_prepare->bind_result($id,$chair_number,$chair_row,$date_chair_reserved);
        if($sqli_prepare === false){
            echo mysqli_error($con);
        } else { 
            if($sqli_prepare->execute()){ 
                
                while($sqli_prepare->fetch()) {

                $current_time = date("Y-m-d H:i:s");
               
                $start_date[$id] = new DateTime($date_chair_reserved);
                $since_start = $start_date[$id]->diff(new DateTime($current_time));


                   if($since_start->h >= 1 || $since_start->i >= 2){
                    $delete_chair[] = $id;
                   } else {
                    $chair_reserved[$chair_row][$chair_number] = true;
                   }
                   
                   
                };
                
            }
            if(count($delete_chair) > 0) {
                foreach($delete_chair as $delete) {
                    $sqli_prepare = $con->prepare("DELETE FROM `temporary_reserved_chairs` WHERE id = '$delete';");

                    if($sqli_prepare === false) {
                        echo mysqli_error($con); 
                    } else{
                        $sqli_prepare->execute();
                    }
                }
                
            }
            
            $sqli_prepare->close();

            
        }

    for($i = 1; $i <= $total_rows; $i++) {
        
        
        for($x = 0; $x < 12; $x++) {

            $current_chair++;

            $click_check = strval($current_chair).strval($i);

            if($current_chair == 1) { ?>
                <div class="row w-100">
            <?php
                if($i == 10){
                    if(!isset($chair_reserved[$i][$current_chair])) { ?>
                        <img src="../assets/chairs/non_reserved_wheelchair.png" alt="niet gereserveerd" class="col mt-3 p-1 pointer" onclick="add_chair(<?= $current_chair .','. $i?>)" width="15" height="75">
                <?php } else if(isset($chair_reserved[$i][$current_chair]) && $chair_reserved[$i][$current_chair] == true) {
                        
                    if(in_array($click_check, $selected_chair)) { ?>
                            <img src="../assets/chairs/temp_reserved_wheelchair.png" alt="niet gereserveerd" class="col mt-3 p-1 pointer" onclick="remove_chair(<?= $current_chair .','. $i?>)" width="15" height="75">
                <?php } else { ?>
                            <img src="../assets/chairs/temp_reserved_wheelchair.png" alt="niet gereserveerd" class="col mt-3 p-1 no-pointer" width="15" height="75">
                <?php }
                 }
                } else {
                    if(!isset($chair_reserved[$i][$current_chair])) { ?>
                        <img src="../assets/chairs/non_reserved_chair.png" alt="niet gereserveerd" class="col mt-3 p-1" onclick="add_chair(<?= $current_chair .','. $i?>)" width="15" height="75">
                <?php } else if(isset($chair_reserved[$i][$current_chair]) && $chair_reserved[$i][$current_chair] == true) { 
                        
                        if(in_array($click_check, $selected_chair)) { ?>
                            <img src="../assets/chairs/temp_reserved_chair.png" alt="niet gereserveerd" class="col mt-3 p-1 pointer" onclick="remove_chair(<?= $current_chair .','. $i?>)" width="15" height="75">
                <?php } else { ?>
                            <img src="../assets/chairs/temp_reserved_chair.png" alt="niet gereserveerd" class="col mt-3 p-1 no-pointer" width="15" height="75">
                <?php }
                }
            }

            //
            } else if($current_chair <= 10 && $i <= 9 || $current_chair <= 11 && $i == 10) {

                if($i == 10 && $current_chair == 2){
                    if(!isset($chair_reserved[$i][$current_chair])) { ?>
                        <img src="../assets/chairs/non_reserved_wheelchair.png" alt="niet gereserveerd" class="col mt-3 p-1 pointer" onclick="add_chair(<?= $current_chair .','. $i?>)" width="15" height="75">
                <?php } else if(isset($chair_reserved[$i][$current_chair]) && $chair_reserved[$i][$current_chair] == true) { 
                    
                        if(in_array($click_check, $selected_chair)) { ?>
                            <img src="../assets/chairs/temp_reserved_wheelchair.png" alt="niet gereserveerd" class="col mt-3 p-1 pointer" onclick="remove_chair(<?= $current_chair .','. $i?>)" width="15" height="75">
                <?php } else { ?>
                            <img src="../assets/chairs/temp_reserved_wheelchair.png" alt="niet gereserveerd" class="col mt-3 p-1 no-pointer" width="15" height="75">
                <?php }
                    }
                } else {
                    if(!isset($chair_reserved[$i][$current_chair])) { ?>
                        <img src="../assets/chairs/non_reserved_chair.png" alt="niet gereserveerd" class="col mt-3 p-1 pointer" onclick="add_chair(<?= $current_chair .','. $i?>)" width="15" height="75">
                <?php } else if(isset($chair_reserved[$i][$current_chair]) && $chair_reserved[$i][$current_chair] == true) { 
                    
                        if(in_array($click_check, $selected_chair)) { ?>
                            <img src="../assets/chairs/temp_reserved_chair.png" alt="niet gereserveerd" class="col mt-3 p-1 pointer" onclick="remove_chair(<?= $current_chair .','. $i?>)" width="15" height="75">
                <?php } else { ?>
                    <img src="../assets/chairs/temp_reserved_chair.png" alt="niet gereserveerd" class="col mt-3 p-1 no-pointer" width="15" height="75">
                <?php }
                 }
                }
            
            //
            } else if($current_chair == 11 && $i <= 9 || $current_chair == 12 && $i == 10) { 
                    
                    if(!isset($chair_reserved[$i][$current_chair])) { ?>
                        <img src="../assets/chairs/non_reserved_chair.png" alt="niet gereserveerd" class="col mt-3 p-1 pointer" onclick="add_chair(<?= $current_chair .','. $i?>)" width="15" height="75">

            <?php } else if(isset($chair_reserved[$i][$current_chair]) && $chair_reserved[$i][$current_chair] == true) {
                    
                    if(in_array($click_check, $selected_chair)) { ?>
                        <img src="../assets/chairs/temp_reserved_chair.png" alt="niet gereserveerd" class="col mt-3 p-1 pointer" onclick="remove_chair(<?= $current_chair .','. $i?>)" width="15" height="75">
            <?php } else { ?>
                        <img src="../assets/chairs/temp_reserved_chair.png" alt="niet gereserveerd" class="col mt-3 p-1 no-pointer" width="15" height="75">
            <?php }
            } 
                    if($i <= 9) { ?>
                        <div class="col p-1"></div>
            <?php  }
                    ?>
                
                </div>
            <?php }


        };

        $current_chair = 0;

    };
    
    ?>
        
        
    </div>
   
</body>
</html>
