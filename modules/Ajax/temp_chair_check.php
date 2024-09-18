<?php
    session_start();

    include "../core/db_connect.php";

    $chair_reserved = [];
    $delete_chair = [];

    $already_reserved = false;

    // Check for already reserved chairs
    $sqli_prepare = $con->prepare("SELECT id, chair_number, chair_row, date_chair_reserved FROM temporary_reserved_chairs");
    $sqli_prepare->execute();
    $result = $sqli_prepare->get_result();
    $sqli_prepare->close();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];

            $current_time = date("Y-m-d H:i:s");
            
            $start_date[$id] = new DateTime($row['date_chair_reserved']);
            $since_start = $start_date[$id]->diff(new DateTime($current_time));


            if($since_start->h >= 1 || $since_start->i >= 10){
                unset($_SESSION['temp_reserved_chair'][$id]);
                $delete_chair[] = $id;
            } else {
                $chair_reserved[$id] = [
                    "row" => $row['chair_row'],
                    "num" => $row['chair_number']
                ];
            }
        }
    }

    // Delete the reserved chairs if needed
    foreach ($delete_chair as $chair) {
        $sqli_prepare = $con->prepare("DELETE FROM temporary_reserved_chairs WHERE id = ?");
        $sqli_prepare->bind_param('i', $chair);
        $sqli_prepare->execute();
        $sqli_prepare->close();
    }

    // Output the result
    $data = [
        "chairs" => $chair_reserved
    ];

    echo json_encode($data);
?>