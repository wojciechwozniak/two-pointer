<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class WaterTrapTest extends TestCase
{
    /**
     * A helper method to call the water trapping calculation directly.
     *
     * @param array $heights
     * @return int
     */
    private function calculateWater(array $heights)
    {
        if(empty($heights) || count($heights) < 3) {
            return 0;
        }
        $left = 0;
        $right = count($heights) - 1;
        $left_max = $heights[$left];
        $right_max = $heights[$right];
        $trapped_water = 0;

        while ($left < $right) {
            if ($heights[$left] < $heights[$right]) {
                $left++;
                $left_max = max($left_max, $heights[$left]);
                $trapped_water += max(0, $left_max - $heights[$left]);
            } else {
                $right--;
                $right_max = max($right_max, $heights[$right]);
                $trapped_water += max(0, $right_max - $heights[$right]);
            }
        }

        return $trapped_water;
    }

    /**
     * Test with sample heights.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample1()
    {
        $heights = [3, 2, 5, 1, 3];
        $expected = 3;

        $result = $this->calculateWater($heights);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test with a different set of heights.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample2()
    {
        $heights = [1, 0, 2, 1, 0, 1, 3, 2, 1, 2, 1];
        $expected = 6;

        $result = $this->calculateWater($heights);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test with no trapped water.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample3()
    {
        $heights = [1, 2, 3, 4, 5];
        $expected = 0;

        $result = $this->calculateWater($heights);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test with equal heights.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample4()
    {
        $heights = [3, 3, 3, 3, 3];
        $expected = 0;

        $result = $this->calculateWater($heights);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test with an empty array.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample5()
    {
        $heights = [];
        $expected = 0;

        $result = $this->calculateWater($heights);
        $this->assertEquals($expected, $result);
    }

    /**
     * Test with a single element.
     *
     * @return void
     */
    public function testCalculateTrappedWaterExample6()
    {
        $heights = [5];
        $expected = 0;

        $result = $this->calculateWater($heights);

        $this->assertEquals($expected, $result);
    }
}
