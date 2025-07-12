<?php
$payload = file_get_contents("php://input");

$ch = curl_init("https://eoceandigitalconnect.com:9090/v1/api/outgoing/message");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "token: YOUR_EOCEAN_TOKEN",  // Replace this with your actual token
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

header("Content-Type: application/json");
echo $response ?: json_encode([
    "error" => $curl_error,
    "http_code" => $http_code
]);
