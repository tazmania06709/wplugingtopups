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
  
}
 function Desactivar(){

 }

//  function Borrar(){

//  }

 register_activation_hook(__FILE__, "Activar");
 register_deactivation_hook(__FILE__, "Desactivar");
//  register_unistall_hook(__FILE__,"Borrar");