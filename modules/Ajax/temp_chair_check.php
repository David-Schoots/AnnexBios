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