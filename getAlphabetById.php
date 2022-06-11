<?php
    require_once "connection.php";
    
    header("Content-Type: application/json");

    $method = $_SERVER['REQUEST_METHOD'];

    $result = array();

    if($method == 'GET'){
        if(isset($_GET['id_alphabet'])){
            $id = $_GET['id_alphabet'];

            $result['status'] = [
                "code" => 200,
                'message' => 'Success'
            ];

            $sql = "SELECT * FROM databisindo WHERE id_alphabet='$id'";

            $result_query = $connect -> query($sql);

            $result['data'] = $result_query ->fetch_all(MYSQLI_ASSOC);
        } else {
            $result['status'] = [
            "code" => 400,
            'message' => 'Failed'];
        }
    } else { 
        $result['status'] = [
            "code" => 403,
            'message' => 'Wrong parameter'
        ];
    }

    echo json_encode($result)

?>