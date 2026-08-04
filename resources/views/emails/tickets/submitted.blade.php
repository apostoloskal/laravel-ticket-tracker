<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    
    <p>We have successfully received your support ticket.</p>
    
    <div style="background-color: #f4f4f5; padding: 15px; border-radius: 5px; margin: 20px 0;">
        <strong>Ticket #:</strong> {{ $ticket->tracking_code }}<br>
        <strong>Subject:</strong> {{ $ticket->title }}
    </div>

    <p>You can view your ticket, add comments, and track our progress at the following link:</p>

    <!-- Generate the full URL to the ticket show page -->
    <a href="{{ route('tickets.show', $ticket) }}" 
       style="display: inline-block; padding: 10px 20px; background-color: #4f46e5; color: #ffffff; text-decoration: none; border-radius: 5px; margin-top: 10px;">
        View Your Ticket
    </a>

    <p style="margin-top: 30px; font-size: 0.9em; color: #666;">
        Thanks,<br>
        The Support Team
    </p>

</body>
</html>