<?php

namespace App\Http\Controllers\User;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{

    public function index()
    {
        $addresses = \Auth::user()->addresses()->paginate();
        return view('principal.pages.user.address.index', compact('addresses'));
    }

    public function create()
    {
        return view('principal.pages.user.address.create');
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
            $request['user_id'] = \Auth::user()->id;
            Address::create($request->all());
            return redirect()->back()->with('success', 'Endereço criado com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Não foi possível criar esse endereço: ' . $exception->getMessage());
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
            Address::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Endereço apagado com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Não foi possível apagar esse endereço');
        }
    }
}
