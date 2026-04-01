<?php
/**
 * LevelAI Static Site Generator
 * Renders all PHP pages to HTML for Vercel deployment
 */

define('BASE_PATH', __DIR__);
$distDir = __DIR__ . '/dist';

// Pages to render: [output_file, source_file, $vars]
$pages = [
  ['index.html',              'index.php',              []],
  ['onboard/step1.html',      'onboard/step1.php',      []],
  ['onboard/step2.html',      'onboard/step2.php',      []],
  ['onboard/step3.html',      'onboard/step3.php',      []],
  ['onboard/step4.html',      'onboard/step4.php',      []],
  ['onboard/step5.html',      'onboard/step5.php',      []],
  ['home.html',               'home.php',               []],
  ['schedule.html',           'schedule.php',           []],
  ['task.html',               'task.php',               []],
  ['break.html',              'break.php',              []],
  ['settings.html',           'settings.php',           []],
];

// Create dist dir
if (!is_dir($distDir)) mkdir($distDir, 0755, true);
if (!is_dir($distDir . '/onboard')) mkdir($distDir . '/onboard', 0755, true);

foreach ($pages as [$out, $src, $vars]) {
  extract($vars);
  ob_start();
  include __DIR__ . '/' . $src;
  $html = ob_get_clean();

  // Rewrite .php links to .html
  $html = preg_replace('/href="([^"]*?)\.php([^"]*?)"/i', 'href="$1.html$2"', $html);
  $html = preg_replace("/href='([^']*?)\.php([^']*?)'/i", "href='$1.html$2'", $html);
  // Also fix JS redirects
  $html = str_replace("window.location.href = '/index.php'", "window.location.href = '/index.html'", $html);
  $html = str_replace("window.location.href = '/home.php'", "window.location.href = '/home.html'", $html);
  $html = str_replace("window.location.href = '/onboard/step2.php'", "window.location.href = '/onboard/step2.html'", $html);
  $html = str_replace("window.location.href = '/onboard/step3.php'", "window.location.href = '/onboard/step3.html'", $html);
  $html = str_replace("window.location.href = '/onboard/step4.php'", "window.location.href = '/onboard/step4.html'", $html);
  $html = str_replace("window.location.href = '/onboard/step5.php'", "window.location.href = '/onboard/step5.html'", $html);

  file_put_contents($distDir . '/' . $out, $html);
  echo "✓ $out\n";
}

// Copy assets
$assetSrc = __DIR__ . '/assets';
$assetDst = $distDir . '/assets';
shell_exec("cp -r " . escapeshellarg($assetSrc) . " " . escapeshellarg($assetDst));
echo "✓ assets/\n";
echo "\nBuild complete → dist/\n";
