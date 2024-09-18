<?php
    session_start();
    include "../core/db_connect.php";

    $chair_num = (int)$_GET['chair_num'];
    $chair_row = (int)$_GET['chair_row'];
    $type_ticket = $_GET['type_ticket'];

    // Prevent duplicate reservations with a unique constraint in the database
    $sqli_prepare = $con->prepare("INSERT INTO `temporary_reserved_chairs` (chair_number, chair_row, type) VALUES (?, ?, ?);");
    $sqli_prepare->bind_param('iis', $chair_num, $chair_row, $type_ticket);

    if (!$sqli_prepare->execute()) {
        echo json_encode(["error" => true, "message" => "Chair already reserved"]);
    } else {
        $last_inserted_id = $sqli_prepare->insert_id;

        $_SESSION['temp_reserved_chair'][$last_inserted_id] = [
            'num' => $chair_num,
            'row' => $chair_row,
            'type' => $type_ticket
        ];

       
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

        echo json_encode([
            "error" => false,
            "reserved" => true,
            "amountOfType" => $amountOfType,
            "amountTotalPrice" => $totalPrijs

        ]);
    }

    $sqli_prepare->close();
    $con->close();
?>