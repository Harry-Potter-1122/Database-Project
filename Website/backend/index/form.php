<?php

include('../connection.php');

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Beexellent Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

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
            <form class="d-flex w-50 mx-auto">
                <input class="form-control me-2" type="search" placeholder="Search movies..." aria-label="Search">
            </form>

            <!-- Login Button -->
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </nav>

    <div class="movie_section ">
        <div class="container">
            <div class="card bg-secondary text-white p-4 mt-5" style="margin-left: 100px !important;margin-right: 100px !important;">
                <div class="pb-3 d-flex border-bottom border-white mb-2">
                    <b style="font-size: 22px;">Add Movies </b>
                    <a href="list.php" class="btn btn-primary ms-auto"> Movie List</a>
                </div>
                <form action="insert.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Movie Title</label>
                            <input type="text" class="form-control" id="title" name="movietitle" required>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="year" class="form-label">Release Year</label>
                            <input type="text" class="form-control" id="title" name="year" required>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="language" class="form-label">Language</label>
                            <input type="text" class="form-control" id="title" name="language" required>
                        </div>

                        <div class="col-md-12 mt-4">
                            <label for="genre" class="form-label">Genre</label>
                            <input type="text" class="form-control" id="genre" name="genre" required>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" class="form-control" id="rating" name="rating" required>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="Description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>

                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mt-3">Add Movie</button>
                </form>
            </div>
        </div>
    </div>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>