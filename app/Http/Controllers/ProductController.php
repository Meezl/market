<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Project;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $user = Auth::user();
            $products = Product::where('user_id', $user->name)->get();

            return view('backend.products.index', compact('products'));
        }else if(Auth::user()->id == 1) {
            $products = Product::all();
            return view('backend.products.index', compact('products'));
        }else {
            $products = Product::all();
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
        if (Auth::check()){
            return view('backend.products.create');
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
            $product = new Product();
            $product->name = $request['name'];
            $product->price = $request['price'];
            $product->description = $request['description'];
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
            $product->save();
        }
        return redirect()->route('products.index')->with(['Success' => 'Product Added!']);
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
        if (Auth::check()){
            return view('backend.products.edit', compact('product'));
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
            $inputs = $request->all();
            $product->update($inputs);
        }

        return redirect()->route('products.index')->with(['Success' => 'Product Updated']);
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
}
