<?php include './config/database.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="./image/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap CDN -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <!-- Styles -->
    <link rel="stylesheet" href="./styles.css" />
    <title>PokeGym</title>
  </head>

  <body>
    <header class="mb-5 d-flex justify-content-center">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-sm w-75">
        <div class="container-fluid">
          <a class="navbar-brand ps-5" href="#"
            ><img
              src="./image/PngItem_202182.png"
              alt="Pokemon"
              style="width: 35px"
            />PokeGym
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div
            class="collapse navbar-collapse justify-content-end pe-5"
            id="navbarNav"
          >
            <ul class="navbar-nav nav-underline">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="./index.php"
                  >Home
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link active" href="./about.php">About</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>