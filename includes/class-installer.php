<?php
class BPI_Installer {
    private $downloader;
    private $validator;
    
    public function __construct() {
        $this->downloader = new BPI_Downloader();
        $this->validator = new BPI_Validator();
    }
    
    public function install_plugin($url, $batch_id) {
        // Validate URL
        if (!$this->validator->is_valid_plugin_url($url)) {
            throw new Exception('Invalid plugin URL');
        }
        
        // Download plugin
        $zip_path = $this->downloader->download($url);
        
        // Install using WordPress core functionality
        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        $upgrader = new Plugin_Upgrader(new Quiet_Skin());
        
        return $upgrader->install($zip_path);
    }
}