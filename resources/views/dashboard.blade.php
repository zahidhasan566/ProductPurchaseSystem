<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<h1>Welcome to the Dashboard</h1>
<p>You are logged in as <strong>{{ auth()->user()->role }}</strong>.</p>
<a href="{{ route('logout') }}">Logout</a>
</body>
</html>
