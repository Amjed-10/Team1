<<?php
$api_key = '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';  // استبدل بمفتاح OpenAI API الخاص بك

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userMessage = $_POST['message'];

    $data = [
        'model' => 'gpt-4',  // أو النموذج الذي قمت بتخصيصه
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user', 'content' => $userMessage],
        ],
        'max_tokens' => 150,
        'temperature' => 0.7,
    ];

    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key,
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response !== false) {
        $result = json_decode($response, true);
        $botReply = $result['choices'][0]['message']['content'];
        echo json_encode(['reply' => $botReply]);
    } else {
        echo json_encode(['reply' => 'Error communicating with the chatbot.']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT Custom Bot</title>
    <style>
        .chatbox {
            width: 100%;
            height: 400px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: auto;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        .user-message {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: right;
        }
        .bot-message {
            background-color: #f1f1f1;
            color: black;
            padding: 10px;
            border-radius: 5px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Chat with GPT</h1>
        <div class="chatbox" id="chatbox">
            <!-- الرسائل ستظهر هنا -->
        </div>
        <input type="text" id="chatbot-input" placeholder="Type your question here..." class="form-control">
        <button id="send-btn">Send</button>
    </div>

    <script>
        // وظيفة لإضافة الرسائل إلى الشات بوكس
        function addMessageToChatbox(sender, message) {
            const chatbox = document.getElementById('chatbox');
            const msgElement = document.createElement('div');
            msgElement.classList.add(sender === 'user' ? 'user-message' : 'bot-message');
            msgElement.textContent = message;
            chatbox.appendChild(msgElement);
            chatbox.scrollTop = chatbox.scrollHeight;
        }

        // إرسال الرسالة إلى الـ GPT API
        document.getElementById('send-btn').addEventListener('click', function() {
            const userMessage = document.getElementById('chatbot-input').value;

            if (userMessage.trim() !== "") {
                addMessageToChatbox('user', userMessage);

                fetch('chatbot.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        'message': userMessage
                    })
                })
                .then(response => response.json())
                .then(data => {
                    addMessageToChatbox('bot', data.reply);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

                document.getElementById('chatbot-input').value = '';
            }
        });
    </script>

</body>
</html>
