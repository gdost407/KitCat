<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// =============================
// 🔑 LOAD SERVICE ACCOUNT JSON
// =============================
$jsonPath = __DIR__ . '/firebase-service-account.json';

if (!file_exists($jsonPath)) {
    echo json_encode(["status" => "error", "message" => "Service account file missing"]);
    exit;
}

$serviceAccount = json_decode(file_get_contents($jsonPath), true);

$projectId   = $serviceAccount['project_id'];
$clientEmail = $serviceAccount['client_email'];
$privateKey  = $serviceAccount['private_key'];

// =============================
// 🔹 CREATE ACCESS TOKEN (JWT)
// =============================
function getAccessToken($clientEmail, $privateKey) {

    $header = ['alg' => 'RS256', 'typ' => 'JWT'];

    $now = time();

    $payload = [
        'iss' => $clientEmail,
        'scope' => 'https://www.googleapis.com/auth/datastore',
        'aud' => 'https://oauth2.googleapis.com/token',
        'iat' => $now,
        'exp' => $now + 3600
    ];

    $base64UrlEncode = function($data) {
        return rtrim(strtr(base64_encode(json_encode($data)), '+/', '-_'), '=');
    };

    $segments = [];
    $segments[] = $base64UrlEncode($header);
    $segments[] = $base64UrlEncode($payload);

    $signingInput = implode('.', $segments);

    openssl_sign($signingInput, $signature, $privateKey, 'SHA256');

    $segments[] = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

    $jwt = implode('.', $segments);

    // request token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://oauth2.googleapis.com/token");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion' => $jwt
    ]));

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    return $result['access_token'] ?? null;
}

// =============================
// 🔹 FIRESTORE REQUEST
// =============================
function firestoreRequest($url, $accessToken, $method = "GET", $data = null) {

    $ch = curl_init($url);

    $headers = [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json"
    ];

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($method === "POST") {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    if ($method === "DELETE") {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    }

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// =============================
// INPUT
// =============================
$data = json_decode(file_get_contents("php://input"), true);

$chatId   = $data['chatId'] ?? '';
$deletedBy = $data['deletedBy'] ?? '';

if (!$chatId || !$deletedBy) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit;
}

// =============================
// GET ACCESS TOKEN
// =============================
$accessToken = getAccessToken($clientEmail, $privateKey);

if (!$accessToken) {
    echo json_encode(["status" => "error", "message" => "Token failed"]);
    exit;
}

// =============================
// FETCH MESSAGES
// =============================
$queryUrl = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents:runQuery";

$query = [
    "structuredQuery" => [
        "from" => [["collectionId" => "messages"]],
        "where" => [
            "fieldFilter" => [
                "field" => ["fieldPath" => "chatId"],
                "op" => "EQUAL",
                "value" => ["stringValue" => $chatId]
            ]
        ]
    ]
];

$result = firestoreRequest($queryUrl, $accessToken, "POST", $query);

$messages = [];

foreach ($result as $doc) {
    if (isset($doc['document'])) {
        $messages[] = $doc['document'];
    }
}

// =============================
// SAVE BACKUP
// =============================
$backupUrl = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/deleted_chats";

$backupData = [
    "fields" => [
        "chatId" => ["stringValue" => $chatId],
        "deletedBy" => ["stringValue" => $deletedBy],
        "deletedAt" => ["timestampValue" => date("c")],
        "messages" => [
            "arrayValue" => [
                "values" => array_map(function($msg) {
                    return ["mapValue" => ["fields" => $msg['fields']]];
                }, $messages)
            ]
        ]
    ]
];

firestoreRequest($backupUrl, $accessToken, "POST", $backupData);

// =============================
// DELETE MESSAGES
// =============================
foreach ($messages as $msg) {
    $docName = $msg['name'];
    $deleteUrl = "https://firestore.googleapis.com/v1/$docName";
    firestoreRequest($deleteUrl, $accessToken, "DELETE");
}

// =============================
// DONE
// =============================
echo json_encode([
    "status" => "success",
    "message" => "Backup done & messages deleted"
]);
?>
