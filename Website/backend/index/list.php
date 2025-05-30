<?php
include('../connection.php');

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        body {
            background-color: #1c1c1c;
            color: white;
            font-family: 'Poppins', sans-serif;
        }

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

        table tbody tr td,
        table thead tr th {
            background-color: black !important;
            color: white !important;
        }
    </style>
</head>

<body>

    <!-- Navbar/Header -->
    <nav class="navbar navbar-dark bg-dark py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <div class="d-flex align-items-center">
                <b class="navbar-brand mb-0 h1">Beexellent Movies</b>
            </div>

            <!-- Search Bar -->
            <form class="d-flex w-50 mx-auto" method="GET" action="">
                <input class="form-control me-2" type="search" name="search" placeholder="Search movies..."
                    value="<?= htmlspecialchars($search) ?>" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>

            <!-- Logout Button -->
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </nav>

    <main>
        <div class="container mt-2 p-5">
            <div class="bg-secondary text-white p-3 rounded">
                <div class="pb-3 d-flex">
                    <b style="font-size: 22px;">Movies list</b>
                    <a href="form.php" class="btn btn-primary ms-auto">Add Movie</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered bg-secondary text-white">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Movie Name</th>
                                <th>Year</th>
                                <th>Language</th>
                                <th>Genre</th>
                                <th>Rating</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($data = $res->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $data['id'] ?></td>
                                    <td><?= $data['moviename'] ?></td>
                                    <td><?= $data['releaseyear'] ?></td>
                                    <td><?= $data['language'] ?></td>
                                    <td><?= $data['genre'] ?></td>
                                    <td><?= $data['rating'] ?></td>
                                    <td><?= $data['description'] ?></td>
                                    <td>
                                        <a href="delet.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php if (mysqli_num_rows($res) === 0): ?>
                        <div class="alert alert-warning mt-3">No movies found.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

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