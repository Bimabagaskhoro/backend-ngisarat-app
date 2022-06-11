<?php
    require_once "connection.php";

    header("Content-Type: application/json");

    $method = $_SERVER['REQUEST_METHOD'];

    $result = array();

    if($method == 'POST'){
        if(isset($_POST['tittle_alphabet'])) {

            $tittle_alphabet = $_POST['tittle_alphabet'];

            $image_tmp = $_FILES['image_alphabet']['tmp_name'];
            $image_name = $_FILES['image_alphabet']['name'];
            move_uploaded_file($image_tmp, 'image_alphabet/'.$image_name);

            $result['status'] = [
                "status" => 200,
                'message' => 'Success insert'
            ];

            $sql = "INSERT INTO databisindo (tittle_alphabet, image_alphabet) 
            VALUES ('$tittle_alphabet', '$image_name')" ;

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