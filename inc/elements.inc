<?php
/**
 * Override drupal core messages with zurb foundation alert-box messages.
 * Customize the colors within the _settings.scss file.
 *
 * http://foundation.zurb.com/docs/elements.php#panelEx
 */
function cross_border_showcase_status_messages($variables) {
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'error' => t('Error message'),
    'status' => t('Status message'),
    'warning' => t('Warning message'),
  );

  $status_mapping = array(
    'error' => 'alert',
    'status' => 'success',
    'warning' => 'warning'
  );

  foreach (drupal_get_messages($display) as $type => $messages) {

    // <div data-closable class="alert callout">
    //   <h5>This is Important!</h5>
    //   <p>But when you're done reading it, click the close button in the corner to dismiss this alert.</p>
    //   <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    //     <span aria-hidden="true">&times;</span>
    //   </button>
    // </div>


    if (isset($status_mapping[$type])) {
      // $output .= "<div data-alert class=\"alert-box \">\n";
      $output .= '<div data-closable class="' . $status_mapping[$type] . ' callout">';
    }
    else {
      $output .= '<div data-closable class="callout">';
      // $output .= "<div data-alert class=\"alert-box\">\n";
    }

    // if (!empty($status_heading[$type])) {
    //   $output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
    // }
    if (count($messages) > 1) {
      $output .= " <ul class=\"no-bullet\">\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }

    if(!theme_get_setting('zurb_foundation_messages_modal')) {
      // $output .= '<a href="#" class="close">&times;</a>';
      $output .= '<button class="close-button" aria-label="Dismiss alert" type="button" data-close> <span aria-hidden="true">&times;</span> </button>';
    }

    $output .= "</div>\n";
  }

  if ($output != '' && theme_get_setting('zurb_foundation_messages_modal')) {
    $output = '<div id="status-messages" class="reveal-modal" role="alertdialog">'. $output;
    $output .= '<a class="close-reveal-modal">&#215;</a>';
    $output .= "</div>";
  }

  return $output;
}
