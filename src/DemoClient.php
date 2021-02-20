<?php

namespace Jyb\Demo;

/**
 * 测试demo
 * Class DemoClient
 * @package Jyb\Demo
 */
class DemoClient
{
    public function get()
    {
        return '测试输出时间：' . date('Y-m-d H:i:s');
    }

    public function set($data)
    {
        return '设置成功：' . $data;
    }
}
