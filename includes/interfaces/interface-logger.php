<?php
interface BPI_Logger_Interface {
    public function log($message, $level = 'info');
    public function init_log_directory();
}