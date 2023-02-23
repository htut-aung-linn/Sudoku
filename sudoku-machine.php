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
    GLOBAL $staticVariable;
    for($i=0; $i<9; $i++){
        $tempV = [0,0,0,0,0,0,0,0,0];
        array_push($staticVariable, $tempV);
    }
}

function build_guessValue(){
    GLOBAL $guessVlues, $domain;
    for($i=0; $i<9; $i++){
        $tempG = (array) null;
        for($j=0; $j<9; $j++){
            array_push($tempG, $domain);
        }
        array_push($guessVlues, $tempG);
    }
}

function reduce_guessValue($y , $x, $val){
    GLOBAL $guessVlues;
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

function reduce_guessValue2($val){
    GLOBAL $guessVlues, $staticVariable;
    for($i =0; $i<3; $i++){
        for($j=0; $j<3; $j++){
            $r = [0,0,0];
            $c = [0,0,0];
            for($y = 0; $y<3; $y++){
                for($x = 0; $x<3; $x++){
                    if($staticVariable[($i*3)+$y][($j*3)+$x]==0 && in_array($val, $guessVlues[($i*3)+$y][($j*3)+$x])){
                        $r[$y] += 1; 
                        $c[$x] += 1;
                    }
                }
            }
            if($r[0]==0||$r[1]==0||$r[2]==0 && $r[0]>0){
                if($r[0]==0 && $r[1]==0 && $r[2]>0){
                    for($a = 0; $a <9; $a++){
                        if($a-($j*3)<0 || $a-($j*3)>2){
                            unset($guessVlues[($i*3)+2][$a][array_search($val,$guessVlues[($i*3)+2][$a])]);
                        }
                    }
                }
                if($r[0]==0 && $r[2]==0 && $r[1]>0){
                    for($a = 0; $a <9; $a++){
                        if($a-($j*3)<0 || $a-($j*3)>2){
                            unset($guessVlues[($i*3)+1][$a][array_search($val,$guessVlues[($i*3)+1][$a])]);
                        }
                    }
                }
                if($r[2]==0 && $r[1]==0 && $r[0]>0){
                    for($a = 0; $a <9; $a++){
                        if($a-($j*3)<0 || $a-($j*3)>2){
                            unset($guessVlues[($i*3)][$a][array_search($val,$guessVlues[($i*3)][$a])]);
                        }
                    }
                }
            }
            if($c[0]==0||$c[1]==0||$c[2]==0){
                if($c[0]==0 && $c[1]==0 && $c[2]>0){
                    for($a = 0; $a <9; $a++){
                        if($a-($i*3)<0 || $a-($i*3)>2){
                            unset($guessVlues[$a][($j*3)+2][array_search($val,$guessVlues[$a][($j*3)+2])]);
                        }
                    }
                }
                
                if($c[0]==0 && $c[2]==0 && $c[1]>0){
                    for($a = 0; $a <9; $a++){
                        echo $a." ". (($j*3)+1).", "; 
                        if($a-($i*3)<0 || $a-($i*3)>2){
                            unset($guessVlues[$a][($j*3)+1][array_search($val,$guessVlues[$a][($j*3)+1])]);
                        }
                    }
                }
                if($c[2]==0 && $c[1]==0 && $c[0]>0){
                    for($a = 0; $a <9; $a++){
                        if($a-($i*3)<0 || $a-($i*3)>2){
                            unset($guessVlues[$a][($j*3)][array_search($val,$guessVlues[$a][($j*3)])]);
                        }
                    }
                }
            }
        }
    }
}

function find_least_comflict(){
    GLOBAL $guessVlues, $staticVariable;
    $data = [0,0,10] ;//y , x , $min comflict
    for($i=0; $i<9; $i++){
        for($j=0; $j<9; $j++){
            $tempMin = sizeof($guessVlues[$i][$j]);
            if($tempMin<$data[2] && $tempMin>0 && $staticVariable[$i][$j]==0){
                $data[0] = $i;
                $data[1] = $j;
                $data[2]= $tempMin;
            }
        }
    }
    //var_dump($data);
    return $data;
}

function reduce_all(){
    GLOBAL $staticVariable, $domain, $guessVlues;
    for($i=0; $i<9; $i++){
        for($j=0; $j<9; $j++){
            $guessv = $staticVariable[$i][$j];
            if(in_array($guessv, $guessVlues[$i][$j])){
                reduce_guessValue($i, $j, $guessv);
            }
        }
    }
}

function solve(){
    GLOBAL $guessVlues, $staticVariable;
    $data = find_least_comflict();
    for($i=0; $i<5; $i++){
        prior_knowledge();
        reduce_all();
        for($j=0; $j<9; $j++){
            //reduce_guessValue2($i);
        }
        $data = find_least_comflict();
    }
}

function prior_knowledge(){
    GLOBAL $guessVlues, $staticVariable;
    for($i=0; $i<9; $i++){
        for($j=0; $j<9; $j++){
            //echo var_dump($staticVariable[$i][$j]);
            foreach($guessVlues[$i][$j] as $v){
                if($staticVariable[$i][$j]==0){
                    if(check_prior($i, $j, $v) == 1){
                        $staticVariable[$i][$j] = $v;
                        reduce_guessValue($i, $j, $v);
                        //echo var_dump($i);
                    }
                }
                //echo "1<br>";
            }
        }
    }
}

function check_prior($y , $x, $val){
    GLOBAL $guessVlues, $staticVariable;
    $isPossible = 0;
    /*for($i=0; $i<9; $i++){
        if(in_array($val, $guessVlues[$y][$i]) && $i!=$x){
           $isPossible++;
        }
    }
    for($i=0; $i<9; $i++){
        if(in_array($val, $guessVlues[$i][$x]) && $i!=$y){
            $isPossible++;
        }
    }*/
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
            if(in_array($val, $guessVlues[$withinY+$i][$withinX+$j]) && $staticVariable[$withinY+$i][$withinX+$j]==0){
                $isPossible++;
            }
        }
    }
    //echo $isPossible.$val;
    if($x==3 && $y==5){
        echo $isPossible." ".$val."e<br>";
    }
    return $isPossible;
}


build_stativ();
$staticVariable = [
    [0,0,3,0,9,2,0,0,0],
    [4,0,0,0,3,0,0,1,0],
    [2,7,0,0,0,0,0,0,0],
    [0,1,0,3,0,0,0,0,8],
    [0,5,0,1,6,7,0,3,0],
    [3,0,0,0,0,8,0,6,0],
    [0,0,0,0,0,0,0,5,3],
    [0,3,0,0,8,0,0,0,9],
    [0,0,0,6,2,0,1,0,0]
];
echo "<pre>";
//echo var_dump($staticVariable);
build_guessValue();
//reduce_all();
//prior_knowledge();
//reduce_guessValue2(9);
//prior_knowledge();
//var_dump($guessVlues);
solve();
echo var_dump($staticVariable);
//$pos = find_least_comflict();
//echo var_dump($pos);
?>