<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_redirects_if_not_authenticated()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_dashboard_shows_counts_and_periode()
    {
        $user = User::factory()->create();
        // Seed data
        \App\Models\Kriteria::factory()->count(3)->create();
        \App\Models\Kandidat::factory()->count(2)->create();
        \App\Models\Periode::factory()->create([
            'nama_periode' => 'Periode Test',
            'tanggal_mulai' => '2026-04-01',
            'tanggal_selesai' => '2026-04-30',
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Jumlah Kriteria');
        $response->assertSee('Jumlah Kandidat');
        $response->assertSee('Periode Aktif');
        $response->assertSee('Periode Test');
        $response->assertSee('2026-04-01');
        $response->assertSee('2026-04-30');
        $response->assertSee('aktif');
    }
}
