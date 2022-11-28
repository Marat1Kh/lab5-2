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
		$product->id = isset($data->id) ? $data->id : NULL;
		$product->name = $data->name;
		$product->price = $data->price;
		$product->description = $data->description;
		if(! is_null($product->id)) {
			if($product->putData()) {
			echo json_encode(array('message' => 'Product updated'));
			} else {
			echo json_encode(array('message' => 'Product Not updated, try again!'));
			}
		} else {
		echo json_encode(array('message' => "Error: Product ID is missing!"));
		}
	} else {
		echo json_encode(array('message' => "Error: incorrect Method!"));
	}