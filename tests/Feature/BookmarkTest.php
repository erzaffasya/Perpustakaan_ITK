<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookmarkTest extends TestCase
{
    // public function test_lihatPrapengajuan()
    // {
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)
    //         ->get(route('PrapengajuanCipta.index'));

    //     $response->assertStatus(200);
    // }

    // public function test_tambahPrapengajuan()
    // {

    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)
    //         ->post(route('PrapengajuanCipta.store'), [
    //             'judul' => 'test',
    //             'user_id' => $user->id,
    //         ]);

    //     $response->assertStatus(302);
    //     $response->assertRedirect(route('PrapengajuanCipta.index'));
    // }

    // public function test_editPrapengajuan()
    // {
    //     $user = User::factory()->create();
    //     // $prapengajuan = PrapengajuanCipta::factory()->create();
    //     $response = $this->actingAs($user)
    //         ->put(route('PrapengajuanCipta.update', 1), [
    //             'judul' => 'test 1',
    //         ]);

    //     $response->assertStatus(302);
    //     $response->assertRedirect(route('PrapengajuanCipta.index'));
    // }
}
