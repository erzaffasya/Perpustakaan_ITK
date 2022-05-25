<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    public function test_lihat_kategori()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(url('/api/kategori'));

        $response->assertStatus(200);
    }

    public function test_tambah_kategori()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post(url('/api/kategori'), [
                'nama_kategori' => 'test',
                'detail' => 'test',
            ]);

        $response->assertStatus(200);
        // $response->assertRedirect(url('/api/kategori'));
    }

    public function test_edit_kategori()
    {
        $user = User::factory()->create();
        // $_kategori = _kategoriCipta::factory()->create();
        $response = $this->actingAs($user)
            ->put(url('/api/kategori', 1), [
                'nama_kategori' => 'test 1',
                'detail' => 'test',
            ]);

        $response->assertStatus(200);
        // $response->assertRedirect(url('/api/kategori'));
    }
}
