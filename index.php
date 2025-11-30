<?php
//TODO: SMS/email, database

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

error_reporting(0);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';

$buildings = [1 => 'East building', 2 => 'West building', 3 => 'Boilers', 4 => 'Garage'];
$state = '<?xml version="1.0" ?>
<state>
        <data>'.bin2hex(serialize([date(DATE_RFC2822), $_SERVER['REMOTE_ADDR'], isset($_COOKIE['admin'])])).'</data>
</state>
'; //Do some API calls!!1

if(isset($_POST['building'])){

        $xstate = simplexml_load_string(base64_decode($_POST['state']));
        $xstate = hex2bin($xstate->data);
        $xstate = (preg_match('/[OC]:[0-9]+"/', $xstate) ? false : unserialize($xstate));
        $check = (is_array($xstate) ? true : false); //add additional API checks here!!1
        $result = ($check ? 'OK' : 'ERROR');

        // save in DB & send alerts
}
?>
<html>
<body>
		<form action="" method="post">
			<select name="building">
				<?php foreach($buildings as $num => $name) print '<option value="'.$num.'"'.(isset($_POST['building']) && $num == $_POST['building'] ? ' selected' : '').'>'.$name.'</option>'.PHP_EOL; ?>
			</select>
			<input type="hidden" name="state" value="<?=base64_encode($state)?>">
			<input type="submit" name="check" value="Check"> <?=(isset($result) ? $result : '')?>
		</form>
</body>
</html>
