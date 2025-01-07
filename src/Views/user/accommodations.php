<?php include '../src/Views/layouts/header.php'; ?>

<h1>Available Accommodations</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($accommodations as $accommodation): ?>
            <tr>
                <td><?= $accommodation['name']; ?></td>
                <td><?= $accommodation['description']; ?></td>
                <td><img src="<?= $accommodation['image_url']; ?>" alt="<?= $accommodation['name']; ?>" style="width: 100px;"></td>
                <td>
                    <form action="/add-accommodation" method="POST">
                        <input type="hidden" name="accommodation_id" value="<?= $accommodation['id']; ?>">
                        <button type="submit">Add to My Account</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../src/Views/layouts/footer.php'; ?>
