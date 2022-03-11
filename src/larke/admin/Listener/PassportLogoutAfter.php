<?php

declare (strict_types = 1);

namespace Larke\Admin\Listener;

use Illuminate\Support\Facades\Cache;
use Larke\Admin\Event;
use Larke\Admin\Model\Admin as AdminModel;

/*
 * 更新信息
 *
 * @create 2021-8-20
 * @author deatil
 */
class PassportLogoutAfter
{
    public function handle(Event\PassportLogoutAfter $event)
    {
        $adminid = app('larke-admin.auth-admin')->getId();
        
        // 更新信息
        AdminModel::where('id', $adminid)->update([
            'refresh_time' => time(), 
            'refresh_ip' => request()->ip(),
        ]);

      //晴空选中游戏大区缓存
      Cache::forget($adminid.env('CACHE_USER_KEY'));
    }
}
