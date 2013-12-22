<?php
$connect_error = 'Sorry, we\'re experiencing connection problems.';
mysql_connect('localhost', 'db_username', 'db_password') or die($connect_error);
mysql_select_db('db_name') or die($connect_error);
?>