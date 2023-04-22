<html>
test
</html>
<?php

$rpcEndpoint = 'https://rpc-mainnet.ankr.network';
$contractAddress = '0xc8faF90F8fcA363E261d8d1892A31a636aA1ef5C';

// Build the JSON-RPC request payload
$requestPayload = [
    'jsonrpc' => '2.0',
    'method' => 'eth_call',
    'params' => [
        [
            'to' => $contractAddress,
            'data' => '0x18160ddd'
        ],
        'latest'
    ],
    'id' => 1
];

// Convert the request payload to JSON
$requestJson = json_encode($requestPayload);

// Send the JSON-RPC request to the Ankr RPC endpoint
$ch = curl_init($rpcEndpoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestJson);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($requestJson)
]);
$responseJson = curl_exec($ch);
curl_close($ch);

// Decode the JSON-RPC response
$response = json_decode($responseJson, true);

// Extract the total supply from the response
$totalSupplyHex = $response['result'];
$totalSupply = hexdec($totalSupplyHex) / pow(10, 18); // Convert from wei to ETH

// Output the total supply
echo "Total Supply: $totalSupply ETH\n";
