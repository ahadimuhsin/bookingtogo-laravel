<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Family;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with(['nationality','families'])->orderBy('cst_id', 'DESC')->get();

        // dd($customers);

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $nationalities = Nationality::get();

        return view('customers.create', compact('nationalities'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cst_name' => 'required',
            'cst_dob' => 'required',
            'cst_phone' => 'required',
            'cst_email' => 'required',
            'nationality_id' => 'required',
        ]);

        //save customer
        DB::beginTransaction();
        try {
            $customer = Customer::create([
                'cst_name' => $request->input('cst_name'),
                'cst_dob' => $request->input('cst_dob'),
                'cst_phone' => $request->input('cst_phone'),
                'cst_email' => $request->input('cst_email'),
                'nationality_id' => $request->input('nationality_id'),
            ]);

            // dd($request->input("family_name"));
            if(count($request->input('family_name')) > 0)
            {
                for($i = 0; $i < count($request->input('family_name')); $i++)
                {
                    $customer->family()->create([
                        'cst_id' => $customer->cst_id,
                        'fl_relation' => $request->input('family_relation')[$i],
                        'fl_name' => $request->input('family_name')[$i],
                        'fl_dob' => $request->input('family_dob')[$i],
                    ]);
                }
            }
                DB::commit();
        } catch (\Throwable $e) {
            # code...
            DB::rollBack();
            dd($e->getMessage());
        }

        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = Customer::with(['nationality', 'families'])->findOrFail($id);
        $nationalities = Nationality::get();

        // dd($customer->family);
        return view('customers.edit', compact('customer', 'nationalities'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cst_name' => 'required',
            'cst_dob' => 'required',
            'cst_phone' => 'required',
            'cst_email' => 'required',
            'nationality_id' => 'required',
        ]);

        $customer = Customer::with('families')->findOrFail($id);
        DB::beginTransaction();
        try {
            # code...
            $customer->update([
                'cst_name' => $request->input('cst_name'),
                'cst_dob' => $request->input('cst_dob'),
                'cst_phone' => $request->input('cst_phone'),
                'cst_email' => $request->input('cst_email'),
                'nationality_id' => $request->input('nationality_id'),
            ]);

            //delete first

            Family::where('cst_id', $id)->delete();

            //save new data
            for($i = 0; $i < count($request->input('family_name')); $i++)
            {
                $customer->families()->create([
                    'cst_id' => $customer->cst_id,
                    'fl_relation' => $request->input('family_relation')[$i],
                    'fl_name' => $request->input('family_name')[$i],
                    'fl_dob' => $request->input('family_dob')[$i],
                ]);
            }
            DB::commit();
        } catch (\Throwable $e) {
            # code...
            DB::rollBack();
            dd($e->getMessage());
        }

        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();
        return redirect()->route('customers.index');
    }
}
