<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/config.php';
	/**
	 * Database Class
	 */
	class Database
	{
		private $host = DB_HOST;
		private $user = DB_USER;
		private $name = DB_NAME;
		private $pass = DB_PASS;
		public $link;
		public $error;

		function __construct()
		{
			$this->connectDB();
		}
		public function connectDB()
		{
			$this->link = new mysqli($this->host, $this->user, $this->pass, $this->name);
			if (!$this->link) {
				$this->error = "Connection Failed".$this->link->connect_error;
				return false;
			}

		}

		// Select or Read Data
		public function select($query)
		{
			$stmt = $this->link->query($query) or die( $this->link->error.__LINE__ );
			if ($stmt->num_rows > 0) {
				return $stmt;
			}else{
				return false;
			}
		}

		//Insert Function
		public function insert($query)
		{
			$inserted_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if ($inserted_row) {
				header("Location:index.php?msg=".urlencode("Data Inserted Successfylly"));
				exit();
			}else{
				die("Error:(".$this->link->errno.")".$this->link->error);
			}
		}

		//Update Function
		public function update($query)
		{
			$updated_row= $this->link->query($query) or die($this->link->error.__LINE__);
			if ($updated_row) {
				header("Location:index.php?msg=".urlencode("Data Updated Successfully"));
				exit();
			}else{
				die("Error:(".$this->link->errno.")".$this->link->error);
			}
		}
	}