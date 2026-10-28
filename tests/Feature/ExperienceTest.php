<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExperienceTest extends TestCase
{
    public function test_experiences_overview_links_to_activity_details(): void
    {
        $this->get('/experiences')->assertOk()
            ->assertSee('Dolphin Cruise')
            ->assertSee(route('experiences.show', 'sunset-cruise'));
    }

    public function test_dining_page_is_accessible_from_the_homepage(): void
    {
        $this->get('/')->assertOk()->assertSee(route('dining'));
        $this->get('/dining')->assertOk()->assertSee('Shared tables.');
    }

    public function test_navigation_links_to_each_experience(): void
    {
        $this->get('/')->assertOk()
            ->assertSee(route('experiences.show', 'diving'))
            ->assertSee(route('experiences.show', 'snorkelling'))
            ->assertSee(route('experiences.show', 'dolphin-cruise'))
            ->assertSee(route('experiences.show', 'sunset-cruise'));
    }

    public function test_experience_page_shows_details_and_planning_information(): void
    {
        $this->get('/experiences/dolphin-cruise')->assertOk()
            ->assertSee('Dolphin Cruise')
            ->assertSee('3 photographs')
            ->assertSee('Open gallery:')
            ->assertSee('sightings cannot be guaranteed')
            ->assertSee('Island experiences');
    }

    public function test_unknown_experience_returns_not_found(): void
    {
        $this->get('/experiences/unknown')->assertNotFound();
    }
}
