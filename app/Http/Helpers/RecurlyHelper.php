<?php

namespace App\Http\Helpers;

class RecurlyHelper
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function getBadge($state)
    {
        switch($state) {
            case "paid":
                $text = ucfirst($state);
                $type = "success";
                break;            
            case "canceled":
                $text = ucfirst($state);
                $type = "warning";
                break;
            case "expired":
                $text = ucfirst($state);
                $type = "secondary";
                break;
            default:
                $text = ucfirst($state);
                $type = "primary";
                break;                
        }

        return '<div class="btn btn-' . $type . ' btn-sm pe-none">' . $text . '</div>';
    }
}
