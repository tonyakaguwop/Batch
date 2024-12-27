<?php
class BPI_Status_Tracker {
    private $installed_plugins = [];
    
    public function track_installation($plugin_url, $success, $batch_id) {
        $slug = BPI_URL_Helper::get_plugin_slug_from_url($plugin_url);
        
        $this->installed_plugins[$slug] = [
            'url' => $plugin_url,
            'success' => $success,
            'batch_id' => $batch_id,
            'installed_at' => current_time('mysql')
        ];
        
        update_option('bpi_installed_plugins', $this->installed_plugins);
    }
    
    public function get_installation_status($plugin_slug) {
        return isset($this->installed_plugins[$plugin_slug]) 
            ? $this->installed_plugins[$plugin_slug] 
            : null;
    }
    
    public function get_batch_installations($batch_id) {
        return array_filter(
            $this->installed_plugins,
            function($plugin) use ($batch_id) {
                return $plugin['batch_id'] === $batch_id;
            }
        );
    }
}