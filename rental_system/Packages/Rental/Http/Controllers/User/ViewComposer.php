<?php

namespace Rental\Http\Controllers\User;

use Illuminate\Contracts\View\View;
use Rental\Models\_common\GetUserInfo;

class ViewComposer
{
    protected $_get_user_info;
    public function __construct(GetUserInfo $userInfo)
    {
        $this->_get_user_info = $userInfo;
    }

    public function compose(View $view)
    {
        $data = $view->getData();
        if (\Auth::guard('user')->check()) {
            $user['user_id'] = \Auth::guard('user')->id();
            $data['user_info'] = $this->_get_user_info->getUserInfo($user);
        }
        return $view->with($data);
    }
}
