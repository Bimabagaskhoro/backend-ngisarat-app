<?php
    require_once "connection.php";

    header("Content-Type: application/json");

    $method = $_SERVER['REQUEST_METHOD'];

    $result = array();

    if($method == 'GET'){
        $result['status'] = [
            "code" => 200,
            'message' => 'Success'
        ];

        $sql = "SELECT * FROM databisindo";

        $result_query = $connect -> query($sql);

        $result['data'] = $result_query ->fetch_all(MYSQLI_ASSOC);


    } else { 
        $result['status'] = [
            "code" => 400,
            'message' => 'Failed'
        ];
    }

    echo json_encode($result)

?>