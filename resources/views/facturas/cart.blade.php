@extends('layouts.app', ['activePage' => 'factura-management', 'titlePage' => __('Factura Management')])

<div class="col-md-4">
    @card
        @slot('title')
            Cart
        @endslot

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Harga</th>
                        <th>QTY</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(row.index) in shoppingCart">
                        <td>@{{ row.nombre }} (@{{ row.codigo }})</td>
                        <td>@{{ row.precio | currency }}</td>
                        <td>@{{ row.cantidad }}</td>
                        <td>
                            <button @click.prevent="removeCart(index)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        @slot('footer')
        <div class="card-footer text-muted">
            @if(url()->curret() == route('facturas.transaction'))
            <a href="{{ route('facturas.checkout') }}" class="btn btn-secondary btn-sm float-right">Checkout</a>
            @else
            <a href="{{ route('facturas.transaction') }}" class="btn btn-secondary btn-sm float-right">Back</a>
            @endif
        </div>
        @endslot
    @endcard
</div>