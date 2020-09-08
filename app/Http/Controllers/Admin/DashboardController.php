<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Gerar Dashboard.
     *
     * Metodo Get relatório com todas Vendas
     * Metodo POST relatório para cliente do Form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
//        dd($request->all());
        $idClient = '';
        $products = Product::all();
        $clients = Client::orderBy('name', 'ASC')->get();
        $resultSales = DB::table('sales as s')
            ->join('products as p', 'p.id', '=', 's.product_id')
            ->select(
                's.status',
                DB::raw('IFNULL(COUNT(s.status), 0) as amount'),
                DB::raw('IFNULL(SUM(p.price), 0) as total')
            )
            ->groupBy('s.status')
            ->get();

        if (empty($request->all())) {
            $sales = Sale::all();
        } else {
            $this->_validate($request);
            $data = $request->all();
            $idClient = $data['inlineFormInputName'];

            list($fromDate, $toDate)  = explode("-", $data['inlineFormInputGroupPeriod']);
            $fromDate = date( 'Y-m-d' , strtotime($fromDate));
            $toDate = date( 'Y-m-d' , strtotime($toDate));

            if(!strtotime($fromDate) || !strtotime($toDate)){
                Session::flash('erro', 'Data inválida');
            }

            $sales = Sale::where('client_id', '=', $idClient)
            ->whereBetween('date_sale', [$fromDate, $toDate])->get();
        }

        return view('admin.dashboard', compact('sales', 'products', 'clients','resultSales', 'idClient'));
    }

    protected function _validate(Request $request)
    {
        $this->validate($request,[
            'inlineFormInputName' =>'required|max:191',
            'inlineFormInputGroupPeriod' => 'required',
        ], [], [
            'inlineFormInputName' => 'Cliente',
            'inlineFormInputGroupPeriod'  => 'Período',
        ]);

    }
}
