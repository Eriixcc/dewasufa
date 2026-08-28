<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dewasufa</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <nav class="navbar">
        <h2>Dewasufa</h2>

        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </div>
    </nav>


    <section id="home" class="hero">

        <div>
            <p class="subtitle">WELCOME TO</p>

            <h1>Dewasufa</h1>

            <p class="description">
                Ini adalah landing page pertama saya menggunakan Laravel.
            </p>

            <a href="#about" class="button">
                Get Started
            </a>
        </div>

    </section>


    <section id="about" class="about">

        <h2>Tentang Dewasufa</h2>

        <p>
            Website ini dibuat menggunakan Laravel,
            Blade, CSS, dan Vite.
        </p>

    </section>


    <footer id="contact">
        <p>© 2026 Dewasufa. All rights reserved.</p>
    </footer>

</body>
</html>