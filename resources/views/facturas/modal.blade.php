<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$ven -> id}}">
    {{Form::open(array('action' => array('FacturaController@destroy', $ven -> id), 'method' => 'delete'))}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <h4 class="modal-title">Cancelar venta</h4>
                </div>
                <div class="modal-body">
                    <p>Confirme si desea cancelar la venta</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-warning">Confirmar</button>
                </div>
            </div>
        </div>
    {{Form::close()}}
</div>