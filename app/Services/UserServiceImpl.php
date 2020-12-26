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
     * С каждой продажи ФК, который первый про дереву, получает 10% от своего агента.
     * Первый вышестоящий наставник, получает 5% и первый вышестоящий ментор получает 5%.
     * В совокупности командный бонус составляет 20%. если в структуре отсутствует финансовый консультант, то первое вышестоящие наставник получают 10% + 5%,
     * а в случае если в структуре отсутствует финансовый консультант и наставник, то 1 вышестоящий ментор получает все 20% командного бонуса.
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

            $consultant = $all_referrers->firstWhere('referral_level_id', ReferralLevelEnum::Consultant);

            $tutor = $all_referrers->firstWhere('referral_level_id', ReferralLevelEnum::Tutor);

            $mentor = $all_referrers->firstWhere('referral_level_id', ReferralLevelEnum::Mentor);

            $direct_referrer = $all_referrers->firstWhere('id', $purchase->user->referrer_id);

            $consultant_percent = 10;
            $tutor_percent = 15;
            $mentor_percent = 20;

            if (!empty($direct_referrer)) {
                $points = $purchasable->isAwardable() && !$is_start_course
                    ? Purchase::$DIRECT_POINTS_PER_PURCHASE
                    : null;
                $this->makeReward($direct_referrer, $purchase, true, $purchasable->getAwardSum(), $points);
            }

            if (!empty($consultant)) {
                $points = $purchasable->getAwardSum() * $consultant_percent / 100;
                $mentor_percent = 5;
                $tutor_percent = 5;
                $this->makeReward($consultant, $purchase, false, null, $points);
            }

            if (!empty($tutor)) {
                $points = $purchasable->getAwardSum() * $tutor_percent / 100;
                $mentor_percent = 5;
                $this->makeReward($tutor, $purchase, false, null, $points);
            }

            if (!empty($mentor)) {
                $points = $purchasable->getAwardSum() * $mentor_percent / 100;
                $this->makeReward($mentor, $purchase, false, null, $points);
            }

//            foreach ($all_referrers as $referrer) {
//                $is_direct = $purchase->user->referrer_id == $referrer->id;
//
//                $points = $is_direct
//                    ? Purchase::$DIRECT_POINTS_PER_PURCHASE
//                    : $purchasable->getAwardSum() * $percent / 100;
//
//                $this->updateOrAddReward($referrer->id, [
//                    'purchase_id' => $purchase->id,
//                ],[
//                    'sum' => $is_direct
//                        ? $purchasable->getAwardSum()
//                        : null,
//                    'is_direct' => $is_direct,
//                    'points' => $purchasable->isAwardable() && !$is_start_course
//                        ? $points
//                        : null
//                ]);
//            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    private function makeReward($referrer, $purchase, $is_direct, $sum, $points) {
        return $this->updateOrAddReward($referrer->id, [
            'purchase_id' => $purchase->id,
        ],[
            'sum' => $sum,
            'is_direct' => $is_direct,
            'points' => $points
        ]);
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

    public function getNextLevelProgress(User $user)
    {
        // TODO: Implement getNextLevelProgress() method.
    }
}
