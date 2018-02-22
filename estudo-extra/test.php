<?php 
    include 'arraysum.php';
    include 'coalescencia.php';
    include 'insert.php';

    echo "arraysum.php <br/>";
    print_r(arraySum([1,54,5],[431,51,2],[532,567,123]));

    echo "<br/><br/>coalescencia.php<br/>";
    echo $username;

    echo "<br/><br/>insert.php<br/>";
    insert(431, "Murollo");   
    echo "executado";

    echo "<br/><br/>nave.php<br/>";
    include 'nave.php';

    echo "<br/><br/>return.php<br/>";
    $return = include 'return.php';
    echo $return;
?>