<?php
namespace Roots\Sage\CustomPostTypes\Setup;

$cpt_includes = [
    'lib/custom-post-types/resources.php',    // Resource Post Type
    'lib/custom-post-types/demandbase_audience.php'    // DemandBase Audience Post Type
];

foreach ($cpt_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
