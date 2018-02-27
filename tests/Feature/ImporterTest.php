<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImporterTest extends TestCase
{
    /**
     * Test if it loads ok
     *
     * @return void
     */
    public function testLoadOk()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Should fail on a blank post
     *
     * @return void
     */
    public function testBlankPostFails()
    {
        $response = $this->post('/');
        $response->assertStatus(500);
    }

    /**
     * Will throw an exception if no actual file present
     *
     * @return void
     */
    public function testProcessNoFile(){
        $this->expectException(\Exception::class);
        $dp = new \App\DataProcess(\Illuminate\Http\UploadedFile::fake()->create('document.csv', 1024));
        $dp->processCsv();
    }
}
