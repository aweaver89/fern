<?php

namespace Seed\Types;

use Seed\Core\Json\JsonSerializableType;
use Seed\Traits\Docs;
use Seed\Core\Json\JsonProperty;

class Json extends JsonSerializableType
{
    use Docs;

    /**
     * @var string $raw
     */
    #[JsonProperty('raw')]
    public string $raw;

    /**
     * @param array{
     *   raw: string,
     *   docs: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->raw = $values['raw'];
        $this->docs = $values['docs'];
    }
}
