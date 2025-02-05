<?php
namespace Infrastructure\Shared\Concerns;

trait HasEncodedId{
    public static function encodeId($id): string
    {
        return 'U'.date('N') . $id . pow(date('N'), 2) * 2;
    }

    public static function decodeId($id): int
    {
        $id = (int)substr($id, 1);
        $firstKey = substr($id, 0, 1);
        $lastKey = pow($firstKey, 2) * 2;
        if (strrpos($id, (string)$lastKey) == false) {
            return false;
        }
        $lastKey = strlen($id) - strlen($lastKey);
        $id = substr($id, 1, $lastKey - 1);
        if (empty($id)) {
            return false;
        }
        return (int)$id;

    }
}
