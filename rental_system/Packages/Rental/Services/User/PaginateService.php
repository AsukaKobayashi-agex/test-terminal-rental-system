<?php

namespace Rental\Services\User;

class PaginateService
{
    public function paginate($all_num)
    {
        $paginate = [];
        $paginate['limit'] = 10;
        $all = count($all_num);
        $paginate['page_num'] = ceil($all / $paginate['limit']);

        return $paginate;
    }
}
