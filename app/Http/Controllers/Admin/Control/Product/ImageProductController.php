<?php

namespace App\Http\Controllers\Admin\Control\Product;

use App\Admin\Product\ImageProduct;
use App\Support\ImageService;
use App\Support\Scopes\MessagesTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ImageProductController extends Controller
{
    use MessagesTrait;
    protected $nameModel = 'Produto';
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->hasFile('image_path')) {

                $image = new ImageService($request->image_path, 373, 327);
                $request['path'] = $image->resizeImage('products', false);

                $thumb = new ImageService($request->image_path, 100, 100);
                $request['thumb_path'] = $thumb->resizeImage('products', true);
            }
            ImageProduct::create($request->all());
            return redirect()->back()->with('success', $this->successCreatedMessage($this->nameModel));
        } catch (\Exception $exception) {
            return redirect()->back()->withInput(Input::all())->with('error', $this->errorCreatedMessage($this->nameModel, $exception));
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
            $image = ImageProduct::findOrFail($id);
            Storage::drive('uploads')->delete($image->image);
            Storage::drive('uploads')->delete($image->thumb_path);
            $image->delete();
            return redirect()->back()->with('success', 'Imagem apagada com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->back()->withInput(Input::all())->with('error', 'Não foi possível apagar esta imagem:' . $exception->getMessage());
        }
    }
}
