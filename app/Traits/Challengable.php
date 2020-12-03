<?php


namespace App\Traits;


use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Challengable
{
    public function getPoints()
    {
        $this->loadMissing('balance');
        return $this->balance->direct_points;
    }

    public function getTeamPoints()
    {
        $this->loadMissing('balance');
        return $this->balance->team_points;
    }

    public function getAllReferrals()
    {
        $this->loadMissing('all_referrals');
        return Helper::flat_all_referrals($this);
    }

    public function getBalanceIncomes($lastMonths = null)
    {
        if (!empty($lastMonths)) {
            $this->loadMissing(['balance.incomes' => function (Builder $q) use ($lastMonths) {
                return $q->whereDate(
                    'created_at', '>=',
                    Carbon::now()->subMonths($lastMonths)
                );
            }]);
        } else {
            $this->loadMissing('balance.incomes');
        }

        return $this->balance->incomes;
    }

    function getPointsForLastMonths($lastMonths)
    {
        $incomes = $this->getBalanceIncomes($lastMonths);
        return $incomes->sum('direct_points');
    }

    function getTeamPointsForLastMonths($lastMonths)
    {
        $incomes = $this->getBalanceIncomes($lastMonths);
        return $incomes->sum('team_points');
    }
}