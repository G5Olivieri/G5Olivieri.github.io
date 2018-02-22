<?php 
    function arraySum(array ...$arrays): array 
    {
        return array_map(function(array $array): int 
        {
            return array_sum($array);
        }, $arrays);
    }

    
?>