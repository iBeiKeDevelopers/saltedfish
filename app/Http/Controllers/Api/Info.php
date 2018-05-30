<?php

namespace App\Http\Controllers\API;

interface Info
{
    /*/
    public function list_orders();

    public function user_update();
    public function get_user_self();
    public function get_user_info();
    public function get_user_total();
    public function get_user_goods();
*/
    public function get_goods($request);
    public function delete_goods($request);

    //public function user_bind($id, $password, $old_un, $old_password);
}
