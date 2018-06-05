<?php

namespace App\Models\Interfaces;

interface Database {
    public function get($id, $info = '');
    public function update_db($id, $arr);
    public function delete_db($id);
}
