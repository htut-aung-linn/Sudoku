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
    GLOBAL $guessVlues, $domain, $staticVariable;
    for($i=0; $i<9; $i++){
        $tempG = (array) null;
        for($j=0; $j<9; $j++){
            array_push($tempG, $domain);
        }
        array_push($guessVlues, $tempG);
    }
    reduce_all();
    for($i=0; $i<9; $i++){
        for($j=0; $j<9; $j++){
            if($staticVariable[$i][$j]!=0){
                foreach($guessVlues[$i][$j] as $var){
                    unset($guessVlues[$i][$j][array_search($var,$guessVlues[$i][$j])]);
                }
            }
        }
    }
}

function reduce_guessValue($y , $x, $val){
    GLOBAL $guessVlues;
    for($i=0; $i<9; $i++){
        if(in_array($val, $guessVlues[$y][$i])){
            unset($guessVlues[$y][$i][array_search($val,$guessVlues[$y][$i])]);
            if($val == 1){
                //echo $y . " ". $i . "," . $val. "rem <br>";
            }
        }
    }
    for($i=0; $i<9; $i++){
        if(in_array($val, $guessVlues[$i][$x])){
            unset($guessVlues[$i][$x][array_search($val,$guessVlues[$i][$x])]);
            if($val == 1){
                //echo $i . " ". $x . "," . $val. "rem <br>";
            }
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
            //for($row=0; $row<)
            for($y = 0; $y<3; $y++){
                for($x = 0; $x<3; $x++){
                    if($staticVariable[($i*3)+$y][($j*3)+$x]==0 && in_array($val, $guessVlues[($i*3)+$y][($j*3)+$x])){
                        $r[$y] += 1; 
                        $c[$x] += 1;
                    }
                }
            }
            if($r[0]==0||$r[1]==0||$r[2]==0 && $r[0]>0){
                if($r[0]==0 && $r[1]==0 && $r[2]>0 && $c[0]<=1 && $c[1]<=1 && $c[2]<=1){
                    for($a = 0; $a <9; $a++){
                        if($a-($j*3)<0 || $a-($j*3)>2){
                            unset($guessVlues[($i*3)+2][$a][array_search($val,$guessVlues[($i*3)+2][$a])]);
                            //echo (($i*3)+2)." ".$a.",";
                        }
                    }
                    //echo $i." ".$j." ".$val."red <br>";
                }
                if($r[0]==0 && $r[2]==0 && $r[1]>0 && $c[0]<=1 && $c[1]<=1 && $c[2]<=1){
                    for($a = 0; $a <9; $a++){
                        if($a-($j*3)<0 || $a-($j*3)>2){
                            unset($guessVlues[($i*3)+1][$a][array_search($val,$guessVlues[($i*3)+1][$a])]);
                            //echo (($i*3)+1)." ".$a.",";
                        }
                    }
                    //echo $i." ".$j." ".$val."red <br>";
                }
                if($r[2]==0 && $r[1]==0 && $r[0]>0 && $c[0]<=1 && $c[1]<=1 && $c[2]<=1){
                    for($a = 0; $a <9; $a++){
                        if($a-($j*3)<0 || $a-($j*3)>2){
                            unset($guessVlues[($i*3)][$a][array_search($val,$guessVlues[($i*3)][$a])]);
                            //echo ($i*3)." ".$a.",";
                        }
                    }
                    //echo $i." ".$j." ".$val."red <br>";
                }
            }
            if($c[0]==0||$c[1]==0||$c[2]==0){
                if($c[0]==0 && $c[1]==0 && $c[2]>0 && $r[0]<=1 && $r[1]<=1 && $r[2]<=1){
                    for($a = 0; $a <9; $a++){
                        if($a-($i*3)<0 || $a-($i*3)>2){
                            unset($guessVlues[$a][($j*3)+2][array_search($val,$guessVlues[$a][($j*3)+2])]);
                            //echo $a." ".(($j*3)+2).",";
                        }
                    }
                   //echo $i." ".$j." ".$val."red <br>";
                }
                
                if($c[0]==0 && $c[2]==0 && $c[1]>0 && $r[0]<=1 && $r[1]<=1 && $r[2]<=1){
                    for($a = 0; $a <9; $a++){
                        if($a-($i*3)<0 || $a-($i*3)>2){
                            unset($guessVlues[$a][($j*3)+1][array_search($val,$guessVlues[$a][($j*3)+1])]);
                            //echo $a." ".(($j*3)+1).",";
                        }
                    }
                    //echo $i." ".$j." ".$val."red <br>";
                }
                if($c[2]==0 && $c[1]==0 && $c[0]>0 && $r[0]<=1 && $r[1]<=1 && $r[2]<=1){
                    //if($val == 5){
                     //   var_dump($c);
                    //    var_dump($r);
                    //}
                    for($a = 0; $a <9; $a++){
                        if($a-($i*3)<0 || $a-($i*3)>2){
                            unset($guessVlues[$a][($j*3)][array_search($val,$guessVlues[$a][($j*3)])]);
                            //echo $a." ".($j*3).",";
                        }
                    }
                    //echo $i." ".$j." ".$val."red <br>";
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
    //$data = find_least_comflict();
    $do = true;
    while($do){
        //echo "com <br>";
        $do = false;
        $tempStatic =array_replace([],$staticVariable);
        prior_knowledge();
        for($y = 0; $y<9; $y++){
            for($x = 0; $x<9; $x++){
                $a = $staticVariable[$y][$x];
                $b = $tempStatic[$y][$x];
                if($a != $b){
                    $do = true;
                }
            }
        }
    }
}

function prior_knowledge(){
    GLOBAL $guessVlues, $staticVariable;
    for($i=0; $i<9; $i++){
        for($j=0; $j<9; $j++){
            //echo var_dump($staticVariable[$i][$j]);
            if(sizeof($guessVlues[$i][$j]) == 1){
                foreach($guessVlues[$i][$j] as $v){
                    //echo $i." ".$j." ".$v."ab<br>";
                    $staticVariable[$i][$j] = $v;
                    reduce_guessValue($i, $j, $v);
                }
            }
            foreach($guessVlues[$i][$j] as $v){
                if($staticVariable[$i][$j]==0){
                    if(check_prior($i, $j, $v) == 1 || check_prior_row($i, $j, $v) == 1 || check_prior_col($i, $j, $v) == 1 ){
                        //echo var_dump((check_prior_row($i, $j, $v) == 1));
                        $staticVariable[$i][$j] = $v;
                        reduce_guessValue($i, $j, $v);
                        //echo $i." ".$j." ".$v."<br>";
                        foreach($guessVlues[$i][$j] as $var){
                            unset($guessVlues[$i][$j][array_search($var,$guessVlues[$i][$j])]);
                        }
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
    return $isPossible;
}

function check_prior_row($y , $x, $val){
    GLOBAL $guessVlues, $staticVariable;
    $isPossible = 0;
    for($i =0; $i<9; $i++){
        if(in_array($val, $guessVlues[$y][$i]) && $staticVariable[$y][$i]==0){
            $isPossible++;
        }
    }
    return $isPossible;
}
function check_prior_col($y , $x, $val){
    GLOBAL $guessVlues, $staticVariable;
    $isPossible = 0;
    for($i =0; $i<9; $i++){
        if(in_array($val, $guessVlues[$i][$x]) && $staticVariable[$i][$x]==0){
            $isPossible++;
        }
    }
    return $isPossible;
}

build_stativ();
$staticVariable = [
    [5,3,0,0,7,0,0,0,0],
    [6,0,0,1,9,5,0,0,0],
    [0,9,8,0,0,0,0,6,0],
    [8,0,0,0,6,0,0,0,3],
    [4,0,0,8,0,3,0,0,1],
    [7,0,0,0,2,0,0,0,6],
    [0,6,0,0,0,0,2,8,0],
    [0,0,0,4,1,9,0,0,5],
    [0,0,0,0,8,0,0,7,9]
];
//echo "<pre>";
build_guessValue();
solve();
//echo "know <br>";
//print_guess();
//prior_knowledge();
print_static();
//reduce_guessValue2(1);
//print_guess();
//reduce_all();
function print_guess(){
    GLOBAL $guessVlues, $staticVariable;
    for($v = 1 ; $v< 10 ; $v++){
        echo $v . "<br>";
        for($i = 0 ; $i< 9 ; $i++){
            for($j = 0 ; $j< 9 ; $j++){
                if($staticVariable[$i][$j]!=0){
                    echo $staticVariable[$i][$j]." ";
                }
                else if(in_array($v, $guessVlues[$i][$j])){
                    echo "T ";
                }else{
                    echo "F ";
                }
            }
            echo "<br>";
        }
    }
}
function print_static(){
    GLOBAL $staticVariable;
    echo " tables <br>";
    for($i = 0 ; $i< 9 ; $i++){
        for($j = 0 ; $j< 9 ; $j++){
            echo $staticVariable[$i][$j]." ";
        }
        echo "<br>";
    }
}

//$pos = find_least_comflict();
//echo var_dump($pos);
?>