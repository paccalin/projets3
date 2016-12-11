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
?>