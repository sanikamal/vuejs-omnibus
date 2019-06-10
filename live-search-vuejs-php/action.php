<?php
$conn = new mysqli("localhost", "root", "", "live_search_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$out = array('error' => false);

$action="show";

if(isset($_GET['action'])){
	$action=$_GET['action'];
}

if($action=='show'){
	$sql = "select * from employees";
	$query = $conn->query($sql);
	$employees = array();

	while($row = $query->fetch_array()){
		array_push($employees, $row);
	}

	$out['employees'] = $employees;
}

if($action=='search'){
	$keyword=$_POST['keyword'];
	$sql="select * from employees where firstname like '%$keyword%' or lastname like '%$keyword%'";
	$query = $conn->query($sql);
	$employees = array();

	while($row = $query->fetch_array()){
		array_push($employees, $row);
	}

	$out['employees'] = $employees;
}

$conn->close();

header("Content-type: application/json");
echo json_encode($out);
die();

?>
