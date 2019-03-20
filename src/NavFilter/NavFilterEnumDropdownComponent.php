<?php

namespace FocalStrategy\Filter\NavFilter;

use FocalStrategy\Core\Renderable;
use FocalStrategy\Filter\FilterManager;
use View;

class NavFilterEnumDropdownComponent implements Renderable
{
    protected $filter;
    protected $field;
    protected $display;
    protected $data;
    protected $options;

    public function __construct(FilterManager $filter, $field, $display, $data)
    {
        $this->filter = $filter;
        $this->field = $field;
        $this->display = $display;
        $this->data = $data;
    }

    public function status()
    {
        if ($this->filter->has($this->field)) {
            $val = $this->data[$this->filter->value($this->field)];
            if ($val !== null) {
                return $this->display.': '.$val;
            } else {
                return $this->display.': '.'Unknown';
            }
        }

        return null;
    }

    public function render()
    {
        try {
            return View::make('filter::enum_dropdown_nav_filter_component')
            ->with('filter', $this->filter)
            ->with('field', $this->field)
            ->with('display', $this->display)
            ->with('data', $this->data)
            ->render();
        } catch (\Exception $e) {
            return $e;
        }
    }
}
