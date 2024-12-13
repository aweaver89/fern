<?php

use Seed\Union\Types\Circle;
use Seed\Union\Square;

readonly class Shape
{
    /**
     * @var ShapeType $type
     */
    public string $type;

    /**
     * @var ?Circle $circle
     */
    private ?Circle $circle;

    /**
     * @var ?Square $square
     */
    private ?Square $square;

    /**
     * @var ?object $_unknown
     */
    private ?object $_unknown;

    /**
     * @param ?array{
     *   type?: ShapeType,
     *   circle?: ?Circle,
     *   square?: ?Square,
     *   _unknown?: ?object,
     * } $options
     */
    private function __construct(
        private readonly ?array $options = null,
    ) {
        $this->type = $this->options['type'] ?? '_unknown';
        $this->circle = $this->options['circle'] ?? null;
        $this->square = $this->options['square'] ?? null;
        $this->_unknown = $this->options['_unknown'] ?? null;
    }

    /**
     * @param 
     */
    static function circle(
        Circle $circle
    ): Shape {
        return new Shape([
            'type' => 'circle',
            'circle' => $circle
        ]);
    }

    static function square(
        Square $square
    ): Shape {
        return new Shape([
            'type' => 'square',
            'square' => $square
        ]);
    }

    static function _unknown(
        mixed $_unknown
    ): Shape {
        return new Shape([
            'unknown' => $_unknown
        ]);
    }
}
