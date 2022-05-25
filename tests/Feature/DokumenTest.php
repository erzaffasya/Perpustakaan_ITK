<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DokumenTest extends TestCase
{
    // public function test_lihat_permohonan_review()
    // {
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)
    //         ->get(route('PermohonanReview.index'));

    //     $response->assertStatus(200);
    // }

    // public function test_tambah_permohonan_review()
    // {
    //     Storage::fake('avatars');
 
    //     $file = UploadedFile::fake()->image('avatar.jpg');

    //     $Kategori = KategoriPaten::factory()->create();
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)
    //         ->post(route('PermohonanReview.store'), [
    //             'judul' => 'Test Judul',
    //             'status' => 'Menunggu',
    //             'file' => $file,
    //             'kategori_paten_id' => $Kategori->id,
    //         ]);

    //     $response->assertStatus(302);
    //     // $response->assertRedirect(route('PermohonanReview.index'));
    // }
    // public function test_edit_permohonan_review()
    // {
    //     Storage::fake('avatars'); 
    //     $file = UploadedFile::fake()->image('avatar.jpg');
    //     $user = User::factory()->create();
    //     $Kategori = KategoriPaten::factory()->create();
    //     $Permohonan = PermohonanReview::factory()->create();
    //     $response = $this->actingAs($user)
    //         ->put(route('PermohonanReview.update', $Permohonan->id), [
    //             'judul' => 'Test edit',
    //             'status' => 'Menunggu',
    //             'file' => $file,
    //             'kategori_paten_id' => $Kategori->id,
    //             'user_id' => $user->id
    //         ]);

    //     $response->assertStatus(302);
    //     $response->assertRedirect(route('PermohonanReview.index'));
    // }
    // public function test_hapus_permohonan_review()
    // {
    //     $Permohonan = PermohonanReview::factory()->create();
    //     $Kategori = KategoriPaten::factory()->create();
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)
    //         ->delete(route('PermohonanReview.destroy', $Permohonan->id), [
    //             'judul' => 'Test Judul',
    //             'status' => 'Menunggu',
    //             'kategori_paten_id' => $Kategori->id,
    //         ]);

    //     $response->assertStatus(302);
    //     // $response->assertRedirect(route('PermohonanReview.index'));
    // }
}
