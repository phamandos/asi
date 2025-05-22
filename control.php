<?php
$db = @pg_connect("dbname=asi user=saptono password=123456789");
function data (){
	$dt = json_decode($_POST['ps'],true);
	$data = array(
		'name'=>@$_POST['name'],
		'slug'=>@$_POST['slug'],
		'is_project'=>@$_POST['is_project'],
		'self_capture'=>@$_POST['self_capture'],
		'client_prefix'=>@$_POST['client_prefix'],
		'client_logo'=>@$_POST['client_logo'],
		'address'=>@$_POST['address'],
		'phone_number'=>@$_POST['phone_number'],
		'city'=>@$_POST['city'],
	);
	return $data;
}
function saveadd(){
	$items = $this->data();
	$items['create_at'] = date('Y-m-d H:i:s');
	$columns = "('name','slug','is_project','self_capture','client_prefix','client_logo','address','phone_number','city''address')";
	$value = "('".@$_POST['name']."','".@$_POST['slug']."','".@$_POST['is_project']."',
				'".@$_POST['self_capture']."','".@$_POST['client_prefix']."','".@$_POST['client_logo']."'
				,'".@$_POST['address']."','".@$_POST['phone_number']."','".@$_POST['city']."')";
	$insert = pg_query("insert into my_client".$columns." VALUES ".$value);
	if($insert){
		return true;
	}
	return false;
}
function saveedit(){
	$items = $this->data();
	$id=$_POST['id'];
	if(!$id){
		return header('HTTP/1.0 404 Not Found');
	}
	$sdel ="DELETE FROM my_client WHERE id = '$id'";
	$rest = pg_query($sdel);
	$cmdtuples = pg_affected_rows($result);
	if (!$rest) {
		$errormessage = pg_last_error();
		echo "query error";
		exit();
	}
	$columns = "('name','slug','is_project','self_capture','client_prefix','client_logo','address','phone_number','city''address')";
	$value = "('".@$_POST['name']."','".@$_POST['slug']."','".@$_POST['is_project']."',
				'".@$_POST['self_capture']."','".@$_POST['client_prefix']."','".@$_POST['client_logo']."'
				,'".@$_POST['address']."','".@$_POST['phone_number']."','".@$_POST['city']."')";
	$insert = pg_query("insert into my_client ".$columns." VALUIES ".$value);
	if($insert){
		return true;
	}
	return false;
}

function savedelete(){
	$items = $this->data();
	$id=$_POST['id'];
	if(!$id){
		return header('HTTP/1.0 404 Not Found');
	}
	$insert = pg_query("update my_client SET('deleted_at') VALUIES ".date('Y-m-d H:i:s'));
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
