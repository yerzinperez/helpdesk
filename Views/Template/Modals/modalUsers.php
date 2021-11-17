<!-- Modal -->
<div class="modal fade" id="modalViewUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Datos del Usuario</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Identificación</td>
                            <td id="celIdentificacion"></td>
                        </tr>
                        <tr>
                            <td>Nombres y apellidos</td>
                            <td id="celNombres"></td>
                        </tr>
                        <tr>
                            <td>Fecha de nacimiento</td>
                            <td id="celFechaNacimiento"></td>
                        </tr>
                        <tr>
                            <td>Edad</td>
                            <td id="celEdad"></td>
                        </tr>
                        <tr>
                            <td>Cargo</td>
                            <td id="celCargo"></td>
                        </tr>
                        <tr>
                            <td>Celular</td>
                            <td id="celCelular"></td>
                        </tr>
                        <tr>
                            <td>Celular alternativo</td>
                            <td id="celCelularAlternativo"></td>
                        </tr>
                        <tr>
                            <td>Correo</td>
                            <td id="celCorreo"></td>
                        </tr>
                        <tr>
                            <td>Rol</td>
                            <td id="celRol"></td>
                        </tr>
                        <tr>
                            <td>Departamento</td>
                            <td id="celDepartamento"></td>
                        </tr>
                        <tr>
                            <td>Estado</td>
                            <td id="celEstado"></td>
                        </tr>
                        <tr>
                            <td>Fecha de creación</td>
                            <td id="celFechaCreacion"></td>
                        </tr>
                        <tr>
                            <td>Fecha de última actualización</td>
                            <td id="celFechaActualización"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Descripción</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea class="summernote" name="name" style="display: none;"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFormUsuario" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="cerrarModal();" class="modal-close" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="titleModal">Nuevo usuario</h4>
            </div>
            <div class="modal-body">
                <form id="formUsuario" name="formUsuario">
                    <input type="hidden" name="idUsuario" id="idUsuario">
                    <p class="text-danger">*Campos obligatorios.</p>
                    <p class="text-info">El usuario será siempre el correo electrónico. La contraseña será el número de identificación la primera vez.</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Tipo de documento</label>
                                <input type="text" class="form-control" value="CC" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtIdentificacion" class="control-label">Número de documento<span class="text-danger">*</span></label>
                                <input type="text" class="form-control valid validNumber" name="txtIdentificacion" id="txtIdentificacion" onkeyup="fntSetPassword(this.value);" onkeypress="return controlTag(event);" required>
                                <div class="text-muted" style="display: none;">Este campo no acepta letras ni símbolos especiales.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtNombres" class="control-label">Nombres<span class="text-danger">*</span></label>
                                <input class="form-control valid validText" id="txtNombres" name="txtNombres" type="text" required>
                                <div class="text-muted" style="display: none;">Este campo no acepta números ni símbolos especiales.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtApellidos" class="control-label">Apellidos<span class="text-danger">*</span></label>
                                <input type="text" class="form-control valid validText" name="txtApellidos" id="txtApellidos" required>
                                <div class="text-muted" style="display: none;">Este campo no acepta números ni símbolos especiales.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtFechaNacimiento" class="form-group">Fecha de nacimiento<span class="text-danger">*</span></label>
                                <input type="text" name="txtFechaNacimiento" id="txtFechaNacimiento" class="form-control valid" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtCargo" class="form-group">Cargo<span class="text-danger">*</span></label>
                                <input type="text" name="txtCargo" id="txtCargo" class="form-control valid validText" required>
                                <div class="text-muted" style="display: none;">Este campo no acepta letras ni símbolos especiales.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtCelular" class="form-group">Celular<span class="text-danger">*</span></label>
                                <input type="text" name="txtCelular" id="txtCelular" class="form-control valid validNumber" onkeypress="return controlTag(event);" required>
                                <div class="text-muted" style="display: none;">Este campo no acepta letras ni símbolos especiales.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtCelularAlternativo" class="form-group">Celular alternativo</label>
                                <input type="text" name="txtCelularAlternativo" id="txtCelularAlternativo" class="form-control valid validNumber opcional" onkeypress="return controlTag(event);" required>
                                <div class="text-muted" style="display: none;">Este campo no acepta letras ni símbolos especiales.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtCorreo" class="form-group">Correo<span class="text-danger">*</span></label>
                                <input type="email" name="txtCorreo" id="txtCorreo" class="form-control valid validEmail" placeholder="alguien@example.com" onkeyup="fntSetUser(this.value);" required>
                                <div class="text-muted" style="display: none;">Email inválido.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group group-rol">
                                <label for="cboRol" class="form-group">Rol<span class="text-danger">*</span></label>
                                <select class="select2" id="cboRol">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group group-departamento">
                                <label for="cboDepartamento" class="form-group">Departamento<span class="text-danger">*</span></label>
                                <select class="select2" id="cboDepartamento">

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group group-estado">
                                <label for="cboEstado" class="form-group">Estado<span class="text-danger">*</span></label>
                                <select class="select2" id="cboEstado">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtUsuario" class="form-group">Usuario</label>
                                <input type="email" name="txtUsuario" id="txtUsuario" class="form-control valid validEmail" placeholder="alguien@example.com" readonly required>
                                <div class="text-muted" style="display: none;">Email inválido.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-group lblPassword">Contraseña</label>
                                <input type="password" name="txtPassword" id="txtPassword" class="form-control" readonly required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cerrarModal();" id="btnCancelar" class="btn btn-rounded btn-danger"> <i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar</button>
                <button type="button" id="btnActionForm" class="btn btn-rounded btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<!--.modal-->