<?php

namespace Tests\Feature;

use App\Models\URL;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLShortenerTest extends TestCase
{
    use RefreshDatabase;

    public function test_short_url_creation_with_valid_url()
    {
        $response = $this->post(route('shorten'), ['long_url' => 'https://example.com']);
        $response->assertSessionHas('short_url');
        $this->assertDatabaseHas('urls', ['long_url' => 'https://example.com']);
    }

    public function test_invalid_url_rejected()
    {
        $response = $this->post(route('shorten'), ['long_url' => 'not-a-valid-url']);
        $response->assertSessionHasErrors('long_url');
    }

    public function test_short_url_uniqueness()
    {
        URL::factory()->create(['short_code' => 'abcdef']);

        $response = $this->post(route('shorten'), ['long_url' => 'https://unique.com']);
        $response->assertSessionHas('short_url');
        $this->assertDatabaseMissing('urls', ['short_code' => 'abcdefg']);
    }

    public function test_redirect_to_original_url()
    {
        $url = URL::factory()->create(['long_url' => 'https://redirect.com', 'short_code' => 'abc123']);

        $response = $this->get('/abc123');
        $response->assertRedirect('https://redirect.com');
    }

    public function test_non_existent_short_url_redirects_to_404()
    {
        $response = $this->get('/nonexistent');
        $response->assertStatus(404);
    }
}
