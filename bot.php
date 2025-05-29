<?php
// chatbot.php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

if (!$userMessage) {
    echo json_encode(['reply' => 'Please enter a message.']);
    exit;
}

$apiKey = 'YOsk-proj-Mb59vRO-VdJDFUg3VNVKHNK4b2qFS_28dATv5Ps0-hNZzUIvrBhfxrL4_BONcGmVN8y2Piwr0oT3BlbkFJAyKXpqDPHL5PogzPCdOyWpBSJUv_EBQhje7jKL_9O2x5N81I5kL0r6ZGxcH1fiZjDSD0G7SqgA';

$data = [
    'model' => 'gpt-4o-mini',
    'messages' => [
        ['role' => 'system', 'content' => 'You are a helpful assistant for a training management system.'],
        ['role' => 'user', 'content' => $userMessage]
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
