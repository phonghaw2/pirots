<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductStatusEnum extends Enum
{
    public const OUT_IN_STOCK = 0;
    public const IN_STOCK = 1;
    public const RUNNING_LOW = 2;
}
