@extends('layouts.app')

@section('content')
<div class="row my-5 gx-5 justify-content-center">
    <div class="col-lg-10 col-xl-7">
        <div class="text-center">
            <h1 class="display-6 fw-normal">Invoices</h1>
            <p class="fs-5 text-muted">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque fugit ratione dicta mollitia. Officiis ad.</p>
        </div>
    </div>
</div>
@if ($invoices)
<div class="table-responsive">
    <table class="table text-center">
        <thead>      
        <tr>
            <th class="list-number text-start">#</th>
            <th class="list-status">Status</th>
            <th class="list-created">Created</th>
            <th class="list-tax text-end">Tax</th>
            <th class="list-total text-end">Total price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <th scope="row" class="text-start">{{ $invoice->getNumber() }}</td>
                <td>
                    <div class="btn-group" role="group">
                        {!! App\Http\Helpers\RecurlyHelper::getBadge($invoice->getState()) !!}
                        <a class="btn btn-secondary btn-sm" href="{{ route('invoices.show', $invoice->getId()) }}" role="button">PDF</a>
                    </div>
                </td>   
                <td>{{ date('d/m/Y', strtotime($invoice->getCreatedAt())) }}</td>
                <td class="text-end"><small class="text-muted">{{ $invoice->getCurrency() }}</small> {{ number_format($invoice->getTax(), 2) }}</td>
                <td class="text-end"><small class="text-muted">{{ $invoice->getCurrency() }}</small> {{ number_format($invoice->getTotal(), 2) }}</td>
            </tr>            
        @endforeach   
        </tbody>
    </table>
</div>
@endif  
@endsection
