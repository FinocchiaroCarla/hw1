<?php

//ritornerà un json con i risultati dell'api selezionata

    $app_id = '1c7bc491';
    $app_key = '66bce3e1769989a794858ed5acf1ed48';

    $content = urlencode($_GET["q"]);

    $url = 'https://api.edamam.com/api/recipes/v2?type=public&q='.$content.'&app_id='.$app_id.'&app_key='.$app_key;

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $data = curl_exec($ch);

    curl_close($ch);

    echo $data;


?>