<div class="detail-photo-gallery" aria-label="{{ $galleryName }} photo gallery">
    <div class="detail-photo-heading"><span class="eyebrow green">A CLOSER LOOK</span><span>{{ count($photos) }} photographs</span></div>
    <div class="detail-photo-layout">
        @foreach ($photos as [$photo, $description])
            <button class="stay-photo detail-photo" type="button" data-photo="{{ $loop->index }}" aria-label="Open gallery: {{ $description }}"><img src="https://images.unsplash.com/{{ $photo }}?auto=format&fit=crop&w=1400&q=85" alt="{{ $description }}" @if (! $loop->first) loading="lazy" @endif>@if ($loop->first)<span class="detail-gallery-cta">VIEW GALLERY </span>@endif</button>
        @endforeach
    </div>
    <p class="detail-photo-note">A glimpse of the experience · Illustrative photography</p>
</div>
<dialog class="stay-gallery-dialog detail-gallery-dialog" aria-label="{{ $galleryName }} photo gallery">
    <div class="stay-gallery-tools"><span id="photo-counter" aria-live="polite"></span><button type="button" data-close aria-label="Close photo gallery">×</button></div><img id="full-photo" alt=""><div class="stay-gallery-tools"><button type="button" data-direction="-1" aria-label="Previous photo">←</button><span>{{ $galleryName }}</span><button type="button" data-direction="1" aria-label="Next photo">→</button></div>
</dialog>
@pushOnce('scripts', 'detail-photo-gallery')
<script src="{{ asset('js/stay.js') }}" defer></script>
@endPushOnce
