<?php

namespace App\Models\Constants;

use Illuminate\Database\Eloquent\Model;

class VoucherStatus extends Model
{
    const AVAILABLE_TO_USE = 'AVAILABLE_TO_USE';

    const USED = 'USED';

    const CLAIMED = 'CLAIMED';

    const ABORTED = 'ABORTED';

    public static function getHumanLanguageDict()
    {
        $arr = [];
        $arr[self::AVAILABLE_TO_USE] = 'Available To Use';
        $arr[self::USED] = 'Used';
        $arr[self::CLAIMED] = 'Claimed';
        $arr[self::ABORTED] = 'Aborted';

        return $arr;
    }

    public static function humanize($value)
    {
        return self::getHumanLanguageDict()[$value];
    }

    public static function values()
    {
        return [
            self::AVAILABLE_TO_USE,
            self::USED,
            self::CLAIMED,
            self::ABORTED,
        ];
    }

    public static function options()
    {
        $humanLanguageDict = self::getHumanLanguageDict();

        return collect(
            self::values()
        )->map(
            function ($e) {
                return [
                    'value' => $e,
                    'label' => $e,
                ];
            }
        )->all();
    }
}
