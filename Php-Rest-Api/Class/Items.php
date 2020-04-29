<?php
class Items{
	// database connection and table name
    private $conn;
    private $table_name = "php_rest.items";
  
    // object properties
    public $id;
    public $name;
    public $age;
    public $department;
    public $subject;
   
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

function create(){
		
	// query to insert record
  	$stmt = $this->conn->prepare("
		INSERT INTO ".$this->php_rest.items."(`id`, `name`, `age`, `department`, `subject`)
		VALUES(?,?,?,?,?)");
  
    // prepare query
    	//sanitize
	$this->id = htmlspecialchars(strip_tags($this->id));
	$this->name = htmlspecialchars(strip_tags($this->name));
	$this->age = htmlspecialchars(strip_tags($this->age));
	$this->department = htmlspecialchars(strip_tags($this->department));
	$this->subject = htmlspecialchars(strip_tags($this->subject));
	
		//bind values
	$stmt->bind_param("ssiis", $this->id, $this->name, $this->age, $this->department, $this->subject);

	
	//execute query
	if($stmt->execute()){
		return true;
	}
 
	return false;		 
}

function read(){	
	if($this->id) {
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->php_rest.items." WHERE id = ?");
		$stmt->bind_param("i", $this->id);			} else {
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->php_rest.items);		
	}		
	$stmt->execute();			
	$result = $stmt->get_result();		
	return $result;		
}

function update(){
	 
	$stmt = $this->conn->prepare("
		UPDATE ".$this->php_rest.items." 
		SET name= ?, age = ?, department = ?, subject = ?
		WHERE id = ?");
 
	$this->id = htmlspecialchars(strip_tags($this->id));
	$this->name = htmlspecialchars(strip_tags($this->name));
	$this->age = htmlspecialchars(strip_tags($this->age));
	$this->department = htmlspecialchars(strip_tags($this->department));
	$this->subject = htmlspecialchars(strip_tags($this->subject));
	
 
	$stmt->bind_param("ssiis", $this->name, $this->age,
		 $this->department, $this->subject, $this->id);
	
	if($stmt->execute()){
		return true;
	}
 
	return false;
}

function delete(){
		
	$stmt = $this->conn->prepare("
		DELETE FROM ".$this->php_rest.items." 
		WHERE id = ?");
		
	$this->id = htmlspecialchars(strip_tags($this->id));
 
	$stmt->bind_param("i", $this->id);
 
	if($stmt->execute()){
		return true;
	}
 
	return false;		 
}
}
?>


