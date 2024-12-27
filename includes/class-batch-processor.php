<?php
class BPI_Batch_Processor {
    private $installer;
    private $logger;
    
    public function __construct() {
        $this->installer = new BPI_Installer();
        $this->logger = new BPI_Logger();
    }
    
    public function process_batch($urls, $batch_id) {
        $results = [];
        
        foreach ($urls as $url) {
            try {
                $this->logger->log("Starting installation for URL: {$url}", 'info');
                $result = $this->installer->install_plugin($url, $batch_id);
                $results[$url] = $result;
                $this->logger->log("Installation completed for URL: {$url}", 'success');
            } catch (Exception $e) {
                $this->logger->log("Installation failed for URL: {$url}. Error: {$e->getMessage()}", 'error');
                $results[$url] = false;
            }
        }
        
        return $results;
    }
}