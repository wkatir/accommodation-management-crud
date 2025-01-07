<?php include '../src/Views/layouts/header.php'; ?>

<h1>Create Accommodation</h1>
<form action="/create-accommodation" method="POST">
    <input type="text" name="name" placeholder="Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="text" name="image_url" placeholder="Image URL" required>
    <button type="submit">Create</button>
</form>

<?php include '../src/Views/layouts/footer.php'; ?>
