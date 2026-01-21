<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 10px; text-align: center; border-bottom: 1px solid #ddd; }
        .content { padding: 20px 0; }
        .footer { margin-top: 20px; padding-top: 10px; border-top: 1px solid #ddd; font-size: 0.8em; text-align: center; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>{{ $subject }}</h2>
        </div>
        <div class="content">
            <p>{!! nl2br(e($content)) !!}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
