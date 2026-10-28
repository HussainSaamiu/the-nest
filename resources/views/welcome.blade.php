<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Discover The Nest, a guest house in Addu Meedhoo, Maldives. Explore comfortable rooms, island dining and island experiences.">
    <meta name="theme-color" content="#153f3b">
    <title>The Nest — Addu Meedhoo, Maldives</title>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/hotel.css').'?v='.filemtime(public_path('css/hotel.css')) }}">
    <script src="{{ asset('js/hotel.js') }}" defer></script>
    <script src="{{ asset('js/scroll-reveal.js').'?v='.filemtime(public_path('js/scroll-reveal.js')) }}" defer></script>
    <script src="{{ asset('js/guest-picker.js').'?v='.filemtime(public_path('js/guest-picker.js')) }}" defer></script>
</head>
<body>
<header class="hero" id="home">
    <video id="hero-video" class="hero-video" poster="https://pix8.agoda.net/hotelImages/789/789390/789390_15010413070024307399.jpg?ca=3&amp;ce=1&amp;s=1024x" autoplay muted loop playsinline aria-label="Aerial view of a tropical island and turquoise ocean">
        <source src="https://videos.pexels.com/video-files/2169880/2169880-hd_1920_1080_30fps.mp4" type="video/mp4">
    </video>
    <div class="hero-shade"></div>
    <nav class="navigation brand-navigation" aria-label="Main navigation">
        <a class="wordmark image-wordmark" href="#home" aria-label="The Nest Maldives home"><img src="{{ asset('images/the-nest-logo.png') }}" alt="The Nest — island escape" width="130" height="130" style="display:block;width:100%;max-width:130px;height:auto"></a>
        <div class="nav-links" id="nav-links"><a href="#island">Our island</a><details class="room-dropdown"><summary>Rooms <span aria-hidden="true">⌄</span></summary><div class="room-dropdown-panel"><p class="eyebrow">FIND YOUR SANCTUARY</p>@foreach ($categories as $slug => $category)<a href="{{ route('stays.show', $slug) }}">{{ $category['name'] }}</a>@endforeach<a class="room-dropdown-all" href="{{ route('stays.index') }}">Explore all stays <span aria-hidden="true">→</span></a></div></details><details class="room-dropdown experience-dropdown"><summary>Experiences <span aria-hidden="true">⌄</span></summary><div class="room-dropdown-panel"><p class="eyebrow">DISCOVER YOUR ISLAND</p>@foreach ($experiences as $slug => $experience)<a href="{{ route('experiences.show', $slug) }}">{{ $experience['name'] }}</a>@endforeach<a class="room-dropdown-all" href="{{ route('experiences.index') }}">Explore island experiences <span aria-hidden="true">→</span></a></div></details><a href="{{ route('dining') }}">Dining</a><a href="{{ route('offers.index') }}">Offers</a></div>
        <a class="nav-book" href="#booking">Reserve your stay </a>
        <button class="menu-toggle" aria-label="Open navigation" aria-expanded="false" aria-controls="nav-links">☰</button>
    </nav>
    <div class="hero-bottom"><a href="#island" class="scroll-link">↓ <span>LET THE ISLAND FIND YOU</span></a><span class="coordinates">ADDU MEEDHOO &nbsp; · &nbsp; MALDIVES</span><button id="video-toggle" class="video-toggle" aria-label="Pause background video">Ⅱ</button></div>
</header>
<main>
    <section class="booking-wrap" id="booking" aria-label="Plan your stay">
        <form id="booking-form" class="booking-form">
            <div class="booking-intro"><span class="eyebrow">YOUR ISLAND AWAITS</span><h2>Find your escape.</h2></div>
            <label>CHECK IN<input type="date" id="check-in" required aria-label="Check-in date"></label>
            <label>CHECK OUT<input type="date" id="check-out" required aria-label="Check-out date"></label>
            <label>GUESTS<select id="guests"><option value="2">2 adults</option><option value="1">1 adult</option><option value="3">3 guests</option><option value="4">4 guests</option><option value="6">6 guests</option></select></label>
            <button class="button" type="submit">EXPLORE AVAILABILITY </button>
        </form>
    </section>
    <section class="welcome-note section-width" aria-label="Welcome to The Nest"><p class="eyebrow green">WELCOME TO THE NEST</p><h1>Explore island life,<br class="welcome-mobile-break"> <em>the local Maldivian way.</em></h1><div class="welcome-divider" aria-hidden="true"><span></span><i></i><span></span></div></section>
    <section class="intro section-width" id="island">
        <div class="intro-copy">
            <p class="eyebrow green intro-kicker"><span aria-hidden="true"></span> A MORE PERSONAL MALDIVES</p>
            <h2 class="heading-one-line">A little closer to <em>paradise.</em></h2>
            <p class="intro-lead">An island to discover.<br>A little place to belong.</p>
            <p>Leave the everyday on the horizon. Welcome to The Nest, your guest house in Addu Meedhoo, where thoughtful comfort meets the simple pleasure of island life.</p>
            <p>Slow mornings. Salt in the air. Time to explore, or simply settle in and make yourself at home.</p>
            <a class="intro-discover" href="{{ route('experiences.index') }}"><span>DISCOVER LIFE AT THE NEST</span></a>
            <div class="intro-location"><div><span>ROOTED IN ISLAND LIFE</span><p>Addu Meedhoo, <em>Maldives</em></p></div></div>
        </div>
        <div class="intro-visual">
            <figure class="intro-property"><img src="https://pix8.agoda.net/hotelImages/789/789390/789390_15010413070024307399.jpg?ca=3&amp;ce=1&amp;s=1024x" alt="Guest house exterior, illustrative accommodation photography" loading="lazy"><figcaption>THE NEST <span>ADDU MEEDHOO</span></figcaption></figure>
            <figure class="intro-shore"><img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=650&q=85" alt="A quiet tropical shoreline, illustrative island photography" loading="lazy"><figcaption>A slower kind of <em>beautiful.</em></figcaption></figure>
            <div class="intro-side-note">STAY A LITTLE. FEEL AT HOME.</div>
            <div class="intro-visual-caption"><span aria-hidden="true">01 —</span> YOUR OWN CORNER OF THE MALDIVES</div>
        </div>
    </section>
    <section class="home-discover section-width" id="discover">
        <div class="section-heading"><div><p class="eyebrow green">A GLIMPSE OF THE NEST</p><h2 class="heading-one-line">Your island. <em>Your way.</em></h2></div><p>A place to settle in. A reason to explore.<br>Discover a little more of what awaits.</p></div>
        <div class="home-discover-grid">
            <a class="home-discover-card" href="{{ route('stays.index') }}"><img src="https://pix8.agoda.net/hotelImages/789/789390/789390_15010413070024307399.jpg?ca=3&amp;ce=1&amp;s=1024x" alt="Guest house accommodation" loading="lazy"><div><p class="eyebrow">MAKE YOURSELF AT HOME</p><h3>Rooms</h3><span>FIND YOUR STAY </span></div></a>
            <a class="home-discover-card" href="{{ route('experiences.index') }}"><img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=900&q=85" alt="Discovering the underwater world" loading="lazy"><div><p class="eyebrow">FOLLOW YOUR CURIOSITY</p><h3>Island experiences</h3><span>EXPLORE ADDU </span></div></a>
            <a class="home-discover-card" href="{{ route('offers.index') }}"><img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=85" alt="A tranquil tropical shoreline" loading="lazy"><div><p class="eyebrow">A LITTLE SOMETHING EXTRA</p><h3>Special escapes</h3><span>VIEW OUR OFFERS </span></div></a>
        </div>
    </section>
    <script type="application/json" id="stay-data">{!! json_encode($categories, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
    <section class="closing"><p class="eyebrow">YOUR NEXT CHAPTER BEGINS HERE</p><h2>Find your place <em>at The Nest.</em></h2><a href="#booking" class="button cream-button">FIND YOUR ISLAND ESCAPE </a></section>
</main>
<footer class="footer section-width"><a class="wordmark dark image-wordmark" href="#home"><img src="{{ asset('images/the-nest-logo.png') }}" alt="The Nest — island escape" width="160" height="160" style="display:block;width:100%;max-width:160px;height:auto"></a><p>A world of your own.<br>Addu Meedhoo, Maldives</p><div><a href="{{ route('stays.index') }}">Our rooms</a><a href="{{ route('experiences.index') }}">Island experiences</a><a href="#booking">Plan your stay</a></div><div class="footer-bottom"><span>© {{ date('Y') }} The Nest Maldives · Guest house website</span><span>Static demonstration · Illustrative rates · No reservations or payments processed</span></div></footer>
<dialog id="gallery-dialog" class="gallery-dialog"><button class="dialog-close" aria-label="Close gallery">×</button><div class="gallery-top"><p class="eyebrow green">YOUR PRIVATE SANCTUARY</p><h2 id="gallery-title"></h2></div><div class="gallery-stage"><img id="gallery-image" alt=""><button id="gallery-prev" aria-label="Previous photo">←</button><button id="gallery-next" aria-label="Next photo">→</button></div><div class="gallery-bottom"><span id="gallery-count" aria-live="polite"></span><button id="gallery-book" class="button">PLAN YOUR STAY</button></div></dialog>
<dialog id="booking-dialog" class="booking-dialog"><button class="dialog-close" aria-label="Close booking preview">×</button><p class="eyebrow green">YOUR ISLAND ESCAPE</p><h2>A beautiful <em>beginning.</em></h2><p class="booking-disclaimer">This is a demo booking preview. No reservation has been made. Rates below are illustrative, excluding taxes and transfers.</p><p id="stay-summary"></p><div id="booking-results"></div><button class="text-link" id="change-dates">CHANGE YOUR DATES</button></dialog>
</body>
</html>
