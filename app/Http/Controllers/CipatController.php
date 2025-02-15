<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cipat;
use App\Models\Customer;
use App\Imports\CipatImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF; // Ensure you have the barryvdh/laravel-dompdf package installed

class CipatController extends Controller
{
    public function index(Request $request)
    {
        $entries = $request->get('entries', 'all'); // Default to 'all' entries per page
        $search = $request->get('search'); // Get the search query

        $query = Cipat::query();

        if ($search) {
            $query->where('customer', 'like', '%' . $search . '%');
        }

        if ($entries == 'all') {
            $cipat = $query->get();
        } else {
            $cipat = $query->paginate($entries);
        }

        return view('cipat.index', compact('cipat', 'search'));
    }

    public function create()
    {
        $customers = Customer::all(); // Ambil semua data customer
        return view('cipat.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|string|max:255',
            'part_name' => 'required|string|max:255',
            'part_number' => 'required|string|max:255',
            'type_package' => 'required|string|max:255',
            'qty_package' => 'required|integer',
            'project' => 'nullable|string|max:255',
            'customer' => 'required|string|max:255',
            'detail_lokasi' => 'nullable|string|max:255',
            'satuan' => 'required|string|max:255',
            'plant' => 'nullable|string|max:255',
        ]);

        $cipat = new Cipat();
        $cipat->inventory_id = $request->inventory_id;
        $cipat->part_name = $request->part_name;
        $cipat->part_number = $request->part_number;
        $cipat->type_package = $request->type_package;
        $cipat->qty_package = $request->qty_package;
        $cipat->project = $request->project;
        $cipat->customer = $request->customer;
        $cipat->detail_lokasi = $request->detail_lokasi;
        $cipat->satuan = $request->satuan;
        $cipat->plant = $request->plant;

        $cipat->save();

        return redirect()->route('cipat.index')->with('success', 'Cipat created successfully.');
    }

    public function show($id)
    {
        $cipat = Cipat::findOrFail($id);
        return view('cipat.show', compact('cipat'));
    }

    public function edit($id)
    {
        $cipat = Cipat::findOrFail($id);
        $customers = Customer::all();
        return view('cipat.edit', compact('cipat', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'inventory_id' => 'required|string|max:255',
            'part_name' => 'required|string|max:255',
            'part_number' => 'required|string|max:255',
            'type_package' => 'required|string|max:255',
            'qty_package' => 'required|integer',
            'project' => 'nullable|string|max:255',
            'customer' => 'required|string|max:255',
            'detail_lokasi' => 'nullable|string|max:255',
            'satuan' => 'required|string|max:255',
        ]);

        $cipat = Cipat::findOrFail($id);
        $cipat->update($request->all());

        return redirect()->route('cipat.index')->with('success', 'Cipat updated successfully.');
    }

    public function destroy($id)
    {
        $cipat = Cipat::findOrFail($id);
        $cipat->delete();

        return redirect()->route('cipat.index')->with('success', 'Cipat deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $import = new CipatImport;
        Excel::import($import, $request->file('file'));

        if (count($import->getErrorRows()) > 0) {
            return redirect()->route('cipat.index')->with('error', 'Some rows failed to import.');
        }

        return redirect()->route('cipat.index')->with('success', 'Cipat imported successfully.');
    }

    public function showUploadForm()
    {
        return view('cipat.upload');
    }
    // public function downloadPdf()
    // {
    //     $cipat = Cipat::all();
    //     $pdf = PDF::loadView('cipat.pdf', compact('cipat'));
    //     return $pdf->download('cipat.pdf');
    // }
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');
        Excel::import(new CipatImport, $file);

        return redirect()->route('cipat.index')->with('success', 'Cipat uploaded successfully.');
    }

    public function changeStatus($id, Request $request)
    {
        $cipat = Cipat::find($id);
        if ($cipat) {
            $cipat->status = $request->status;
            $cipat->save();

            return response()->json(['success' => true, 'message' => 'Status berhasil diubah.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Cipat tidak ditemukan.']);
        }
    }
}