<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
</head>
<body>

<div id="container">
	<input placeholder="Enter any config key" type="text" value="" id="inputConfig" name="inputConfig">
    <button onclick="getJSONString(document.getElementById('inputConfig').value)">Get Value</button>

    <div id="ResultString"></div><br><br>

    <div id="ErrorFileString"></div><br><br> <br><br>
</div>
	<script>
		let mergedObject = JSON.parse('<?php echo $ResultArray; ?>');
		let errorFileLit = JSON.parse('<?php echo $errorFiles; ?>');
	</script>
    <script src="<?php echo base_url('assets/js/divido.js') ?>"></script>
</body>
</html>