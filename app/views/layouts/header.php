<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Books CRUD App</title>
</head>

<body class="d-flex flex-column min-vh-100 ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid ">
            <a href="/" class="navbar-brand text-white">Books</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle bg-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= ROOT ?>category">All</a></li>
                            <li><a class="dropdown-item" href="<?= ROOT ?>category/add">Add Category</a></li>
                        </ul>
                    </div>
                    <li class="nav-item">
                        <a href="<?= ROOT ?>book/add" class="nav-link text-white">Add Books</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4 h-100">