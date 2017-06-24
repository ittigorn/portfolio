<?php

class mysql_db extends mysqli {



	function __construct() {

		parent::__construct(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

		if (mysqli_connect_error()) {
            die('Connect Error [ ' . mysqli_connect_errno() . ' ] ' . mysqli_connect_error());
        }// end if

        // Making sure it's compatible with Thai language too
        $this->set_charset('utf8mb4');

	}// end construct function

	///////////////////////// QUERYING ///////////////////////////
	private function check_query($result){
		if(!$result){
			die('Database Query failed! [ '. mysqli_error($this) .' ]');
		}// end if
	}// end function

	
	public function query_and_check($query){
		$result = $this->query($query);
		$this->check_query($result);
		return $result;
	}// end function


	//////////////////////// FETCHING //////////////////////////
	public function fetch_single_entry($fetch_table, $fetch_column) {

		$result = $this->query_and_check("SELECT `{$fetch_column}` FROM `{$fetch_table}`;");
		return mysqli_fetch_array($result)[0];

	}// end function

	// This function already returns string or int, no need to parse an array after the returned value
	public function fetch_single_entry_where($fetch_table, $fetch_column, $eval_column, $eval_value, $eval_operator = "=", $return_as_object = FALSE) {

		if ($fetch_column !== "*") { $fetch_column = '`' . $fetch_column . '`'; }

		$result = $this->query_and_check("SELECT {$fetch_column} FROM `{$fetch_table}` WHERE `{$eval_column}` {$eval_operator} '{$eval_value}' LIMIT 1;");
		
		if ($return_as_object) { return mysqli_fetch_object($result); }
		else { return mysqli_fetch_array($result)[0]; }

	}// end function


	public function fetch_rows_where($fetch_table, $fetch_column, $eval_column, $eval_value, $eval_operator = "=", $return_as_object_array = FALSE) {

		$result_array = array();
		if ($fetch_column !== "*") { $fetch_column = '`' . $fetch_column . '`'; }
		if (!is_numeric($eval_value)) { $eval_value = "'" . $eval_value . "'"; }

		$result = $this->query_and_check("SELECT {$fetch_column} FROM `{$fetch_table}` WHERE `{$eval_column}` {$eval_operator} {$eval_value};");

		if ($return_as_object_array) {
			while ($current_row = mysqli_fetch_object($result)) {
				array_push($result_array, $current_row);
			} // end while
		}
		else {
			while ($current_row = mysqli_fetch_assoc($result)) {
				array_push($result_array, $current_row);
			} // end while
		}

		return $result_array;

	}// end function


	public function fetch_all_rows($fetch_table, $fetch_column, $return_as_object_array = FALSE) {

		$result_array = array();
		if ($fetch_column !== "*") { $fetch_column = '`' . $fetch_column . '`'; }

		$result = $this->query_and_check("SELECT {$fetch_column} FROM `{$fetch_table}`;");

		if ($return_as_object_array) {
			while ($current_row = mysqli_fetch_object($result)) {
				array_push($result_array, $current_row);
			} // end while
		}
		else {
			while ($current_row = mysqli_fetch_assoc($result)) {
				array_push($result_array, $current_row);
			} // end while
		}

		return $result_array;

	}// end function


	public function fetch_single_row_table($table_name){

		if ($this->check_table_exists($table_name)) {
			$result = $this->query_and_check("SELECT * FROM {$table_name};");
			return mysqli_fetch_object($result);
		}
		else {
			return NULL;
		}

	}// end function


	public function fetch_single_row_where($fetch_table, $eval_column, $eval_value, $eval_operator = "=") {
		$result = $this->query_and_check("SELECT * FROM `{$fetch_table}` WHERE `{$eval_column}` {$eval_operator} '{$eval_value}' LIMIT 1;");
		return mysqli_fetch_object($result);
	}// end function


	public function fetch_auto_increment_value($table_name){
		$query  		 = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES ";
		$query 			.= "WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME = '{$table_name}';";
		$result   		 = $this->query_and_check($query);
		return mysqli_fetch_object($result)->AUTO_INCREMENT;
	}// end function


	//////////////////////// UPDATING /////////////////////////
	public function update_where($table,$set,$where_column,$where_value) {
		$query 	= 	'UPDATE `' . $table . '` SET ' . $set;
		$query .= 	' WHERE `' . $where_column . '` = "' . $where_value . '";';
		$result = $this->query_and_check($query);
		return $result;
	} // end function


	private function reset_auto_increment($table_name) {
		$query = "ALTER TABLE '{$table_name}' AUTO_INCREMENT = 1;";
		$this->query_and_check($query);
	}// end function


	public function check_table_exists($table_name){

		$query  = "SELECT COUNT(*) as table_number ";
		$query .= "FROM information_schema.tables ";
		$query .= "WHERE table_schema = '".DB_NAME."' ";
		$query .= "AND table_name = '{$table_name}';";

		$result = $this->query_and_check($query);
		$result = mysqli_fetch_object($result);

		if ($result->table_number != 0){return true;}
		else {return false;}

	}// end function


	//////////////////////// CLEAN INPUT ///////////////////////////
	public function clean_input($input) {

		$input = trim($input);
		//$input = stripslashes($input);
		//$input = htmlspecialchars($input);
		$input = mysqli_real_escape_string($this, $input);

		return $input;

	}// end function


	public function clean_array($input_array){

		$cleaned_array = array();

		foreach ($input_array as $master_key => $master_value) {
			if (!is_array($master_value)) { $input_array[$master_key] = $this->clean_input($master_value); }
			else {
				foreach ($master_value as $key => $value) {
					if (!is_array($value)) { $master_value[$key] = $this->clean_input($value); }
					else { echo "Warning!: Too many nested arrays for clean_array() function in mysql_db"; }
				}
			}
		}

		return $input_array;

	}// end function
	

	// this function takes string and return cleaned string
	function clean_comma_deliminated_string($string) {

		$string		= explode(',', $string);
					  array_unique($string);
		$string 	= array_map('trim',$string);
		$string 	= array_filter($string);
		$string 	= implode(",", $string);
		$string		= mysqli_real_escape_string($this, $string);

		return $string;

	} // end function


	///////////////////////// ENCRYPTING /////////////////////////
	public function hash($password) {
		$hash = password_hash($password, PASSWORD_BCRYPT);
		return mysqli_real_escape_string($this, $hash);
	}// end function



}// end class mysql_db

?>