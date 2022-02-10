<?php

namespace App\Services;

class PaginationService
{
    public static function validatePage($paginator, $page)
    {
        if (! is_null($page)) {
            if ($page < 1) {
                return redirect($paginator->url(1));
            }
            if ($page > $paginator->lastPage()) {
                return redirect($paginator->url($paginator->lastPage()));
            }
        }

        return null;
    }
}
