<?php

namespace FocalStrategy\Filter;

use FocalStrategy\Filter\FilterManager;

trait HasFilterManager
{
    protected $filter;

    public function setFilterManager(FilterManager $filter)
    {
        $this->filter = $filter;
    }
}
