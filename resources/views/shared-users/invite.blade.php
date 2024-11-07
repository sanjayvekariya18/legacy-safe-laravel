
<!-- resources/views/emails/invite.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invite to Join</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        h2 {
            color: #4CAF50;
        }
        .button {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>You're Invited to Join Our Platform!</h2>
        <p>Hello,</p>
        <p>You have been invited to join our platform. Please click the link below to register and complete your profile:</p>

        <p>
            <a href="{{ $inviteLink }}" class="button">Join Now</a>
        </p>

        <p>If you didn't request an invitation, please ignore this email.</p>
        <p>Best regards,<br>The Team</p>
    </div>

</body>
</html>
