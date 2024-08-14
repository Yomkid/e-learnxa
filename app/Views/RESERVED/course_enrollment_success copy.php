<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Montserrat', sans-serif;
        }

        .card {
            border: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .payment-details {
            margin-top: 20px;
        }

        .success-message {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }

        .show {
            opacity: 1;
            transform: translateY(0);
        }

        .lottie-animation {
            width: 200px;
            height: 200px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="display-4 text-success success-message">Payment Successful!</h1>
                        <lottie-player src="path/to/confetti.json" mode="autoplay" class="lottie-animation">
                        </lottie-player>
                        <p class="lead">Your payment has been processed successfully.</p>
                        <div class="payment-details">
                        </div>
                        <a href="#" class="btn btn-primary mt-3">Start Your Course</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@lottie/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="script.js"></script>
    <script>
        // Example: Displaying dynamic payment details
        const paymentDetails = document.querySelector('.payment-details');
        // Assuming you have payment data
        const paymentData = {
            amount: 199.99,
            transactionId: 'TXN123456',
            date: '2023-11-22'
        };

        paymentDetails.innerHTML = `
    <p>Amount paid: $${paymentData.amount}</p>
    <p>Transaction ID: ${paymentData.transactionId}</p>
    <p>Payment Date: ${paymentData.date}</p>
`;

        // Example: Adding 'show' class to success message after a delay
        setTimeout(() => {
            document.querySelector('.success-message').classList.add('show');
        }, 500); // Adjust delay as needed
    </script>
</body>

</html>