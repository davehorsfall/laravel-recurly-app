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
        $page_num = isset($_GET['page']) ? (int) $_GET['page'] : 0;
        $per_page = 5;

        $options = [
            'params' => [
              'state' => 'active',
            ]
          ];

        $client = new \Recurly\Client(env('RECURLY_PRIVATE_API_KEY'));

        try {
            //$account = $client->getAccount('code-'. Auth::id());
            $account = $client->getAccount('code-62');
            $invoices = $client->listAccountInvoices($account->getId());
        } catch (\Recurly\Errors\Validation $e) {
            $account = false;
            $invoices = false;
        } catch (\Recurly\Errors\NotFound $e) {
            $account = false;
            $invoices = false;
        } catch (\Recurly\RecurlyError $e) {
            $account = false;
            $invoices = false;
        }

        return view('invoices.index')->with('invoices', $invoices);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new \Recurly\Client(env('RECURLY_PRIVATE_API_KEY'));

        try {
            $invoice = $client->getInvoicePdf($id);

            return $response = response($invoice->getData(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="invoice_' . $id . '.pdf"',
            ]);
        } catch (\Recurly\Errors\NotFound $e) {
            // Could not find the resource, you may want to inform the user
            // or just return a NULL
            echo 'Could not find resource.' . PHP_EOL;
            var_dump($e);
        } catch (\Recurly\RecurlyError $e) {
            // Something bad happened... tell the user so that they can fix it?
            echo 'Some unexpected Recurly error happened. Try again later.' . PHP_EOL;
        }
    }
}
