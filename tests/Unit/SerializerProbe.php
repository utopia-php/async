<?php

namespace Utopia\Tests\Unit;

final class SerializerProbe
{
    public static int $restored = 0;

    public string $value = 'probe';

    /**
     * @return array{value: string}
     */
    public function __serialize(): array
    {
        return ['value' => $this->value];
    }

    /**
     * @param array{value: string} $data
     */
    public function __unserialize(array $data): void
    {
        self::$restored++;
        $this->value = $data['value'];
    }
}
