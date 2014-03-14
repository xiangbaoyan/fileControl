<?php
require $_SERVER['DOCUMENT_ROOT'] . "/libs/Smarty.class.php";

$smarty = new Smarty;

$smarty->left_delimiter = "<{";

$smarty->right_delimiter = "}>";


?>