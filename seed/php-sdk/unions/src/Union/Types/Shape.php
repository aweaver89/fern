<?php

use Seed\Core\Json\JsonSerializableType;
use Seed\Union\Types\Circle;
use Seed\Union\Square;

class Shape extends JsonSerializableType
{
    /**
     * @var 'circle'|'square'|'_unknown' $type 
     */
    public string $type;

    /**
     * @var ?Circle $circle
     */
    public ?Circle $circle;

    /**
     * @var ?Square $square
     */
    public ?Square $square;

    /**
     * @var ?object $_unknown
     */
    public ?object $_unknown;

    /**
     * @param ?array{
     *   type?: 'circle'|'square'|'_unknown',
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
