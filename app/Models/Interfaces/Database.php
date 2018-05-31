<?php

namespace App\Models\Interfaces;

interface Database {
    public function get($info = 'id');
    public function update_db($arr = []);
    public function delete_db($id);
}
