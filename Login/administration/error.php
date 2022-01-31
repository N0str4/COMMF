<?php
switch($_GET['code'])
{
case '404':header('Location: http://intradef.vikatchev.com/Login/administration/pages-error-404.html');
break;
default:header('Location: http://intradef.vikatchev.com/Login/login.php');
}
?>