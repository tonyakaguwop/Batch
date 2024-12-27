<?php
class BPI_Error_Handler {
    private $logger;
    
    public function __construct(BPI_Logger $logger) {
        $this->logger = $logger;
    }
    
    public function handle_error($error, $context = []) {
        $message = $error instanceof Exception 
            ? $error->getMessage() 
            : (string) $error;
            
        $this->logger->log($message, 'error');
        
        return [
            'success' => false,
            'message' => $message,
            'context' => $context
        ];
    }
}