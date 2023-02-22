<?php 
/**
 * Finding solution - algorithm
 * guessValues is three-dimensional array
 * staticVariable is two-dimensional array
 */
$domain = [1,2,3,4,5,6,7,8,9];
$guessVlues = (array) null;
$staticVariable = (array) null;

function build_stativ(){
    for($i=0; $i<9; $i++){
        $tempV = [0,0,0,0,0,0,0,0,0];
        array_push($staticVariable, $tempV);
    }
}

function build_guessValue(){
    for($i=0; $i<9; $i++){
        $tempG = (array) null;
        for($j=0; $j<9; $j++){
            array_push($tempG, $domain);
        }
        array_push($guessVlues, $tempG);
    }
}

function reduce_guessValue($y , $x, $val){
    for($i=0; $i<9; $i++){
        if(in_array($val, $guessVlues[$y][$i])){
            unset($guessVlues[$y][$i][array_search($val,$guessVlues[$y][$i])]);
        }
    }
    for($i=0; $i<9; $i++){
        if(in_array($val, $guessVlues[$i][$x])){
            unset($guessVlues[$i][$x][array_search($val,$guessVlues[$i][$x])]);
        }
    }
    $withinY = 0;
    if($y>2){
        $withinY = 3;
    }
    if($y>5){
        $withinY = 6;
    }
    $withinX = 0;
    if($x>2){
        $withinX = 3;
    }
    if($x>5){
        $withinX = 6;
    }
    for($i =0; $i<3; $i++){
        for($j=0; $j<3; $j++){
            if(in_array($val, $guessVlues[$withinY+$i][$withinX+$j])){
                unset($guessVlues[$withinY+$i][$withinX+$j][array_search($val,$guessVlues[$withinY+$i][$withinX+$j])]);
            }
        }
    }
}




?>