<?php

namespace FocalStrategy\Filter;

use Illuminate\Http\Request;

class FilterManager
{
    protected $params_holder;
    protected $query_params;

    public function __construct(Request $req)
    {
        if ($req->route() != null) {
            $this->params_holder = collect($req->route()->parameters() + $req->query());
        } else {
            $this->params_holder = collect([]);
        }

        $this->query_params = $req->query();
    }

    public function get()
    {
        return $this->params_holder->toArray();
    }

    public function except($fields)
    {
        $tmp_holder = clone $this->params_holder;

        return $tmp_holder->except($fields)->toArray();
    }

    public function set($values = [])
    {
        $tmp_holder = clone $this->params_holder;

        foreach ($values as $k => $v) {
            $tmp_holder->put($k, $v);
        }

        return $tmp_holder->toArray();
    }

    public function value($param)
    {
        if ($this->has($param)) {
            return $this->params_holder[$param];
        }

        return null;
    }

    public function getQueryParams()
    {
        return $this->query_params;
    }

    public function has($param)
    {
        return $this->params_holder->has($param);
    }

    public function addValue($field, $value)
    {
        return $this->params_holder[$field] = $value;
    }

    public function hasAll(array $all)
    {
        $result = true;
        foreach ($all as $a) {
            if (!$this->has($a)) {
                $result = false;
                break;
            }
        }

        return $result;
    }

    public function hasWhere($param, $value)
    {
        return $this->has($param) && $this->params_holder->get($param) == $value;
    }
}
