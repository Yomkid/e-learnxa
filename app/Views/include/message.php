<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Message</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    #message {
      position: fixed;
      top: 20px;
      right: -300px; /* Initially hide the message outside the viewport */
      background-color: <?= session('message_type') == 'success' ? '#4caf50' : '#f44336'; ?>;
      color: white;
      padding: 15px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: right 0.5s ease, opacity 0.5s ease;
      opacity: 0;
      z-index: 1030;
    }

    #message.visible {
      right: 20px; /* Slide in the message */
      opacity: 1;
    }

    #loading {
  display: none; /* Hidden by default */
  position: fixed;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  z-index: 1000;
}

.spinner {
  border: 4px solid rgba(0, 0, 0, 0.1);
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border-top-color: #333;
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}
  </style>
</head>
<body>
  <div id="message"><?= session('message') ?></div>

  <script>
    function showMessage() {
      const messageDiv = document.getElementById('message');
      messageDiv.classList.add('visible');

      // Hide the message after 3 seconds
      setTimeout(() => {
        messageDiv.classList.remove('visible');
      }, 3000);
    }

    showMessage();
  </script>
</body>
</html>
