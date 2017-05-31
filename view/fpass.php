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
		<form id='fpasword' class='form'>
			<h2 id='fpassword' class='form_title'>Forgot Password</h2>
			<div class='encap'><p class='form_tag'>Registered Email</p><input type='text' class='form_input'></div>
			<div class='encap'><p class='form_tag message'>Enter your Registered Email a password change link will be sent to the email</p></div>
			<div class='encap'><p class='form_tag error'></p></div>
			<div class='encap'><p id='sendPassword' class='link form_input'>Send Email</p></div>
		</form>
	</div>
<?php
	echo(misc\footer());
?>
	</body>
</html>