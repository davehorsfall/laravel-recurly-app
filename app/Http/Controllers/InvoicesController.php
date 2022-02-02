<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params = ['limit' => 200];
        $account_id = 0;
        $client = new \Recurly\Client(env('RECURLY_PRIVATE_API_KEY'));
        $account = $client->getAccount('code-'.$account_id);
        $invoices = $client->listAccountInvoices($account->getId(), $params);
        foreach ($invoices as $invoice) {
            // print_r($invoice);
        // exit;
        }

        return view('invoices.index')->with('invoices', $invoices);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show')->with('invoice', $invoice);
    }
}
