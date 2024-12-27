<?php
class BPI_Results_Processor {
    public function process_batch_results($results) {
        $summary = [
            'total' => count($results),
            'successful' => 0,
            'failed' => 0,
            'failures' => []
        ];
        
        foreach ($results as $url => $result) {
            if ($result === true) {
                $summary['successful']++;
            } else {
                $summary['failed']++;
                $summary['failures'][$url] = $result;
            }
        }
        
        return $summary;
    }
}