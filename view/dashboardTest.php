<?php
namespace view;
require('marks.php');

echo(json_encode(array(list_papers(),logout())));
?>