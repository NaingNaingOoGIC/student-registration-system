<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class StudentFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];
    public function rollno($rollno)
    {
        return $this->where(function ($q) use ($rollno) {
            return $q->where('rollno', $rollno);
        });
    }
    public function regDate($regdate)
    {
        return $this->where(function ($q) use ($regdate) {
            return $q->where('register_date', $regdate);
        });
    }
}
