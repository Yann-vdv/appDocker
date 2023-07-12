
<?php
$connection = mysqli_connect("bdd", "root", "root1234") or die(mysqli_connect_error());
echo "Connected to MySQL<br />";

mysqli_close($connection);
?>
<?php
//phpinfo()

function CallAPI($method, $url, $data = false)
{
    $token = "#£kc+[¨uuayeizrrtui&/&mdf4£@¤a&-";
    $curl = curl_init();
    $authorization = 'Authorization: Bearer'.$token;
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        var_dump($error_msg);
    }
    curl_close($curl);

    return $result;
}
var_dump(CallAPI("GET","http://localhost:3005/api/recette/client"))
?>

