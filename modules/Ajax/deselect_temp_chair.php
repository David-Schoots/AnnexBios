<?php
    session_start();
    include "../core/db_connect.php";

    $chair_num = (int)$_GET['chair_num'];
    $chair_row = (int)$_GET['chair_row'];
    $type_ticket = $_GET['type_ticket'];

    // Remove the chair from temporary_reserved_chairs table
    $sqli_prepare = $con->prepare("DELETE FROM `temporary_reserved_chairs` WHERE chair_number = ? AND chair_row = ? LIMIT 1");
    $sqli_prepare->bind_param('ii', $chair_num, $chair_row);

    if (!$sqli_prepare->execute()) {
        echo json_encode(["error" => true, "message" => "Failed to remove chair"]);
    } else {
        // Also remove it from the session if it exists
        foreach ($_SESSION['temp_reserved_chair'] as $key => $value) {
            if ($value['num'] == $chair_num && $value['row'] == $chair_row) {
                unset($_SESSION['temp_reserved_chair'][$key]);
                break;
            }
        }

        $amountOfType = 0;
        $totalPrijs = 0;
        foreach ($_SESSION['temp_reserved_chair'] as $chair) {
            if ($chair['type'] == $type_ticket) {
                $amountOfType++;
            }
            if($chair['type'] == "normal") {
                $totalPrijs += 9;
            } else if($chair['type'] == "child") {
                $totalPrijs += 5;
            } else if($chair['type'] == "older") {
                $totalPrijs += 7;
            }
        }

        $data = [
            "error" => false,
            "reserved" => false,
            "amountOfType" => $amountOfType,
            "amountTotalPrice" => $totalPrijs
            
        ];

        echo json_encode($data);
    }

    $sqli_prepare->close();
    $con->close();
?>