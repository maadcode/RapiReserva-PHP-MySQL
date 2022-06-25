<?php
    $names = array('Juan', 'Ana', 'Lucas');
    print_r($names);
    echo '<br>';
    if(count($names) > 2) {
        echo $names[0];
    }
    // $currentDate = new DateTime('now', new DateTimeZone('America/Lima'));
    // $fromBase = new DateTime('2022-06-24 11:10:20', new DateTimeZone('America/Lima'));
    // $diff = $currentDate->diff($fromBase);
    // $hours = $diff->h;
    // $hours = $hours + ($diff->days*24);
    // $res = var_dump($hours < 24);