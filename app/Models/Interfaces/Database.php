<?php

namespace App\Models\Interfaces;

interface Database {
    function get($id, $info = '');
    function update_db($id, $arr);
    function delete_db($id);

    function search_by();
}
