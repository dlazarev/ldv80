<?php 
error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
$new_state = $_POST['state'];
$id = $_POST['id'];
$post_arr = array();
$gpio_arr = array();

try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');
	
	# Send command to raspberry
	$query = 'SELECT id, "GPIO_pin", state FROM actuators';
	
	foreach($dbh->query($query) as $row) {
		if ($row['id'] == $_POST['id']) $row['state'] = strcmp($new_state, "true") ? 0 : 1;
		array_push($gpio_arr, $row);
	}
		
	$post_arr['token'] = 'b6PwvrVJaZXKv6GP';
	$post_arr['gpio_arr'] = $gpio_arr;
	
	file_put_contents('/tmp/setActuatorsState.txt', print_r($post_arr, true));
	
    $url = "https://ldv80.ddns.net/ldv80/setGPIO.php";
	$opts = array(
			'http' => array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => http_build_query($post_arr)
				),
		    'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					)
			);

	$context = stream_context_create($opts);
#	file_put_contents('/tmp/setActuatorsState.txt', print_r($context, true));
	
	$result = file_get_contents($url, false, $context);

	if (strcmp($result, "") == 0) {
#	file_put_contents('/tmp/setActuatorsState.txt', print_r($result, true));
		$dbh = null;
		exit();
	}
	
	# Update actuator state in to database
	$query = "UPDATE actuators SET state = '".$new_state."' WHERE id = '".$id."'";
	$dbh->query($query);
	
	$lines = explode("\n", $result);
	$arr = array();
	foreach($lines as $row) {
        if (strcmp($row, "") == 0) continue;
        list($GPIO_pin, $state) = explode(",", $row);
        $actuator_id = find_actuator_id($gpio_arr, $GPIO_pin);
        array_push($arr, array('actuator_id' => $actuator_id, 'GPIO_pin' => $GPIO_pin, 'state' => $state));
	}

#	file_put_contents('/tmp/setActuatorsState.txt', print_r($arr, true));
	
	print(json_encode($arr));
	$dbh = null;
} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

function find_actuator_id($a, $gpio) {
	$key = array_search($gpio, array_column($a, 'GPIO_pin'));
	if ($key !== false) return $a[$key]['id'];
	return -1;
}

?>
