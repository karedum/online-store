<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\Basket;
use function PHPUnit\Framework\isNull;

class BasketController extends Controller
{
    public function basket()
    {
        $order = (new Basket())->getOrder();
        return view('basket', compact('order'));
    }

    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailbale()) {
            session()->flash('warning', 'Товар в большем количестве недоступен для заказа '.$product->name);
            return redirect()->route('basket');
        }
        return view('order', compact('order'));
    }

    public function basketConfirm(Request $request)
    {
        $success = (new Basket())->saveOrder($request->name, $request->phone, $request->email);

        if ($success) {
            session()->flash('success', 'Ваш заказ принят в обработку');
        } else {
            session()->flash('error', 'Товар в большем количестве недоступен для заказа '.$product->name);
        }

        Order::eraseOrderSum();

        return redirect()->route('index');
    }

    public function basketAdd(Product $product)
    {
        $result = (new Basket(true))->addProduct($product);
        if ($result) {
            session()->flash('success', 'Добавлен товар '.$product->name);
        } else {
            session()->flash('warning', 'Товар в большем количестве недоступен для заказа '.$product->name);
        }

        return redirect()->route('basket');
    }

    public function basketRemove(Product $product)
    {
        (new Basket())->removeProduct($product);


        session()->flash('warning', 'Удален товар '.$product->name);
        return redirect()->route('basket');
    }
}
