<?php

namespace App\Infrustructure\Traits;

use Carbon\Carbon;

trait Filterable
{

    /**
     * @param $query
     * @param $request
     * @return mixed
     */
    public function scopeFilter($query, $request)
    {
        foreach ($_GET as $key => $value) {

            if (empty($value)) {
                continue;
            }

            switch ($key) {
                case "start_at":
                case "expired_at":
                case "birthday":
                    $value = jalali_to_carbon($value);
                    break;
            }

            if (in_array($key, $this->filters)) {

                $function = 'scope' . ucfirst($key);

                if (method_exists($this, $function)) {
                    $query->{$key}($value);
                }
            }
        }

        return $query;
    }
}
