<?php

class SiteController extends Controller {

	public function index() {
		$this->render("index");
	}

	public function aFaire(){
		$this->render("nonRealise");
	}
}


