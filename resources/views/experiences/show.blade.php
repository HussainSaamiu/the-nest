@extends('offers.layout')
@section('title', $experience['name'])
@section('description', $experience['description'])
@section('back-url', route('experiences.index'))
@section('back-label', 'Island experiences')
@section('content')
<article class="experience-story">
    <header class="experience-story-hero">
        <img src="https://images.unsplash.com/{{ $experience['image'] }}?auto=format&fit=crop&w=2200&q=90" alt="{{ $experience['alt'] }}" fetchpriority="high">
        <div class="experience-story-hero-content section-width">
            <a class="experience-story-back" href="{{ route('experiences.index') }}">← THE EXPERIENCE COLLECTION</a>
            <div class="experience-story-title"><p class="eyebrow">THE NEST · ADDU MEEDHOO</p><h1>{{ $experience['name'] }}</h1><p>{{ $experience['tagline'] }}</p></div>
            <div class="experience-story-hero-bottom"><span>ISLAND LIFE, BEAUTIFULLY UNHURRIED</span><button type="button" data-open-gallery>EXPLORE THE GALLERY </button></div>
        </div>
    </header>
    <section class="experience-story-intro section-width">
        <div><p class="eyebrow green">FOLLOW YOUR CURIOSITY</p><h2 class="heading-one-line">A different <em>perspective.</em></h2></div>
        <div><p>{{ $experience['description'] }}</p><a class="text-link" href="#experience-details">DISCOVER THE DETAILS <span>↓</span></a></div>
    </section>
    <section class="experience-story-gallery section-width" aria-label="Experience photographs">
        @include('offers.gallery', ['photos' => $experience['photos'], 'galleryName' => $experience['name']])
    </section>
    <section class="experience-story-details section-width" id="experience-details">
        <div class="experience-story-details-copy"><p class="eyebrow green">THE EXPERIENCE</p><h2 class="heading-one-line">Moments worth <em>making time for.</em></h2><ol class="experience-story-highlights">@foreach ($experience['highlights'] as $highlight)<li><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><p>{{ $highlight }}</p></li>@endforeach</ol><details class="experience-story-notes"><summary>Before you go <span aria-hidden="true">+</span></summary><p>{{ $experience['note'] }}</p></details></div>
        <aside class="experience-story-plan"><p class="eyebrow">YOUR NEXT CHAPTER</p><h3 class="heading-one-line">Let the island <em>inspire you.</em></h3><p>Begin with your stay. Then confirm the little details of your island experience with The Nest.</p><a href="{{ route('home') }}#booking" class="experience-story-plan-link">PLAN YOUR STAY </a><p class="experience-story-demo">Illustrative experience information. Activities, availability, and prices require confirmation. No booking or payment is processed here.</p></aside>
    </section>
    <div class="experience-story-return section-width"><span class="eyebrow green">THERE IS MORE TO DISCOVER</span><a href="{{ route('experiences.index') }}">Find your next <em>island moment.</em> </a></div>
</article>
@endsection
