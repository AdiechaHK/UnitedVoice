<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('render_page'))
{
  
  function render_page($controller, $name, $data = array(), $additional_module = array(), $isAdmin = false)
  {
    $_additional_modules_info = array(
      /*
      'module_name'=> array(
        'css'=> array('css1', 'css2'),
        'js'=> array('js1', 'js2')
        )
      */
      'dataTable'=> array(
        'css'=> array('jquery.dataTables.min'),
        'js'=> array('jquery.dataTables.min')
        ),
      'mediaElement'=> array(
        'css'=> array('mediaelementplayer.min'),
        'js'=> array('mediaelement-and-player.min'),
        )
      );
    // $css_list = array($name);
    // $js_list = array($name);
    $css_list = array();
    $js_list = array();
    foreach ($additional_module as $module) {
      if (array_key_exists($module, $_additional_modules_info)) {
        $module_details = $_additional_modules_info[$module];
        # adding css related to module;
        foreach ($module_details['css'] as $css) {
          array_push($css_list, $css);
        }
        # adding js related to module;
        foreach ($module_details['js'] as $js) {
          array_push($js_list, $js);
        }
      } else {
        // echo $module." module need to add in util helper";
      }
      array_push($css_list, $name);
      array_push($js_list, $name);
    }
    $controller->load->view('common/header', array('css'=> $css_list));
    if($isAdmin) {
      $data['active_page'] = $name;
      $controller->load->view('common/specific_admin_header', $data);
    }
    $controller->load->view('pages/'.$name, $data);
    if($isAdmin) {
      $controller->load->view('common/specific_admin_footer', $data);
    }
    $controller->load->view('common/footer', array('js'=> $js_list));
  }

}