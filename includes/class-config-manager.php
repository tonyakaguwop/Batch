<?php
class BPI_Config_Manager {
    private $options;
    private static $instance = null;
    
    private function __construct() {
        $this->options = get_option('bpi_settings', []);
    }
    
    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function get($key, $default = null) {
        return isset($this->options[$key]) ? $this->options[$key] : $default;
    }
    
    public function set($key, $value) {
        $this->options[$key] = $value;
        return update_option('bpi_settings', $this->options);
    }
}