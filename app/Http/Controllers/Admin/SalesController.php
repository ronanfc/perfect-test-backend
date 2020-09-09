<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();
        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.sales.create',
            [
                'sale' => new Sale(),
                'products' => $products
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->_validate($request);
        $data = $request->all();
        if(empty($data['client_id'])) {
            $client = Client::create($request->all());
            $data['client_id'] = $client->id;
        }

        $data['date_sale'] = date( 'Y-m-d' , strtotime($data['date_sale']));
        $data['discount'] = str_replace(array('.', ','), array('', '.'), $data['discount']);
        Sale::create($data);
        return redirect()->route('sales.index')->with('success', 'Venda atualizada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return view('admin.sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $products = Product::all();
        return view('admin.sales.edit', compact('products', 'sale'));
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
        $sales = Sale::findOrFail($id);
        $this->_validate($request);
        $data = $request->all();
        if($sales->client_id == $data['client_id']) {
            if(($sales->client->nome != $data['name']) ||
                ($sales->client->email != $data['email']) ||
                ($sales->client->cpf != $data['cpf']))
            {
                $sales->client->name = $data['name'];
                $sales->client->email = $data['email'];
                $sales->client->cpf = $data['cpf'];
                $sales->client->save();
            }
        }
        $data['date_sale'] = date( 'Y-m-d' , strtotime($data['date_sale']));
        $data['discount'] = str_replace(array('.', ','), array('', '.'), $data['discount']);
        $sales->fill($data);
        $sales->save();
        return redirect()->route('sales.index')->with('success', 'Venda atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Venda deletada com sucesso');
    }

    protected function _validate(Request $request)
    {
        $this->validate($request,[
            'name' =>'required|max:191',
            'email' => 'required|email|max:191',
            'cpf' => 'required|size:11',
            'product_id' => 'required|numeric',
            'date_sale' => 'required',
            'qtd_product' => 'required|numeric|min:1|max:10',
            'discount' => 'required',
            'status' => 'required|numeric',
        ], [], [
            'name' => 'Nome',
            'email'  => 'E-mail',
            'cpf' => 'CPF',
            'product_id' => 'Produto',
            'date_sale' => 'Data',
            'qtd_product' => 'Quantidade',
            'discount' => 'Desconto',
            'status' => 'Status',
        ]);

    }
}
