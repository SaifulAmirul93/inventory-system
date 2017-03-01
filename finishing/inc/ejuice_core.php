<?php

class ejuice {
	private $self_file = 'ejuice_core.php';
	private $mysqli = false;
	private $session = false;
	
	public function __construct($m) { $this->mysqli = $m; }
	
	public function set_session_obj($obj) { $this->session = $obj; }
	
	public function get_ejuices($page, $items_per_page) {
		$page = stripslashes($page);
		$items_per_page = stripslashes($items_per_page);
		
		if($page == 0 || $page == 1)
			$x = 0;
		else
			$x = ($items_per_page * ($page-1));
		$y = $items_per_page;
		$q = $this->query("SELECT * FROM invento_ejuice ORDER BY id DESC LIMIT $x,$y", 'get_ejuices()');
		return $q;
	}
	
	public function search($string, $page, $items_per_page) {
		$s = "%$string%";
		
		if($page == 0 || $page == 1)
			$x = 0;
		else
			$x = ($items_per_page * ($page-1));
		$y = $items_per_page;

		$prepared = $this->prepare("SELECT * FROM invento_ejuice WHERE id LIKE ? OR name LIKE ? OR descrp LIKE ? OR date_added LIKE ? ORDER BY id DESC LIMIT $x,$y", 'search()');
		$this->bind_param($prepared->bind_param('ssss', $s, $s, $s, $s), 'search()');
		$this->execute($prepared, 'search()');
		
		if($this->is_mysqlnd())
			return $prepared->get_result();
		else{
			return $this->prepared_to_object($prepared);
		}
	}
	
	public function count_ejuice() {
		$res = $this->query("SELECT COUNT(*) as c FROM invento_ejuice", 'count_ejuice()');
		$obj = $res->fetch_object();
		return $obj->c;
	}
	
	public function count_ejuice_search($string) {
		$string = "%$string%";
		$prepared = $this->prepare("SELECT COUNT(*) as c FROM invento_ejuice WHERE id LIKE ? OR name LIKE ? OR descrp LIKE ? OR date_added LIKE ?", 'count_ejuice_search()');
		$this->bind_param($prepared->bind_param('ssss', $string, $string, $string, $string), 'count_ejuice_search()');
		$this->execute($prepared, 'count_ejuice_search()');
		
		if($this->is_mysqlnd()) {
			$result = $prepared->get_result();
			$row = $result->fetch_object();
			return $row->c;
		}else{
			$prepared->bind_result($val);
			$prepared->fetch();
			return $val;
		}
	}
	
	public function delete_ejuice($catid) {
		$prepared = $this->prepare("DELETE FROM invento_ejuice WHERE id=?", 'delete_ejuice()');
		$this->bind_param($prepared->bind_param('i', $catid), 'delete_ejuice()');
		$this->execute($prepared, 'delete_ejuice()');
		return true;
	}
	
	public function get_ejuice_dropdown() {
		$q = $this->query("SELECT id,name FROM invento_ejuice", 'get_ejuice_dropdown()');
		return $q;
	}
	
	public function new_lineup($name, $desc) {
		$date = date('Y-m-d');
		$prepared = $this->prepare("INSERT INTO invento_ejuice(name,descrp,date_added) VALUES(?,?,?)", 'new_lineup()');
		$this->bind_param($prepared->bind_param('sss', $name, $desc, $date), 'new_lineup()');
		$this->execute($prepared, 'new_lineup()');
		return true;
	}
	
	public function edit_ejuice($ejuiceid, $name, $desc) {
		$prepared = $this->prepare("UPDATE invento_ejuice SET name=?, descrp=? WHERE id=?", 'edit_ejuice()');
		$this->bind_param($prepared->bind_param('ssi', $name, $desc, $ejuiceid), 'edit_ejuice()');
		$this->execute($prepared, 'edit_ejuice()');
		return true;
	}
	
	public function get_ejuice($ejuiceid) {
		$res = $this->query("SELECT * FROM invento_ejuice WHERE id=$ejuiceid", 'get_ejuice()');
		$obj = $res->fetch_object();
		return $obj;
	}
	
	
	/***
	  *  Private functions
	  *
	***/
	private function prepare($query, $func) {
		$prepared = $this->mysqli->prepare($query);
		if(!$prepared)
			die("Couldn't prepare query. inc/{$this->self_file} - $func");
		return $prepared;
	}
	private function bind_param($param, $func) {
		if(!$param)
			die("Couldn't bind parameters. inc/{$this->self_file} - $func");
		return $param;
	}
	private function execute($prepared, $func) {
		$exec = $prepared->execute();
		if(!$exec)
			die("Couldn't execute query. inc/{$this->self_file} - $func");
		return $exec;
	}
	private function query($query, $func) {
		$q = $this->mysqli->query($query);
		if(!$q)
			die("Couldn't run query. inc/{$this->self_file} - $func");
		return $q;
	}
	
	/****
	 * Alternative to fetch_object for users who doesn't have MySQL Native Driver
	 * (Single row)
	*****/
	private function prepared_to_sobject($prepared) {
		$parameters = array();
		$metadata = $prepared->result_metadata();
		
		while($field = $metadata->fetch_field())
			$parameters[] = &$row[$field->name];
		call_user_func_array(array($prepared, 'bind_result'), $parameters);
		
		$nrs = 0;
		while($prepared->fetch()) {
			$cls = new stdClass;
			foreach($row as $key => $val)
				$cls->$key = $val;
			$nrs++;
		}
		
		return ($nrs == 0) ? 0 : $cls;
	}
	
	/****
	 * Alternative to fetch_object for users who doesn't have MySQL Native Driver
	 * (Multiple rows)
	*****/
	private function prepared_to_object($prepared) {
		$parameters = array();
		$metadata = $prepared->result_metadata();
		
		while($field = $metadata->fetch_field())
			$parameters[] = &$row[$field->name];
		call_user_func_array(array($prepared, 'bind_result'), $parameters);
		
		$nrs = 0;
		while($prepared->fetch()) {
			$cls = new stdClass;
			foreach($row as $key => $val)
				$cls->$key = $val;
			$results[] = $cls;
			$nrs++;
		}
		
		return ($nrs == 0) ? 0 : $results;
	}
	public function is_mysqlnd() {
		if(function_exists('mysqli_stmt_get_result'))
			return true;
		return false;
	}
	public function __destruct() {
		if(is_resource($this->mysqli) && get_resource_type($this->mysqli) == 'mysql link')
			$this->mysqli->close();
	}
}

$_ejuice = new ejuice($mysqli);