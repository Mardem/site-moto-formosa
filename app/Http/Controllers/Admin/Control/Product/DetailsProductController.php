<?php

namespace App\Http\Controllers\Admin\Control\Product;

use App\Models\Admin\Product\CategoryProduct;
use App\Models\Admin\Product\DetailProduct;
use App\Support\Scopes\MessagesTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class DetailsProductController extends Controller
{
    use MessagesTrait;

    protected $nameModel = 'Detalhe';
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DetailProduct::create($request->all());
        try {
            return redirect()->back()->with('success', $this->successCreatedMessage($this->nameModel));
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
        $detail = DetailProduct::findOrFail($id);
        return view('admin.control.product.product.edit-detail', compact('detail'));
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
            DetailProduct::findOrFail($id)->update($request->all());
            return redirect()->back()->with('success', $this->successUpdateMessage($this->nameModel));
        } catch (\Exception $exception) {
            return redirect()->back()->withInput(Input::all())->with('error', $this->errorUpdateMessage($this->nameModel, $exception));
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
            DetailProduct::findOrFail($id)->delete();
            return redirect()->back()->with('success', $this->successDeleteMessage($this->nameModel));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $this->errorDeleteMessage($this->nameModel, $exception));
        }
    }
}
