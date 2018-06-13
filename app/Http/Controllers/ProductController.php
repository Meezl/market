<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        if (Auth::check()){
            $user = Auth::user();
            $products = Product::where('user_id', $user->id)->get();

            return view('backend.products.index', compact('products'));
        }else if(Auth::check() && Auth::user()->id == 1) {
            $products = Product::all();
            return view('backend.products.index', compact('products'));
        }else {
            $products = Product::paginate(9);
            return view('frontend.products.index', compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $categories = Category::all();
        if (Auth::check()){
            return view('backend.products.create', ['countries' => $countries, 'categories' => $categories]);
        }else {
            return redirect()->route('products.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            /* $request->validate( [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|max:255',
                'description' => 'required|string|min:6|max:255',
                'phone_number' => 'required|string|min:6',
            ]);*/

            $product = new Product();
            $product->name = $request['name'];
            $product->price = $request['price'];
            $product->description = $request['description'];
            $product->town = $request['town'];
            $product->category_id = $request['category'];
            $product->user_id = Auth::user()->id;
            $product->country_id = $request['country'];

            if($request->hasFile('image')) {

                $file = $request->file('image');

                $destination_path = 'images/products';
                $name = $file->getClientOriginalName();
                $file->move($destination_path, $name);

                $product->image = $name;
            }
            $product->save();
            return redirect()->route('products.index')->with(['Success' => 'Product Added!']);
        }else {
            return redirect()->route('products.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (Auth::check()){
            return view('backend.products.show', compact('product'));
        }else {
            return view('frontend.products.show', compact('product'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if (Auth::check()) {
            return view('backend.products.edit', compact('product'));
        }else {
            return view('frontend.products.show', compact('product'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if (Auth::check()){
            $product->name = $request['name'];
            $product->price = $request['price'];
            $product->description = $request['description'];
            $product->town = $request['town'];
            $category = Category::where('name', $request['category'])->get();
            $product->category_id = $category->id;
            $product->user_id = Auth::user()->id;
            $country = Country::where('name',$request['country'])->get();
            $product->country_id = $country->id;

            if($request->hasFile('image')) {

                $file = $request->file('image');

                $destination_path = 'images/products';
                $name = $file->getClientOriginalName();
                $file->move($destination_path, $name);

                $product->image = $name;
            }
            $product->update();

            return redirect()->route('products.index')->with(['Success' => 'Product Updated']);
        }else {
            return redirect()->route('products.index');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(Auth::check()){
            $product->delete();
        }

        return redirect()->route('products.index')->with(['Success' => 'Product Deleted!']);
    }

    public function search(Request $request){
        $name = $request['name'];
        $products = Product::where('name', 'like', '%' . $name . '%')->paginate(6);
        return view('frontend.products.index', compact('products'));
    }
}
