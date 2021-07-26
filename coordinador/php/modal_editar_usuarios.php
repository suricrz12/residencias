<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <input type="text" id="id_edit_user" hidden>
        <input type="text" id="email_edit_user" hidden>
        <input type="text" id="password_edit_user" hidden>

        <div class="form-group">
          <div class="input-group-prepend">
            <span class="col-form-label" id="email">EMAIL</span>
          </div>
          <input type="email" class="form-control" aria-label="email" required name="editar_email" aria-describedby="email" placeholder="SE ENVIARAN LOS DATOS DE USUARIO A ESTE" autocomplete="nope">
        </div>

        <div class="form-group">
          <div class="input-group-prepend">
            <span class="col-form-label" id="password">CONTRASEÑA</span>
          </div>
          <input type="text" class="form-control" aria-label="password" required name="editar_password" aria-describedby="password" placeholder="ESCRIBA LA CONTRASEÑA" autocomplete="nope">
        </div>
                
        <div class="form-group">
          <div class="input-group-prepend">
            <label class="col-form-label" for="tipo_usuario">
              TIPO USUARIO
            </label>
          </div>
          <select class="form-control" autocomplete="nope" name="editar_tipo_usuario" onchange="if(this.value==2){document.getElementsByName('editar_asignar_asesor')[0].disabled = true;document.getElementsByName('editar_asignar_asesor')[0].value =0}else{document.getElementsByName('editar_asignar_asesor')[0].disabled = false;document.getElementsByName('editar_asignar_asesor')[0][1].disabled=true,document.getElementsByName('editar_asignar_asesor')[0].value =''}" required>
            <option value="" disabled selected>SELECCIONE UNO</option>
            <option value="2" >ASESOR</option>
            <option value="3" >ALUMNO</option>
          </select>
        </div>

        <div class="form-group">
          <div class="input-group-prepend">
            <label class="col-form-label" for="asignar_asesor">
              ASIGNAR ASESOR
            </label>
          </div>
          <select class="form-control" autocomplete="nope" name="editar_asignar_asesor" required>
          </select>
        </div>

        <div class="form-group">
          <div class="input-group-prepend">
            <label class="col-form-label" for="asignar_carrera">
              ASIGNAR CARRERA
            </label>
          </div>
          <select class="form-control" autocomplete="nope" name="editar_asignar_carrera" required>
          </select>
        </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="editar_usuario($('#id_edit_user').val())">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>