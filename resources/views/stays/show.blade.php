<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $category['description'] }}">
    <title>{{ $category['name'] }} — The Nest, Addu Meedhoo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/hotel.css').'?v='.filemtime(public_path('css/hotel.css')) }}">
    <script src="{{ asset('js/stay.js') }}" defer></script>
    <script src="{{ asset('js/scroll-reveal.js').'?v='.filemtime(public_path('js/scroll-reveal.js')) }}" defer></script>
</head>
<body class="stay-page">
    <nav class="stay-navigation" aria-label="Main navigation"><a class="wordmark image-wordmark" href="{{ route('home') }}" aria-label="The Nest Maldives home"><img src="{{ asset('images/the-nest-logo.png') }}" alt="The Nest — island escape" width="108" height="108" style="display:block;width:100%;max-width:108px;height:auto"></a><a class="stay-back" href="{{ route('stays.index') }}">← All stays</a><a class="button" href="{{ route('home') }}#booking">PLAN YOUR STAY</a></nav>
    <main>
        <section class="stay-heading section-width"><p class="eyebrow green">THE NEST · ADDU MEEDHOO</p><h1>{{ $category['name'] }}</h1><p>{{ $category['tagline'] }}</p></section>
        <section class="stay-photo-grid section-width" aria-label="{{ $category['name'] }} photo gallery">
            @foreach ($category['photos'] as [$photo, $description])
                <button type="button" class="stay-photo" data-photo="{{ $loop->index }}" aria-label="Enlarge photo: {{ $description }}"><img src="https://images.unsplash.com/{{ $photo }}?auto=format&fit=crop&w=1400&q=85" alt="{{ $description }}" @if (! $loop->first) loading="lazy" @endif>@if ($loop->first)<span class="gallery-tag">▧ EXPLORE THE GALLERY</span>@endif</button>
            @endforeach
        </section>
        <section class="stay-content section-width"><div><p class="eyebrow green">MAKE YOURSELF AT HOME</p><h2>A space to <em>simply be.</em></h2><p class="stay-description">{{ $category['description'] }}</p><div class="stay-facts"><span>{{ $category['size'] }}<small>YOUR SPACE</small></span><span>{{ $category['capacity'] }} guests<small>MAXIMUM OCCUPANCY</small></span><span>{{ $category['feature'] }}<small>A LITTLE EXTRA</small></span></div><h3>Thoughtful comforts</h3><ul class="stay-amenities">@foreach ($category['amenities'] as $amenity)<li><span aria-hidden="true">✓</span> {{ $amenity }}</li>@endforeach</ul></div><aside class="stay-rate"><p class="eyebrow green">YOUR ISLAND ESCAPE</p><p>From <strong>${{ number_format($category['price']) }}</strong> / night</p><a class="button" href="{{ route('home') }}#booking">CHECK YOUR DATES</a><p class="stay-demo">Illustrative category and photography. Rates are sample prices, excluding taxes and transfers. No reservation is made on this page.</p></aside></section>
        <section class="closing"><p class="eyebrow">FIND YOUR FAVOURITE CORNER</p><h2>More ways to <em>feel at home.</em></h2><a class="button" href="{{ route('stays.index') }}">EXPLORE ALL STAYS</a></section>
    </main>
    <footer class="stay-footer">The Nest · Addu Meedhoo, Maldives · Static demonstration</footer>
    <dialog class="stay-gallery-dialog" aria-label="{{ $category['name'] }} gallery"><div class="stay-gallery-tools"><span id="photo-counter" aria-live="polite"></span><button type="button" data-close aria-label="Close photo gallery">×</button></div><img id="full-photo" alt=""><div class="stay-gallery-tools"><button type="button" data-direction="-1" aria-label="Previous photo">←</button><span>{{ $category['name'] }}</span><button type="button" data-direction="1" aria-label="Next photo">→</button></div></dialog>
</body>
</html>
