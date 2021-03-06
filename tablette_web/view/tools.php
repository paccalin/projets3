<?php

function __autoload($name) {

	$dir = "model";
	if (strpos($name,"Controller") !== FALSE)
		$dir = "controller";
	if (strpos($name,"Ajax") !== FALSE)
		$dir = "ajax";
	include_once $dir."/".$name.".php";
}


function flattenArray($pNonFlatArray){
	$flat = array(); // initialize return array
    $stack = array_values($pNonFlatArray); // initialize stack
    while($stack) // process stack until done
    {
        $value = array_shift($stack);
        if (is_array($value)) // a value to further process
        {
            $stack = array_merge(array_values($value), $stack);
        }
        else // a value to take
        {
           $flat[] = $value;
        }
    }
    return $flat;
}

function gereRetour($defaut=null){
	if(isset($_GET['retour'])){
		$retour=str_replace('-','&',$_GET['retour']);
	}else{
		if($defaut!=null){
			$retour=$defaut;
		}else{
			$retour='site/index';
		}
	}
	return $retour;
}

function formatCout($montant){
	return number_format($montant, 0,'',' ');
}

function removeQuote($st){
	return str_replace("'", "\'",$st);
}
?>