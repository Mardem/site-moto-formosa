<?php

namespace App\Http\Controllers\Admin\Control\Product;

use App\Http\Requests\Product\ProductRequest;
use App\Models\Admin\Product\CategoryProduct;
use App\Models\Admin\Product\DetailProduct;
use App\Models\Admin\Product\Product;
use App\Support\Scopes\MessagesTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use NumberFormatter;

class ProductController extends Controller
{
    use MessagesTrait;
    protected $nameModel = 'Produto';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category:id,name'])->paginate();
        return view('admin.control.product.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryProduct::all();
        return view('admin.control.product.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $request['rfc'] = Str::uuid();
            $request['price'] = $this->currencyBR($request->price);
            $product = Product::create($request->all());
            
            return redirect()->route('admin.products.edit', $product->id)->with('success', $this->successCreatedMessage($this->nameModel));
        } catch (\Exception $exception) {
            return redirect()->back()->withInput(Input::all())->with('error', $this->errorCreatedMessage($this->nameModel, $exception));
        }
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = CategoryProduct::all();
        $product = Product::findOrFail($id);
        $images = $product->images()->paginate();
        $details = $product->details()->paginate(5);

        return view('admin.control.product.product.edit', compact('categories', 'product', 'details', 'images'));
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
            $product = Product::findOrFail($id);
            if($request->price == null) {
                $request['price'] = $product->price;
            } else {
                $request['price'] = $this->currencyBR($request->price);
            }
            $product->update($request->all());
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
            Product::findOrFail($id)->delete();
            return redirect()->back()->with('success', $this->successUpdateMessage($this->nameModel));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $this->errorDeleteMessage($this->nameModel, $exception));
        }
    }
    private function currencyBR($getValue) {
        $source = array('.', ',', 'R$');
        $replace = array('.', '.', '');
        $valor = str_replace($source, $replace, $getValue); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }
}
