<?php
return array(
    'taskid1' =>
        array(
            'name' => '测试',  //任务名称
            'time' => '* * * * *',//定时规则
            "unique" => 1, //排他数量，如果已经有这么多任务在执行，即使到了下一次执行时间，也不执行
            'task' =>
                array(
                    'parse'  => 'Cmd',//命令处理类
                    'cmd'    => '测试',//命令
                    'ext' => '',//附加属性
                ),
        ),
);