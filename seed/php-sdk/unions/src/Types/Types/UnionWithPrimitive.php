<?php

use Seed\Core\Json\JsonSerializableType;

class UnionWithPrimitive extends JsonSerializableType
{
    /**
     * @var 'integer'|'string'|'_unknown' $type
     */
    public string $type;

    /**
     * @var ?int $integer
     */
    public ?int $integer;

    /**
     * @var ?string $string
     */
    public ?string $string;

    /**
     * @var mixed $_unknown
     */
    public mixed $_unknown;

    /**
     * @param ?array{
     *   type?: 'integer'|'string'|'_unknown',
     *   integer?: ?int,
     *   string?: ?string,
     *   _unknown?: mixed
     * } $options
     */
    private function __construct(
        private readonly ?array $options = null,
    ) {
        $this->type = $this->options['type'] ?? '_unknown';
        $this->integer = $this->options['integer'] ?? null;
        $this->string = $this->options['string'] ?? null;
        $this->_unknown = $this->options['_unknown'] ?? null;
    }

    public static function integer(
        int $integer
    ): UnionWithPrimitive {
        return new UnionWithPrimitive([
            'type' => 'integer',
            'integer' => $integer
        ]);
    }

    public static function string(
        string $string
    ): UnionWithPrimitive {
        return new UnionWithPrimitive([
            'type' => 'string',
            'string' => $string
        ]);
    }

    public static function _unknown(
        mixed $_unknown
    ): UnionWithPrimitive {
        return new UnionWithPrimitive([
            '_unknown' => $_unknown
        ]);
    }

    public function asInteger(): int
    {
        if ($this->type == 'integer' && $this->integer != null) {
            return $this->integer;
        } else {
            throw new \Exception(
                "Expected type to be 'integer'; got '$this->type.'"
            );
        }
    }

    public function asString(): string
    {
        if ($this->type == 'string' && $this->string != null) {
            return $this->string;
        } else {
            throw new \Exception(
                "Expected type to be 'string'; got '$this->type.'"
            );
        }
    }
}
