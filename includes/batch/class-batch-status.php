<?php
class BPI_Batch_Status {
    private $batch_id;
    private $status;
    private $started_at;
    private $completed_at;
    private $total_plugins;
    private $processed_plugins;
    
    public function __construct($batch_id, $total_plugins) {
        $this->batch_id = $batch_id;
        $this->total_plugins = $total_plugins;
        $this->processed_plugins = 0;
        $this->status = 'pending';
        $this->started_at = current_time('mysql');
    }
    
    public function increment_processed() {
        $this->processed_plugins++;
        if ($this->processed_plugins >= $this->total_plugins) {
            $this->complete();
        }
    }
    
    public function complete() {
        $this->status = 'completed';
        $this->completed_at = current_time('mysql');
    }
    
    public function to_array() {
        return [
            'batch_id' => $this->batch_id,
            'status' => $this->status,
            'started_at' => $this->started_at,
            'completed_at' => $this->completed_at,
            'total_plugins' => $this->total_plugins,
            'processed_plugins' => $this->processed_plugins
        ];
    }
}