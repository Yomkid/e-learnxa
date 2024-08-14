<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busola Acknowledgment Slip | LearnXa </title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
    margin: 0px;
    padding: 0px;
    text-decoration: none;
    box-sizing: border-box;
    list-style: none;
}
.navbar-brand {
            font-size: 30px;
            font-weight: 700;
            color: black !important;
            text-decoration: none !important;
        }

        .navbar-brand {
            display: inline-block;
            padding-top: .3125rem;
            padding-bottom: .3125rem;
            margin-right: 1rem;
            /* font-size: 1.25rem; */
            line-height: inherit;
            white-space: nowrap;
        }

body {
    margin: 0px;
    padding: 0px;
    font-style: sans-serif, arial;
    background: #ffff;
    /* background: #f2f2f2; */
}

.invoice-body {
    border: solid #011B33 1px;
    /* margin: 50px auto; */
    margin: 0px auto;
    width: 600px;
    background: white;
    /* box-shadow: red 50px; */
    /* padding: 20px; */
}

.invoice-container {
    margin: 20px;
}

.invoice-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    /* border: solid #011B33; */
}

.logo {
    width: 200px;
}

.invoice-head-name {
    /* background-color: #011B33; */
    background-color: #1C7EDA;
    color: #ffff;
    padding: 10px;
    border-radius: 10px 0px 0px 0px;
    font-weight: bold;
    font-size: 24px;
    text-align: center;
}

/* Billing Section */
.bill-group {
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
}

/* Billing Table Section */
.table-section {
    margin-bottom: 40px;
    height: 150px;
    border: solid #011B33 1px;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #f2f2f2
}

th {
    /* background-color: #4CAF50; */
    background-color: #1C7EDA;
    color: white;
}

/* Payment Group Section */
.payment-group {
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
}

/* Invoice Footer */
.invoice-footer {
    background: #1C7EDA;
    color: white;
    padding: 10px 20px;
    display: flex;
    margin-bottom: 0 auto;
}

.online-payment-btn {
    display: flex;
    justify-content: space-between;
}

.pay-card {
    align-items: center;
}

.payment-btn,
button {
    padding: 7px;
    border-radius: 5px;
    /* background: #008000; */
    background: #4CAF50;
    color: white;
    border: solid white 0px;


}

.company-info {
    display: flex;
    justify-content: space-between;
    /* align-items: center; */
    width: 100%;
}

.total {
    padding: 7px;
    width: 100%;
    background: #1C7EDA;
    color: white;
    font-weight: bold;
    font-size: 20px;

}

@media screen and (max-width: 600px) {
    .invoice-body {
        width: 90%;
    }

    .invoice-container {
        margin: 10px;
    }

    .invoice-head {
        flex-direction: column;
        align-items: center;
    }

    .invoice-head-name {
        font-size: 18px;
        margin-top: 10px;
    }

    .bill-group,
    .payment-group {
        flex-direction: column;
        gap: 20px;
    }

    @page {
        size: A4;
    }

    .invoice-body {
        padding: 20px;
    }
}

/* Limit content to fit in a single page */
@page {
    size: A4;
}

.invoice-body {
    padding: 20px;
}

.passportContainer {
    display: flex;
    /* float: right;
    clear: right; */
    /* max-width: 20vh; */
    align-items: baseline;
    justify-content: space-between;
    margin-bottom: 10px;
}

.passCont {
    /* border: 2.5px solid #011B33; */
    border: 2.5px solid #1C7EDA;
    background-color: #ffffff00;
    padding: 0.3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    /* float: right; */
    /* clear: both; */
}

.passCont img {
    width: 117px;
    height: 117px;
    /* height: 100%;
    width: 100%; */
    border-radius: inherit;
    object-fit: cover;
    background: url("./assets/img/login.jpg");
}

.content {
    /* text-align: justify; */
    font-size: 17px;
}
    </style>
</head>

<body>

    <main>
        <div class="invoice-body">
            <!-- ... Your existing invoice content ... -->
            <div class="invoice-container">
                <div class="invoice-head">
                    <div>
                        <!-- <img src="./assets/img/logo.png" alt="logo" class="logo"> -->
                        <a class="navbar-brand nav-logto text-dark" href="https://learnxa.com">Learn<span
                        style="color: #007bff;">X</span>a</a>
                        <h3 style="color:#333">Digital Skills Academy</h3>
                    </div>
                    <div class="invoice-name">
                        <h3 class="invoice-head-name">Acknowledged</h3>
                    </div>
                </div>
                <div>
                    <?php
                    $year = date("Y");
                    $nxtyr = date("Y") + 1;
                    $session = $year . "/" . $nxtyr;
                    ?>
                    <h2>Acknowledgement Slip For <?php echo $session ?> Session</h2>
                </div>
                <!-- <hr> -->
            </div>



            <div class="invoice-name">
                <!-- <h5 class="invoice-head-name">Registration Acknowledgement Slip For <?php //echo $session 
                                                                                            ?> Session</h5> -->
                <h5 class="invoice-head-name">Registration Slip [Batch A]</h5>
            </div>
            <div class="passportContainer" style="margin-top: 5px;">
             
                <p>Dear Busola Fajana,</p>
                <div class="passCont">
                    <img class="passportImg" src="./assets/img/tutor3.jpg" alt="" style="background: url(./assets/img/login.jpg);">
                </div>
            </div>


            <div class="content" style="margin-top: 5px;">
                <p>Congratulations on successfully registering with <strong>LearnXa</strong> Learning Platform! You are now part of a vibrant community of learners dedicated to expanding their tech knowledge.</p>
                <br>
                <div>
                    <div>Here's a quick summary of your registration:</div>
                    
                    <div class="table-responsive">
                        <table class="table table-info">
                            <thead>
                                <tr>
                                    <th scope="col">Details</th>
                                    <th scope="col">Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td scope="row">Application No</td>
                                    <td>LXA/DSA/24/0675</td>
                                </tr>
                                <tr class="">
                                    <td>Full Name</td> 
                                    <td>Damilola Ojelere</td>
                                </tr>
                                <tr class="">
                                    <td>Email</td>
                                    <td>ojeleredamilola@gmail.com</td>
                                </tr>
                                <tr class="">
                                    <td>Gender</td>
                                    <td>Female</td>
                                </tr>
                                <tr class="">
                                    <td>Registration Date</td>  
                                    <td>June 25, 2024</td>
                                </tr>
                                <tr class="">
                                    <td>Course(s) Enrolled</td>
                                    <td>Website Development & Computer Basics</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <br>

                <div>
                    <p>Your commitment to learning is commendable. Our platform offers:</p>
                    <ul>
                        <li>Expertly crafted courses with practical insights.</li>
                        <li>Engaging video lectures, quizzes, and assignments.</li>
                        <li>Interactive discussion forums for collaboration.</li>
                        <li>Regular updates on new courses.</li>
                    </ul>
                </div>
                <br>

                <div>
                    <p>Should you have any questions or need assistance, feel free to reach us at <span><a href="mailto:LearnXa@gmail.com">LearnXa@gmail.com</a></span> or through our website's live chat.</p>
                    <p>Thank you for choosing <strong>LearnXa</strong> for your learning journey!</p>
                    <br>
                    <p>Best regards,</p>
                </div>
                <br>

                <div>
    <div>
        <img src="assets/img/authsign.jpg" alt="C.E.O Signature" width="150">
        <div>
            <h4>Mayomi ODEWAYE</h4>
            <!-- <p>Founder</p> -->
        </div>
    </div>
</div>
                <p><strong>LearnXa</strong> Learning Platform</p>
                <div><a href="https://LearnXa.com">LearnXa.com</a></div>
                <p>Ilaro, Ogun State.</p>

            </div>
    </main>
</body>

</html>