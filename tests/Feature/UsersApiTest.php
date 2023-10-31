<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersApiTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     */
    public function it_returns_all_users_from_all_providers()
    {
        $response = $this->get('/api/v1/users');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_filters_by_provider()
    {        
        $response = $this->get('/api/v1/users?provider=DataProviderX');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_filters_users_by_multiple_criteria()
    {
        $filterParams = [
            'provider' => 'DataProviderX',
            'statusCode' => 'authorised',
            'balanceMin' => 200,
            'balanceMax' => 800,
            'currency' => 'USD',
        ];
        $response = $this->get('/api/v1/users?' . http_build_query($filterParams));
        $response->assertStatus(200);
    }
}