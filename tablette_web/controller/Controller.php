<?php

$data = NULL;
$option=null;

class Controller {

	public function __construct() {

	}

	public function render($view, $d=null, $option=null) {
		global $data;
		global $globOption;

		$controller = get_class($this);
		$model = substr($controller, 0, 
			        strpos($controller, "Controller"));
		$data = $d;
		$globOption = $option;
		include_once "view/header.php";
		include_once "view/".strtolower($model)."/".$view.".php";
	}

}

