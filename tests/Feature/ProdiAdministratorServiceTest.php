<?php

namespace Tests\Feature;

use App\Services\ProdiAdministratorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProdiAdministratorServiceTest extends TestCase
{

    private ProdiAdministratorService $service;

    public function __construct()
    {
        $this->service = new ProdiAdministratorService();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login_success()
    {
        $this->service->login('tif@gmail.com', 'rahasia');
    }


}
