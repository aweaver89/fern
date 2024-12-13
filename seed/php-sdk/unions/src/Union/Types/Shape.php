<?php

class Circle {}

class Square {}

interface ShapeVisitor
{
    public function visitCircle(Circle $circle);
    public function visitSquare(Square $square);
    public function _visitUnknown(object $unknown);
}

enum ShapeType
{
    case CIRCLE;
    case SQUARE;
    case UNKNOWN;
}

readonly class Shape
{
    /**
     * @var ShapeType $type
     */
    public ShapeType $type;

    /**
     * @var ?Circle $circle
     */
    private ?Circle $circle;

    /**
     * @var ?Square $square
     */
    private ?Square $square;

    /**
     * @var ?object $unknown
     */
    private ?object $unknown;

    /**
     * @param ?array{
     *   type?: ShapeType,
     *   circle?: ?Circle,
     *   square?: ?Square,
     *   unknown?: ?object,
     * } $options
     */
    private function __construct(
        private readonly ?array $options = null,
    ) {
        $this->type = $this->options['type'] ?? ShapeType::UNKNOWN;
        $this->circle = $this->options['circle'] ?? null;
        $this->square = $this->options['square'] ?? null;
        $this->unknown = $this->options['unknown'] ?? null;
    }

    /**
     * @param 
     */
    static function circle(Circle $circle): Shape
    {
        return new Shape([
            'type' => ShapeType::CIRCLE,
            'circle' => $circle
        ]);
    }

    static function square(Square $square): Shape
    {
        return new Shape([
            'type' => ShapeType::SQUARE,
            'square' => $square
        ]);
    }

    static function _unknown(object $unknown): Shape
    {
        return new Shape([
            'unknown' => $unknown
        ]);
    }

    public function isCircle(): bool
    {
        return $this->type == ShapeType::CIRCLE;
    }

    public function isSquare(): bool
    {
        return $this->type == ShapeType::SQUARE;
    }

    public function visit(ShapeVisitor $visitor)
    {
        return match ($this->type) {
            ShapeType::CIRCLE => $visitor->visitCircle($this->circle),
            ShapeType::SQUARE => $visitor->visitSquare($this->square),
            ShapeType::UNKNOWN => $visitor->_visitUnknown($this),
        };
    }
}
