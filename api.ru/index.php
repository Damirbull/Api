<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

require 'connect.php';
require 'functions.php';

$method = $_SERVER['REQUEST_METHOD'];

$type = $_GET['q'];
$params = explode('/', $type);

$type = $params[0];
$id = $params[1];

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
} elseif ($method === 'PATCH') {
    if ($type === 'posts') {
        if (isset($id)) {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            apdatePost($connect, $id, $data);
        } else {
            addPost($connect, $_POST);
        }
    }
} elseif($method === 'DELETE') {
        if ($type === 'posts') {
        if (isset($id)) {
            deletePost($connect, $id);
        } else {
            addPost($connect, $_POST);
        }
    }
}
