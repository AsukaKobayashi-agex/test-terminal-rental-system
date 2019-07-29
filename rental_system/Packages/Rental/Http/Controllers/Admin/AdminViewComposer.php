<?php

namespace Rental\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use Rental\Models\_common\AdminAccountData;

class AdminViewComposer
{
    protected $_get_user_info;
    public function __construct(AdminAccountData $userInfo)
    {
        $this->_get_user_info = $userInfo;
    }

    public function compose(View $view)
    {
        $data = $view->getData();
        if (\Auth::guard('admin')->check()) {
            $admin_id = \Auth::guard('admin')->id();
            $data['admin_info'] = $this->_get_user_info->getUserAuthDataById($admin_id);
        }
        return $view->with($data);
    }
}
