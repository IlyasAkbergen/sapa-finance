<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Client()
 * @method static static Agent()
 * @method static static Consultant()
 * @method static static Tutor()
 * @method static static Mentor()
 * @method static static Partner()
 */
final class ReferralLevelEnum extends Enum
{
    const Client = 0;
    const Agent = 1;
    const Consultant = 2;
    const Tutor = 3;
    const Mentor = 4;
    const Partner = 5;
}
