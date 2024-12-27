<?php
if (!class_exists('Quiet_Skin')) {
    class Quiet_Skin extends WP_Upgrader_Skin {
        public function feedback($string, ...$args) {}
        public function header() {}
        public function footer() {}
        public function error($errors) {}
    }
}