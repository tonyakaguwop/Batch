<?php
class BPI_URL_Helper {
    public static function normalize_url($url) {
        // Remove trailing slashes
        $url = rtrim($url, '/');
        
        // Ensure https for wordpress.org domains
        if (strpos($url, 'wordpress.org') !== false) {
            $url = str_replace('http://', 'https://', $url);
        }
        
        return $url;
    }
    
    public static function get_plugin_slug_from_url($url) {
        return basename(parse_url($url, PHP_URL_PATH), '.zip');
    }
}