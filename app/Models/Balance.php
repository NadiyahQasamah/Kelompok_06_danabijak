<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    // Inisialisasi Table
    protected $table = 'balance';
    public $timestamps = false;

    // Fillable fields
    protected $fillable = [
        'amount', 'description', 'updated_at'
    ];

    // Define relationships to Incomes and Expenses models
    public function incomes()
    {
        return $this->hasMany(Incomes::class, 'balance_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expenses::class, 'balance_id');
    }

    // Get All Data
    public static function getAll()
    {
        return self::all();
    }

    // Get Data by ID
    public static function getById($id)
    {
        return self::where('id_balance', $id)->first();
    }

    // Calculate Total Balance
    public static function totalBalance()
    {
        $totalIncome = Incomes::sum('amount');
        $totalExpense = Expenses::sum('amount');
        
        // Total balance = Total incomes - Total expenses
        return $totalIncome - $totalExpense;
    }

    // Get all incomes and expenses combined
    public static function getAllIncomesAndExpenses()
    {
        // Get all incomes
        $incomes = Incomes::all();

        // Get all expenses
        $expenses = Expenses::all();

        // Combine incomes and expenses
        $incomesAndExpenses = $incomes->concat($expenses);

        // Sort by date descending
        $incomesAndExpenses = $incomesAndExpenses->sortByDesc('date');

        // Return combined data
        return $incomesAndExpenses;
    }
}
