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

//encolar bootstrap

function EncolarBootstarpJS(){

    wp_enqueue_script('bootstrapJS',plugins_url('admin/bootstrap/js/bootstrap.min.js'),__FILE__),array('jquery'));

}
add_action('admin_enqueue_scripts','EncolarBootstrapJS');