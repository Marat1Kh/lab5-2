<?php
class Products {
    private $conn;
    public $id;
    public $name;
    public $price;
    public $description;

    public function __construct($db){
        $this->conn = $db;
    }

    public function fetchAll() {
        $stmt = $this->conn->prepare('SELECT * FROM productss');
        $stmt->execute();
        return $stmt;
    }
    public function fetchOne() {
        $stmt = $this->conn->prepare('SELECT  * FROM productss WHERE id = ?');
        $stmt->bindParam(1, $this->id);
        $stmt->execute();        

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->price = $row['price'];
            $this->description = $row['description'];
            return TRUE;
        }
        return FALSE;
    }
    public function postData() {
        $stmt = $this->conn->prepare('INSERT INTO productss SET name = :name, price = :price, description = :description');

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);

        if($stmt->execute()) {
            return TRUE;
        }
        return FALSE;
    }
    public function putData() {
        $stmt = $this->conn->prepare('UPDATE productss SET name = :name, price = :price, description = :description WHERE id = :id');
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }
    public function delete() {
        $stmt = $this->conn->prepare('DELETE FROM productss WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }


}