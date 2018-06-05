<?php

namespace App\Models\Interfaces;

interface Searchable
{
    //
    public function search_by($info = '', $arr = []);
}
