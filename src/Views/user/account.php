<?php include '../src/Views/layouts/header.php'; ?>

<h2>My Account</h2>
<ul>
    <?php foreach ($accommodations as $accommodation): ?>
        <li>
            <?= $accommodation['name']; ?>
            <a href="/remove-accommodation?id=<?= $accommodation['id']; ?>">Remove</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../src/Views/layouts/footer.php'; ?>
