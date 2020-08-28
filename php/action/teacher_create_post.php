<?php
require_once  '../autoload.php';

use App\Teacher;

$Teacher = new Teacher();

$result = $Teacher->createPost($_POST);

var_dump($result);
exit;
