<?php

/**
 * sanskrit Addon
 *
 * @author cukabeka
 * @author <a href="http://www.redaxo.de">www.redaxo.de</a>
 *
 * @package redaxo4
 * @version svn:$Id$
 */

?>

<div class="rex-addon-output">

  <h2 class="rex-hl2"><?php echo $I18N->msg('sanskrit_title'); ?></h2>

  <div class="rex-addon-content">
    <p class="rex-tx1">
    <?php echo $I18N->msg('sanskrit_versinfo'); ?>
    </p>
    <p class="rex-tx1">
    <?php echo $I18N->msg('sanskrit_shorthelp'); ?>
    </p>
    <p class="rex-tx1">
    <?php echo $I18N->msg('sanskrit_longhelp'); ?>
    </p>
    <p class="rex-tx1">
    <?php echo $I18N->msg('sanskrit_nodel_notice'); ?>
    </p>

  </div>

</div>

<div class="rex-addon-output">

  <h2 class="rex-hl2"><?php echo $I18N->msg('sanskrit_title_module_input'); ?></h2>

  <div class="rex-addon-content">
    <p class="rex-tx1">
    <?php echo $I18N->msg('sanskrit_help_module_input'); ?>
    </p>
    <?php rex_highlight_string(rex_get_file_contents($REX['INCLUDE_PATH'].'/addons/sanskrit/modul_input.txt')); ?>
  </div>

</div>

<div class="rex-addon-output">

  <h2 class="rex-hl2"><?php echo $I18N->msg('sanskrit_title_module_output'); ?></h2>

  <div class="rex-addon-content">
    <p class="rex-tx1">
    <?php echo $I18N->msg('sanskrit_help_module_output'); ?>
    </p>
    <?php rex_highlight_string(rex_get_file_contents($REX['INCLUDE_PATH'].'/addons/sanskrit/modul_output.txt')); ?>
  </div>

</div>
