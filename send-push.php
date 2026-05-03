<?php
// ==========================================
// PHASE 4 = SEND PUSH FROM PHP BACKEND
// FILE: send-push.php
// Put in your server root
// ==========================================

header("Content-Type: application/json");

// ==========================================
// CONFIG
// ==========================================
$projectId = "asgkitcat";
$serviceAccountFile = __DIR__ . "/firebase-service-account.json";

// ==========================================
// INPUT
// ==========================================
$input = json_decode(file_get_contents("php://input"), true);

$token   = $input["token"]   ?? "";
$title   = $input["title"]   ?? "KitCat";
$body    = $input["body"]    ?? "New Message";
$chatId  = $input["chatId"]  ?? "";
$photo   = $input["photo"]   ?? "";

if (!$token) {
    echo json_encode([
        "status" => false,
        "msg" => "Token missing"
    ]);
    exit;
}

// ==========================================
// GOOGLE ACCESS TOKEN
// ==========================================
function base64url($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function getAccessToken($jsonFile)
{
    $json = json_decode(file_get_contents($jsonFile), true);

    $header = base64url(json_encode([
        "alg" => "RS256",
        "typ" => "JWT"
    ]));

    $now = time();

    $claim = base64url(json_encode([
        "iss"   => $json["client_email"],
        "scope" => "https://www.googleapis.com/auth/firebase.messaging",
        "aud"   => $json["token_uri"],
        "exp"   => $now + 3600,
        "iat"   => $now
    ]));

    $signatureInput = $header . "." . $claim;

    openssl_sign(
        $signatureInput,
        $signature,
        $json["private_key"],
        "SHA256"
    );

    $jwt = $signatureInput . "." . base64url($signature);

    $ch = curl_init($json["token_uri"]);

    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/x-www-form-urlencoded"
        ],
        CURLOPT_POSTFIELDS =>
            "grant_type=urn%3Aietf%3Aparams%3Aoauth%3Agrant-type%3Ajwt-bearer&assertion=" . $jwt
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    return $result["access_token"] ?? "";
}

// ==========================================
// GET ACCESS TOKEN
// ==========================================
$accessToken = getAccessToken($serviceAccountFile);

if (!$accessToken) {
    echo json_encode([
        "status" => false,
        "msg" => "Access token failed"
    ]);
    exit;
}

// ==========================================
// FCM PAYLOAD
// ==========================================
$payload = [
    "message" => [
        "token" => $token,

        "notification" => [
            "title" => $title,
            "body"  => $body
        ],

        "data" => [
            "title"  => $title,
            "body"   => $body,
            "chatId" => $chatId,
            "photo"  => $photo
        ],

        "webpush" => [
            "notification" => [
                "title" => $title,
                "body"  => $body,
                "icon"  => "https://kitcat.aniketgolhar.in/assets/KitCat-Logo.jpg"
            ]
        ]
    ]
];

// ==========================================
// SEND TO FIREBASE
// ==========================================
$url = "https://fcm.googleapis.com/v1/projects/$projectId/messages:send";

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . $accessToken,
        "Content-Type: application/json"
    ],
    CURLOPT_POSTFIELDS => json_encode($payload)
]);

$response = curl_exec($ch);
$error    = curl_error($ch);

curl_close($ch);

// ==========================================
// OUTPUT
// ==========================================
echo json_encode([
    "status" => $error ? false : true,
    "response" => json_decode($response, true),
    "error" => $error
]);