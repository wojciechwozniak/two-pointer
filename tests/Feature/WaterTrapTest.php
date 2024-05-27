<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WaterTrapTest extends TestCase
{
    /**
     * Test with sample heights.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample1()
    {
        $response = $this->postJson('/api/calculate', ['heights' => [3, 2, 5, 1, 3]]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'trapped_water' => 3,
            ]);
    }

    /**
     * Test with a different set of heights.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample2()
    {
        $response = $this->postJson('/api/calculate', ['heights' => [1, 0, 2, 1, 0, 1, 3, 2, 1, 2, 1]]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'trapped_water' => 6,
            ]);
    }

    /**
     * Test with no trapped water.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample3()
    {
        $response = $this->postJson('/api/calculate', ['heights' => [1, 2, 3, 4, 5]]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'trapped_water' => 0,
            ]);
    }

    /**
     * Test with equal heights.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample4()
    {
        $response = $this->postJson('/api/calculate', ['heights' => [3, 3, 3, 3, 3]]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'trapped_water' => 0,
            ]);
    }

    /**
     * Test with empty array.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample5()
    {
        $response = $this->postJson('/api/calculate', ['heights' => []]);

        $response
            ->assertStatus(422)
            ->assertJson([
                "message" => "Error 1001: Heights field is required.",
                "errors" => [
                    "heights" => [
                        "Error 1001: Heights field is required."
                    ]
                ]
            ]);
    }

    /**
     * Test with a single element.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample6()
    {
        $response = $this->postJson('/api/calculate', ['heights' => [5]]);

        $response
            ->assertStatus(422)
            ->assertJson([
                "message" => "Error 1003: Heights field must have at least three elements.",
                "errors" => [
                    "heights" => [
                        "Error 1003: Heights field must have at least three elements."
                    ]
                ]
            ]);
    }
    /**
     * Test with sample heights.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample7()
    {
        $response = $this->postJson('/api/calculate', ['heights' => [3, 2, 5, 1, 3]]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'trapped_water' => 3,
            ]);
    }
}
