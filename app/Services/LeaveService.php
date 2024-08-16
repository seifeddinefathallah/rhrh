<?php

namespace App\Services;

use Carbon\Carbon;
use App\Services\HolidayService;

class LeaveService
{
    protected $holidayService;

    public function __construct(HolidayService $holidayService)
    {
        $this->holidayService = $holidayService;
    }

    /**
     * Calcule la durée des congés en excluant les jours fériés.
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return int
     */
    public function calculateLeaveDuration(Carbon $startDate, Carbon $endDate): int
    {
        $totalDays = $startDate->diffInDays($endDate) + 1; // +1 pour inclure la date de fin

        $holidaysWithinPeriod = 0;
        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            if ($this->holidayService->isHoliday($currentDate)) {
                $holidaysWithinPeriod++;
            }
            $currentDate->addDay();
        }

        return $totalDays - $holidaysWithinPeriod;
    }
}
