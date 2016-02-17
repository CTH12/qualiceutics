<?php

// Table of Contents
// ----------------------------------------
// 01. General Site things
// 02. Preprocess Functions
// 03. Form Alters
// 04. View Functions
//




/**
 * Loads additional template files.
 */
function _qualiceutics_load() {
  $themepath = drupal_get_path('theme', 'qualiceutics');
  include $themepath . '/inc/elements.inc';
  // include $themepath . '/inc/form.inc';
  include $themepath . '/inc/menu.inc';
}

_qualiceutics_load();


// 01. General Site things
// ============================================================
function qualiceutics_theme() {

  // create custom user-login.tpl.php
  // ----------------------------------------
  // ----------------------------------------
  $items = array();

  $items['user_login'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'qualiceutics') . '/templates',
      'template' => 'user-login',
      'preprocess functions' => array(
        'qualiceutics_preprocess_user_login'
      ),
  );

  return $items;
  // shout out to this blog post:
  // http://dannyenglander.com/blog/customizing-user-login-page-drupal-7
  // ----------------------------------------

}


/**
 * Implements hook_css_alter().
 */
function qualiceutics_css_alter(&$css) {
 // Always remove base theme CSS.
 $theme_path = drupal_get_path('theme', 'zurb_foundation');

 foreach($css as $path => $values) {
   if(strpos($path, $theme_path) === 0) {
     unset($css[$path]);
   }
 }
}


/**
 * Implements hook_js_alter().
 */
function qualiceutics_js_alter(&$js) {
 // Always remove base theme JS.
 $theme_path = drupal_get_path('theme', 'zurb_foundation');

 foreach($js as $path => $values) {
   if(strpos($path, $theme_path) === 0) {
     unset($js[$path]);
   }
 }
}


/**
 * Implements theme_links() targeting the main menu topbar.
 * Override base template, which would add the class of "left",which  we don't need
 */
function qualiceutics__topbar_main_menu($variables) {
  // We need to fetch the links ourselves because we need the entire tree.
  $links = menu_tree_output(menu_tree_all_data(variable_get('menu_main_links_source', 'main-menu')));
  $output = _zurb_foundation_links($links);

  return '<ul' . drupal_attributes($variables['attributes']) . '>' . $output . '</ul>';
}





// 02. Preprocess Functions
// ============================================================

/**
 * Implements template_preprocess_html().
 *
 */
// function qualiceutics_preprocess_html(&$variables) {
//   // things for all HTML pages
// }

/**
 * Implements template_preprocess_page
 *
 */
//function qualiceutics_preprocess_page(&$variables) {
//}
/**
 * Implements template_preprocess_page
 */
function qualiceutics_preprocess_page(&$variables) {
  // https://www.drupal.org/node/1427564
  drupal_add_js('jQuery.extend(Drupal.settings, { "themePath": "' . path_to_theme() . '" });', 'inline');
}


/**
 * Implements template_preprocess_node
 *
 */
//function qualiceutics_preprocess_node(&$variables) {
//}

/**
 * Implements hook_preprocess_block()
 */
//function qualiceutics_preprocess_block(&$variables) {
//  // Add wrapping div with global class to all block content sections.
//  $variables['content_attributes_array']['class'][] = 'block-content';
//
//  // Convenience variable for classes based on block ID
//  $block_id = $variables['block']->module . '-' . $variables['block']->delta;
//
//  // Add classes based on a specific block
//  switch ($block_id) {
//    // System Navigation block
//    case 'system-navigation':
//      // Custom class for entire block
//      $variables['classes_array'][] = 'system-nav';
//      // Custom class for block title
//      $variables['title_attributes_array']['class'][] = 'system-nav-title';
//      // Wrapping div with custom class for block content
//      $variables['content_attributes_array']['class'] = 'system-nav-content';
//      break;
//
//    // User Login block
//    case 'user-login':
//      // Hide title
//      $variables['title_attributes_array']['class'][] = 'element-invisible';
//      break;
//
//    // Example of adding Foundation classes
//    case 'block-foo': // Target the block ID
//      // Set grid column or mobile classes or anything else you want.
//      $variables['classes_array'][] = 'six columns';
//      break;
//  }
//
//  // Add template suggestions for blocks from specific modules.
//  switch($variables['elements']['#block']->module) {
//    case 'menu':
//      $variables['theme_hook_suggestions'][] = 'block__nav';
//    break;
//  }
//}

//function qualiceutics_preprocess_views_view(&$variables) {
//}

/**
 * Implements template_preprocess_panels_pane().
 *
 */
//function qualiceutics_preprocess_panels_pane(&$variables) {
//}

/**
 * Implements template_preprocess_views_views_fields().
 *
 */
//function qualiceutics_preprocess_views_view_fields(&$variables) {
//}

/**
 * Implements theme_form_element_label()
 * Use foundation tooltips
 */
//function qualiceutics_form_element_label($variables) {
//  if (!empty($variables['element']['#title'])) {
//    $variables['element']['#title'] = '<span class="secondary label">' . $variables['element']['#title'] . '</span>';
//  }
//  if (!empty($variables['element']['#description'])) {
//    $variables['element']['#description'] = ' <span data-tooltip="top" class="has-tip tip-top" data-width="250" title="' . $variables['element']['#description'] . '">' . t('More information?') . '</span>';
//  }
//  return theme_form_element_label($variables);
//}

/**
 * Implements hook_preprocess_button().
 */
//function qualiceutics_preprocess_button(&$variables) {
//  $variables['element']['#attributes']['class'][] = 'button';
//  if (isset($variables['element']['#parents'][0]) && $variables['element']['#parents'][0] == 'submit') {
//    $variables['element']['#attributes']['class'][] = 'secondary';
//  }
//}

/**
 * Implements hook_form_alter()
 * Example of using foundation sexy buttons
 */
// function qualiceutics_form_alter(&$form, &$form_state, $form_id) {
//   // Sexy submit buttons
//   if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
//     $classes = (is_array($form['actions']['submit']['#attributes']['class']))
//       ? $form['actions']['submit']['#attributes']['class']
//       : array();
//     $classes = array_merge($classes, array('secondary', 'button', 'radius'));
//     $form['actions']['submit']['#attributes']['class'] = $classes;
//   }
// }

/**
 * Implements hook_form_FORM_ID_alter()
 * Example of using foundation sexy buttons on comment form
 */
//function qualiceutics_form_comment_form_alter(&$form, &$form_state) {
  // Sexy preview buttons
//  $classes = (is_array($form['actions']['preview']['#attributes']['class']))
//    ? $form['actions']['preview']['#attributes']['class']
//    : array();
//  $classes = array_merge($classes, array('secondary', 'button', 'radius'));
//  $form['actions']['preview']['#attributes']['class'] = $classes;
//}


/**
 * Add placeholder attribute to the Search form
 * Implements hook_form_FORM_ID_alter()
*/
// function qualiceutics_form_search_block_form_alter(&$form, &$form_state) {
//   $form['search_block_form']['#attributes']['placeholder'] = "I'm looking for...";
// }

// function qualiceutics_preprocess_search_block_form(&$variables) {
//   // dpm($variables);
// }
