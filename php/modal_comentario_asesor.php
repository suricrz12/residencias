<div id="modalComentarioAsesor" class="modal" tabindex="-1" role="dialog">
  <input type="text" id="name_archivo_asesor" hidden>
  <input type="text" id="status_asesor" hidden>


  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">AGREGAR COMENTARIOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <textarea id="comentarios_asesor" class="form-control" style="text-transform: uppercase;"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-primary" onclick="guardar_asesor()">GUARDAR REVISIÓN</button>
      </div>
    </div>
  </div>
</div>