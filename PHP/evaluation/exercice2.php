<?php
require_once("include/header.php");

//  Fonction permettant de convertir un montant en euros vers un montant en dollars américains.

function convertion($nombre)
{
    return $nombre*1.17; 
}

echo "500 euros = " . convertion(500) . ' dollars americains' . '<br>';
?>


<?php
require_once("include/footer.php");
?>