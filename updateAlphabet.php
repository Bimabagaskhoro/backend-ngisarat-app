<?php
    require_once "connection.php";
    
    header("Content-Type: application/json");

    $method = $_SERVER['REQUEST_METHOD'];

    $result = array();

    if($method == 'PUT'){
        parse_str(file_get_contents("php://input"), $_PUT);
        if(isset($_PUT['id_alphabet']) AND isset($_PUT['tittle_alphabet'])) {

            $id_alphabet = $_PUT['id_alphabet'];    
            $tittle_alphabet = $_PUT['tittle_alphabet'];

            $image_tmp = $_FILES['image_alphabet']['tmp_name'];
            $image_name = $_FILES['image_alphabet']['name'];
            move_uploaded_file($image_tmp, 'image_alphabet/'.$image_name);

            $result['status'] = [
                "status" => 200,
                'message' => 'Success updated'
            ];

            $sql = "UPDATE databisindo SET tittle_alphabet='$tittle_alphabet', 
            image_alphabet='$image_name'
            WHERE id_alphabet='$id_alphabet'" ;

            $connect -> query($sql);

            $result['data'] = [
                "tittle" => $tittle_alphabet,
                "image" => $image_name
            ];
        } else {
            $result['status'] = [
            "status" => 400,
            'message' => 'Failed'];
        }
    } else { 
        $result['status'] = [
            "status" => 403,
            'message' => 'Wrong parameter'
        ];
    }

    echo json_encode($result)
?>