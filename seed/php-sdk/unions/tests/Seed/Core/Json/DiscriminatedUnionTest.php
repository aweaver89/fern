<?php

namespace Seed\Tests\Core\Json;

use PHPUnit\Framework\TestCase;
use Seed\Union\Types\Circle;
use Seed\Union\Types\Shape;

class DiscriminatedUnionTest extends TestCase
{
    public function testRoundtripSerde(): void
    {
        $expectedJson = json_encode(
            [
                'type' => 'circle',
                'circle' => [
                    'radius' => 1.0
                ]
            ]
        );

        $circle = Shape::circle(new Circle([
            'radius' => 1.0
        ]));
        $circleJson = $circle->toJson();
        $roundTripCircleObject = Shape::fromJson($circleJson);

        $this->assertJsonStringEqualsJsonString($expectedJson, $circleJson);
        $this->assertIsString($roundTripCircleObject->type, 'type should be a string');
        $this->assertEquals($roundTripCircleObject->type, 'circle', 'Type should be circle');
        $this->assertNotNull($roundTripCircleObject->circle, 'circle must not be null');
        $this->assertNull($roundTripCircleObject->square, 'square must be null');
        $this->assertNull($roundTripCircleObject->_unknown, '_unknown should be null');
        $this->assertEquals($roundTripCircleObject->circle->radius, 1.0, 'radius should match the original definition');
    }

    public function testRoundtripSerdeFlat(): void
    {
        $expectedJson = json_encode(
            [
                'type' => 'circle',
                'radius' => 1.0
            ]
        );

        $circle = Shape::circle(new Circle([
            'radius' => 1.0
        ]));
        $circleJson = $circle->toJson();
        $roundTripCircleObject = Shape::fromJson($circleJson);

        $this->assertJsonStringEqualsJsonString($expectedJson, $circleJson);
        $this->assertIsString($roundTripCircleObject->type, 'type should be a string');
        $this->assertEquals($roundTripCircleObject->type, 'circle', 'Type should be circle');
        $this->assertNotNull($roundTripCircleObject->circle, 'circle must not be null');
        $this->assertNull($roundTripCircleObject->square, 'square must be null');
        $this->assertNull($roundTripCircleObject->_unknown, '_unknown should be null');
        $this->assertEquals($roundTripCircleObject->circle->radius, 1.0, 'radius should match the original definition');
    }
}
