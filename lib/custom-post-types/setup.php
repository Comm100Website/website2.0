<?php
namespace Roots\Sage\CustomPostTypes\Setup;

$cpt_includes = [
    'lib/custom-post-types/announcements.php',
    'lib/custom-post-types/resources.php',
    'lib/custom-post-types/press_release.php',
    'lib/custom-post-types/press_coverage.php',
    'lib/custom-post-types/demandbase_audience.php'
];

foreach ($cpt_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
