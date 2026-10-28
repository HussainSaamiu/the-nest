@extends('offers.layout')
@section('title', 'Island experiences')
@section('back-url', route('home'))
@section('back-label', 'Back to The Nest')
@section('content')
<section class="offer-index section-width"><div class="offers-heading"><div><p class="eyebrow green">ADDU, AT YOUR PACE</p><h1 class="heading-one-line">Days made for <em>remembering.</em></h1></div><p>Discover the water, follow the sunset,<br>and make room for a little wonder.</p></div><div class="collection-grid">
@foreach ($experiences as $slug => $experience)
<article class="collection-card"><a href="{{ route('experiences.show', $slug) }}"><img src="https://images.unsplash.com/{{ $experience['image'] }}?auto=format&fit=crop&w=1100&q=85" alt="{{ $experience['alt'] }}" loading="lazy"><div><p class="eyebrow green">THE NEST · ISLAND LIFE</p><h2>{{ $experience['name'] }}</h2><p>{{ $experience['tagline'] }}</p><span class="collection-action">Discover the experience </span></div></a></article>
@endforeach
</div><p class="offers-demo">Illustrative activities. Arrangements, prices, and availability require confirmation.</p></section>
@endsection
