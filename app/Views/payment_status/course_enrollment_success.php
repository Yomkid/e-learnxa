<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Body styles */
        body,
        html {
            margin: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgb(9, 25, 60);
        }

        /* Card Styles */
        .success-card {
            background: linear-gradient(135deg, #fff, #e1bee7, #fff);
            border-radius: 20px;
            padding: 30px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
        }

        /* Back Icon */
        .back-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 1.5rem;
            color: rgb(9, 25, 60);
            cursor: pointer;
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

        /* Responsive styles */
        @media (max-width: 576px) {
            .container {
                padding: 0 15px;
            }

            .success-card {
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="success-card">
            <i class="fas fa-arrow-left back-icon" id="backBtn"></i>
            <div class="checkmark-circle">
                <div class="checkmark">✓</div>
            </div>
            <h1 class="title">Payment Successful!</h1>
            <p class="subtitle">You have successfully enrolled for the course</p>
            <hr>
            <div class="info">
                <div class="date">
                    <span class="label">Transaction ID</span>
                    <div class="value">TNX_5789345323</div>
                </div>
                <div class="status">
                    <span class="label">Status</span>
                    <div class="value"><i class="fas fa-check-circle text-success"></i> Successful</div>
                </div>

                <div class="date">
                    <span class="label">Date</span>
                    <div class="value">Aug 30, 2023 at 7.58PM</div>
                </div>
                <div class="payment-method">
                    <span class="label">Course Details</span>
                    <div class="method-details d-flex align-items-center">
                        <img src="../assets/img/cplus.jpg" alt="Course Image" class="card-logo">
                        <span class="value">Introduction to Data Analysis using Microsoft Excel</span>
                    </div>
                </div>
            </div>

            <button id="downloadInvoiceBtn" class="btn btn-dark btn-block mt-4">
                Invoice Download <i class="fas fa-download"></i>
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Back button functionality
        document.getElementById('backBtn').addEventListener('click', function () {
            window.history.back();
        });

        // Download Invoice button functionality
        document.getElementById('downloadInvoiceBtn').addEventListener('click', function () {
            alert('Invoice download initiated.');
        });
    </script>
</body>

</html>
