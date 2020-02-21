<?php
	class Contact{
		private $conn;
		private $table_name="person";

		public $id;
		public $first_name;
		public $surnames;
        public $phones;
        public $emails;

		public function __construct($db){
        	$this->conn = $db;
    	}

    	function read(){
            $query = "SELECT
                p.id,p.first_name,p.surnames,tp.phone,e.email
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    phone tp
                        ON p.id = tp.person_id
                LEFT JOIN
                    email e
                        ON p.id = e.person_id"; 

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }


        function create(){
            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                    first_name=:first_name, surnames=:surnames";
         
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));
            $this->surnames=htmlspecialchars(strip_tags($this->surnames));
            $stmt->bindParam(":first_name", $this->first_name);
            $stmt->bindParam(":surnames", $this->surnames);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        // update the product
        function update(){
            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        first_name = :first_name,
                        surnames = :surnames
                    WHERE
                        id = :id";
         
            // prepare query statement
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));
            $this->surnames=htmlspecialchars(strip_tags($this->surnames));
            $this->id=htmlspecialchars(strip_tags($this->id));
         
            // bind new values
            $stmt->bindParam(':first_name', $this->first_name);
            $stmt->bindParam(':surnames', $this->surnames);
            $stmt->bindParam(':id', $this->id);
         
            // execute the query
            if($stmt->execute()){
                return true;
            }
         
            return false;
        }

        function updateEmail(){
            $query = "UPDATE
                       email
                    SET
                        email = :email
                    WHERE
                        id = :id";
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->id=htmlspecialchars(strip_tags($this->id));
         
            // bind new values
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':id', $this->id);
         
            // execute the query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function updatePhone(){
            $query = "UPDATE
                       phone
                    SET
                        phone = :phone
                    WHERE
                        id = :id";
         
            // prepare query statement
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->id=htmlspecialchars(strip_tags($this->id));
         
            // bind new values
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':id', $this->id);
            
            // execute the query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function addEmail(){
            $query = "INSERT INTO
                Email
                    SET
                email=:email, person_id=:person_id";
            $stmt = $this->conn->prepare($query);
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->person_id=htmlspecialchars(strip_tags($this->person_id));

            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':person_id', $this->person_id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function addPhone(){
            $query = "INSERT INTO
                phone
                    SET
                phone=:phone, person_id=:person_id";
            $stmt = $this->conn->prepare($query);
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->person_id=htmlspecialchars(strip_tags($this->person_id));

            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':person_id', $this->person_id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function delete(){
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $this->id=htmlspecialchars(strip_tags($this->id));       
            $stmt->bindParam(1, $this->id);
         
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>