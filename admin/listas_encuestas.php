<?php 
 
    global $wpdb; 
 ?>

<diV class="wrap"
    <?php
        echo "<h1>".get_admin_page_title()."</h1>";
    ?>
     <a class="page-title-action">Añadir nuevo:</a>
     <br><br><br>
   
     <table class="wp-list-table widefat fixed striped pages">
        <thead>
            <th> Nombre de la encuesta</th>
            <th>ShortCode</th>
            <th>Acciones</th>
        </thead>
        <tbody id="the-list">
           <?php ?>
              <tr>
                <td>Primera encuesta</td>
                <td>[CODE]</td>
                <td>
                  <a class="page-title-action">Ver estadisticas</a>
                  <a class="page-title-action">Borrar</a>
                </td>
              </tr> 
           <?php ?> 
        </tbody>    
     </table>
</div>   