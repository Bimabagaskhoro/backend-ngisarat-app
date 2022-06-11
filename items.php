<?php

require_once "connection.php";

if (function_exists($_GET['function'])) {
    $_GET['function']();
} else {
    $response['status'] = 403;
    $response['message'] = "Url tidak ditemukan!"; 
    echo json_encode($response);
}

// CRUD Items
function insertItems(){
    global $connect;   

    $check = array(
        'tittle_alphabet' => '', 
        'description_alphabet' => '',
        'image_alphabet' => '');

    $check_match = count(array_intersect_key($_POST, $check));
    
    if($check_match == count($check)){
        $query = mysqli_query($connect, "INSERT INTO databisindo SET
            tittle_alphabet = '$_POST[tittle_alphabet]',
            description_alphabet = '$_POST[description_alphabet]',
            image_alphabet = '$_POST[image_alphabet]'");

        if($query){
            $response=array(
                'status' => 200,
                'message' =>'Insert Success'
            );
        } else {
            $response=array(
                'status' => 404,
                'message' =>'Insert Failed.'
            );
        }
    } else{
            $response=array(
                'status' => 400,
                'message' =>'Wrong Parameter'
            );
        }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function getAllItems(){
    global $connect;
    $query = $connect -> query("SELECT * FROM databisindo");
    while($row=mysqli_fetch_object($query))
    {
        $data[] =$row;
    }
    if (empty($data)) {
        $response=array(
        'status' => 201,
        'message' =>'Data Not Found',
        'data' => []);
    } else {
        $response=array(
        'status' => 200,
        'message' =>'Success',
        'data' => $data);
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
}

function getItemsById(){
    global $connect;
    if (!empty($_GET["id_alphabet"])) {
        $id_alphabet = $_GET["id_alphabet"];      
    } 

    $query ="SELECT * FROM databisindo WHERE id_alphabet= $id_alphabet";      
    $result = $connect->query($query);
    while($row = mysqli_fetch_object($result)){
        $data[] = $row;
    } 
    if($data){
        $response = array(
            'status' => 200,
            'message' =>'Success',
            'data' => $data);               
    } else {
        $response=array(
            'status' => 201,
            'message' =>'Data Not Found');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function updateItems(){
    global $connect;
    if (!empty($_GET["id_alphabet"])) {
        $id_alphabet = $_GET["id_alphabet"];      
    } 

    $check = array(
        'tittle_alphabet' => '', 
        'description_alphabet' => '',
        'image_alphabet' => '');
    
    $check_match = count(array_intersect_key($_POST, $check));
    if($check_match == count($check)){
        $query = mysqli_query($connect, "UPDATE databisindo SET
            tittle_alphabet = '$_POST[tittle_alphabet]',
            description_alphabet = '$_POST[description_alphabet]',
            image_alphabet = '$_POST[image_alphabet]'
        WHERE id_alphabet = $id_alphabet");

        if($query){
            $response=array(
                'status' => 200,
                'message' =>'Update Success'
            );
        } else {
            $response=array(
                'status' => 404,
                'message' =>'Update Failed.'
            );
        }
    } else{
            $response=array(
                'status' => 400,
                'message' =>'Wrong Parameter'
            );
        }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function deletedItems(){
    global $connect;
    if (!empty($_GET["id_alphabet"])) {
        $id_alphabet = $_GET["id_alphabet"];      
    } 

    $query = "DELETE FROM databisindo WHERE id_alphabet=".$id_alphabet;
    if(mysqli_query($connect, $query)){
        $response=array(
            'status' => 200,
            'message' =>'Delete Success');
    } else { 
        $response=array(
            'status' => 404,
            'message' =>'Delete Failed');
    }
    header('Content-Type: application/json');
    echo json_encode($response); 
}

function uploadImage() {
    global $connect;

    $image = $_FILES['file']['tmp_name'];
    $imageName = $_FILES['file']['name'];
    $file_path = "imageitems";

    $response = array();

    if (!file_exists($filePath)) {
        mkdir($filePath, 0777, true);
    }

    if (!$image) {
        $response["status"] = 400;
        $response["message"] = "Gambar tidak ditemukan";
    } else {
        if (move_uploaded_file($image, $filePath.'/'.$imageName)) {
            $response["status"] = 200;
            $response["message"] = "Sukses upload gambar";
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
