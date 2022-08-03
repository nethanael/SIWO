<?php

    function antecedenteMedicoFIX($antecedente){
        $antecedente = trim($antecedente, "choco");
        return "chocolate";
    }
    
    echo "This is a TRIM test<br>";

    $mistring = "      s         leche con mucho chocolate          s        ";

    $minuevostring = antecedenteMedicoFIX($mistring);

    echo $minuevostring;



?>