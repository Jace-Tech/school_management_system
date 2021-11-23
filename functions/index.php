<?php


function generateId (int $lenght) {
    $id = "";
    $alpha = 'a';
    $prefix = [];

    for($i = 1; $i <= 26; $i++): 
        array_push($prefix, $alpha++);
    endfor;

    for ($j=0; $j < $lenght - 2 * 3; $j++) { 
        $id .= $prefix[rand(0, 25)];
        $id .= rand(0, 9);
    }

    return $id;

}