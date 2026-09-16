<?php $current = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Macmillan College Student Event Registration System">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' - Macmillan College' : 'Macmillan College'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark site-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <span class="brand-mark"><i class="bi bi-building"></i></span>
            <span>
                <strong>MACMILLAN</strong>
                <small>COLLEGE</small>
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link <?php echo $current === 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link <?php echo $current === 'events.php' ? 'active' : ''; ?>" href="events.php">Events</a></li>
                <li class="nav-item"><a class="nav-link <?php echo $current === 'register.php' ? 'active' : ''; ?>" href="register.php">Register</a></li>
                <li class="nav-item"><a class="nav-link <?php echo $current === 'records.php' ? 'active' : ''; ?>" href="records.php">Records</a></li>
            </ul>
            <div class="nav-motto d-none d-xl-flex">
                <span></span>
                <div>Learning Today<br><em>Leading Tomorrow</em></div>
            </div>
        </div>
    </div>
</nav>
