<?php

namespace Rental\Services\_common;

trait PaginateTrait
{
    public function paginate($all_num)
    {
        $paginate = [];
        $paginate['limit'] = config('my_app.app.LIST_LIMIT_NUMBER_OF_USER');
        $all = count($all_num);
        $paginate['page_num'] = ceil($all / $paginate['limit']);

        return $paginate;
    }
}
