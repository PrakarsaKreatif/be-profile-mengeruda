<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VillageProfileApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test getting the village profile.
     */
    public function test_can_get_village_profile(): void
    {
        $response = $this->getJson('/api/village-profile');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data'
        ]);
    }
}
