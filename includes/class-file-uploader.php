<?php
class BPI_File_Uploader {
    private $allowed_mime_types = ['application/zip', 'application/x-zip-compressed'];
    private $max_file_size = 10485760; // 10MB
    
    public function handle_uploads($files) {
        $results = [];
        
        foreach ($files['tmp_name'] as $key => $tmp_name) {
            try {
                $this->validate_upload($files, $key);
                $file_path = $this->move_to_temp_directory($tmp_name, $files['name'][$key]);
                $results[$files['name'][$key]] = $file_path;
            } catch (Exception $e) {
                $results[$files['name'][$key]] = [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }
        }
        
        return $results;
    }
    
    private function validate_upload($files, $key) {
        if ($files['error'][$key] !== UPLOAD_ERR_OK) {
            throw new Exception('Upload failed with error code: ' . $files['error'][$key]);
        }
        
        if (!in_array($files['type'][$key], $this->allowed_mime_types)) {
            throw new Exception('Invalid file type. Only ZIP files are allowed.');
        }
        
        if ($files['size'][$key] > $this->max_file_size) {
            throw new Exception('File size exceeds limit of 10MB.');
        }
    }
    
    private function move_to_temp_directory($tmp_name, $filename) {
        $upload_dir = WP_CONTENT_DIR . '/upgrade';
        if (!wp_mkdir_p($upload_dir)) {
            throw new Exception('Failed to create upload directory');
        }
        
        $destination = $upload_dir . '/' . sanitize_file_name($filename);
        if (!move_uploaded_file($tmp_name, $destination)) {
            throw new Exception('Failed to move uploaded file');
        }
        
        return $destination;
    }
}