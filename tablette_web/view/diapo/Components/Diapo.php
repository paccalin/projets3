<?php
function showDiapo($pPhotoList){
    $returnValue = "";
    $returnValue .= "<ul id='mainCarousel_ul'>";
    $i=0;
    foreach ($pPhotoList as $aPhoto) {
        $returnValue .= "<li class = '".$i."'>";
        $returnValue .= "<img class='diapoImg' src='".$aPhoto->path."'>";
        $returnValue .= "</li>";
        $i++;
    }
    $returnValue .= "</ul>";

    return $returnValue;
}

function showBandeImg($pPhotoList){
    $returnValue = "";
    $returnValue .= "<ul id='bandeCarousel_ul'>";
    $i=0;
    foreach ($pPhotoList as $aPhoto) {
        $returnValue .= "<li class = '".$i."'>";
        $returnValue .= "<img class='diapoImg' src='".$aPhoto->path."'>";
        $returnValue .= "</li>";
        $i++;
    }
    $returnValue .= "</ul>";

    return $returnValue;
}

function showDesc($pPhotoList){
    $returnValue = "";
    $returnValue .= "<ul id='descCarousel_ul'>";
    $i=0;
    foreach ($pPhotoList as $aPhoto) {
        $returnValue .= oneDesc($aPhoto->vehicule, $i);
        $i++;
    }
    $returnValue .= "</ul>";

    return $returnValue;
}

function oneDesc($pVecicule, $i){
    $returnValue = "";
    $returnValue .= "<li class = '".$i."'>";
    $returnValue .= "<div class='aDesc'>";
    if ($pVecicule == null){
        $returnValue .= "<h3>Modèle, Marque</h3>";
        $returnValue .= "<br/>";
        $returnValue .= "<h3>Options:</h3>";
        $returnValue .= "<h4>Aucunes Option</h4>";
    }else{
        $returnValue .= "<h3>".$pVecicule->modele->libelle.", ".$pVecicule->modele->constructeur->libelle."</h3>";
        $returnValue .= "<br/>";
        $returnValue .= "<h3>Options:</h3><br/>";
        if($pVecicule->optionList == null || count($pVecicule->optionList) == 0){
            $returnValue .= "<h4> - Aucunes Option</h4>";
        }
        foreach ($pVecicule->optionList as $anOption) {
            if($anOption != null){
                $returnValue .= "<h4> - ".$anOption->libelle."</h4>";
                $returnValue .= "<p>".$anOption->desc."</p><br/>";
            }else
                $returnValue .= "<h4>error, null option raised</h4>";
        }
    }
    $returnValue .= "</div>";
    $returnValue .= "</li>";
    return $returnValue;
}
?>