<?php

return [
    // 系统信息
    'admin' => [
        'name' => "LarkeAdmin",
        'name_mini' => "Larke",
        'logo' => "<b>Larke</b> admin",
        'release' => 20220225,
        'version' => "1.3.3",
    ],
    
    // 是否使用 https 方式
    'https' => env('LARKE_ADMIN_HTTPS', false),
    
    // 路由
    'route' => [
        'domain' => env('LARKE_ADMIN_ROUTE_DOMAIN', null),
        'prefix' => env('LARKE_ADMIN_ROUTE_PREFIX', 'admin-api'),
        'namespace' => env('LARKE_ADMIN_ROUTE_NAMESPACE', 'Larke\\Admin\\Controller'),
        'middleware' => env('LARKE_ADMIN_ROUTE_MIDDLEWARE') ? explode(',', env('LARKE_ADMIN_ROUTE_MIDDLEWARE')) : ['larke-admin'],
        'as' => env('LARKE_ADMIN_ROUTE_AS', 'larke-admin.'),
        
        // 超级管理员检测
        'admin_middleware' => env('LARKE_ADMIN_ROUTE_ADMIN_MIDDLEWARE') ? explode(',', env('LARKE_ADMIN_ROUTE_ADMIN_MIDDLEWARE')) : ['larke-admin.admin-auth'],
    ],
    
    // 登陆器
    'passport' => [
        'password_salt' => env('LARKE_ADMIN_PASSPORT_PASSWORD_SALT', 'e6c2ea864004a461e744b28a394df50c'),
        'header_captcha_key' => env('LARKE_ADMIN_PASSPORT_HEADER_CAPTCHA_KEY', 'Larke-Admin-Captcha-Id'),
        'access_token_id' => env('LARKE_ADMIN_PASSPORT_ACCESS_TOKEN_ID', 'larke-passport-access-token'),
        'access_expires_in' => env('LARKE_ADMIN_PASSPORT_ACCESS_EXPIRED_IN', 86400),
        'refresh_token_id' => env('LARKE_ADMIN_PASSPORT_REFRESH_TOKEN_ID', 'larke-passport-refresh-token'),
        'refresh_expires_in' => env('LARKE_ADMIN_PASSPORT_REFRESH_EXPIRED_IN', 604800),
        
        // 验证码 
        'captcha_expose_headers' => env('LARKE_ADMIN_PASSPORT_CAPTCHA_EXPOSE_HEADERS', 'Larke-Admin-Captcha-Id'),
        
        // RSA 公钥 
        'passkey_expose_headers' => env('LARKE_ADMIN_PASSPORT_PASSKEY_EXPOSE_HEADERS', 'Larke-Admin-Passkey-Id'),
        
        // 登陆公钥 key
        'header_passkey_key' => env('LARKE_ADMIN_PASSPORT_HEADER_PASSKEY_KEY', 'Larke-Admin-Passkey-Id'),
        // 私钥缓存时间
        'prikey_cache_time' => env('LARKE_ADMIN_PASSPORT_PRIKEY_CACHE_TIME', 600),

        // 登陆方式 [ single - 单点登陆 | many - 多点登陆 ]
        'login_type' => env('LARKE_ADMIN_PASSPORT_LOGIN_TYPE', 'many'),
    ],
    
    // JWT
    'jwt' => [
        'iss' => env('LARKE_ADMIN_JWT_ISS', 'admin-api.yourdomain.com'),
        'aud' => env('LARKE_ADMIN_JWT_AUD', !app()->runningInConsole() ? md5(request()->ip().request()->server('HTTP_USER_AGENT')) : ''),
        'sub' => env('LARKE_ADMIN_JWT_SUB', 'larke-admin-passport'),
        'jti' => env('LARKE_ADMIN_JWT_JTI', 'larke-admin-jid'),
        'exp' => env('LARKE_ADMIN_JWT_EXP', 3600),
        'nbf' => env('LARKE_ADMIN_JWT_NBF', 0),
        'leeway' => env('LARKE_ADMIN_JWT_LEEWAY', 0),
        
        // 载荷加密秘钥，为空不加密，base64编码后
        'passphrase' => env('LARKE_ADMIN_JWT_PASSPHRASE', 'YTY5YmNiZTgxMzVhMWY2MTA3Njc3NGY1YTE3MWI2MjQ='),
        
        // 签名
        'signer' => [
            // jwt 签名方式, 包括: HS... | RS... | ES... | EdDSA
            'algorithm' => env('LARKE_ADMIN_JWT_SIGNER_ALGORITHM', 'HS256'),
            
            // HS256,HS384,HS512
            'hmac' => [
                // 密码，base64编码后
                'secrect' => env('LARKE_ADMIN_JWT_SIGNER_HMAC_SECRECT', 'czFmZWdkUg=='),
            ],
            // RS256,RS384,RS512
            'rsa' => [
                'private_key' => env('LARKE_ADMIN_JWT_SIGNER_RSA_PRIVATE_KEY', ''),
                'public_key' => env('LARKE_ADMIN_JWT_SIGNER_RSA_PUBLIC_KEY', ''),
                // 私钥密码，base64编码后
                'passphrase' => env('LARKE_ADMIN_JWT_SIGNER_RSA_PASSPHRASE', ''),
            ],
            // ES256,ES384,ES512
            'ecdsa' => [
                'private_key' => env('LARKE_ADMIN_JWT_SIGNER_ECDSA_PRIVATE_KEY', ''),
                'public_key' => env('LARKE_ADMIN_JWT_SIGNER_ECDSA_PUBLIC_KEY', ''),
                // 私钥密码，base64编码后
                'passphrase' => env('LARKE_ADMIN_JWT_SIGNER_ECDSA_PASSPHRASE', ''),
            ],
            // EdDSA
            'eddsa' => [
                'private_key' => env('LARKE_ADMIN_JWT_SIGNER_EDDSA_PRIVATE_KEY', ''),
                'public_key' => env('LARKE_ADMIN_JWT_SIGNER_EDDSA_PUBLIC_KEY', ''),
            ],
        ],
    ],
    
    // 系统相关缓存配置
    'cache' => [
        'store' => env('LARKE_ADMIN_CACHE_STORE', 'default'),
        
        'auth_rule' => [
            'store' => env('LARKE_ADMIN_CACHE_AUTH_RULE_STORE', 'default'),
            'key' => env('LARKE_ADMIN_CACHE_AUTH_RULE_KEY', md5('larke_no_auth_rule')),
            'ttl' => env('LARKE_ADMIN_CACHE_AUTH_RULE_TTL', 43200),
        ],
    ],
    
    // 响应
    'response' => [
        'json' => [
            'is_allow_origin' => env('LARKE_ADMIN_RESPONSE_JSON_IS_ALLOW_ORIGIN', 1),
            'allow_origin' => env('LARKE_ADMIN_RESPONSE_JSON_ALLOW_ORIGIN', '*'),
            'allow_credentials' => env('LARKE_ADMIN_RESPONSE_JSON_ALLOW_CREDENTIALS', 0),
            'allow_methods' => env('LARKE_ADMIN_RESPONSE_JSON_ALLOW_METHODS', 'GET,POST,PATCH,PUT,DELETE,OPTIONS'),
            // 发送数据到服务器可携带的请求头字段 [Access-Control-Allow-Headers]
            'allow_headers' => env('LARKE_ADMIN_RESPONSE_JSON_ALLOW_HEADERS', 'X-Requested-With,X_Requested_With,Content-Type,Authorization,Locale-Language,Larke-Admin-Captcha-Id'),
            // 客户端可获取请求头字段 [Access-Control-Expose-Headers]
            'expose_headers' => env('LARKE_ADMIN_RESPONSE_JSON_EXPOSE_HEADERS', ''),
            'max_age' => env('LARKE_ADMIN_RESPONSE_JSON_MAX_AGE', ''),
        ],
    ],
    
    // 权限
    'auth' => [
        // 登陆过滤
        'authenticate_excepts' => env('LARKE_ADMIN_AUTH_AUTHENTICATE_EXCEPTS') ? explode(',', env('LARKE_ADMIN_AUTH_AUTHENTICATE_EXCEPTS')) : [],
        // 权限过滤
        'permission_excepts' => env('LARKE_ADMIN_AUTH_PERMISSION_EXCEPTS') ? explode(',', env('LARKE_ADMIN_AUTH_PERMISSION_EXCEPTS')) : [],
        // 超级管理员
        'admin_id' => env('LARKE_ADMIN_AUTH_ADMIN_ID', '04f65b19e5a2513fe5a89100309da9b7'),
    ],
    
    // 扩展
    'extension' => [
        // 扩展存放文件夹
        'directory' => env('LARKE_ADMIN_EXTENSION_DIRECTORY', 'extension'),
    ],
    
    // 上传
    'upload' => [
        // Disk in `config/filesystem.php`.
        'disk' => env('LARKE_ADMIN_UPLOAD_DISK', 'public'),
        
        // 文件夹
        'directory' => [
            'image' => env('LARKE_ADMIN_UPLOAD_DIRECTORY_IMAGE', 'images'),
            'media' => env('LARKE_ADMIN_UPLOAD_DIRECTORY_MEDIA', 'medias'),
            'file' => env('LARKE_ADMIN_UPLOAD_DIRECTORY_FILE', 'files'),
        ],
        
        // 后缀类型
        'file_types' => [
            'image'  => '/^(gif|png|jpe?g|svg|webp)$/i',
            'html'   => '/^(htm|html)$/i',
            'office' => '/^(docx?|xlsx?|pptx?|pps|potx?)$/i',
            'docs'   => '/^(docx?|xlsx?|pptx?|pps|potx?|rtf|ods|odt|pages|ai|dxf|ttf|tiff?|wmf|e?ps)$/i',
            'text'   => '/^(txt|md|csv|nfo|ini|json|php|js|css|ts|sql)$/i',
            'video'  => '/^(og?|mp4|webm|mp?g|mov|3gp)$/i',
            'audio'  => '/^(og?|mp3|mp?g|wav)$/i',
            'pdf'    => '/^(pdf)$/i',
            'flash'  => '/^(swf)$/i',
        ],
    ],
    
    // 验证码
    'captcha' => [
        'charset' => 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789',
        'codelen' => 4,
        'width' => 130,
        'height' => 50,
        'fontsize' => 20,
        'cachetime' => 300,
        // 为空为默认字体
        'font' => '',
    ],
];
