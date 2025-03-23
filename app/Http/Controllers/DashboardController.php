<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Fetch total sales, purchases, and expenses
        $totalSales = Sale::sum('total_amount'); // Replace 'total_amount' with the actual column name
        $totalPurchases = Purchase::sum('total_amount'); // Replace 'total_amount' with the actual column name
        $totalExpenses = Expense::sum('amount'); // Replace 'amount' with the actual column name

        // Fetch user statistics
        $activeUsers = User::where('status', true)->count();
        $inactiveUsers = User::where('status', false)->count();

        // Fetch data for the chart (example: monthly sales and purchases)
        $salesData = Sale::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total');
        $purchaseData = Purchase::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total');

        // Pass data to the view
        return view('dashboard', compact(
            'totalSales',
            'totalPurchases',
            'totalExpenses',
            'activeUsers',
            'inactiveUsers',
            'salesData',
            'purchaseData'
        ));
    }
}