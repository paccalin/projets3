<?php
function showDiapo($pPhotoList){
    $returnValue = "";
    $returnValue .= "<ul id='mainCarousel_ul'>";
    foreach ($pPhotoList as $aPhoto) {
        $returnValue .= "<li>";
        $returnValue .= "<img src='".$aPhoto->path."'>";
        $returnValue .= "</li>";
    }
    $returnValue .= "</ul>";

    return $returnValue;
}

function showBandeImg($pPhotoList){
    $returnValue = "";
    $returnValue .= "<ul id='bandeCarousel_ul'>";
    foreach ($pPhotoList as $aPhoto) {
        $returnValue .= "<li>";
        $returnValue .= "<p>Mdèr</p>";
        $returnValue .= "</li>";
    }
    $returnValue .= "</ul>";

    return $returnValue;
}
?>