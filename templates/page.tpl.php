<div role="document" class="container">
  <header role="banner" class="header">
    <?php if (!empty($page['header'])): ?><?php print render($page['header']); ?><?php endif; ?>
    <?php if ($top_bar_main_menu) : ?> <?php print $top_bar_main_menu; ?> <?php endif; ?>
  </header>

  <?php if ($messages && !$zurb_foundation_messages_modal): ?>
    <div class="drupal-messages">
      <?php if ($messages): print $messages; endif; ?>
    </div>
  <?php endif; ?>


  <main id="main" class="main" role="main">
    <?php //if ($breadcrumb): print $breadcrumb; endif; ?>

    <?php if (!empty($tabs) && $is_admin): ?>
      <div class="drupal-edit-buttons">
        <?php print render($tabs); ?>
        <?php if (!empty($tabs2)): print render($tabs2); endif; ?>
      </div>
    <?php endif; ?>

    <?php if ($action_links && $is_admin): ?>
      <ul class="action-links">
        <?php print render($action_links); ?>
      </ul>
    <?php endif; ?>

    <?php print render($page['content']); ?>
  </main>


  <footer class="footer" role="contentinfo">
  <?php if (!empty($page['footer'])): ?><?php print render($page['footer']); ?><?php endif; ?>
  </footer>

  <?php if ($messages && $zurb_foundation_messages_modal): print $messages; endif; ?>
</div>
