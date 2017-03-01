<?php


class Logs {
	private $self_file = 'logs_core.php';
	private $mysqli = false;
	private $session = false;
	
	public function __construct($m) { $this->mysqli = $m; }
	
	public function set_session_obj($obj) { $this->session = $obj; }
	
	public function get_logs($type, $itemid, $catid,$userid) {
	//start modified
			$s = "%$userid%";
	//	if($page == 0 || $page == 1)
//			$x = 0;
//		else
//			$x = ($items_per_page * ($page-1));
//		$y = $items_per_page;
		
		//	//start added
//			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE type LIKE $s ORDER BY date_added DESC LIMIT $x,$y", 'search()');
//			$this->bind_param($prepared->bind_param('sssss', $s, $s, $s, $s, $s), 'get_logs()');
//			//end added
		
		
		if($itemid != false){
			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE item=? AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?) ORDER BY id DESC ", 'search()');
			$this->bind_param($prepared->bind_param('issss', $itemid, $s, $s, $s, $s), 'get_logs()');
		}
			
		elseif($catid != false){
			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE item IN (SELECT id FROM invento_items WHERE category=?) AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?) ORDER BY id DESC", 'search()');
			$this->bind_param($prepared->bind_param('issss', $catid, $s, $s, $s, $s), 'get_logs()');
		}
		elseif($type != false){
			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE type LIKE ? ORDER BY date_added DESC", 'search()');
			$this->bind_param($prepared->bind_param('i', $type), 'get_logs()');
		}
		
		
		
		
		
	
	//	else{
//			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE type LIKE $s ORDER BY date_added DESC LIMIT ?,?", 'search()');
//			$this->bind_param($prepared->bind_param('ssssii', $s, $s, $s, $s, $x, $y), 'get_logs()');
//		}
//end modified
		
		
		
		
		
		
	//	if($page == 0 || $page == 1)
//			$x = 0;
//		else
//			$x = ($items_per_page * ($page-1));
//		$y = $items_per_page;
//		
//		if($itemid != false) {
//			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE item=? ORDER BY id DESC LIMIT ?,?", 'get_logs()');
//			$this->bind_param($prepared->bind_param('iii', $itemid, $x, $y), 'get_logs()');
//		}elseif($catid != false){
//			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE item IN (SELECT id FROM invento_items WHERE category=?) ORDER BY id DESC LIMIT ?,?", 'get_logs()');
//			$this->bind_param($prepared->bind_param('iii', $catid, $x, $y), 'get_logs()');
//		}elseif($userid != false){
//			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE `user`=? ORDER BY id DESC LIMIT ?,?", 'get_logs()');
//			$this->bind_param($prepared->bind_param('iii', $userid, $x, $y), 'get_logs()');
//		}else{
//			$prepared = $this->prepare("SELECT * FROM invento_logs ORDER BY id DESC LIMIT ?,?", 'get_logs()');
//			$this->bind_param($prepared->bind_param('ii', $x, $y), 'get_logs()');
//		}
//		



		$this->execute($prepared, 'get_logs()');
		
		if($this->is_mysqlnd()) {
			return $prepared->get_result();
		}else{
			return $this->prepared_to_object($prepared);
		}
	}
	

	
		public function get_type_dropdown() {
		$q = $this->query("SELECT id,type FROM invento_logs", 'get_type_dropdown()');
		return $q;
		}
		
		
		
	//	public function search_filter_date($date ) {
//		
//					$prepared = $this->prepare("SELECT * FROM invento_logs WHERE date_added LIKE ?" , 'search_filter_date()');
//					$this->bind_param($prepared->bind_param('s', $date), 'search_filter_date()');
//				
//				
//				$this->execute($prepared, 'search_filter_date()');
//				
//				if($this->is_mysqlnd()) {
//					return $prepared->get_result();
//				}else{
//					return $this->prepared_to_object($prepared);
//				}
//		}
//		
		public function search_filter($item_id,$user_id,$date,$type) {

		if(($item_id != false)&&($user_id != false)&&($date != false)&&($type != false)){

			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE item = ? AND user = ? AND date_added LIKE ? AND type = ?" , 'search_filter()');
			$this->bind_param($prepared->bind_param('iisi', $item_id,$user_id, $date,$type), 'search_filter()');
		}
		elseif(($date != false && $type != false) && (($item_id == false)||($user_id == false))){
	
			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE date_added LIKE ? AND type = ?" , 'search_filter()');
			$this->bind_param($prepared->bind_param('si', $date,$type), 'search_filter()');
		}
	
		$this->execute($prepared, 'search_filter()');
		
		if($this->is_mysqlnd()) {
			return $prepared->get_result();
		}else{
			return $this->prepared_to_object($prepared);
		}
		
		
		
		
		
	}
	
	
		
//	
	
	
	//start modified
//	public function search($string, $page, $items_per_page, $itemid, $catid, $userid) {
//		$s = "%$string%";
//		if($page == 0 || $page == 1)
//			$x = 0;
//		else
//			$x = ($items_per_page * ($page-1));
//		$y = $items_per_page;
//		
//		if($itemid != false){
//			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE item=? AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?) ORDER BY id DESC LIMIT ?,?", 'search()');
//			$this->bind_param($prepared->bind_param('issssii', $itemid, $s, $s, $s, $s, $x, $y), 'search()');
//		}elseif($catid != false){
//			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE item IN (SELECT id FROM invento_items WHERE category=?) AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?) ORDER BY id DESC LIMIT ?,?", 'search()');
//			$this->bind_param($prepared->bind_param('issssii', $catid, $s, $s, $s, $s, $x, $y), 'search()');
//		}elseif($userid != false){
//			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE `user`=? AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?) ORDER BY id DESC LIMIT ?,?", 'search()');
//			$this->bind_param($prepared->bind_param('issssii', $userid, $s, $s, $s, $s, $x, $y), 'search()');
//		}else{
//			$prepared = $this->prepare("SELECT * FROM invento_logs WHERE id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ? ORDER BY id DESC LIMIT ?,?", 'search()');
//			$this->bind_param($prepared->bind_param('ssssii', $s, $s, $s, $s, $x, $y), 'search()');
//		}
//		$this->execute($prepared, 'search()');
//		
//		if($this->is_mysqlnd()) {
//			return $prepared->get_result();
//		}else{
//			return $this->prepared_to_object($prepared);
//		}
//	}
	//end modified
		//start modified
		public function count_logs() {
		//$s = "%$string%";
//		if($itemid != false){
//			$prepared = $this->prepare("SELECT COUNT(*) as c FROM invento_logs WHERE item=? AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?)", 'count_logs_search()');
//			$this->bind_param($prepared->bind_param('issss', $itemid, $s, $s, $s, $s), 'count_logs()');
//		}elseif($catid != false){
//		$prepared = $this->prepare("SELECT COUNT(*) as c FROM invento_logs WHERE item IN (SELECT id FROM invento_items WHERE category=?) AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?)", 'count_logs_search()');
//			$this->bind_param($prepared->bind_param('issss', $catid, $s, $s, $s, $s), 'count_logs()');
//		}
//		elseif($userid != false){
//			$prepared = $this->prepare("SELECT COUNT(*) as c FROM invento_logs WHERE `user`=? AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?)", 'count_logs_search()');
//			$this->bind_param($prepared->bind_param('issss', $userid, $s, $s, $s, $s), 'count_logs_search()');
//		}
//		else{
			$res = $this->query("SELECT COUNT(*) as c FROM invento_logs", 'count_logs()');
			$obj = $res->fetch_object();
			
			return $obj->c;
//		}
		
		//$this->execute($prepared, 'count_logs()');
//		
//		if($this->is_mysqlnd()) {
//			$result = $prepared->get_result();
//			$row = $result->fetch_object();
//			return $row->c;
//		}else{
//			$prepared->bind_result($c);
//			$prepared->fetch();
//			return $c;
//		}
	}
	//end modified
	
	public function get_log($itemid) {
		$prepared = $this->prepare("SELECT * FROM invento_logs WHERE id=?", 'get_log()');
		$this->bind_param($prepared->bind_param('i', $itemid), 'get_log()');
		$this->execute($prepared, 'get_log()');
		
		if($this->is_mysqlnd()) {
			$result = $prepared->get_result();
			return $result->fetch_object();
		}else{
			return $this->prepared_to_object($prepared);
		}
	}
	
	
	
	public function count_logs_search($string, $itemid, $catid, $userid) {
		$s = "%$string%";
		if($itemid != false){
			$prepared = $this->prepare("SELECT COUNT(*) as c FROM invento_logs WHERE item=? AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?)", 'count_logs_search()');
			$this->bind_param($prepared->bind_param('issss', $itemid, $s, $s, $s, $s), 'count_logs_search()');
		}elseif($catid != false){
			$prepared = $this->prepare("SELECT COUNT(*) as c FROM invento_logs WHERE item IN (SELECT id FROM invento_items WHERE category=?) AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?)", 'count_logs_search()');
			$this->bind_param($prepared->bind_param('issss', $catid, $s, $s, $s, $s), 'count_logs_search()');
		}elseif($userid != false){
			$prepared = $this->prepare("SELECT COUNT(*) as c FROM invento_logs WHERE `user`=? AND (id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?)", 'count_logs_search()');
			$this->bind_param($prepared->bind_param('issss', $userid, $s, $s, $s, $s), 'count_logs_search()');
		}else{
			$prepared = $this->prepare("SELECT COUNT(*) as c FROM invento_logs WHERE id LIKE ? OR item IN (SELECT id FROM invento_items WHERE name LIKE ?) OR `user` IN (SELECT id FROM invento_users WHERE username LIKE ?) OR date_added LIKE ?", 'count_logs_search()');
			$this->bind_param($prepared->bind_param('ssss', $s, $s, $s, $s), 'count_logs_search()');
		}
		
		$this->execute($prepared, 'count_logs_search()');
		
		if($this->is_mysqlnd()) {
			$result = $prapred->get_result();
			$obj = $result->fetch_object();
			return $obj->c;
		}else{
			$prepared->bind_result($c);
			$prepared->fetch();
			return $c;
		}
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

$_logs = new Logs($mysqli);