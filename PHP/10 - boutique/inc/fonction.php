<?php
//------------------- FONCTION DEBUG -------------------//
function debug($var, $mode = 1)
{
    echo '<div class="col-md-10 offset-md-1 alert alert-info mt-2 mb-2">';
    $trace = debug_backtrace(); // fonction prédéfinie retournant un tableau ARRAy contenant des informations telles que la ligne et le fichier où est exécuté la fonction
    // echo '<pre>'; print_r($trace); echo '</pre>';

    $trace = array_shift($trace); // retire une dimension du tableau ARRAY multidimensionnel
    // echo '<pre>'; print_r($trace); echo '</pre>';

    echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line]<hr>";

    if($mode === 1) // si le mode est à 1, on exécute un print_r
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else // sinon, dans tous les autres cas, quelque soit la valeur de $mode, on exécute un var_dump
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }

    echo '</div>';
}

?>