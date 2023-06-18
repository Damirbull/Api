<?php
function getPosts($connect) {
    $posts = mysqli_query($connect, 'SELECT * FROM `auto`');
    $postsList = [];

    while ($post = mysqli_fetch_assoc($posts)) {
        $postsList[] = $post;
    }

    echo json_encode($postsList);
}

function getMen($connect) {
    $men = mysqli_query($connect, 'SELECT * FROM `Men`');
    $menList = [];

    while ($man = mysqli_fetch_assoc($men)) {
        $menList[] = $man;
    }

    return $menList;
}

function getPost($connect, $id) {
    $post = mysqli_query($connect, "SELECT * FROM `auto` WHERE `id` = '$id'");
    $post = mysqli_fetch_assoc($post);
    echo json_encode($post);
}

function getMenPost($connect, $id) {
    $menPost = mysqli_query($connect, "SELECT * FROM `Men` WHERE `id` = '$id'");
    $menPost = mysqli_fetch_assoc($menPost);
    echo json_encode($menPost);
}


function addPost($connect, $data) {
    $brand = $data['brand'];
    $model = $data['model'];
    $bodycolor = $data['bodycolor'];
    $StatenumberoftheRussianFederation = $data ['StatenumberoftheRussianFederation'];
    $Status = $data ['Status'];
    mysqli_query($connect, "INSERT INTO `auto` (`id`, `brand`, `model`, `bodycolor`, `StatenumberoftheRussianFederation`, `Status`) VALUES (NULL, '$brand', '$model', '$bodycolor', '$StatenumberoftheRussianFederation', '$Status')");
    http_response_code(201);
    
    $res = [
        'state' => true,
        'post_id' => mysqli_insert_id($connect)
    ];
    
        echo json_encode($res);
}

if ($method === 'GET') {
    if ($type === 'posts') {
        if (isset($id)) {
            getPost($connect, $id);
        } else {
            getPosts($connect);
        }
    }
} elseif ($method === 'POST') {
    if ($type === 'posts') {
        addPost($connect, $_POST);
    }
}

function apdatePost($connect, $id, $data) {
    $brand = $data['brand'];
    $model = $data['model'];
    $bodycolor = $data['bodycolor'];
    $StatenumberoftheRussianFederation = $data ['StatenumberoftheRussianFederation'];
    $Status = $data ['Status'];
    mysqli_query($connect, "UPDATE `auto` SET `brand` = '$brand', `model` = '$model', `bodycolor` = '$bodycolor', `StatenumberoftheRussianFederation` = '$StatenumberoftheRussianFederation', `Status` = '$Status' WHERE `auto`.`id` = '$id'");
    http_response_code(200);
    
    $res = [
        'state' => true,
        'message' => "Post Good"
    ];
    
        echo json_encode($res);
}


function deletePost($connect, $id) {
    mysqli_query($connect, "DELETE FROM auto WHERE `auto`.`id` = '$id'");
    http_response_code(200);
    
        
    $res = [
        'state' => true,
        'message' => "Post delete"
    ];
    
        echo json_encode($res);
}