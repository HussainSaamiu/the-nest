<?php

namespace Tests\Feature;

use Tests\TestCase;

class OfferTest extends TestCase
{
    public function test_homepage_links_to_offers_without_listing_individual_packages(): void
    {
        $this->get('/')->assertOk()
            ->assertSee(route('offers.index'))
            ->assertDontSee('Stay a little longer');
    }

    public function test_all_offers_page_lists_each_package_with_its_image_and_link(): void
    {
        $this->get('/offers')->assertOk()
            ->assertSee('Stay a little longer')
            ->assertSee('Something to look forward to')
            ->assertSee('Just the two of you')
            ->assertSee('photo-1507525428034-b723cf961d3e')
            ->assertSee(route('offers.show', 'early-escape'));
    }

    public function test_offer_details_show_inclusions_terms_and_demo_booking_link(): void
    {
        $this->get('/offers/early-escape')->assertOk()
            ->assertSee('3 photographs')
            ->assertSee('Open gallery:')
            ->assertSee('Sample 15% saving on the room rate')
            ->assertSee('Book at least 30 days before arrival.')
            ->assertSee('not applied automatically')
            ->assertSee(route('home').'#booking');
    }

    public function test_unknown_offer_returns_not_found(): void
    {
        $this->get('/offers/unknown-offer')->assertNotFound();
    }
}
