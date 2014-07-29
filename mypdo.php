<?php
//
// Custom PDO class
//
class MyPDO extends PDO{


    public function query($query){ //secured query with prepare and execute
        $args = func_get_args();
        array_shift($args); //first element is not an argument but the query itself, should removed

        $reponse = parent::prepare($query);
        $reponse->execute($args);
        return $reponse;

    }

	public function error() {
		$array = parent::errorInfo();
		return $array[2];
	}

	public function update($table,$data,$where) {
	
		$args = array();
		
		$query = "UPDATE `$table` SET ";
		$con = '';
		foreach ( $data as $key => $value ) {
			$query .= "$con$key=?";
			$con = ',';
			$args[] = $value;
		}
		
		$query .= " WHERE ";
		$con = '';
		foreach ( $where as $key => $value ) {
			$query .= "$con$key = ?";
			$con = " AND ";
			$args[] = $value;
		}

        $reponse = parent::prepare($query);
        $reponse->execute($args);
        return $reponse;
		
	}

	public function insert($table,$data) {
	
		$args = array();
		$values = '';
		$query = "INSERT INTO `$table` (";
		$con = '';
		foreach ( $data as $key => $value ) {
			$query .= "$con$key";
			$values .= "$con?";
			$con = ',';
			$args[] = $value;
		}
		$query .= ") VALUES ($values)";
		
        $reponse = parent::prepare($query);
        $reponse->execute($args);
        return $reponse;

	}
	
}


?>
