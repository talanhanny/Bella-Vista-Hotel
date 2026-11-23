<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bella Vista Hotel &amp; Events Place | Home</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Young+Serif&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Design.css">
</head>
<body class="home">

<?php include __DIR__ . '/navbar.php'; ?>

<!-- HERO: change the url(...) on the next line to swap the photo. -->
<section class="hero" style="background-image: url('Pictures/hero-bg.jpg'); background-size: cover; background-position: center;">

    <div class="hero-content">
        <span class="hero-tag">Boutique hotel &amp; events place</span>

        <h1>Welcome to <span>Bella Vista Hotel</span></h1>

        <p>
            Bella Vista combines traditional Filipino hospitality
            with modern comfort and relaxation. Enjoy a peaceful
            and memorable stay with us.
        </p>

        <div class="hero-actions">
            <a href="booking.php" class="btn btn-primary">Book your stay</a>
            <a href="rooms.php" class="btn btn-ghost">See our rooms</a>
        </div>
    </div>

</section>

<!-- QUICK BOOKING BAR: sends the dates to the booking page -->
<form class="quick-book" action="booking.php" method="GET">
    <label class="qb-field">
        <span>Check-in</span>
        <input type="date" name="check_in" id="check_in" required>
    </label>
    <label class="qb-field">
        <span>Check-out</span>
        <input type="date" name="check_out" id="check_out" required>
    </label>
    <label class="qb-field">
        <span>Guests</span>
        <input type="number" name="guests" min="1" max="20" value="2" required>
    </label>
    <button type="submit" class="btn btn-dark">Continue to booking</button>
</form>

<!-- DISCOVER -->
<section class="discover">
    <figure class="discover-art">
        <div class="arch" role="img" aria-label="Bella Vista Hotel"
             style="background-image: url('Pictures/hero-bg.jpg');"></div>
        <figcaption class="arch-note">Since 2021</figcaption>
    </figure>

    <div class="discover-text">
        <h2>Discover Bella Vista</h2>

        <p>
            Bella Vista combines traditional Filipino hospitality
            with modern comfort and relaxation. Enjoy a peaceful
            and memorable stay with us.
        </p>

        <p>
            Bella Vista Hotel &amp; Events Place is a premier eco-chic
            boutique hotel and events destination nestled at the scenic
            foothills of the mountains. It offers a tranquil, elegant,
            and exclusive retreat for families, tourists, and corporate
            clients looking for a peaceful sanctuary away from the
            hustle and bustle of the city.
        </p>

        <a href="aboutus.php" class="btn btn-dark">Learn more</a>
    </div>
</section>

<!-- WHAT WE OFFER -->
<section class="offers">
    <div class="offers-head">
        <h2>What Bella Vista offers</h2>
        <p>
            Everything here is built around rest, cool mountain air,
            and time spent together.
        </p>
    </div>

    <div class="offer-grid">

        <article class="offer">
            <svg viewBox="0 0 32 32" aria-hidden="true">
                <path d="M2 26 L12 10 L18 19 L22 13 L30 26 Z"/>
                <circle cx="24" cy="6" r="2.5"/>
            </svg>
            <h3>Scenic view of mountain hills</h3>
            <p>Wake up to green foothills and layered ridgelines right outside your window.</p>
        </article>

        <article class="offer">
            <svg viewBox="0 0 32 32" aria-hidden="true">
                <path d="M3 11h16a4 4 0 1 0-4-4"/>
                <path d="M3 17h22a4 4 0 1 1-4 4"/>
                <path d="M3 23h10"/>
            </svg>
            <h3>Fresh air</h3>
            <p>Cool mountain breezes and well-ventilated rooms keep every stay light and easy.</p>
        </article>

        <article class="offer">
            <svg viewBox="0 0 32 32" aria-hidden="true">
                <path d="M6 26 C6 12 14 6 27 5 C26 18 20 26 6 26 Z"/>
                <path d="M6 26 L18 14"/>
            </svg>
            <h3>Tranquility</h3>
            <p>A quiet, private retreat made for intimate stays, far from the city rush.</p>
        </article>

        <article class="offer">
            <svg viewBox="0 0 32 32" aria-hidden="true">
                <path d="M3 25V10"/>
                <path d="M3 20h26v5"/>
                <path d="M29 20v-4a4 4 0 0 0-4-4H14v8"/>
                <circle cx="8" cy="15" r="2.5"/>
            </svg>
            <h3>Comfortable rooms</h3>
            <p>Warm, well-kept rooms with everything you need to rest properly.</p>
        </article>

        <article class="offer">
            <svg viewBox="0 0 32 32" aria-hidden="true">
                <path d="M16 3 L19 12 L28 13 L21 19 L23 28 L16 23 L9 28 L11 19 L4 13 L13 12 Z"/>
            </svg>
            <h3>Events and entertainment</h3>
            <p>Space for family gatherings, celebrations, and company team events.</p>
        </article>

    </div>
</section>

<!-- AT A GLANCE -->
<section class="stats" aria-label="Bella Vista at a glance">
    <div class="stat"><strong>2021</strong><span>Welcoming guests since</span></div>
    <div class="stat"><strong>3</strong><span>Room types</span></div>
    <div class="stat"><strong>4</strong><span>Guest amenities</span></div>
    <div class="stat"><strong>&#8369;1,500</strong><span>Rooms from, per night</span></div>
</section>

<!-- CLOSING CALL TO ACTION -->
<section class="stay-cta">
    <div>
        <h2>Planning a getaway or an event?</h2>
        <p>Pick your dates and reserve a room in a few minutes.</p>
    </div>
    <a href="booking.php" class="btn btn-dark">Book your stay</a>
</section>

<footer>
    <p>&copy; 2026 Bella Vista Hotel &amp; Events Place. All Rights Reserved.</p>
</footer>

<script src="JavaScriptt.js"></script>

<!-- BELLA VISTA BACKGROUND MUSIC -->
<audio id="backgroundMusic" loop preload="auto">
    <source src="bella_vista_bgm.mp3" type="audio/mpeg">
</audio>

<button id="musicButton" class="music-toggle"
        aria-label="Play background music"
        title="Play Music">
    <span id="musicIcon">♫</span>
</button>

</body>
</html>