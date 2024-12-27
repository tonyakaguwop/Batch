<?php
class BPI_Downloader {
    private $temp_dir;
    
    public function __construct() {
        $this->temp_dir = WP_CONTENT_DIR . '/upgrade';
    }
    
    public function download($url) {
        if (!wp_mkdir_p($this->temp_dir)) {
            throw new Exception('Unable to create temporary directory');
        }
        
        $file_name = basename($url);
        $file_path = $this->temp_dir . '/' . $file_name;
        
        $response = wp_safe_remote_get($url, [
            'timeout' => 30,
            'stream' => true,
            'filename' => $file_path
        ]);
        
        if (is_wp_error($response)) {
            throw new Exception($response->get_error_message());
        }
        
        return $file_path;
    }
}