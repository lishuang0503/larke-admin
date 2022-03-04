<?php

declare (strict_types = 1);

namespace Larke\Admin\Event;

/**
 * 系统信息
 *
 * @create 2020-11-5
 * @author deatil
 */
class SystemInfo
{
    /**
     * info
     * 
     * @var array
     */
    public $info;
    
    /**
     * 构造方法
     * 
     * @access public
     */
    public function __construct($info)
    {
        $this->info = $info;
    }
    
}
