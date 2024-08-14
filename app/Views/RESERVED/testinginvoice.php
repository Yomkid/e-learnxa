<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Body styles */
        body,
        html {
            margin: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* background-color: #1a1a1a; */
            /* Dark background */
            background-color: rgb(9, 25, 60);
        }

        /* Card Styles */
        .success-card {
            /* background: linear-gradient(135deg, #f3e5f5, #e1bee7); */
            background: linear-gradient(135deg, #ffff, #e1bee7, #ffff);
            border-radius: 20px;
            padding: 30px;
            width: 350px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* Checkmark Circle */
        .checkmark-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #4caf50;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
        }

        .checkmark {
            font-size: 30px;
            color: white;
        }

        /* Title and Subtitle */
        .title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: rgb(9, 25, 60);
        }

        .subtitle {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 30px;
        }

        /* Info Section */
        .info {
            text-align: left;
            margin-bottom: 20px;
        }

        .info .label {
            font-size: 0.8rem;
            color: #999;
        }

        .info .value {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
        }

        .info .status,
        .info .date,
        .info .payment-method {
            margin-bottom: 15px;
        }

        /* Payment Method Details */
        .method-details {
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 10px;
        }

        .card-logo {
            width: 40px;
            margin-right: 10px;
        }

        /* Button */
        #downloadInvoiceBtn {
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="success-card">
            <div class="checkmark-circle">
                <div class="checkmark">✓</div>
            </div>
            <h1 class="title">Payment Successful!</h1>
            <p class="subtitle">We have received your membership request.</p>

            <div class="info">
                <div class="status">
                    <span class="label">Status</span>
                    <span class="value"><i class="bi bi-check-circle-fill text-success"></i> Successful</span>
                </div>
                <div class="date">
                    <span class="label">Date</span>
                    <span class="value">Aug 30, 2023 at 7.58PM</span>
                </div>
                <div class="payment-method">
                    <span class="label">Payment Method</span>
                    <div class="method-details d-flex align-items-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png"
                            alt="Mastercard" class="card-logo">
                        <span class="value">Mastercard<br>Ending in 1887</span>
                    </div>
                </div>
            </div>

            <button id="downloadInvoiceBtn" class="btn btn-dark btn-block mt-4">
                Invoice Download <i class="bi bi-download"></i>
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
    <script>
        document.getElementById('downloadInvoiceBtn').addEventListener('click', function () {
            // Implement the logic to download the invoice
            alert('Invoice download initiated.');
        });
    </script>
</body>

</html>