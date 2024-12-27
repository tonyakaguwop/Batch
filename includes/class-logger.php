<?php
class BPI_Logger {
    private $log_dir;
    
    public function __construct() {
        $this->log_dir = WP_CONTENT_DIR . '/bpi-logs';
        $this->init_log_directory();
    }
    
    private function init_log_directory() {
        if (!file_exists($this->log_dir)) {
            wp_mkdir_p($this->log_dir);
        }
    }
    
    public function log($message, $level = 'info') {
        $timestamp = current_time('mysql');
        $log_entry = sprintf(
            "[%s] [%s] %s\n",
            $timestamp,
            strtoupper($level),
            $message
        );
        
        $log_file = $this->log_dir . '/bpi-' . date('Y-m-d') . '.log';
        error_log($log_entry, 3, $log_file);
    }
}