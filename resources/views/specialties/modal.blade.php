<div class="modal modal fade" id="delete{{$specialty->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Confirmar su eliminación</h4>
      </div>
      <form action="{{ route('specialties.destroy', $specialty->id) }}" method="post">
          @csrf
          @method('DELETE')
        <div class="modal-body">
        <p class="text-center">
          ¿Está seguro que desea eliminar {{ $specialty->name }}?
        </p>
            <input type="hidden" name="category_id" id="cat_id" value="{{ $specialty->id }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>