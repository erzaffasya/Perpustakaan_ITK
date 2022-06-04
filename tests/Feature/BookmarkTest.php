<?php

namespace Tests\Feature;

use App\Models\Bookmark;
use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookmarkTest extends TestCase
{
    public function test_lihat_bookmark()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(url('/api/bookmark'));

        $response->assertStatus(200);
    }

    public function test_tambah_bookmark()
    {

        $user = User::factory()->create();
        $Dokumen = Dokumen::factory()->create();
        $response = $this->actingAs($user)
            ->post(url('/api/bookmark'), [
                'dokumen_id' => $Dokumen->id,
                'user_id' => $user->id,
            ]);

        $response->assertStatus(200);
        // $response->assertRedirect(url('/api/bookmark.index'));
    }

    public function test_edit_bookmark()
    {
        $bookmark = Bookmark::factory()->create();
        $user = User::factory()->create();
        $Dokumen = Dokumen::factory()->create();
        $response = $this->actingAs($user)
            ->put(url('/api/bookmark', $bookmark->id), [
                'dokumen_id' => $Dokumen->id,
                'user_id' => $user->id,
            ]);

        $response->assertStatus(200);
        // $response->assertRedirect(url('/api/bookmark.index'));
    }
    public function test_hapus_bookmark()
    {
        $bookmark = Bookmark::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->delete(url('/api/bookmark',$bookmark->id));

        $response->assertStatus(200);
        // $response->assertRedirect(url('/api/bookmark.index'));
    }
}
