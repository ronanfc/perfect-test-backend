<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;
use Validator;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = \App\Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create', ['client' => new Client()]);
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
        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Cliente criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
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
        $client = Client::findOrFail($id);
        $this->_validate($request);
        $client->fill($request->all());
        $client->save();
        return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $sales = $client->sales();
        if($sales) {
            $sales->delete();
        }
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente deletado com sucesso');
    }

    protected function _validate(Request $request)
    {
        $this->validate($request,[
            'name' =>'required|max:191',
            'email' => 'required|email|max:191',
            'cpf' => 'required|size:11'
        ], [], [
            'name' => 'Nome',
            'email'  => 'E-mail',
            'cpf' => 'CPF',
        ]);

    }

    public function autoComplete(Request $request) {

        $query = $request->get('term','');

        $queryLike = Client::whereRaw("(name LIKE '%".$query."%')")
            ->get();

        $data=array();
        foreach ($queryLike as $qlike) {
            $data[]=array('id'=>$qlike->id, 'value'=>$qlike->name, 'email'=>$qlike->email, 'cpf'=>$qlike->cpf );
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'Nenhum cliente encontrado','id'=>''];
    }
}
