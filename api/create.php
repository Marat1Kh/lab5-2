<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../config/Database.php';
    include_once '../models/Product.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $db = new Database();
      $db = $db->connect();

      $product = new Products($db);

      $data = json_decode(file_get_contents("php://input"));

      $product->name = $data->name;
      $product->price = $data->price;
      $product->description = $data->description;
    
      if($product->postData()) {
        echo json_encode(array('message' => 'Product added'));
      } else {
        echo json_encode(array('message' => 'Product Not added, try again!'));
      }
    } else {
        echo json_encode(array('message' => "Error: incorrect Method!"));
    }