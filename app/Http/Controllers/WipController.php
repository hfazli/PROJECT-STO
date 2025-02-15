<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wip;
use App\Models\Customer;
use App\Imports\WipImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF; // Ensure you have the barryvdh/laravel-dompdf package installed

class WipController extends Controller
{
    public function index(Request $request)
    {
        $entries = $request->get('entries', 'all'); // Default to 'all' entries per page
        $search = $request->get('search'); // Get the search query

        $query = Wip::query();

        if ($search) {
            $query->where('customer', 'like', '%' . $search . '%');
        }

        if ($entries == 'all') {
            $wips = $query->get();
        } else {
            $wips = $query->paginate($entries);
        }

        return view('wip.index', compact('wips', 'search'));
    }

    public function create()
    {
        $customers = Customer::all(); // Ambil semua data customer
        return view('wip.create', compact('customers'));
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

        $wip = new Wip();
        $wip->inventory_id = $request->inventory_id;
        $wip->part_name = $request->part_name;
        $wip->part_number = $request->part_number;
        $wip->type_package = $request->type_package;
        $wip->qty_package = $request->qty_package;
        $wip->project = $request->project;
        $wip->customer = $request->customer;
        $wip->detail_lokasi = $request->detail_lokasi;
        $wip->satuan = $request->satuan;
        $wip->plant = $request->plant;

        $wip->save();

        return redirect()->route('wip.index')->with('success', 'WIP created successfully.');
    }

    public function show($id)
    {
        $wip = Wip::findOrFail($id);
        return view('wip.show', compact('wip'));
    }

    public function edit($id)
    {
        $wip = Wip::findOrFail($id);
        $customers = Customer::all();
        return view('wip.edit', compact('wip', 'customers'));
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
            'plant' => 'nullable|string|max:255',
        ]);

        $wip = Wip::findOrFail($id);
        $wip->update($request->all());

        return redirect()->route('wip.index')->with('success', 'WIP updated successfully.');
    }

    public function destroy($id)
    {
        $wip = Wip::findOrFail($id);
        $wip->delete();

        return redirect()->route('wip.index')->with('success', 'WIP deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $import = new WipImport;
        Excel::import($import, $request->file('file'));

        if (count($import->getErrorRows()) > 0) {
            return redirect()->route('wip.index')->with('error', 'Some rows failed to import.');
        }

        return redirect()->route('wip.index')->with('success', 'WIP imported successfully.');
    }

    public function showUploadForm()
    {
        return view('wip.upload');
    }

    // public function downloadPdf()
    // {
    //     $wips = Wip::all();
    //     $pdf = PDF::loadView('wip.pdf', compact('wips'));
    //     return $pdf->download('wips.pdf');
    // }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');
        Excel::import(new WipImport, $file);

        return redirect()->route('wip.index')->with('success', 'WIP uploaded successfully.');
    }

    public function changeStatus($id, Request $request)
    {
        $wip = Wip::find($id);
        if ($wip) {
            $wip->status = $request->status;
            $wip->save();

            return response()->json(['success' => true, 'message' => 'Status berhasil diubah.']);
        } else {
            return response()->json(['success' => false, 'message' => 'WIP tidak ditemukan.']);
        }
    }
}