<?php
class BPI_Validation_Service {
    private $validator;
    private $error_handler;
    
    public function __construct(BPI_Validator $validator, BPI_Error_Handler $error_handler) {
        $this->validator = $validator;
        $this->error_handler = $error_handler;
    }
    
    public function validate_installation_request($url) {
        if (!$this->validator->is_valid_plugin_url($url)) {
            return $this->error_handler->handle_error('Invalid plugin URL');
        }
        
        return ['success' => true];
    }
}