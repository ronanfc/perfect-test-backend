<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', ['product' => new Product()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->_validate($request);
        $data = $request->all();

        $data['img_src'] = $data['img_src_url'];

        if ($request->hasFile('img_src_file') && $request->file('img_src_file')->isValid()) {

            $image = $request->file('img_src_file');

            $nome = $image->getClientOriginalName();

            $extensions = array('jpeg', 'png', 'jpg', 'gif', 'svg', 'JPEG', 'PNG', 'JPG', 'GIF', 'SVG');

            $result = array($request->file('img_src_file')->getClientOriginalExtension());

            if (!in_array($result[0], $extensions)) {
                Session::flash('erro', 'Arquivo deve ser do tipo: jpeg,png,jpg,gif,svg');
                return back()->with(['error' => 'Arquivo deve ser do tipo: jpeg,png,jpg,gif,svg']);
            }

            $nome = strtolower(str_replace(" ", "_", preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($nome)))));


            $destinationPath = public_path('/img/products');

            $image->move($destinationPath, $nome);
            $data['img_src'] = $nome;
        }

        $data['price'] = str_replace(array('.', ','), array('', '.'), $data['price']);
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->_validate($request);
        $data = $request->all();

        if (!empty($data['img_src_url'])) {
            $data['img_src'] = $data['img_src_url'];
        }

        if ($request->hasFile('img_src_file') && $request->file('img_src_file')->isValid()) {

            $image = $request->file('img_src_file');

            $nome = $image->getClientOriginalName();

            $extensions = array('jpeg', 'png', 'jpg', 'gif', 'svg', 'JPEG', 'PNG', 'JPG', 'GIF', 'SVG');

            $result = array($request->file('img_src_file')->getClientOriginalExtension());

            if (!in_array($result[0], $extensions)) {
                Session::flash('erro', 'Arquivo deve ser do tipo: jpeg,png,jpg,gif,svg');
                return back()->with(['error' => 'Arquivo deve ser do tipo: jpeg,png,jpg,gif,svg']);
            }

            // Remover acentos e espaços do nome da imagem
            $nome = strtolower(str_replace(" ", "_", preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($nome)))));


            $destinationPath = public_path('/img/products');

            $image->move($destinationPath, $nome);
            $data['img_src'] = $nome;
        }

        $data['price'] = str_replace(array('.', ','), array('', '.'), $data['price']);
        $product->fill($data);
        $product->save();
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $sales = $product->sales();
        if ($sales) {
            $sales->delete();
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'produto deletado com sucesso');
    }

    /*
    * Validação do Formulário de Cadastro e Atualização
    */
    protected function _validate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'description' => 'required|max:191',
            'price' => 'required',
            'img_src_url' => 'nullable|string|max:191',
            'img_src_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ], [], [
            'name' => 'Nome',
            'description' => 'Descrição',
            'price' => 'Preço',
            'img_src_file' => 'Imagem',
            'img_src_url' => 'URL',
        ]);

    }

}
