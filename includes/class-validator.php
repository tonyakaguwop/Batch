<?php
class BPI_Validator {
    private $allowed_domains = [
        'wordpress.org',
        'downloads.wordpress.org',
        'github.com'
    ];
    
    public function is_valid_plugin_url($url) {
        $domain = parse_url($url, PHP_URL_HOST);
        
        if (!$domain) {
            return false;
        }
        
        return in_array($domain, $this->allowed_domains, true);
    }
    
    public function validate_zip_file($file_path) {
        if (!file_exists($file_path)) {
            return false;
        }
        
        $zip = new ZipArchive();
        $result = $zip->open($file_path);
        
        if ($result !== true) {
            return false;
        }
        
        $zip->close();
        return true;
    }
}