<?php

namespace Tests\Feature;

use Tests\TestCase;

class StayCategoryTest extends TestCase
{
    public function test_stays_overview_links_to_room_details(): void
    {
        $this->get('/stays')->assertOk()
            ->assertSee('Standard Room')
            ->assertSee('Deluxe Room')
            ->assertSee(route('stays.show', 'standard'))
            ->assertSee(route('stays.show', 'deluxe'))
            ->assertDontSee('Beach Pool Villa')
            ->assertDontSee('Island Residence');
    }

    public function test_homepage_links_to_category_detail_pages(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee(route('stays.show', 'standard'))
            ->assertSee('Standard Room');
    }

    public function test_category_page_shows_its_details_amenities_and_gallery(): void
    {
        $response = $this->get('/stays/standard');

        $response->assertOk()
            ->assertSee('Standard Room')
            ->assertSee('En-suite bathroom')
            ->assertSee('photo-1611892440504-42a792e24d32')
            ->assertSee('Addu Meedhoo');
    }

    public function test_unknown_category_returns_not_found(): void
    {
        $this->get('/stays/unknown-category')->assertNotFound();
        $this->get('/stays/beach')->assertNotFound();
        $this->get('/stays/deluxe')->assertOk()->assertSee('Deluxe Room');
    }

    public function test_new_category_is_available_without_new_routes_or_templates(): void
    {
        $category = config('stays.standard');
        $category['name'] = 'Courtyard Suite';
        config(['stays.courtyard' => $category]);

        $this->get('/')->assertOk()->assertSee(route('stays.show', 'courtyard'));
        $this->get('/stays/courtyard')->assertOk()->assertSee('Courtyard Suite');
    }
}
