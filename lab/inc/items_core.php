<?php

class Items {
	private $self_file = 'items_core.php';
	private $mysqli = false;
	private $session = false;
	
	public function __construct($m) { $this->mysqli = $m; }
	
	public function set_session_obj($obj) { $this->session = $obj; }
	
	public function get_items($page, $items_per_page) {
		$page = stripslashes($page);
		$items_per_page = stripslashes($items_per_page);
		
		if($page == 0 || $page == 1)
			$x = 0;
		else
			$x = ($items_per_page * ($page-1));
		$y = $items_per_page;
		
		$res = $this->query("SELECT * FROM invento_items ORDER BY id DESC LIMIT $x,$y", 'get_items()');
		return $res;
	}
	
	//start modified
		public function get_items_home() {
	
		$res = $this->query("SELECT * FROM invento_items ORDER BY category ASC", 'get_items_home()');
		return $res;
	}
	//end modified
	
	public function count_items() {
		$res = $this->query("SELECT COUNT(*) as c FROM invento_items", 'count_items()');
		$obj = $res->fetch_object();
		return $obj->c;
	}
	
		public function count_items_bryan() {
		$res = $this->query("SELECT SUM(qty) AS s FROM invento_items WHERE category = 1", 'count_items_bryan()');
		$obj = $res->fetch_object();
		return $obj->s;
	}

		public function count_items_vis_company() {
		$res = $this->query("SELECT SUM(qty) AS s FROM invento_items WHERE category = 2", 'count_items_vis_company()');
		$obj = $res->fetch_object();
		return $obj->s;
	}
	
		public function count_items_green_house() {
		$res = $this->query("SELECT SUM(qty) AS s FROM invento_items WHERE category = 3", 'count_items_green_house()');
		$obj = $res->fetch_object();
		return $obj->s;
	}
	
		public function count_items_capella() {
		$res = $this->query("SELECT SUM(qty) AS s FROM invento_items WHERE category = 4", 'count_items_capella()');
		$obj = $res->fetch_object();
		return $obj->s;
	}
	
		public function count_items_matrix() {
		$res = $this->query("SELECT SUM(qty) AS s FROM invento_items WHERE category = 5", 'count_items_matrix()');
		$obj = $res->fetch_object();
		return $obj->s;
	}
	
		public function count_items_quantity($id) {
		$res = $this->query("SELECT qty AS s FROM invento_items WHERE id = $id", 'count_items_quantity()');
		$obj = $res->fetch_object();
		return $obj->s;
	}
	
	public function count_items_search($string) {
		$s = "%$string%";
		$prepared = $this->prepare("SELECT COUNT(*) as c FROM invento_items WHERE id LIKE ? OR name LIKE ? OR descrp LIKE ? OR date_added LIKE ? OR category IN (SELECT id FROM invento_categories WHERE name LIKE ?)", 'count_items_search()');
		$this->bind_param($prepared->bind_param('sssss', $s, $s, $s, $s, $s), 'count_items_search()');
		$this->execute($prepared, 'count_items_search()');
		
		if($this->is_mysqlnd()) {
			$result = $prepared->get_result();
			$row = $result->fetch_object();
			return $row->c;
		}else{
			$prepared->bind_result($c);
			$prepared->fetch();
			return $c;
		}
	}
	
		public function get_items_dropdown() {
		$q = $this->query("SELECT id,name FROM invento_items", 'get_items_dropdown()');
		return $q;
	}
	
	
	
	
	public function search($string, $page, $items_per_page) {
		$s = "%$string%";
		if($page == 0 || $page == 1)
			$x = 0;
		else
			$x = ($items_per_page * ($page-1));
		$y = $items_per_page;
		
		$prepared = $this->prepare("SELECT * FROM invento_items WHERE id LIKE ? OR name LIKE ? OR descrp LIKE ? OR date_added LIKE ? OR category IN (SELECT id FROM invento_categories WHERE name LIKE ?) ORDER BY id DESC LIMIT $x,$y", 'search()');
		$this->bind_param($prepared->bind_param('sssss', $s, $s, $s, $s, $s), 'search()');
		$this->execute($prepared, 'search()');
		
		if($this->is_mysqlnd())
			return $prepared->get_result();
		else
			return $this->prepared_to_object($prepared);
	}
	
	public function get_category_name($id) {
		$prepared = $this->prepare("SELECT name FROM invento_categories WHERE id=?", 'get_category_name()');
		$this->bind_param($prepared->bind_param('i', $id), 'get_category_name()');
		$this->execute($prepared, 'get_category_name()');
		
		if($this->is_mysqlnd()) {
			$result = $prepared->get_result();
			$row = $result->fetch_object();
			return $row->name;
		}else{
			$prepared->bind_result($name);
			$prepared->fetch();
			return $name;
		}
	}
	
	public function get_item_name($id) {
		$prepared = $this->prepare("SELECT name FROM invento_items WHERE id=?", 'get_item_name()');
		$this->bind_param($prepared->bind_param('i', $id), 'get_item_name()');
		$this->execute($prepared, 'get_item_name()');
		
		if($this->is_mysqlnd()) {
			$result = $prepared->get_result();
			$row = $result->fetch_object();
			return $row->name;
		}else{
			$prepared->bind_result($name);
			$prepared->fetch();
			return $name;
		}
	}
	
	public function delete_item($id) {
		$prepared = $this->prepare("DELETE FROM invento_items WHERE id=?", 'delete_items()');
		$this->bind_param($prepared->bind_param('i', $id), 'delete_item()');
		$this->execute($prepared, 'delete_item()');
		
		$prepared = $this->prepare("DELETE FROM invento_logs WHERE item=?", 'delete_items()');
		$this->bind_param($prepared->bind_param('i', $id), 'delete_item()');
		$this->execute($prepared, 'delete_item()');
		
		return true;
	}
	
	public function update_item_qty($type, $id, $fromqty, $qty) {
		$to = $fromqty + $qty;
		
		if(!is_numeric($id) || !is_numeric($fromqty) || !is_numeric($qty))
			die('inc/items_core.php - update_item_qty - Non Numeric Values');
		
		// First, update the item
		if($type == 1) {
			$prepared = $this->prepare("UPDATE invento_items SET qty = qty+$qty WHERE id=?", 'update_item_qty()');
			$this->bind_param($prepared->bind_param('i', $id), 'update_item_qty()');
			$this->execute($prepared, 'update_item_qty()');
		}elseif($type == 2){
			$prepared = $this->prepare("UPDATE invento_items SET qty = qty-$qty WHERE id=?", 'update_item_qty()');
			$this->bind_param($prepared->bind_param('i', $id), 'update_item_qty()');
			$this->execute($prepared, 'update_item_qty()');
		}
		
		// Try to create the log, if fail, revert change
		if($type == 1)
			$update = $this->new_log(1, $id, $fromqty, $to);
		else
			$update = $this->new_log(2, $id, $fromqty, $to-$qty-$qty);
		
		if($update == false) {
			$prepared = $this->prepare("UPDATE invento_items SET qty = $fromqty WHERE id=?", 'update_item_qty()');
			$this->bind_param($prepared->bind_param('i', $id), 'update_item_qty()');
			$this->execute($prepared, 'update_item_qty()');
			return false;
		}
		return true;
	}
	
	private function new_log($type, $item, $from, $to) {
		if($type == 1) {
			$difference = $to - $from;
			$date = date('Y-m-d');
			$user = $this->session->get_user_id();
			
			$prepared = $this->prepare("INSERT INTO invento_logs(`type`,item,fromqty,toqty,fromprice,date_added,`user`) VALUES(1,?,?,?,((SELECT price FROM invento_items WHERE id=?)*?),?,?)", 'new_log()');
			$this->bind_param($prepared->bind_param('iiiiisi', $item, $from, $to, $item, $difference, $date, $user), 'new_log()');
			$this->execute($prepared, 'new_log()');
			
		}elseif($type == 2) {
			$difference = $from - $to;
			$date = date('Y-m-d');
			$user = $this->session->get_user_id();
			
			$prepared = $this->prepare("INSERT INTO invento_logs(`type`,item,fromqty,toqty,fromprice,date_added,`user`) VALUES(2,?,?,?,((SELECT price FROM invento_items WHERE id=?)*?),?,?)", 'new_log()');
			$this->bind_param($prepared->bind_param('iiiiisi', $item, $from, $to, $item, $difference, $date, $user), 'new_log()');
			$this->execute($prepared, 'new_log()');
			
		}elseif($type == 3) {
			$date = date('Y-m-d');
			$user = $this->session->get_user_id();
			// Get actual price (from)
			$prepared = $this->prepare("INSERT INTO invento_logs(`type`,item,fromprice,toprice,date_added,`user`) VALUES(3,?,(SELECT price FROM invento_items WHERE id=?),?,?,?)", 'new_log()');
			$this->bind_param($prepared->bind_param('iissi', $item, $item, $to, $date, $user), 'get_log()');
			$this->execute($prepared, 'new_log()');
		}
		return true;
	}
	
	public function get_cat_reg_items($catid) {
		$prepared = $this->prepare("SELECT COUNT(*) as c FROM invento_items WHERE category=?", 'get_cat_reg_items()');
		$this->bind_param($prepared->bind_param('i', $catid), 'get_cat_reg_items()');
		$this->execute($prepared, 'get_cat_reg_items()');
		
		if($this->is_mysqlnd()) {
			$result = $prepared->get_result();
			$row = $result->fetch_object();
			return $row->c;
		}else{
			$prepared->bind_result($c);
			$prepared->fetch();
			return $c;
		}
	}
	
	public function get_cat_tot_items($catid) {
		$prepared = $this->prepare("SELECT SUM(qty) as s FROM invento_items WHERE category=?", 'get_cat_tot_items()');
		$this->bind_param($prepared->bind_param('i', $catid), 'get_cat_tot_items()');
		$this->execute($prepared, 'get_cat_tot_items()');
		
		if($this->is_mysqlnd()) {
			$result = $prepared->get_result();
			$row = $result->fetch_object();
			$s = $row->s;
		}else{
			$prepared->bind_result($s);
			$prepared->fetch();
		}
		
		if($s == '')
			return 0;
		return $s;
	}
	
	public function new_item($name, $desc, $cat, $qty, $price) {
		$name = stripslashes($name);
		$desc = stripslashes($desc);
		$cat = stripslashes($cat);
		$qty = stripslashes($qty);
		$price = stripslashes($price);
		$date = date('Y-m-d');
		if($qty == '')
			$qty = 0;
			
		$prepared = $this->prepare("INSERT INTO invento_items(name,descrp,category,qty,price,date_added) VALUES(?,?,?,?,?,?)", 'new_item()');
		$this->bind_param($prepared->bind_param('ssiiis', $name, $desc, $cat, $qty, $price, $date), 'new_item()');
		$this->execute($prepared, 'new_item()');
		
		return true;
	}
	
	public function get_item($itemid) {
		$prepared = $this->prepare("SELECT * FROM invento_items WHERE id=?", 'get_item()');
		$this->bind_param($prepared->bind_param('i', $itemid), 'get_item()');
		$this->execute($prepared, 'get_item()');
		
		if($this->is_mysqlnd()) {
			$result = $prepared->get_result();
			return $result->fetch_object();
		}else{
			return $this->prepared_to_object($prepared);
		}
	}

	public function update_item($itemid, $name, $desc, $cat, $price) {
		// Create log
		$update = $this->new_log(3, $itemid, false, $price);

		$prepared = $this->prepare("UPDATE invento_items SET name=?, descrp=?, category=?, price=? WHERE id=?", 'update_item()');
		$this->bind_param($prepared->bind_param('ssssi', $name, $desc, $cat, $price, $itemid), 'update_item()');
		$this->execute($prepared, 'update_item()');
		return true;
	}
	
	public function parse_price($p) {
		return $p;
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

$_items = new Items($mysqli);