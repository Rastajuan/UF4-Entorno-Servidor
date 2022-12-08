<!--HACEMOS DINAMICO EL VALOR DE CADA <td> ASIGNANDOLE EL VALOR DEL OBJETO $actividad CON CADA UNO DE SUS PARAMETROS QUE SON LOS QUE HA ENVIADO EL FORMULARIO-->
<div id="nuevaActividad">
  <section>
    <img class="imgs" src="./imgs/<?php echo $actividad->tipo ?>.jpg" />
    <fieldset>
      <legend class="negrita">Actividad creada</legend>
      <table>
        <tr>
          <td class="negrita">T&iacute;tulo:</td>
          <td><?php echo $actividad->getTitulo() ?></td>
        </tr>
        <tr>
          <td class="negrita">Fecha:</td>
          <!-- Se formatea el formato de fecha por defecto con la función 'strostring'-->
          <td><?php echo date("d/m/Y", strtotime($actividad->getFecha())) ?></td>
        </tr>
        <tr>
          <td class="negrita">Ciudad:</td>
          <td><?php echo $actividad->getCiudad() ?></td>
        </tr>
        <tr>
          <td class="negrita">Tipo:</td>
          <td><?php echo $actividad->getTipo() ?></td>
        </tr>
        <tr>
          <td class="negrita">Precio:</td>
          <td><?php echo $actividad->getPrecio() ?>
          </td>
        </tr>
        <tr>
          <td class="negrita">Autor:</td>
          <td><?php echo $actividad->getUsuario() ?>
          </td>
        </tr>
        
      </table>
    </fieldset>
  </section>
</div>