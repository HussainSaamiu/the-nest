@extends('offers.layout')
@section('title', 'Special offers')
@section('content')
    <section class="escape-hero" aria-labelledby="escape-title">
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2400&q=90" alt="Sunlight over a peaceful Maldivian shoreline" fetchpriority="high">
        <div class="escape-hero-copy">
            <p class="eyebrow">THE NEST COLLECTION</p>
            <h1 id="escape-title">A little more <em>island time.</em></h1>
            <p>Thoughtful escapes. Unhurried days. Something just for you.</p>
            <a href="#escape-collection" class="escape-hero-link">DISCOVER OUR OFFERS <span aria-hidden="true">↓</span></a>
        </div>
        <span class="escape-location">ADDU MEEDHOO · MALDIVES</span>
    </section>
    <section class="escape-collection section-width" id="escape-collection" aria-labelledby="collection-title">
        <div class="escape-intro">
            <p class="eyebrow green">STAY A LITTLE. FEEL AT HOME.</p>
            <h2 id="collection-title">An invitation to <em>escape.</em></h2>
            <p>More time to explore. More moments together.<br>Find the little extras that make your stay your own.</p>
        </div>
        <div class="escape-grid">
            @foreach ($offers as $slug => $offer)
                <article class="escape-card">
                    <a href="{{ route('offers.show', $slug) }}">
                        <div class="escape-card-photo">
                            <img src="https://images.unsplash.com/{{ $offer['image'] }}?auto=format&fit=crop&w=1000&q=85" alt="{{ $offer['alt'] }}" loading="lazy">
                            <span class="escape-card-label">{{ $offer['label'] }}</span>
                        </div>
                        <div class="escape-card-copy">
                            <p class="escape-card-stay">{{ $offer['stay'] }}</p>
                            <h3>{{ $offer['name'] }}</h3>
                            <p class="escape-card-summary">{{ $offer['summary'] }}</p>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
        <p class="offers-demo">All offers shown are sample packages. Availability, pricing, and terms require confirmation.</p>
        <div class="escape-personal"><p class="eyebrow green">YOUR OWN KIND OF ISLAND STAY</p><h2>Find your place <em>at The Nest.</em></h2><a class="button" href="{{ route('stays.index') }}">EXPLORE OUR ROOMS <span aria-hidden="true">→</span></a></div>
    </section>
@endsection
