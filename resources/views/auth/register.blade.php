<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<h1>Register</h1>
<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="role">Role</label>
        <select id="role" name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <button type="submit">Register</button>
</form>
</body>
</html>
