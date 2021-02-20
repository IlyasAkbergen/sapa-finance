<?php


namespace App\Traits;


use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Challengable
{
    public function getPoints()
    {
        $points = data_get($this, 'balance.direct_points');
        if (!$points) {
            $this->loadMissing('balance');
        }
        return data_get($this, 'balance.direct_points');
    }

    public function getDirectPoints()
    {
        return $this->getPoints();
    }

    public function getTeamPoints()
    {
        $points = data_get($this, 'balance.team_points');
        if (!$points) {
            $this->loadMissing('balance');
        }
        return data_get($this, 'balance.team_points');
    }

    public function getAllReferrals()
    {
        $this->load('all_referrals');
        return Helper::flat_all_referrals($this);
    }

    public function getBalanceIncomes($lastMonths = null)
    {
        if (!empty($lastMonths)) {
            $this->load(['balance.incomes' => function ($q) use ($lastMonths) {
                return $q->whereDate(
                    'created_at', '>=',
                    Carbon::now()->subMonths($lastMonths)
                );
            }]);
        } else {
            $this->load('balance.incomes');
        }

        return data_get($this, 'balance.incomes');
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
