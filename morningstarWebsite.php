<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morningstar Website</title>
    <link rel="stylesheet" href="../Morningstar-School/morningStarWebsite.css">
</head>
<body>
    
    <div class="logo">
        <img src="../Morningstar-School/images/Morningstar_logo.png">
        <h1 class="text">Welcome to the Morningstar Website</h1>
    </div>
    
    <header>
        <button class="sidebar-toggle" id="sidebarToggle">☰</button>
    </header>

    <div class="sidebar" id="sidebar">
        <img src="../Morningstar-School/images/Morningstar_logo.png" class="sidebar-img">
        <div class="sidebar-content">
            <h2 class="but">Menu</h2>
            <ul class="but">
                <li><a href="#">DataBase</a></li>
                <li><a href="#">Users</a></li>
            </ul>
        </div>
    </div>

    <script>
        const toggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('is-active');
        });
    </script>
    
</body>
</html>