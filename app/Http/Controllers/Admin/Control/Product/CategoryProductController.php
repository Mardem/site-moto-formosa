<?php

namespace App\Http\Controllers\Admin\Control\Product;

use App\Models\Admin\Product\CategoryProduct;
use App\Support\Scopes\MessagesTrait;
use GuzzleHttp\Psr7\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class CategoryProductController extends Controller
{
    use MessagesTrait;
    protected $nameModel = 'Categoria';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryProduct::paginate();
        return view('admin.control.product.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.control.product.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            CategoryProduct::create($request->all());
            return redirect()->back()->with('success', $this->successCreatedMessage($this->nameModel));
        } catch (\Exception $exception) {
            return redirect()->back()->withInput(Input::all())->with('error', $this->errorCreatedMessage($this->nameModel, $exception));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = CategoryProduct::findOrFail($id);
        return view('admin.control.product.category.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryProduct::findOrFail($id);
        return view('admin.control.product.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $category = CategoryProduct::findOrFail($id);
            $category->slug = null;
            $category->update($request->all());
            return redirect()->back()->with('success', $this->successUpdateMessage($this->nameModel));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $this->errorUpdateMessage($this->nameModel, $exception));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            CategoryProduct::findOrFail($id)->delete();
            return redirect()->back()->with('success', $this->successDeleteMessage($this->nameModel));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $this->errorDeleteMessage($this->nameModel, $exception));
        }
    }
}
