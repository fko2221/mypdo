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

}


?>
