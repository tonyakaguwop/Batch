<?php
class BPI_Plugin_Metadata {
    private $plugin_data;
    
    public function __construct($plugin_file) {
        if (!function_exists('get_plugin_data')) {
            require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }
        $this->plugin_data = get_plugin_data($plugin_file, false, false);
    }
    
    public function get_version() {
        return $this->plugin_data['Version'] ?? '';
    }
    
    public function get_name() {
        return $this->plugin_data['Name'] ?? '';
    }
    
    public function get_author() {
        return $this->plugin_data['Author'] ?? '';
    }
    
    public function to_array() {
        return [
            'name' => $this->get_name(),
            'version' => $this->get_version(),
            'author' => $this->get_author()
        ];
    }
}