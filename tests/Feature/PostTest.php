<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $otherUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();
    }

    public function test_post_creation_success(): void
    {
        $response = $this->actingAsUser()->post('/posts', [
            'body' => 'This is a test post.',
        ]);

        $response->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', [
            'body' => 'This is a test post.',
            'user_id' => $this->user->id,
        ]);
    }

    public function test_post_creation_validation_failure(): void
    {
        $this->actingAsUser()
            ->post('/posts', ['body' => ''])
            ->assertSessionHasErrors('body');

        $this->actingAsUser()
            ->post('/posts', ['body' => str_repeat('a', 1001)])
            ->assertSessionHasErrors('body');
    }

    public function test_post_creation_requires_authentication(): void
    {
        $this->post('/posts', [
            'body' => 'This is a test post.',
        ])->assertRedirect('/login');
    }

    public function test_user_can_update_own_post(): void
    {
        $post = $this->createPost();

        $this->actingAsUser()
            ->put(route('posts.update', $post), [
                'body' => 'updated body',
            ])
            ->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'body' => 'updated body',
        ]);
    }

    public function test_user_can_delete_own_post(): void
    {
        $post = $this->createPost();

        $this->actingAsUser()
            ->delete(route('posts.destroy', $post))
            ->assertRedirect();

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }

    public function test_user_cannot_update_other_users_post(): void
    {
        $post = $this->createPost([
            'user_id' => $this->otherUser->id,
        ]);

        $this->actingAsUser()
            ->put(route('posts.update', $post), [
                'body' => 'illegal update',
            ])
            ->assertStatus(403);
    }

    public function test_user_cannot_delete_other_users_post(): void
    {
        $post = $this->createPost([
            'user_id' => $this->otherUser->id,
        ]);

        $this->actingAsUser()
            ->delete(route('posts.destroy', $post))
            ->assertStatus(403);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
        ]);
    }

    private function createPost(array $overrides = []): Post
    {
        return Post::create(array_merge([
            'user_id' => $this->user->id,
            'body' => 'default body',
        ], $overrides));
    }

    private function actingAsUser()
    {
        return $this->actingAs($this->user);
    }

    private function actingAsOtherUser()
    {
        return $this->actingAs($this->otherUser);
    }
}
