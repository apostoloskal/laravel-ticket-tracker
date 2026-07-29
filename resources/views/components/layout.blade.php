<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - Ticket Tracker' : 'Ticket Tracker' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <!-- Main Content Area -->
    <main>
        {{ $slot }}
    </main>
</body>
</html>