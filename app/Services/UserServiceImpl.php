<?php


namespace App\Services;


use App\Enums\ReferralLevelEnum;
use App\Helpers\Helper;
use App\Models\Course;
use App\Models\Purchase;
use App\Models\ReferralLevel;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserServiceImpl extends BaseServiceImpl implements UserService
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function addReward($id, array $reward_attributes)
    {
        return Reward::create(array_merge($reward_attributes, [
            'target_user_id' => $id
        ]));
    }

    public function updateOrAddReward($id, array $params, array $reward_attributes)
    {
        return Reward::updateOrCreate(array_merge($params, [
            'target_user_id' => $id
        ]), $reward_attributes);
    }

    public function addPayout($id, array $payout_attributes) {
        $user = $this->findWith($id, ['balance']);

        if ($payout_attributes['sum'] > $user->balance->sum) {
            return null;
        }

        return $user->payouts()->create($payout_attributes);
    }

    /**
     * @inheritDoc
     */
    public function awardReferrersAfterPurchase(Purchase $purchase)
    {
        DB::beginTransaction();

        try {

            $purchase->loadMissing('user.referrer_recursive', 'purchasable');

            if (empty($purchase->user->referrer)) {
                return;
            }

            $purchasable = $purchase->purchasable;

            $all_referrers = Helper::flat_all_referrers($purchase->user);

            $is_start_course = $purchasable instanceof Course
                && $purchasable->id == Course::START_COURSE_ID;

            foreach ($all_referrers as $referrer) {
                $is_direct = $purchase->user->referrer_id == $referrer->id;
                $this->updateOrAddReward($referrer->id, [
                    'purchase_id' => $purchase->id,
                ],[
                    'sum' => $is_direct
                        ? $purchasable->getAwardSum()
                        : $purchasable->getAwardSum() * $referrer->fee_percent / 100,
                    'is_direct' => $is_direct,
                    'points' => $purchasable->isAwardable() && !$is_start_course
                        ? Purchase::$DIRECT_POINTS_PER_PURCHASE
                        : null
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function allReferralsOf($user_id)
    {
        $model = $this->findWith($user_id, ['all_referrals']);
        return Helper::flat_all_referrals($model);
    }

    public function tryNextLevel(User $user)
    {
        if ($user->referral_level_id == ReferralLevelEnum::Partner) {
            return false;
        }

        $next_level_id = empty($user->referral_level_id)
            ? ReferralLevelEnum::Agent
            : $user->referral_level_id + 1;

        $next_level = ReferralLevel::findOrFail($next_level_id);

        $deservesLevelUp = true;

        foreach ($next_level->achieve_challenges as $challenge) {
            $deservesLevelUp = $deservesLevelUp && $challenge::check($user);
        }

        if ($deservesLevelUp) {
            return $user->updateReferralLevel($next_level_id);
        }

        return $deservesLevelUp;
    }
}