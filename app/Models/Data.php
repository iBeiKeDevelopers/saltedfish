<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Interfaces\Database;

/**
 * Model Data, within all the universal
 * db operations, @return array
 */
class Data extends Model
{

    /**
     * get all the members
     */
    public function getIndex() {
        return $this->all();
    }

    /**
     * insert into table
     * @param array
     * @return integer
     */
    public function insert_db($arr) {
        return Report::send(
            DB::table($table)->insertGetId($arr)
        );
    }

    /**
     * update where the id is
     * @param integer
     * @param array
     * @return integer
     */
    public function update_db($id, $arr) {
        return Report::send(
            DB::table($table)->where('id', $id)->update($arr)
        );
    }

    /**
     * delete where the id is
     * @param integer
     * @return boolean
     */
    public function delete_db($id) {}

    //todo search using algorithms
    /**
     * search with a rule(?)
     * @param string
     * @return array
     */
    public function search_by($info = []) {
        $res = DB::table($this->table)
            ->where($info)->select();
        return Report::report($res, $res, 'DB error');
    }

    public function select_by_limit($start, $num, $args = []) {
        $res = DB::table($this->table)
            ->skip($start)->take($num)->get();
        return Report::report($res, $res, 'DB error');
    }
}
