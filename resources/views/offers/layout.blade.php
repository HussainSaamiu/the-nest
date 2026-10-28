<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Explore sample island escape packages at The Nest, Addu Meedhoo, Maldives.')">
    <title>@yield('title') — The Nest, Addu Meedhoo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/hotel.css').'?v='.filemtime(public_path('css/hotel.css')) }}">
    <script src="{{ asset('js/scroll-reveal.js').'?v='.filemtime(public_path('js/scroll-reveal.js')) }}" defer></script>
</head>
<body>
    <nav class="stay-navigation" aria-label="Main navigation"><a class="wordmark image-wordmark" href="{{ route('home') }}" aria-label="The Nest Maldives home"><img src="{{ asset('images/the-nest-logo.png') }}" alt="The Nest — island escape" width="108" height="108" style="display:block;width:100%;max-width:108px;height:auto"></a><a class="stay-back" href="@yield('back-url', route('offers.index'))">@yield('back-label', 'All offers')</a><a class="button" href="{{ route('home') }}#booking">PLAN YOUR STAY</a></nav>
    <main>@yield('content')</main>
    @stack('scripts')
    <footer class="stay-footer"><a href="{{ route('home') }}">The Nest · Addu Meedhoo, Maldives</a><p>Static demonstration · Illustrative content and photography</p></footer>
</body>
</html>
