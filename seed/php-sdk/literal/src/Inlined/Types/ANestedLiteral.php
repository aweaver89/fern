<?php

namespace Seed\Inlined\Types;

use Seed\Core\Json\JsonSerializableType;
use Seed\Core\Json\JsonProperty;

class ANestedLiteral extends JsonSerializableType
{
    /**
     * @var string $myLiteral
     */
    #[JsonProperty('myLiteral')]
    public string $myLiteral;

    /**
     * @param array{
     *   myLiteral: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->myLiteral = $values['myLiteral'];
    }
}
