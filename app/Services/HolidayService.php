<?php

namespace App\Services;

use App\Models\Holiday;
use Carbon\Carbon;

class HolidayService
{
    /**
     * Check if a given date is a holiday.
     *
     * @param \Carbon\Carbon $date
     * @return bool
     */
    public function isHoliday(Carbon $date)
    {
        return Holiday::whereDate('start_date', '<=', $date->toDateString())
            ->whereDate('end_date', '>=', $date->toDateString())
            ->exists();
    }
}
