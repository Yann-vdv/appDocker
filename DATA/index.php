
<?php
$connection = mysqli_connect("bdd", "root", "root1234") or die(mysqli_connect_error());
echo "Connected to MySQL<br />";

mysqli_close($connection);
?>
<?php

    $url = 'http://api:3000/api/recette/client';

    $token = "#£kc+[¨uuayeizrrtui&/&mdf4£@¤a&-";

    $options = [
        'http' => [
            'method' => 'GET',
            'header' => 'Content-Type: application/json' . "\r\n" .
                    'Authorization: Bearer ' . $token
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, true, $context);

    if ($response === false) {
        echo('error2' . $response);
    } else {
        // Process the response
        echo $response;
    }
?>