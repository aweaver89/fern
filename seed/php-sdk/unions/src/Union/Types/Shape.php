<?php

namespace Seed\Union\Types;

use Seed\Core\Json\JsonProperty;
use Seed\Core\Json\JsonSerializableType;
use Seed\Union\Types\Circle;
use Seed\Union\Types\Square;

class Shape extends JsonSerializableType
{
    /**
     * @var 'circle'|'square'|'_unknown' $type 
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var ?Circle $circle
     */
    #[JsonProperty('circle')]
    public ?Circle $circle;

    /**
     * @var ?Square $square
     */
    #[JsonProperty('square')]
    public ?Square $square;

    /**
     * @var mixed $_unknown
     */
    public mixed $_unknown;

    /**
     * @param ?array{
     *   type?: 'circle'|'square'|'_unknown',
     *   circle?: ?Circle,
     *   square?: ?Square,
     *   _unknown?: mixed,
     * } $options
     */
    public function __construct(
        private readonly ?array $options = null,
    ) {
        $this->type = $this->options['type'] ?? '_unknown';
        $this->circle = $this->options['circle'] ?? null;
        $this->square = $this->options['square'] ?? null;
        $this->_unknown = $this->options['_unknown'] ?? null;
    }

    public static function circle(
        Circle $circle
    ): Shape {
        return new Shape([
            'type' => 'circle',
            'circle' => $circle
        ]);
    }

    public static function square(
        Square $square
    ): Shape {
        return new Shape([
            'type' => 'square',
            'square' => $square
        ]);
    }

    public static function _unknown(
        mixed $_unknown
    ): Shape {
        return new Shape([
            '_unknown' => $_unknown
        ]);
    }

    public function asCircle(): Circle
    {
        if ($this->type == 'circle' && $this->circle != null) {
            return $this->circle;
        } else {
            throw new \Exception(
                "Expected type to be 'circle'; got '$this->type.'"
            );
        }
    }

    public function asSquare(): Square
    {
        if ($this->type == 'square' && $this->square != null) {
            return $this->square;
        } else {
            throw new \Exception(
                "Expected type to be 'square'; got '$this->type.'"
            );
        }
    }
}
