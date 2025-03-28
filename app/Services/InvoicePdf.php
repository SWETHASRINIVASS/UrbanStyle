<?php

namespace App\Services;

use setasign\Fpdf\Fpdf;

class InvoicePdf extends \FPDF
{
    protected $invoice;
    protected $type;

    public function __construct($invoice, $type)
    {
        parent::__construct();
        $this->invoice = $invoice;
        $this->type = $type;
    }

    // Add a header with a company name and logo
    public function Header()
    {
        // Add a logo (optional)
        // $this->Image(storage_path('app/public/logo.png'), 10, 6, 30);

        // Add company name
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(190, 10, 'UrbanStyle', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(190, 5, '123 street, Coimbatore, Tamil Nadu ,638402', 0, 1, 'C');
        $this->Cell(190, 5, 'Phone: (+91) 8870957129  | Email: UrbanStyle@gmail.com', 0, 1, 'C');
        $this->Ln(10);
    }

    // Add a footer with a thank-you message
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Thank you for your business!', 0, 0, 'C');
    }

    public function generatePDF()
    {
        $this->AddPage();
        $this->SetFont('Arial', 'B', 16);

        // Invoice Title
        $title = $this->type === 'sale' ? 'Sale Invoice' : 'Purchase Invoice';
        $this->Cell(0, 10, "{$title} : # {$this->invoice->id}", 0, 1, 'L');

        // Invoice Date and Customer/Supplier Info
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, "Date : {$this->invoice->created_at->format('d/m/Y')}", 0, 1, 'L');

        if ($this->type === 'sale') {
            $this->Cell(0, 10, "Customer : {$this->invoice->customer->name}", 0, 1, 'L');
        } else {
            $this->Cell(0, 10, "Supplier : {$this->invoice->supplier->name}", 0, 1, 'L');
        }

        $this->Ln(10);

        // Table Header
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(200, 200, 200); // Light gray background
        $this->Cell(50, 10, 'Product', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Quantity', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Price', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Discount', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Tax %', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Total', 1, 1, 'C', true);

        // Table Body
        $this->SetFont('Arial', '', 12);
        $fill = false; // Alternating row colors
        $items = $this->type === 'sale' ? $this->invoice->saleInvoiceItems : $this->invoice->purchaseInvoiceItems;
        foreach ($items as $item) {
            $this->SetFillColor(240, 240, 240); // Light gray for alternating rows
            $this->Cell(50, 10, $item->product->name ?? 'N/A', 1, 0, '', $fill);
            $this->Cell(30, 10, $item->quantity, 1, 0, 'C', $fill);
            $this->Cell(30, 10, number_format($item->price, 2), 1, 0, 'C', $fill);
            $this->Cell(30, 10, $item->discount . '%', 1, 0, 'C', $fill);
            $this->Cell(20, 10, $item->tax_rate . '%', 1, 0, 'C', $fill);
            $this->Cell(30, 10, number_format($item->total_amount, 2), 1, 1, 'C', $fill);
            $fill = !$fill; // Toggle row color
        }

        // Total Amount
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(130, 10, 'Total Amount', 1, 0, 'C');
        $this->Cell(60, 10, number_format($this->invoice->total_amount, 2), 1, 1, 'R');

        // Save PDF to file
        $pdfPath = storage_path("app/invoices/{$this->type}_invoice_{$this->invoice->invoice_number}.pdf");
        $this->Output($pdfPath, 'F');

        

        return $pdfPath;
    }
}