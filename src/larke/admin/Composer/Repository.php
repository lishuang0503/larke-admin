<?php

declare (strict_types = 1);

namespace Larke\Admin\Composer;

use Illuminate\Support\Facades\File;

use Larke\Admin\Composer\Resolve;

/*
 * 仓库
 *
 * @create 2021-1-25
 * @author deatil
 */
class Repository
{
    /**
     * @var string
     */
    protected $directory = '';
    
    /**
     * 创建
     *
     * @return object
     */
    public static function create()
    {
        return new static();
    }
    
    /**
     * 目录
     *
     * @param string $directory
     * @return object
     */
    public function withDirectory($directory)
    {
        $this->directory = $directory;
        return $this;
    }
    
    /**
     * Resolve对象
     *
     * @return Resolve
     */
    public function getResolve()
    {
        $resolve = Resolve::create()
            ->withDirectory($this->directory);
        
        return $resolve;
    }
    
    /**
     * 判断
     *
     * @param   string  $name
     * @return  bool
     */
    public function has(string $name)
    {
        $resolve = $this->getResolve();
        
        return $resolve->hasRepository($name);
    }
    
    /**
     * 注册仓库
     *
     * @param   string  $name
     * @param   array   $repository
     * @return  bool
     */
    public function register(string $name, array $repository = [])
    {
        $resolve = $this->getResolve();
        
        $contents = $resolve->registerRepository($name, $repository);
        
        return $this->updateComposer($resolve, $contents);
    }
    
    /**
     * 移除仓库
     *
     * @param   string  $name
     * @return  bool
     */
    public function remove(string $name)
    {
        $resolve = $this->getResolve();
        
        $contents = $resolve->removeRepository($name);
        
        return $this->updateComposer($resolve, $contents);
    }
    
    /**
     * 更新composer信息
     *
     * @param   Resolve $resolve
     * @param   array   $contents
     * @return  bool
     */
    public function updateComposer(Resolve $resolve, array $contents)
    {
        if (empty($contents)) {
            return false;
        }
        
        if (empty($this->directory)) {
            return false;
        }
        
        $composerPath = $resolve->getComposerNamePath();
        if (! File::exists($composerPath)) {
            return false;
        }
        
        try {
            $data = $resolve->formatToJson($contents);
        } catch(\Exception $e) {
            return false;
        }
        
        return File::put($composerPath, $data, true);
    }

}
