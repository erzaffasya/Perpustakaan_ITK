<?php

namespace Tests\Feature;

use App\Models\Dokumen;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker ;
use Tests\TestCase;

class PeminjamanTest extends TestCase
{
    use WithFaker;
    public function test_lihat_peminjaman()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(url('/api/peminjaman'));

        $response->assertStatus(200);
    }

    public function test_tambah_peminjaman()
    {

        $user = User::factory()->create();
        $Dokumen = Dokumen::factory()->create();
        $response = $this->actingAs($user)
            ->post(url('/api/peminjaman'), [
                'tgl_peminjaman' => $this->faker->date(),
                'tgl_pengembalian' => $this->faker->date(),
                'status' => 1,
                'dokumen_id' => $Dokumen->id,
                'user_id' => $user->id,
            ]);

        $response->assertStatus(200);
        
    }

    public function test_edit_peminjaman()
    {
        $peminjaman = Peminjaman::factory()->create();
        $user = User::factory()->create();
        $Dokumen = Dokumen::factory()->create();
        $response = $this->actingAs($user)
            ->put(url('/api/peminjaman', $peminjaman->id), [
                'tgl_peminjaman' => $this->faker->date(),
                'tgl_pengembalian' => $this->faker->date(),
                'status' => 0,
                'dokumen_id' => $Dokumen->id,
                'user_id' => $user->id,
            ]);

        $response->assertStatus(200);
        
    }
    public function test_hapus_peminjaman()
    {
        $peminjaman = Peminjaman::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->delete(url('/api/peminjaman',$peminjaman->id));

        $response->assertStatus(200);
        
    }
}
