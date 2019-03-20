<?php

namespace FocalStrategy\Filter\NavFilter;

use FocalStrategy\Core\Renderable;
use FocalStrategy\Filter\FilterManager;
use View;

class NavFilterDropdown implements Renderable
{
    protected $filter;
    protected $field;
    protected $display;
    protected $data;
    protected $options;

    public function __construct(FilterManager $filter, $field, $display, $data, array $options = [])
    {
        $this->filter = $filter;
        $this->field = $field;
        $this->display = $display;
        $this->data = $data;
        $this->options = $options;
    }

    public function status()
    {
        if ($this->filter->has($this->field)) {
            $val = $this->data->find($this->filter->value($this->field));
            if ($val !== null) {
                return $val->name;
            } else {
                return 'Unknown';
            }
        }

        return null;
    }
    public function render()
    {
        $unset_on_remove = isset($this->options['unset_on_remove']) ? explode(' ', $this->options['unset_on_remove']) : [];

        $unset_on_change = isset($this->options['unset_on_change']) ? explode(' ', $this->options['unset_on_change']) : [];
        $unset_on_change = array_fill_keys($unset_on_change, null);
        try {
            return View::make('filter::dropdown_nav_filter_component')
            ->with('filter', $this->filter)
            ->with('field', $this->field)
            ->with('display', $this->display)
            ->with('data', $this->data)
            ->with('unset_on_remove', $unset_on_remove)
            ->with('unset_on_change', $unset_on_change)
            ->render();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
