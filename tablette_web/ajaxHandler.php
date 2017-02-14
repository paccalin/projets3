<?php

// Debug. Désactiver en prod
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

include_once "db.php";
include_once "tools.php";

date_default_timezone_set('Australia/Melbourne');

// Gestion des routes
// Déclenchement automatique des scripts pour ajax


// Accès POST ou GET indifférent
$parameters = array();
if (isset($_POST))
	foreach($_POST as $k=>$v)
		$parameters[$k] = $v;
if (isset($_GET))
	foreach($_GET as $k=>$v)
		$parameters[$k] = $v;

// Pour accès ultérieur sans "global"
function parameters() {
	global $parameters;
	return $parameters;
}

// Gestion des la route : paramètre r = controller/action
if (isset(parameters()["r"])) {
	
		$route = parameters()["r"];
	if (strpos($route,"/") === FALSE)
		list($controller, $action) = array($route, "index");
	else
		list($controller, $action) = explode("/", $route);

	$controller = ucfirst($controller)."Ajax";
	$c = new $controller();
	$c->$action();
} else {

	throw new Exception('Trying to access ajaxHandler without specifying any Ajax script');
	
}

?>
