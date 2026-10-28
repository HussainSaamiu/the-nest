<article class="offer-card">
    <a href="{{ route('offers.show', $slug) }}" class="offer-card-link">
        <div class="offer-card-image"><img src="https://images.unsplash.com/{{ $offer['image'] }}?auto=format&fit=crop&w=1200&q=85" alt="{{ $offer['alt'] }}" loading="lazy"></div>
        <div class="offer-card-copy">
            <div class="offer-editorial-top"><p class="eyebrow">{{ $offer['label'] }}</p><span aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></div>
            <h3>{{ $offer['name'] }}</h3>
            <p class="offer-summary">{{ $offer['summary'] }}</p>
            <p class="offer-duration"><span aria-hidden="true">—</span> {{ $offer['stay'] }}</p>
            <span class="offer-card-action">EXPLORE THE DETAILS </span>
        </div>
    </a>
</article>
