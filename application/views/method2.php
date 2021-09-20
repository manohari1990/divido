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
	<input type="text" value="" id="inputConfig" name="inputConfig">
    <button onclick="getJSONString(document.getElementById('inputConfig').value)">Get Config Value</button>

    <div id="ResultString"></div><br><br>

    <div id="ErrorFileString"></div><br><br>
</div>
    <script>
        let AppBasePath = '<?php echo base_url(); ?>';
    </script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/js/divido2.js') ?>"></script>
</body>
</html>