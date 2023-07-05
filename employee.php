<?php
class Employee{
// Connection
private $conn;
// Table
private $db_table = "pelanggan";
// Columns
public $id;
public $nama;
public $tipe_laptop;
public $pw_laptop;
public $no_hp;
public $kerusakan;
public $created;
// Db connection
public function __construct($db){
$this->conn = $db;
}
// GET ALL
public function getEmployee(){
$sqlQuery = "SELECT id, nama, tipe_laptop, pw_laptop, no_hp, kerusakan, created FROM "
. $this->db_table . "";
$stmt = $this->conn->prepare($sqlQuery);
$stmt->execute();
return $stmt;
}
// CREATE
public function createEmployee(){
$sqlQuery = "INSERT INTO
". $this->db_table ."
SET
nama = :nama, 
tipe_laptop = :tipe_laptop, 
pw_laptop = :pw_laptop, 
no_hp = :no_hp, 
kerusakan = :kerusakan, 
created = :created";
$stmt = $this->conn->prepare($sqlQuery);
// sanitize
$this->nama=htmlspecialchars(strip_tags($this->nama));
$this->tipe_laptop=htmlspecialchars(strip_tags($this->tipe_laptop));
$this->pw_laptop=htmlspecialchars(strip_tags($this->pw_laptop));
$this->no_hp=htmlspecialchars(strip_tags($this->no_hp));
$this->kerusakan=htmlspecialchars(strip_tags($this->kerusakan));
$this->created=htmlspecialchars(strip_tags($this->created));
// bind data
$stmt->bindParam(":nama", $this->nama);
$stmt->bindParam(":tipe_laptop", $this->tipe_laptop);
$stmt->bindParam(":pw_laptop", $this->pw_laptop);
$stmt->bindParam(":no_hp", $this->no_hp);
$stmt->bindParam(":kerusakan", $this->kerusakan);
$stmt->bindParam(":created", $this->created);
if($stmt->execute()){
    return true;
}
return false;
}
// READ single
public function getSingleEmployee(){
$sqlQuery = "SELECT
id, 
nama, 
tipe_laptop, 
pw_laptop, 
no_hp, 
kerusakan,
created
FROM
". $this->db_table ."
WHERE 
id = ?
LIMIT 0,1";
$stmt = $this->conn->prepare($sqlQuery);
$stmt->bindParam(1, $this->id);
$stmt->execute();
$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
$this->nama = $dataRow['nama'];
$this->tipe_laptop = $dataRow['tipe_laptop'];
$this->pw_laptop = $dataRow['pw_laptop'];
$this->no_hp = $dataRow['no_hp'];
$this->kerusakan = $dataRow['kerusakan'];
$this->created = $dataRow['created'];
} 
// UPDATE
public function updateEmployee(){
$sqlQuery = "UPDATE
". $this->db_table ."
SET
nama = :nama, 
tipe_laptop = :tipe_laptop, 
pw_laptop = :pw_laptop, 
no_hp = :no_hp,
kerusakan = :kerusakan, 
created = :created
WHERE 
id = :id";
$stmt = $this->conn->prepare($sqlQuery);
$this->nama=htmlspecialchars(strip_tags($this->nama));
$this->tipe_laptop=htmlspecialchars(strip_tags($this->tipe_laptop));
$this->pw_laptop=htmlspecialchars(strip_tags($this->pw_laptop));
$this->no_hp=htmlspecialchars(strip_tags($this->no_hp));
$this->kerusakan=htmlspecialchars(strip_tags($this->kerusakan));
$this->created=htmlspecialchars(strip_tags($this->created));
$this->id=htmlspecialchars(strip_tags($this->id));
// bind data
$stmt->bindParam(":nama", $this->nama);
$stmt->bindParam(":tipe_laptop", $this->tipe_laptop);
$stmt->bindParam(":pw_laptop", $this->pw_laptop);
$stmt->bindParam(":no_hp", $this->no_hp);
$stmt->bindParam(":kerusakan", $this->kerusakan);
$stmt->bindParam(":created", $this->created);
$stmt->bindParam(":id", $this->id);
$stmt->errorInfo();
if($stmt->execute()){
return true;
}
return false;
}

// DELETE
function deleteEmployee(){
$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
$stmt = $this->conn->prepare($sqlQuery);
$this->id=htmlspecialchars(strip_tags($this->id));
$stmt->bindParam(1, $this->id);
if($stmt->execute()){
return true;
}
return false;
}
}
?>