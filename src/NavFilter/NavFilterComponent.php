<?php

namespace FocalStrategy\Filter\NavFilter;

use FocalStrategy\Core\Renderable;
use FocalStrategy\Filter\FilterManager;
use View;

class NavFilterComponent implements Renderable
{
    protected $filter;
    protected $callable;

    protected $components = [];

    protected $is_called = false;

    public function __construct(FilterManager $filter, callable $callable)
    {
        $this->filter = $filter;
        $this->callable = $callable;
        $this->components['main'] = [];
    }

    public function dropdown($field, $display, $data, string $group = 'main', array $options = [])
    {
        $dd = new NavFilterDropdownComponent($this->filter, $field, $display, $data, $options);

        if (!isset($this->components[$group])) {
            $this->components[$group] = [];
        }

        $this->components[$group][] = $dd;

        return $this;
    }

    public function tab($field, $value, $display, $route = null, string $group = 'main', array $options = [])
    {
        $dd = new NavFilterTabComponent($this->filter, $field, $value, $display, $route, $options);

        if (!isset($this->components[$group])) {
            $this->components[$group] = [];
        }

        $this->components[$group][] = $dd;

        return $this;
    }

    public function enumDropdown($field, $display, $data, string $group = 'main')
    {
        $dd = new NavFilterEnumDropdownComponent($this->filter, $field, $display, $data);

        if (!isset($this->components[$group])) {
            $this->components[$group] = [];
        }

        $this->components[$group][] = $dd;

        return $this;
    }

    public function status()
    {
        $this->init();

        $results = [];
        foreach ($this->components as $group => $components) {
            foreach ($components as $field => $component) {
                $status = $component->status();

                if ($status != null) {
                    $results[] = $status;
                }
            }
        }

        if (count($results) > 0) {
            $results = implode(', ', $results);

            return [[
            '',
            $results
            ]];
        } else {
            return [];
        }
    }

    public function render(string $group = 'main', string $classes = '') : string
    {
        $this->init();

        if (!isset($this->components[$group])) {
            return '';
        }

        return View::make('filter::nav_filter_component')
        ->with('components', $this->components[$group])
        ->with('additional_cl', $classes)
        ->render();
    }

    public function init()
    {
        if ($this->is_called) {
            return;
        }

        $callable = $this->callable;
        $callable($this);

        $this->is_called = true;
    }
}
