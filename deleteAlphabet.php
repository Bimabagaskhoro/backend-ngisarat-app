<?php
    require_once "connection.php";
    
    header("Content-Type: application/json");

    $method = $_SERVER['REQUEST_METHOD'];

    $result = array();

    if($method == 'DELETE'){
        parse_str(file_get_contents("php://input"), $_DELETE);
        if(isset($_DELETE['id_alphabet'])) {

            $id_alphabet = $_DELETE['id_alphabet'];    

            $result['status'] = [
                "code" => 200,
                'message' => 'Success deleted'
            ];

            $sql = "DELETE FROM databisindo WHERE id_alphabet='$id_alphabet'" ;

            $connect -> query($sql);

            $result['data'] = [
                "id" => $id_alphabet
            ];
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