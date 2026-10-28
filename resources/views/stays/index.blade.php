@extends('offers.layout')
@section('title', 'Rooms')
@section('back-url', route('home'))
@section('back-label', 'Back to The Nest')
@section('content')
<section class="offer-index section-width"><div class="offers-heading"><div><p class="eyebrow green">THE STAY COLLECTION</p><h1 class="heading-one-line">A space to call <em>your own.</em></h1></div><p>Discover our Standard and Deluxe rooms.<br>Find the space that suits your island chapter.</p></div><div class="collection-grid">
@foreach ($categories as $slug => $category)
<article class="collection-card"><a href="{{ route('stays.show', $slug) }}"><img src="https://images.unsplash.com/{{ $category['photos'][0][0] }}?auto=format&fit=crop&w=1100&q=85" alt="{{ $category['photos'][0][1] }}" loading="lazy"><div><p class="eyebrow green">{{ $category['tagline'] }}</p><h2>{{ $category['name'] }}</h2><p>{{ $category['size'] }} · Up to {{ $category['capacity'] }} guests · {{ $category['feature'] }}</p><span class="collection-action">From ${{ number_format($category['price']) }} / night </span></div></a></article>
@endforeach
</div><p class="offers-demo">Illustrative categories, rates, and photography. Explore each stay for details and its gallery.</p></section>
@endsection
