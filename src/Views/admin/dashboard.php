<?php include '../src/Views/layouts/header.php'; ?>

<h2>Admin Dashboard</h2>
<a href="/create-accommodation">Add Accommodation</a>
<ul>
    <?php foreach ($accommodations as $accommodation): ?>
        <li><?= $accommodation['name']; ?></li>
    <?php endforeach; ?>
</ul>

<?php include '../src/Views/layouts/footer.php'; ?>
