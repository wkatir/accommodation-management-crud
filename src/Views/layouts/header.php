<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accommodation Management</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
    <nav>
        <a href="/">Home</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="/account">My Account</a>
            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <a href="/dashboard">Dashboard</a>
            <?php endif; ?>
            <a href="/logout">Logout</a>
        <?php else: ?>
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        <?php endif; ?>
    </nav>
</header>
<main>
