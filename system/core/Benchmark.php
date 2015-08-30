<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Benchmark {

    private $times = array();
    private $memory = array();
    
    public function tic($mark) {
        $this->times[$mark] = microtime();
    }
    
    public function tock($mark) {
        $this->times[$mark] = microtime() - $this->times[$mark];
        $this->memory[$mark] = memory_get_usage()/1000;
    }
    
    public function get_time($mark) {
        if (isset($this->times[$mark])) {
            echo $mark . ' time: ' . $this->times[$mark] . 'us<br>';
        }
    }
    
    public function show() {
        echo '<br><br><b>--Benchmark--</b><br>';
        foreach ($this->times as $mark => $time) {
            echo $mark . ' time: ' . $time . 'us<br>';
            echo $mark . ' memory: ' . $this->memory[$mark] . 'kb<br><br>';
        }
    }

}
