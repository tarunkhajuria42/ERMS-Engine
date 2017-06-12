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
require('..\config.php');
?>
<html>
	<head >
		<link rel="stylesheet" type="text/css" href="css/user.css">
		<script src='javascript/login.js'></script>
		<script src='javascript/jquery-3.2.1.min.js'></script>
		<script src='javascript/jquery.validate.js'></script>
		<title>Board of Technical Education: Login</title>
	</head>
	<body onload="checktoken()">
<?php
	echo(misc\header());
?>
	<div id='main'>
		<form id='login_form' class='form'>
			<h2 id='login_title' class='form_title'>Login</h2>
			<div class='encap'><p id='Email' class='form_tag'>Email</p><input class='form_input' type='email' name='email' required></div>
			<div class='encap'><p id='pword' class='form_tag'>Password</p><input class='form_input' type='password' name='password' required></div>
			<div class='encap'><p id='sign_in' class='link'>Sign In</p></div>
			<div class='encap'><p id='fpass' class='link'>Forgot Password?</p><p class='link' id='register' onclick='goto("register")'>Register</p></div>
		</form>
	</div>
<?php
	echo(misc\footer());
?>
	</body>
</html>



