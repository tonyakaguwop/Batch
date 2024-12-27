<?php
class BPI_Filesystem_Helper {
    public static function ensure_directory($path) {
        if (!file_exists($path)) {
            return wp_mkdir_p($path);
        }
        return true;
    }
    
    public static function cleanup_temp_files($directory) {
        if (!is_dir($directory)) {
            return false;
        }
        
        $files = glob($directory . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        
        return true;
    }
}