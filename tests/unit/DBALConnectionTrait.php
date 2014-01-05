<?php

trait DBALConnectionTrait
{
    /**
     * @var array
     */
    protected $data;

    protected function getDBALConnectionMock()
    {
        $this->data = [];

        $methods = [
            'hget' => function($index, $key) {
                return isset($this->predisData[$index][$key]) ?: null;
            },
            'hset' => function($index, $key, $value) {
                if (!isset($this->predisData[$index])) {
                    $this->predisData[$index] = [];
                }
                return $this->predisData[$index][$key] = $value;
            },
            'hdel' => function($index, $key) {
                unset($this->predisData[$index][$key]);
                return true;
            },
            'hgetall' => function($index) {
                return $this->predisData[$index];
            },
            'get' => function($key) {
                return isset($this->predisData[$key]) ?: null;
            },
            'set' => function($key, $value) {
                return $this->predisData[$key]= $value;
            },
            'incr' => function($key) {
                if (!isset($this->predisData[$key])) {
                    $this->predisData[$key] = 0;
                }
                return ++$this->predisData[$key];
            },
            'multi' => function() {},
            'exec' => function() {},
        ];

        $stub = $this->getMock('\\Doctrine\\DBAL\\Connection', array_keys($methods), [], '', false);

        foreach($methods as $method => $callback) {
            $stub->expects($this->any())->method($method)->will($this->returnCallback($callback));
        }

        return $stub;
    }
}
