<?php
// Configuration settings for the web chat application

// Application settings
define('APP_NAME', 'Web Chat Application');
define('APP_VERSION', '1.0.0');

// Database settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'web_chat_app');
define('DB_USER', 'root');
define('DB_PASS', ''); // Change this to your database password

// WebSocket settings
define('WEBSOCKET_HOST', 'localhost');
define('WEBSOCKET_PORT', 8080);

// Other settings
define('UPLOAD_DIR', __DIR__ . '/../public/images/uploads/');
define('MAX_FILE_SIZE', 10485760); // 10 MB
?>