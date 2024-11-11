<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Country;
use App\Models\Ebook;

class CartController extends Controller
{
    public function cart(){

        return view('Frontend.cart');
    }

    public function addToCart($id)
    {

            $course = Course::findOrFail($id);
            // $ebook = Ebook::findOrFail($id);
            $cart = session()->get('cart', []);

            if($course->discount > 0){
                if($course->discounttype == "0"){
                    $new_price = $course->fee - ($course->fee * $course->discount/100);
                    $pre_price=$course->fee;
                }else{
                    $new_price = $course->fee -  $course->discount;
                    $pre_price=$course->fee;
                }
            }else{
                $new_price = $course->fee;
            }

            $cart[$id.'-type-course'] = [
                "name" => $course->name,
                "fee" => $new_price,
                "preprice"=>$pre_price,
                "course_id"=>$course->id,
                "discount" => $course->discount,
                "image" => $course->teacher?->image_show,
                "order_type"=>'course',
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
            session()->flash('success', 'Cart removed successfully');
            if(session()->has('cart')){
                if(count(session()->get('cart')) == 0){
                    session()->forget('cart');
                    return redirect()->to('/');
                }
                
            }

            return view('Frontend.cart');
        }
    }

    public function checkout(){
        if(session()->has('cart')){
            return view('Frontend.checkout');
        }else{
            return redirect()->to('/');
        }

    }
}
