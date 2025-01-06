<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    // Show All Data
    public function index()
    {
        $categories = Categories::getAll();
        return view('dashboard.categories.list', compact('categories'));
    }

    // Goto Add Data Page
    public function addPage()
    {
        $title = "Tambah Kategori";
        return view('dashboard.categories.add', compact('title'));
    }

    // Insert & Send Data to Model
    public function insert(Request $request)
    {
        // Validate form data
        $request->validate([
            'name_category' => 'required|string|max:255',
            'type' => 'required|in:expense,income', // Ensure type is either 'expense' or 'income'
        ]);

        // Insert data
        $data = [
            'name_category' => $request->name_category,
            'type' => $request->type,
        ];

        Categories::insert($data);
        return redirect()->route('categories')->with('success', 'Data berhasil ditambahkan!');
    }



    // Go to Edit Data Page
    public function editPage($id)
    {
        $title = "Edit Kategori";
        $category = Categories::getById($id);
        return view('dashboard.categories.edit', compact('title', 'category'));
    }

    // Update Data via Model
    public function update(Request $request, $id_category)
{
    // Validate input data
    $validatedData = $request->validate([
        'name_category' => 'required|string|max:255',
        'type' => 'required|in:expense,income',  // Ensure 'type' is either 'expense' or 'income'
    ]);

    // Prepare data for update
    $data = [
        'name_category' => $request->name_category,
        'type' => $request->type,  // Make sure 'type' is passed and not null
    ];

    // Perform the update
    Categories::where('id_category', $id_category)->update($data);

    // Redirect with success message
    return redirect()->route('categories')->with('success', 'Data berhasil diubah!');
}



    // Delete Data
    public function delete($id)
    {
        // Hapus data pendapatan berdasarkan id
        $category = Categories::deleteData($id);

        // Notifikasi
        if ($category) {
            return redirect()->route('categories')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('categories')->with('error', 'Data Gagal Dihapus');
        }
    }
}
