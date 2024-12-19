<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/websocket.js" defer></script>
    <script src="../js/webrtc.js" defer></script>
    <script src="../js/app.js" defer></script>
</head>
<body>
    <div class="chat-container">
        <aside class="sidebar">
            <h2>Contacts</h2>
            <ul id="contact-list">
                <!-- Contact list will be populated here -->
            </ul>
        </aside>
        <main class="chat-area">
            <div id="messages" class="messages">
                <!-- Messages will be displayed here -->
            </div>
            <div class="message-input">
                <input type="text" id="message" placeholder="Type a message...">
                <button id="send-btn">Send</button>
                <button id="emoji-btn">😊</button>
                <input type="file" id="file-upload" accept="image/*,application/pdf">
            </div>
        </main>
    </div>
    <div id="call-interface" class="call-interface">
        <!-- Call interface will be displayed here -->
    </div>
</body>
</html>