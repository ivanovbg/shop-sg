<?php
if(!defined("LOCALPATH")) {
    define("LOCALPATH", substr(dirname(__FILE__), 0, -6));
}

$application = require LOCALPATH.'app/bootstrap_web.php';

##for tests
if(defined("TEST")){
    return $application;
}