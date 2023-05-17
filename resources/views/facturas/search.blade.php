{!! Form::open(array('url'=>'facturas','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}

<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Buscar por número de comprobante">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-warning">Buscar</button>
        </span>
    </div>
</div>

{{Form::close()}}