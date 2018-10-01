<?php
namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function getStatus($id) {
        return Order::findOrFail($id)->status;
    }
}