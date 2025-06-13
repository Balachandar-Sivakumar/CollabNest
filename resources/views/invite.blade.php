<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Project Invitation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            text-align: center;
        }

        .content {
            padding: 20px;
            color: #333333;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #777;
            text-align: center;
        }

        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="header">
        <h2>Project Invitation</h2>
    </div>

    <div class="content">
        <p>Hi there,</p>

        <p>You have been invited to collaborate on a project titled:</p>

        <p style="font-size: 18px; font-weight: bold; color: #2e7d32;">
            {{ $project->title }}
        </p>

        <p>The project team is excited to have you onboard and contribute your skills!</p>

        <a href="{{ url('/') }}" class="btn">View Project</a>

        <p>If you believe this was a mistake, feel free to ignore this email.</p>
    </div>
</div>

</body>
</html>
