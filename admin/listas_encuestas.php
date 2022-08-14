<?php 
 
    global $wpdb; 
    $query = "SELECT * FROM {$wpdb->prefix}encuestas";
    $lista_encuestas = $wpdb->get_results($query,ARRAY_A);
    if(empty($lista_encuestas))
     {
      $lista_encuestas = array();
     }
 ?>

<diV class="wrap"
    <?php
        echo "<h1>".get_admin_page_title()."</h1>";
    ?>
     <a id="btnnuevo" class="page-title-action">Añadir nuevo:</a>
     <br><br><br>
   
     <table class="wp-list-table widefat fixed striped pages">
        <thead>
            <th> Nombre de la encuesta</th>
            <th>ShortCode</th>
            <th>Acciones</th>
        </thead>
        <tbody id="the-list">
           <?php foreach ($lista_encuestas as $key => $value) {
            # code...
            $nombre = $value['Nombre'];
            $shortcode = $value['ShortCode'];
            echo "
                  <tr>
                    <td>$nombre</td>
                    <td>$shortcode</td>
                    <td>
                      <a class='page-title-action'>Ver estadisticas</a>
                      <a class='page-title-action'>Borrar</a>
                    </td>
                  </tr> 
                  ";
                }
            ?> 
        </tbody>    
     </table>
</div>  



<!-- Modal -->
<div class="modal fade" id="modalnew" tabindex="-1" aria-labelledby="modalnewLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalnewLabel">Nueva encuesta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>