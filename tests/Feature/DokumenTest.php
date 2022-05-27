<?php

namespace Tests\Feature;

use App\Models\Dokumen;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DokumenTest extends TestCase
{
    use WithFaker;

    public function test_lihat_dokumen()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(url('/api/dokumen'));

        $response->assertStatus(200);
    }

    public function test_tambah_dokumen()
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $Kategori = Kategori::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post(url('/api/dokumen'), [
                'judul' => 'Test Judul',
                'kategori_id' => $Kategori->id,
                'tahun_terbit' => 2001,
                'nama_pengarang' => 'Test Judul',
                'penerbit' => $this->faker->name(),
                'user_id' => $user->id,
                'cover' => $file,
                'abstract_en' => $file,
                'abstract_id' => $file,
                'bab1' => $file,
                'bab2' => $file,
                'bab3' => $file,
                'bab4' => $file,
                'kesimpulan' => $file,
                'daftar_pustaka' => $file,
                'paper' => $file,
                'lembar_persetujuan' => $file,
                'full_dokumen' => $file,
            ]);

        $response->assertStatus(200);
      
    }
    public function test_edit_dokumen()
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $user = User::factory()->create();
        $Dokumen = Dokumen::factory()->create();
        $Kategori = Kategori::factory()->create();
        $response = $this->actingAs($user)
            ->put(url('/api/dokumen', $Dokumen->id), [
                'judul' => 'Test Judul',
                'kategori_id' => $Kategori->id,
                'tahun_terbit' => 2001,
                'nama_pengarang' => 'Test Judul',
                'penerbit' => $this->faker->name(),
                'user_id' => $user->id,
                'cover' => $file,
                'abstract_en' => $file,
                'abstract_id' => $file,
                'bab1' => $file,
                'bab2' => $file,
                'bab3' => $file,
                'bab4' => $file,
                'kesimpulan' => $file,
                'daftar_pustaka' => $file,
                'paper' => $file,
                'lembar_persetujuan' => $file,
                'full_dokumen' => $file,
            ]);

        $response->assertStatus(200);
      
    }
    public function test_hapus_dokumen()
    {
        $Dokumen = Dokumen::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->delete(url('/api/dokumen',$Dokumen->id));

        $response->assertStatus(200);
      
    }
}
