<?php include '../src/Views/layouts/header.php'; ?>

<h2>Login</h2>
<form action="/login" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<?php include '../src/Views/layouts/footer.php'; ?>
