<?php

declare (strict_types = 1);

namespace Larke\Admin\Listener;

use Larke\Admin\Event;

/*
 * 更新登陆信息
 *
 * @create 2020-11-10
 * @author deatil
 */
class PassportLoginAfter
{
    public function handle(Event\PassportLoginAfter $event)
    {
        // jwt 数据
        $jwt = $event->jwt;
        
        // token
        $accessToken = $jwt['access_token'];
        $refreshToken = $jwt['refresh_token'];
        
        // 权限 token 签发时间
        $decodeAccessToken = app('larke-admin.auth-token')
                ->decodeAccessToken($accessToken);
        $decodeAccessTokenIat = $decodeAccessToken->getClaim('iat');
        
        // 权限 token 签发时间
        $decodeRefreshToken = app('larke-admin.auth-token')
                ->decodeRefreshToken($refreshToken);
        $decodeRefreshTokenIat = $decodeRefreshToken->getClaim('iat');
        
        $event->admin->update([
            'refresh_time' => $decodeAccessTokenIat, 
            'refresh_ip' => request()->ip(),
            'last_active' => $decodeRefreshTokenIat, 
            'last_ip' => request()->ip(),
        ]);
    }
}
