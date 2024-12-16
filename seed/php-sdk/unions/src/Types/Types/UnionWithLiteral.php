<?php

use Seed\Core\Json\JsonSerializableType;

class UnionWithLiteral extends JsonSerializableType
{
    /**
     * @var 'base' $base
     */
    public string $base;

    /**
     * @var 'fern'|'_unknown' $type
     */
    public string $type;

    /**
     * @var 'fern' $type
     */
    public ?string $fern;

    /**
     * @var mixed $_unknown
     */
    public mixed $_unknown;

    /**
     * @param ?array{
     *   base: 'base',
     *   type?: 'fern'|'_unknown',
     *   fern?: ?'fern',
     *   _unknown?: mixed,
     * } $options
     */
    private function __construct(
        private readonly ?array $options = null,
    ) {
        if ($this->options != null) {
            $this->base = $this->options['base'];
        } else {
            throw new \Exception("Missing required argument 'base'");
        }
        $this->type = $this->options['type'] ?? '_unknown';
        $this->fern = $this->options['fern'] ?? null;
        $this->_unknown = $this->options['_unknown'] ?? null;
    }

    public static function fern(): UnionWithLiteral
    {
        return new UnionWithLiteral([
            'base' => 'base',
            'type' => 'fern',
            'fern' => 'fern',
        ]);
    }

    public static function _unknown(
        mixed $_unknown
    ): UnionWithLiteral {
        return new UnionWithLiteral([
            'base' => 'base',
            'type' => '_unknown',
            '_unknown' => $_unknown
        ]);
    }

    public function asFern(): string
    {
        if ($this->type == 'fern' && $this->fern != null) {
            return $this->fern;
        } else {
            throw new \Exception(
                "Expected type to be 'fern'; got '$this->type'"
            );
        }
    }
}
