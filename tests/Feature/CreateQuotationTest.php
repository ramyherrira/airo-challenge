<?php

namespace Tests\Feature;

use App\Models\PolicyQuotation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateQuotationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();

        $this->actingAs($user);
    }

    public function test_create_quotation_fails_when_body_params_is_empty()
    {
        $response = $this->postJson('/api/quotation', []);

        $response->assertInvalid(['age', 'currency_id', 'start_date', 'end_date']);
    }

    public function test_create_quotation_fails_when_dates_are_not_valid()
    {
        $response = $this->postJson('/api/quotation', [
            'age' => '25,30',
            'currency_id' => 'EUR',
            'start_date' => '2020-10-01',
            'end_date' => '2019-10-01',
        ]);

        $response->assertInvalid(['end_date']);
    }

    public function test_create_quotation_fails_when_currency_is_invalid()
    {
        $response = $this->postJson('/api/quotation', [
            'age' => '25,30',
            'currency_id' => 'VERY_ISO_EURO',
            'start_date' => '2020-10-01',
            'end_date' => '2020-10-20',
        ]);

        $response->assertInvalid([
            'currency_id' => 'Currency VERY_ISO_EURO is invalid.',
        ]);
    }

    public function test_create_quotation_fails_when_age_list_is_not_valid()
    {
        $response = $this->postJson('/api/quotation', [
            'age' => '35,ff',
            'currency_id' => 'TND',
            'start_date' => '2020-10-01',
            'end_date' => '2020-10-20',
        ]);

        $response->assertInvalid([
            'age' => 'Age list is invalid.',
        ]);

        $response = $this->postJson('/api/quotation', [
            'age' => '35,12,71',
            'currency_id' => 'TND',
            'start_date' => '2020-10-01',
            'end_date' => '2020-10-20',
        ]);

        $response->assertInvalid([
            'age' => 'Age list is invalid.',
        ]);
    }

    public function test_create_quotation_and_records_row_in_db(): void
    {
        $response = $this->postJson('/api/quotation', [
            'age' => '35,28,40,69',
            'currency_id' => 'EUR',
            'start_date' => '2020-10-01',
            'end_date' => '2020-10-30',
        ]);

        $this->assertDatabaseHas(PolicyQuotation::class, [
            'total' => 270.00,
            'currency_id' => 'EUR',
            'start_date' => '2020-10-01',
            'end_date' => '2020-10-30',
        ]);
        $response
            ->assertStatus(201)
            ->assertJson([
                'total' => 270.00,
                'currency_id' => 'EUR',
                'quotation_id' => 1,
            ]);
    }
}
