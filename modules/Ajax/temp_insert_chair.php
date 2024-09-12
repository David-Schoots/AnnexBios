<?php
    session_start();
?>

<?php
    include "../core/db_connect.php";

    $total_rows = 10;
    $total_chairs = 111;
    $current_chair = 0;
    $chair_reserved = [];
    $delete_chair = [];
    $selected_chair = array();

    $chair_num = $_GET['chair_num'];
    $row_chair = $_GET['chair_row'];
    $already_reserved = false;


    
    $sqli_prepare = $con->prepare("INSERT INTO `temporary_reserved_chairs` (chair_number, chair_row) VALUES (?,?);");
    $sqli_prepare->bind_param('dd', $chair_num, $row_chair);
    
    if($sqli_prepare === false) {
        echo mysqli_error($con); 
    } else{
        if($sqli_prepare->execute()) {
             
            } 

        }
    
    $sqli_prepare->close();

    $double_reserved_check = mysqli_insert_id($con);

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

                if($chair_number == $_GET['chair_num'] && $chair_row == $_GET['chair_row'] && $id !== $double_reserved_check) {
                    $delete_chair[] = $double_reserved_check;
                    $already_reserved = true; 
                }

                if($since_start->h >= 1 || $since_start->i >= 2){
                    if(!in_array($id, $delete_chair)) {
                        $delete_chair[] = $id;
                    }
                } else if(!in_array($id, $delete_chair)) {
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
       
        if($already_reserved == false) {
            if(!isset($_SESSION['temp_reserved_chair'][$double_reserved_check]['number'])) {
                $_SESSION['temp_reserved_chair'][$double_reserved_check]['number'] = $_GET['chair_num'];
                $_SESSION['temp_reserved_chair'][$double_reserved_check]['row'] = $_GET['chair_row'];
                
            }
        
            foreach ($_SESSION['temp_reserved_chair'] as $key => $value) {
                    $temp_chair = $value['number'] . $value['row'];
                    array_push($selected_chair, $temp_chair);
            }
        } 
        if($already_reserved == true) {?>
        <div id="message_chair_res" style="display: flex;" class="position-absolute vw-100 vh-100 p-0 m-0 justify-content-center align-items-center z-1">
            <div class="card w-25 m-0 p-0">
                <div class="card-body p-2 d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title mt-3 w-100 text-center">--Oeps er is een klein probleem--</h5>
                    <p class="card-text w-100 mt-3 text-center">Helaas heeft iemand anders de door u gekozen stoel al geselecteerd, ons excuses daarvoor.</p>
                    <button class="btn btn-primary w-25" onclick="exit_message()">X</button>
                </div>
            </div>
        </div>

        <?php }


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