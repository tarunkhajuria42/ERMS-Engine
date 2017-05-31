<?php
/* 
Scalable Data Management System
Educational Institutions
----------------------------------------------------
Version 0.1 
Author: Tarun Khajuria (tarunkhajuria42@gmail.com)
----------------------------------------------------
User management Pages
*/
namespace view;
require('misc.php');

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/user.css">
		<script src='javascript/login.js'></script>
		<title>Board of Technical Education: Register</title>
	</head>
	<body>
<?php
	echo(misc\header());
?>
	<div id='main'>
		<form id='register_form' class ='form'>
			<h2 id='signUp' class='form_title'>Sign Up</h2>
			<div class='encap'><p class='form_tag'>Full Name</p><input class='form_input' type='text'></div>
			<div class='encap'><p class='form_tag'>Registered Email</p><input class='form_input' type='text'></div>
			<div class='encap'><p class='form_tag'>Password</p><input class='form_input' type='password'></div>
			<div class='encap'><p class='form_tag'>Re-Enter Password</p><input class='form_input' type='text'></div>
			<div class='encap'><p class='form_tag error' id='signUpError'></p></div>
			<div class='encap'><p id='register' class='link'> Register</p></div>	
		</form>
	</div>
<?php

	echo(misc\footer());
?>
	</body>
</html>
