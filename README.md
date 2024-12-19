# Web Chat Application

## Overview
This project is a feature-rich web-based chat application built using PHP, HTML, CSS, and JavaScript. It provides real-time messaging, file sharing, voice and video calls, and screen sharing capabilities.

## Features
- **Text Messaging**: Real-time message sending and receiving, typing indicators, and message timestamps.
- **File Sharing**: Upload and send files (images, PDFs, etc.) with previews before sending.
- **Emojis**: An emoji picker for inserting emojis in messages.
- **Voice and Video Calls**: One-on-one voice and video calls.
- **Screen Sharing**: Users can share their screens during a video call.

## Tech Stack
- **Frontend**: HTML, CSS, JavaScript (with WebRTC for voice/video calls and screen sharing)
- **Backend**: PHP for server-side logic
- **Database**: MySQL for user and message storage
- **Real-Time Communication**: WebSocket (using a PHP WebSocket library)

## Installation
1. Clone the repository:
   ```
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```
   cd web-chat-app
   ```
3. Install dependencies using Composer:
   ```
   composer install
   ```
4. Set up the database:
   - Create a MySQL database and import the necessary SQL files (if provided).
   - Update the `.env` file with your database credentials.

5. Start the WebSocket server:
   ```
   php src/websocket/WebSocketServer.php
   ```

6. Open `public/index.html` in your web browser to access the application.

## Usage
- Users can sign up and log in to access the chat interface.
- The chat interface allows users to send messages, share files, and initiate voice/video calls.
- Users can also share their screens during video calls.

## Contributing
Contributions are welcome! Please open an issue or submit a pull request for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for details.