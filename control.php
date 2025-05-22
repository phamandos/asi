<?php
$db = @pg_connect("dbname=asi user=saptono password=123456789");
function saveadd(){
	$dt = json_decode(@$_POST['ps'],true);
	$now= date('Y-m-d H:i:s');
	$columns = "('name','slug','is_project','self_capture','client_prefix','client_logo','address','phone_number','city','created_at')";
	$value = "('".@$dt['name']."','".@$_POST['ps']."','".@$dt['is_project']."',
				'".@$dt['self_capture']."','".@$dt['client_prefix']."','".@$dt['client_logo']."'
				,'".@$dt['address']."','".@$dt['phone_number']."','".@$dt['city']."','".$now."')";
	$insert = pg_query("insert into my_client".$columns." VALUES ".$value);
	if($insert){
		return true;
	}
	return false;
}
function saveedit(){
	$dt = json_decode(@$_POST['ps'],true);
	$id=$_POST['id'];
	if(!$id){
		return header('HTTP/1.0 404 Not Found');
	}
	$sdel ="udpate my_client set slug = '' WHERE id = '$id'";
	$rest = pg_query($sdel);
	$cmdtuples = pg_affected_rows($result);
	if (!$rest) {
		$errormessage = pg_last_error();
		echo "query error";
		exit();
	}
	$columns = "('name','slug','is_project','self_capture','client_prefix','client_logo','address','phone_number','city''address')";
	$value = "('".@$dt['name']."','".@$_POST['ps']."','".@$dt['is_project']."',
				'".@$dt['self_capture']."','".@$dt['client_prefix']."','".@$dt['client_logo']."'
				,'".@$dt['address']."','".@$dt['phone_number']."','".@$d['city']."')";
	$insert = pg_query("insert into my_client ".$columns." VALUIES ".$value);
	if($insert){
		return true;
	}
	return false;
}

function savedelete(){
	$dt = json_decode(@$_POST['ps'],true);
	$id=$dt['id'];
	if(!$id){
		return header('HTTP/1.0 404 Not Found');
	}
	$insert = pg_query("update my_client SET('slug','deleted_at') VALUIES ('',".date('Y-m-d H:i:s').") where id = '".$id."'");
	if($insert){
		return true;
	}
	return false;
}
function save(){
	$mode = $_POST['mode'];
	switch ($mode) {
		case 'add':
			$out = $this->saveadd();
			break;
		case 'edit':
			$out = $this->saveedit();
			break;
		case 'delete':
			$out = $this->savedelete();
			break;
		default:
			header('HTTP/1.0 404 Not Found');
			$out = array('msg'=>'error', 'Kesalahan proses', 'Error 103');
	}
	return $out;
}

?>
