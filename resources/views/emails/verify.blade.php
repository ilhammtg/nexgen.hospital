<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email - NexGenbot Hospital</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color: #f9f9f9;">
    <table width="100%" bgcolor="#f9f9f9" cellpadding="0" cellspacing="0" style="padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" bgcolor="#ffffff" cellpadding="40" cellspacing="0" style="border-radius: 10px;">
                    <tr>
                        <td align="center">
                            <img src="https://res.cloudinary.com/dwuqcgyrl/image/upload/v1746979703/1_wbkwzu.png" alt="NexGenbot Hospital" width="150" style="margin-bottom: 10px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #333;">
                            <h2 style="margin-bottom: 10px;">Hello {{ $user->name }},</h2>
                            <p style="font-size: 16px; margin-bottom: 20px;">
                                Thank you for registering at <strong>NexGenbot Hospital</strong>!<br>
                                Please verify your email address by clicking the button below:
                            </p>
                            <p style="text-align: center;">
                                <a href="{{ $url }}" style="background-color: #00bfa6; color: white; padding: 14px 24px; text-decoration: none; border-radius: 6px; font-size: 16px;">
                                    Verify Email Address
                                </a>
                            </p>
                            <p style="font-size: 14px; margin-top: 30px; color: #666;">
                                This verification link will expire in {{ $expiredMinutes }} minutes.<br>
                                If you did not create an account, no further action is required.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 12px; color: #aaa; margin-top: 30px;">
                            © {{ now()->year }} NexGenbot Hospital. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

