<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSewa Payment Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-container {
            text-align: center;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .error-container h1 {
            color: #e74c3c;
            font-size: 2.5em;
        }
        .error-container p {
            font-size: 1.2em;
            color: #555;
        }
        .error-message {
            color: #e74c3c;
            font-weight: bold;
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background: #e74c3c;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Payment Failed!</h1>
        <p>Unfortunately, your eSewa payment could not be processed.</p>
        <p class="error-message">Error: Transaction could not be completed. Please try again later.</p>
        <a href=" {{ route('user.payment') }} " class="btn">Try Again</a>
    </div>
</body>
</html>
