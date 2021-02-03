<?php

include_once('Dir.php');

$root = new Dir();
print_r($root->scanDir());
