<?php
session_start();
include("sudoku-machine.php");
if(isset($_POST['getP'])){
    $data = $_POST['getP'];
    if(sizeof($data)>8){
        $staticVariable = $data;
        build_guessValue();
        solve();
        $final = (array) null;
        foreach($guessVlues as $row){
            $col = (array) null;
            foreach($row as $values){
                $val = (array) null;
                foreach($values as $v){
                    array_push($val, $v);
                }
                array_push($col, $val);
            }
            array_push($final,$col);
        }
        $jsonArray = json_encode($final);
        echo $jsonArray;
    }
}
if(isset($_POST['mydata'])){
    $data = $_POST['mydata'];
    if(sizeof($data)>8){
        $staticVariable = $data;
        build_guessValue();
        solve();
        $jsonArray = json_encode($staticVariable);
        echo $jsonArray;
        $_SESSION['static'] = $staticVariable;
    }
}

?>