<?php
$ip_address="180.191.135.187";
$jsondata = file_get_contents("http://timezoneapi.io/api/ip/?" . $ip_address);

// Decode
$data = json_decode($jsondata, true);

// Request OK?
if($data['meta']['code'] == '200'){
    echo json_encode($data['data']);
    // Example: Get the city parameter
    echo "City: " . $data['data']['city'] . "<br>";

    // Example: Get the users time
    echo "Time: " . $data['data']['country'] . "<br>";

}

?>