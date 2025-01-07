<?php include '../src/Views/layouts/header.php'; ?>

<h1>Welcome to Accommodation Management</h1>
<p>Explore our accommodations below:</p>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($accommodations as $accommodation): ?>
            <tr>
                <td><?= $accommodation['name']; ?></td>
                <td><?= $accommodation['description']; ?></td>
                <td><img src="<?= $accommodation['image_url']; ?>" alt="<?= $accommodation['name']; ?>" style="width: 100px;"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../src/Views/layouts/footer.php'; ?>
