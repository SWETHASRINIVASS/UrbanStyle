<?php

namespace App\Http\Controllers;

use App\Models\SaleInvoice;
use App\Models\PurchaseInvoice;
use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Fetch total sales, purchases, and expenses
        $totalSales = SaleInvoice::sum('total_amount'); 
        $totalPurchases = PurchaseInvoice::sum('total_amount'); 
        $totalExpenses = Expense::sum('amount'); 

        // Fetch user statistics
        $activeUsers = User::where('status', true)->count();
        $inactiveUsers = User::where('status', false)->count();

        // Fetch data for the chart (example: monthly sales and purchases)
        $salesData = SaleInvoice::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total');
        $purchaseData = PurchaseInvoice::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total');

            // Convert sales and purchase data to ensure they have all months (1-12)
        $formattedSalesData = array_fill(1, 12, 0);
        foreach ($salesData as $month => $total) {
            $formattedSalesData[$month] = $total;
        }

        $formattedPurchaseData = array_fill(1, 12, 0);
        foreach ($purchaseData as $month => $total) {
            $formattedPurchaseData[$month] = $total;
        }

        // Pass data to the view
        return view('dashboard', [
            'totalSales' => $totalSales,
            'totalPurchases' => $totalPurchases,
            'totalExpenses' => $totalExpenses,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'salesData' => array_values($formattedSalesData),
            'purchaseData' => array_values($formattedPurchaseData),
        ]);
    }
}