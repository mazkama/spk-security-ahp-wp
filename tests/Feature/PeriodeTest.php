<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Periode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeriodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_periode()
    {
        $user = User::factory()->create();
        $data = [
            'nama_periode' => 'Periode Uji',
            'tanggal_mulai' => '2026-05-01',
            'tanggal_selesai' => '2026-05-31',
        ];
        $response = $this->actingAs($user)->post(route('periode.store'), $data);
        $response->assertRedirect(route('periode.index'));
        $this->assertDatabaseHas('periode', [
            'nama_periode' => 'Periode Uji',
            'status' => 'draft',
        ]);
    }

    public function test_hanya_satu_periode_aktif()
    {
        $user = User::factory()->create();
        $p1 = Periode::create([
            'nama_periode' => 'P1',
            'tanggal_mulai' => '2026-01-01',
            'tanggal_selesai' => '2026-01-31',
            'status' => 'aktif',
        ]);
        $p2 = Periode::create([
            'nama_periode' => 'P2',
            'tanggal_mulai' => '2026-02-01',
            'tanggal_selesai' => '2026-02-28',
            'status' => 'draft',
        ]);
        $response = $this->actingAs($user)->post(route('periode.set-aktif', $p2->id));
        $this->assertEquals('aktif', $p2->fresh()->status);
        $this->assertEquals('draft', $p1->fresh()->status);
    }
}
