<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FiturSpkTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_dashboard_accessible(): void
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_kriteria_list_accessible(): void
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/kriteria');
        $response->assertStatus(200);
    }

    public function test_hasil_ranking_accessible(): void
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/hasil-ranking');
        $response->assertStatus(200);
    }
}
