@extends('offers.layout')
@section('title', 'Island dining')
@section('back-url', route('home'))
@section('back-label', 'Back to The Nest')
@section('content')
<section class="offer-detail section-width"><div class="offer-detail-top"><div><p class="eyebrow green">A TASTE OF ISLAND LIFE</p><h1 class="heading-one-line">Slow mornings. <em>Shared tables.</em></h1><p class="stay-description">From a relaxed breakfast to discovering local flavours in Addu Meedhoo, make time for the simple pleasure of a good meal.</p></div><img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1400&q=85" alt="An illustrative tropical shoreline"></div><p class="stay-description">Ask The Nest about breakfast arrangements, local dining recommendations, and any dietary requirements before your stay.</p><p class="offers-demo">Sample dining information. Menus, meal inclusions, and special arrangements require confirmation.</p><a class="text-link" href="{{ route('home') }}#booking">PLAN YOUR STAY </a></section>
@endsection
