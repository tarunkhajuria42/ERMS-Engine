<?php
/* 
Scalable Data Management System
Educational Institutions
----------------------------------------------------
Version 0.1 
Author: Tarun Khajuria (tarunkhajuria42@gmail.com)
----------------------------------------------------
Header and Footer
*/
namespace view\misc;
function header(){
	return <<<HTML
	<html>
	<div id='header'>
		<img id='header_logo' src='images\logoWhite.png'>
		<h1 id='header_title'>Board of Technical Education</h1>
		<h2 id='header_subtitle'>Government of N.C.T. of Delhi</h2>
		<style>
			#header{
				width:100%;
				height:130px;
				background-color: #FF931E;
				}
			#header_logo{
				position:absolute;
				height:100px;
				top:20px;
				right:40px;
			}
			#header_title{	
				position:absolute;
				color:white;
				font-size:18px;
				top:35px;
				right:150px;
			}
			#header_subtitle{
				position:absolute;
				color:white;
				font-size:16px;
				top:55px;
				right:160px;

			}
		</style>
	</div>
HTML;
}

function footer(){
	return <<<HTML
	<div id="footer"></div>
	<style>
		#footer{
			width:100%;
			height:50px;
			background-color:#FF931E; 
		}
	</style>
	</html>
HTML;
}



