<?php
include('../backend/connection.php');

// Handle search
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $query = "SELECT * FROM movies 
              WHERE moviename LIKE '%$search%' 
              OR releaseyear LIKE '%$search%' 
              OR language LIKE '%$search%' 
              OR genre LIKE '%$search%' 
              OR rating LIKE '%$search%' 
              OR description LIKE '%$search%'";
} else {
    $query = "SELECT * FROM movies";
}

$res = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Beexellent Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        .table thead {
            color: orange;
        }

        .btn-orange {
            background-color: orange;
            color: white;
        }

        .form-control {
            background-color: #333;
            color: white;
            border: none;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        table thead tr th {
            padding: 20px;
        }

        table tbody tr td {
            padding: 10px 20px;
        }
    </style>
</head>

<body>

    <!-- Navbar/Header -->
    <nav class="navbar navbar-dark bg-dark py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <b class="navbar-brand mb-0 h1">Beexellent Movies</b>

            <!-- Search Bar -->
            <form class="d-flex w-50 mx-auto" method="GET" action="">
                <input class="form-control me-2" type="search" name="search" placeholder="Search movies..."
                    value="<?= htmlspecialchars($search) ?>" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>

            <?php session_start(); ?>
            <!-- Inside navbar -->
            <?php if (isset($_SESSION['admin'])): ?>
                <a href="../backend/index/logout.php" class="btn btn-danger">Logout</a>
            <?php else: ?>
                <a href="../backend/index/login.php" class="btn btn-primary">Admin Login</a>
            <?php endif; ?>

        </div>
    </nav>

    <div class="moviescards">
        <div class="container">
            <div class="row mt-5">
                <div class="card">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Movie Name</th>
                                <th>Year</th>
                                <th>Language</th>
                                <th>Genre</th>
                                <th>Rating</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($res) > 0): ?>
                                <?php while ($data = $res->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?= $data['moviename'] ?></td>
                                        <td><?= $data['releaseyear'] ?></td>
                                        <td><?= $data['language'] ?></td>
                                        <td><?= $data['genre'] ?></td>
                                        <td><?= $data['rating'] ?></td>
                                        <td><?= $data['description'] ?></td>
                                    </tr>
                                <?php } ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No movies found for
                                        "<?= htmlspecialchars($search) ?>"</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const searchInput = document.querySelector('input[name="search"]');
        const searchForm = searchInput.closest('form');

        // Auto-submit form when input becomes empty
        searchInput.addEventListener('input', () => {
            if (searchInput.value.trim() === '') {
                searchForm.submit();
            }
        });

        // Clean URL (remove ?search=...) after search
        if (window.location.search.includes('search=')) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>


</body>

</html>