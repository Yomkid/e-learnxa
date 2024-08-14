<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error Message</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    #message {
      position: fixed;
      top: 20px;
      right: -300px; /* Initially hide the message outside the viewport */
      background-color: #f44336; /* Red background for error messages */
      color: white;
      padding: 15px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: right 0.5s ease, opacity 0.5s ease;
      opacity: 0;
    }

    #message.visible {
      right: 20px; /* Slide in the message */
      opacity: 1;
    }
  </style>
</head>
<body>
  <div id="message"><?= session('error') ?></div>

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
