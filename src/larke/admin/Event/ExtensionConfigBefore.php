<?php

declare (strict_types = 1);

namespace Larke\Admin\Event;

use Illuminate\Http\Request;

/**
 * 扩展更新配置之前
 *
 * @create 2020-12-11
 * @author deatil
 */
class ExtensionConfigBefore
{
    /**
     * 扩展名称
     * 
     * @var string
     */
    public $name;
    
    /**
     * 请求数据
     * 
     * @var Request
     */
    public $request;
    
    /**
     * 构造方法
     * 
     * @access public
     * @param Request $request 请求数据
     */
    public function __construct(string $name, Request $request)
    {
        $this->name = $name;
        
        $this->request = $request;
    }
    
}
