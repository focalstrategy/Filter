<?php

namespace FocalStrategy\Filter\Components;

use Exception;
use FocalStrategy\Core\Renderable;
use FocalStrategy\Filter\FilterManager;
use Route;
use View;

class NavFilterTab implements Renderable
{
    protected $filter;
    protected $field;
    protected $display;
    protected $route;

    protected $options;

    public function __construct(FilterManager $filter, $field, $value = null, $display, $route = null, array $options = [])
    {
        $this->filter = $filter;
        $this->field = $field;
        $this->value = $value;
        $this->display = $display;
        $this->route = $route;

        $this->options = $options;

        if ($this->route == null) {
            $this->route = Route::currentRouteName();
        }
    }

    public function status()
    {
        if ($this->value !== null) {
            $active = $this->filter->hasWhere($this->field, $this->value);
        } else {
            $active = !$this->filter->has($this->field);
        }

        if ($active) {
            return $this->display;
        }

        return null;
    }



    public function render()
    {
        try {
            return View::make('filter::tab_nav_filter_component')
            ->with('filter', $this->filter)
            ->with('field', $this->field)
            ->with('display', $this->display)
            ->with('route', $this->route)
            ->with('value', $this->value)
            ->render();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
