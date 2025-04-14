<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        .content {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4f46e5;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .details {
            margin: 20px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .status {
            display: inline-block;
            padding: 5px 10px;
            background-color: #e5e7eb;
            color: #374151;
            border-radius: 15px;
            font-size: 14px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Booking Confirmation</h1>
        <p>Thank you for choosing our hotel!</p>
    </div>

    <div class="content">
        <p>Dear {{ $booking->user->name }},</p>

        <p>Your booking has been received and is currently pending confirmation. Here are your booking details:</p>

        <div class="details">
            <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
            <p><strong>Room:</strong> {{ $booking->room->name }}</p>
            <p><strong>Check-in Date:</strong> {{ $booking->check_in_date->format('M d, Y') }}</p>
            <p><strong>Check-out Date:</strong> {{ $booking->check_out_date->format('M d, Y') }}</p>
            <p><strong>Number of Guests:</strong> {{ $booking->number_of_guests }}</p>
            <p><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>
            @if($booking->special_requests)
                <p><strong>Special Requests:</strong> {{ $booking->special_requests }}</p>
            @endif
        </div>

        <div class="status">
            Status: Pending Confirmation
        </div>

        <p>You can view your booking details and track its status by clicking the button below:</p>

        <div style="text-align: center;">
            <a href="{{ route('bookings.show', $booking) }}" class="button">View Booking Details</a>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated message, please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>
</html> 