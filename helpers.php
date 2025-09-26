<?php
function transformPayload($input) {
    $arrival = DateTime::createFromFormat('d/m/Y', $input['Arrival']);
    $departure = DateTime::createFromFormat('d/m/Y', $input['Departure']);

    $guests = array_map(function($age) {
        return ['Age Group' => $age >= 13 ? 'Adult' : 'Child'];
    }, $input['Ages']);

    return [
        'Unit Type ID' => -2147483637,
        'Arrival' => $arrival->format('Y-m-d'),
        'Departure' => $departure->format('Y-m-d'),
        'Guests' => $guests
    ];
}

function callRemoteAPI($payload) {
    $ch = curl_init('https://dev.gondwana-collection.com/Web-Store/Rates/Rates.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        return ['error' => curl_error($ch)];
    }
    curl_close($ch);

    return json_decode($response, true);
}
