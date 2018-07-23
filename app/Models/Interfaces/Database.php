<?php

namespace App\Models\Interfaces;

interface Database {
    function get($id);

    function decode_db();
    function encode_db();

    function insert_db($arr);
    function update_db($id, $arr);
    function delete_db($id);

    function search_by($info = 'id');
}
