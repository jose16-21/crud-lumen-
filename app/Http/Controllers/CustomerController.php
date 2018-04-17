<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Customer;
use Validator;

class CustomerController extends Controller {
    
    public function __construct() {
        $this->middleware('auth',['only'=>[
        'select',        
        'create',
        'update',
        'delete']]);
    }
    
    public function index(Request $request) {
    
        $customers = Customer::all();      
        return response()->json($customers);
    }

    public function store(Request $request) {
        try{
         $this->validate($request, [
         'name' => 'required',
         'address' => 'required',
         'phone' => 'required'
         ]);        
            $result = Customer::create($request->all());
            return response()->json($result); 
        }catch (Exception $e) {
        dd( 'Excepción capturada: '. $e->getMessage());
      }
     }
    
    
    public function update(Request $request, $id) { 
       try{
        $this->validate($request, [
         'name' => 'required',
         'address' => 'required',
         'phone' => 'required'
         ]);         

        $customer = Customer::find($id);        
        $result = $customer->update($request->all());
        return response()->json(['update' => $result]); 
        }catch (Exception $e) {
        dd( 'Excepción capturada: '. $e->getMessage());
      }
    }
    
    public function destroy($id) {
        $customer = Customer::destroy($id);
        return  response()->json(['delete' => $customer]); 
    }
}
