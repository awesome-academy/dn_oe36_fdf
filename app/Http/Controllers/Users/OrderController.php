<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\Eloquent\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Repositories\Interfaces\OrderRepositoryInterface;


class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->middleware('auth');
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        return view('users.orders.index');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        if ($this->orderRepository->createOrder($request->all())) {
            return redirect()->back()->with('success', trans('messages.order.success'));
        } else {

            return redirect()->route('cart.show')->with('fail', trans('messages.order.fail'));
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

}