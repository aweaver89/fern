<?php

use Seed\Core\Json\JsonSerializableType;
use Seed\Types\Types\Foo;

class UnionWithBaseProperties extends JsonSerializableType
{
    /**
     * @var string $id
     */
    public string $id;

    /**
     * @var 'integer'|'string'|'foo'|'_unknown'
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
     * @var ?Foo $foo
     */
    public ?Foo $foo;

    /**
     * @var mixed $_unknown;
     */
    public mixed $_unknown;

    /**
     * @param ?array{
     *   id: string,
     *   type?: 'integer'|'string'|'foo'|'_unknown'
     *   integer?: ?int
     *   string?: ?string
     *   foo?: ?Foo
     *   _unknown?: mixed
     * } $options
     */
    private function __construct(
        private readonly ?array $options = null,
    ) {
        $this->id = $this->options['id'];
        $this->type = $this->options['type'] ?? '_unknown';
        $this->integer = $this->options['integer'] ?? null;
        $this->string = $this->options['string'] ?? null;
        $this->foo = $this->options['foo'] ?? null;
        $this->_unknown = $this->options['unknown'] ?? null;
    }

    public static function integer(
        int $id,
        int $integer
    ): UnionWithBaseProperties {
        return new UnionWithBaseProperties([
            'id' => $id,
            'type' => 'integer',
            'integer' => $integer,
        ]);
    }

    public static function string(
        int $id,
        string $string
    ): UnionWithBaseProperties {
        return new UnionWithBaseProperties([
            'id' => $id,
            'type' => 'string',
            'string' => $string
        ]);
    }

    public static function foo(
        int $id,
        Foo $foo
    ): UnionWithBaseProperties {
        return new UnionWithBaseProperties([
            'id' => $id,
            'type' => 'foo',
            'foo' => $foo
        ]);
    }

    public static function _unknown(
        int $id,
        mixed $_unknown
    ): UnionWithBaseProperties {
        return new UnionWithBaseProperties([
            'id' => $id,
            'type' => '_unknown',
            '_unknown' => $_unknown
        ]);
    }

    public function asInteger(): int
    {
        if ($this->type == 'integer') {
            return $this->integer;
        } else {
            throw new \Exception(
                "Expected type to be 'integer'; got '$this->type'"
            );
        }
    }

    public function asString(): string
    {
        if ($this->type == 'string') {
            return $this->string;
        } else {
            throw new \Exception(
                "Expected type to be 'string'; got '$this->type'"
            );
        }
    }

    public function asFoo(): Foo
    {
        if ($this->type == 'foo') {
            return $this->foo;
        } else {
            throw new \Exception(
                "Expected type to be 'foo'; got '$this->type'"
            );
        }
    }
}
