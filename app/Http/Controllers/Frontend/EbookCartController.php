<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Country;
use App\Models\Ebook;

class EbookCartController extends Controller
{
    public function cart(){

        return view('Frontend.cart');
    }

    public function addToEbookCart($id)
    {
        //dd('hi');
        $ebook = Ebook::findOrFail($id);
        $cart = session()->get('cart', []);

        if($ebook->discount > 0){
            if($ebook->discounttype == "0"){
                $new_price = $ebook->fee - ($ebook->fee * $ebook->discount/100);
                $pre_price=$ebook->fee;
            }else{
                $new_price = $ebook->fee -  $ebook->discount;
                $pre_price=$ebook->fee;
            }
        }else{
            $new_price = $ebook->fee;
        }

            $cart[$id.'-type-e-book'] = [

                "name" => $ebook->title,
                "fee" => $new_price,
                "preprice"=>$pre_price,
                "ebook_id"=>$ebook->id,
                "discount" => $ebook->discount,
                "image" => $ebook->image_show,
                "order_type"=>'ebook',
            ];

        session()->put('cart', $cart);
        return redirect()->route('cart');

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove($id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Ebook removed successfully');
            if(session()->has('cart')){
                if(count(session()->get('cart')) == 0){
                    session()->forget('cart');
                    return redirect()->to('/');
                }

            }

            return view('Frontend.cart');
        }

        // if($id) {
        //     $cart = session()->get('cart');
        //     if(isset($cart[$id])) {
        //         unset($cart[$id]);
        //         session()->put('cart', $cart);
        //     }
        //     session()->flash('success', 'Ebook removed successfully');

        //     return view('Frontend.cart');
        // }
    }

    public function checkout(){
        if(session()->has('cart')){
            return view('Frontend.checkout');
        }else{
            return redirect()->to('/');
        }
        //return view('Frontend.checkout');
    }
}
