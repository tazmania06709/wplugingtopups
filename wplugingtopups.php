<?php

/*
Plugin Name: Wp Plugins TopUps
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: Josman Vicéns Noa
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

//requires

require_once dirname(__FILE__).'/clases/codigocorto.class.php';


function Activar(){
  global $wpdb;

  $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}encuestas(
          `EncuestaId` int NOT NULL AUTO_INCREMENT,
          `Nombre` varchar(45) NULL,
          `ShortCode` varchar(45) NULL,
           PRIMARY KEY (`EncuestaId`));";

  $wpdb->query($sql);

  $sql2 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}encuestas_detalle(
          `DetalleId` int NOT NULL AUTO_INCREMENT,
          `EncuestaId` int null,
          `Pregunta` varchar(150) null,
          `Tipo` varchar(45) null,
          primary key (`DetalleId`));";

  $wpdb->query($sql2);

  $sql3 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}encuestas_respuesta(
    `RespuestaId` int NOT NULL AUTO_INCREMENT,
    `DetalleId` int null,
    `Respuesta` varchar(45) null,
    primary key (`RespuestaId`));";

  $wpdb->query($sql3);
}

 function Desactivar(){
   flush_rewrite_rules();
 }

//  function Borrar(){

//  }

 register_activation_hook(__FILE__, "Activar");
 register_deactivation_hook(__FILE__, "Desactivar");
//  register_unistall_hook(__FILE__,"Borrar");

add_action('admin_menu','CrearMenu');

function CrearMenu(){
    add_menu_page(
                   'Super Encuestas Titulos',// Titulo de la pagina
                   'Super Encuestas Menu',// Titulo de Menu
                   'manage_options', // Capability
                   //'tu_menu', //slug
                    plugin_dir_path(__FILE__).'admin/listas_encuestas.php', //slug
                  // 'MostrarContenido', // Mostrar contenido de la pagina
                    null, // Mostrar contenido de la pagina
                    plugin_dir_url(__FILE__).'admin/img/folderup.png', // Icono del pulgin
                   '1'
                );
// Agregar un submenu//
/*     add_submenu_page(
                    'tu_menu', // parent slug
                    'Ajustes', // titulo pagina
                    'Ajustes', // Titulo menu
                    'manage_options',
                    'tu_menu_ajustes', // ajustes menus padre
                    'Submenu', // funcio submenu


                    );     */        
}
 
// Muestra el contenido de la pagina principal del plugin
function MostrarContenido(){
    echo "<h1>Contenido de la pagina</h1>";
}

// Funcion submenu
/*  function Submenu(){
    echo "<h1>SubMenu pagina</h1>";
}  */

//encolar bootstrap JS

function EncolarJS($hook){
   //echo "<script>console.log('$hook')</script>";
   if($hook != "wplugingtopups/admin/listas_encuestas.php"){
    return ;
   }
   wp_enqueue_script('bootstrapJs',plugins_url('admin/bootstrap/js/bootstrap.min.js',__FILE__), array('jquery'));

}
add_action('admin_enqueue_scripts','EncolarJS'); 

//encolar bootstrap CSS

function EncolarCSS($hook){
  //echo "<script>console.log('$hook')</script>";
  if($hook != "wplugingtopups/admin/listas_encuestas.php"){
   return ;
  }
  wp_enqueue_style('bootstrapcss',plugins_url('admin/bootstrap/css/bootstrap.min.css',__FILE__));

}
add_action('admin_enqueue_scripts','EncolarCSS'); 


//encolar Funciones JS

function FuncionesJS($hook){
  //echo "<script>console.log('$hook')</script>";
  if($hook != "wplugingtopups/admin/listas_encuestas.php"){
   return ;
  }
  wp_enqueue_script('functionJs',plugins_url('admin/js/lista_encuestas.js',__FILE__), array('jquery'));
  wp_localize_script('functionJs','SolicitudesAjax',[
       'url' => admin_url('admin-ajax.php'), // Worpress ejecuta all las peticiones ajax desde admin-ajax.php
       'seguridad' => wp_create_nonce('seg')
  ]);

}
add_action('admin_enqueue_scripts','FuncionesJS'); 

// Ajax

function EliminarEncuesta(){
  $nonce = $_POST['nonce'];
  if(!wp_verify_nonce($nonce, 'seg')){
      die('No tiene permisos para ejecutar ese AJAx');
  }
  $id = $_POST['id'];
  global $wpdb;
  $tabla = "{$wpdb->prefix}encuestas";
  $tabla2 = "{$wpdb->prefix}encuestas_detalle";
  $wpdb->delete($tabla,array('Encuestaid' => $id));
  $wpdb->delete($tabla2,array('Encuestaid' => $id));
  return true;

}

add_action('wp_ajax_peticioneliminar', 'EliminarEncuesta');



// shortCode

function imprimirshortcode($atts){
    $_short = new codigocorto; // Instancia de la clase codigocorto
    //obtener el id por parametro
    $id= $atts['id'];
    //Programar las acciones del boton
    if(isset($_POST['btnguardar'])){
        $listadePreguntas = $_short->ObtenerEncuestaDetalle($id);
        $codigo = uniqid();
        foreach ($listadePreguntas as $key => $value) {
           $idpregunta = $value['DetalleId'];
           if(isset($_POST[$idpregunta])){
               $valortxt = $_POST[$idpregunta];
               $datos = [
                   'DetalleId' => $idpregunta,
                   'Codigo' => $codigo,
                   'Respuesta' => $valortxt
               ];
               $_short->GuardarDetalle($datos);
           }
        }
        return " Encuesta enviada exitosamente";
    }
    //Imprimir el formulario
    $html = $_short->Armador($id);
    return $html;
}

add_shortcode("ENC","imprimirshortcode"); 