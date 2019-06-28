<?php

namespace MyCommon\Libraries\Routing;

use Illuminate\Routing\RouteUrlGenerator;

class CustomRouteUrlGenerator extends RouteUrlGenerator
{
    protected function getRouteScheme($route)
    {
        if ($this->request->server('HTTP_X_FORWARDED_PROTO') == 'https') {
            return 'https://';
        }

        return parent::getRouteScheme($route); // TODO: Change the autogenerated stub
    }
}