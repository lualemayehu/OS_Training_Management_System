<?php
// chatbot.php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

if (!$userMessage) {
    echo json_encode(['reply' => 'Please enter a message.']);
    exit;
}

$apiKey = 'apikey'
$data = [
    'model' => 'gpt-4o-mini',
    'messages' => [
        [
            'role' => 'system',
            'content' => 'You are an educational assistant. You only respond to questions related to education, such as learning, courses, training, academic subjects, teaching methods, and skill development. If the user asks anything not related to education, kindly respond that you only provide educational content.'
        ],
        [
            'role' => 'user',
            'content' => $userMessage
        ]
    ],
    'max_tokens' => 150,
];


$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    "Authorization: Bearer $apiKey"
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(['reply' => 'Error communicating with API.']);
    curl_close($ch);
    exit;
}

curl_close($ch);

$responseData = json_decode($response, true);
$chatGptReply = $responseData['choices'][0]['message']['content'] ?? 'No response from API.';

echo json_encode(['reply' => $chatGptReply]);
