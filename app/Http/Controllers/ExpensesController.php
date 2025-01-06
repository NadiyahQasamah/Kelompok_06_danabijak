<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\Categories;

class ExpensesController extends Controller
{
    // Halaman List Pengeluaran
    public function index()
    {
        $expenses = Expenses::getAll();
        $categories = Categories::getAll();
        return view('dashboard.expenses.list', compact('expenses', 'categories'));
    }

    // Halaman Tambah Pengeluaran
    public function addPage()
    {
        $categories = Categories::getAll();
        return view('dashboard.expenses.add', compact('categories'));
    }

    // Tambah Pengeluaran
    public function insert(Request $request)
    {
        // Insert data ke table
        $expense = Expenses::insert([
            'amount'        => $request->amount,
            'description'   => $request->description,
            'date'          => $request->date,
            'id_category'   => $request->id_category,
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        // Cek jika berhasil
        if ($expense) {
            return redirect('/expenses')->with(['success' => $request->description . ' Telah ditambahkan']);
        } else {
            return redirect('/expenses')->with(['error' => 'Terjadi kesalahan']);
        }    
    }

    // Halaman Edit Pengeluaran
    public function editPage($id_expense)
    {
        $title = "Edit Pengeluaran";  // Ganti dari Pemasukan ke Pengeluaran jika sesuai
        $expense = Expenses::getById($id_expense);  // Menarik data pengeluaran berdasarkan ID
        $categories = Categories::all();  // Mengambil semua kategori
        return view('dashboard.expenses.edit', compact('title', 'expense', 'categories'));
    }

    // Update Data via Model
        public function update(Request $request, $id_expense)
    {
            // Update data pengeluaran
            $data = [
                'amount'        => $request->amount,
                'description'   => $request->description,
                'date'          => $request->date,
                'id_category'   => $request->id_category,
                'created_at'    => now(),
            ];

            Expenses::updateData($id_expense, $data);
            return redirect()->route('expenses')->with('success', 'Data berhasil diubah!');
    }

    // Hapus Data
    public function delete($id)
    {
        // Hapus data pengeluaran berdasarkan id
        $expense = Expenses::deleteData($id);

        // Notifikasi
        if ($expense) {
            return redirect()->route('expenses')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('expenses')->with('error', 'Data Gagal Dihapus');
        }
    }
}
