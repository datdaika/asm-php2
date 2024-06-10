<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <h2>Register</h2>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-warning">
                <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <form action="<?= url('auth/handle_register') ?>" method="POST">
            <div class="mb-3 mt-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>
