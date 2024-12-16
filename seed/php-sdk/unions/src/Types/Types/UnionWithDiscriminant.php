<?php

use Seed\Core\Json\JsonSerializableType;
use Seed\Types\Types\Foo;
use Seed\Types\Types\Bar;

class UnionWithDiscriminant extends JsonSerializableType
{
    /**
     * @var 'foo'|'bar'|'_unknown' $type
     */
    public string $type;

    /**
     * @var ?Foo $foo
     */
    public ?Foo $foo;

    /**
     * @var ?Bar $bar
     */
    public ?Bar $bar;

    /**
     * @var mixed $_unknown
     */
    public mixed $_unknown;

    /**
     * @param ?array{
     *   type?: 'foo'|'bar'|'_unknown',
     *   foo?: ?Foo,
     *   bar?: ?Bar,
     *   _unknown?: mixed
     * } $options
     */
    private function __construct(
        private readonly ?array $options = null,
    ) {
        $this->type = $this->options['type'] ?? '_unknown';
        $this->foo = $this->options['foo'] ?? null;
        $this->bar = $this->options['bar'] ?? null;
        $this->_unknown = $this->options['_unknown'] ?? null;
    }

    public static function foo(
        Foo $foo
    ): UnionWithDiscriminant {
        return new UnionWithDiscriminant([
            'type' => 'foo',
            'foo' => $foo
        ]);
    }

    public static function bar(
        Bar $bar
    ): UnionWithDiscriminant {
        return new UnionWithDiscriminant([
            'type' => 'bar',
            'bar' => $bar
        ]);
    }

    public static function _unknown(
        mixed $_unknown
    ): UnionWithDiscriminant {
        return new UnionWithDiscriminant([
            '_unknown' => $_unknown
        ]);
    }

    public function asFoo(): Foo
    {
        if ($this->type == 'foo') {
            return $this->foo;
        } else {
            throw new \Exception(
                "Expected type to be 'foo'; got '$this->type.'"
            );
        }
    }

    public function asBar(): Bar
    {
        if ($this->type == 'bar') {
            return $this->bar;
        } else {
            throw new \Exception(
                "Expected type to be 'bar'; got '$this->type.'"
            );
        }
    }
}
