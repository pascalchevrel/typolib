<?php

ob_start();

$javascript_include = isset($javascript_include) ? $javascript_include : [];
$css_include = isset($css_include) ? $css_include : [];
if (strpos(VERSION, 'dev') !== false) {
    $beta_version = true;
    $title_productname = PRODUCT . ' Beta';
} else {
    $beta_version = false;
    $title_productname = PRODUCT;
}

?>
<!doctype html>

<html lang="en" dir="ltr">
  <head>
    <title><?php if ($show_title == true) {
    echo $page_title . ' — ';
} ?><?=$title_productname?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/typolib.css?<?php echo VERSION; ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="/assets/font-awesome/font-awesome-built.css?<?php echo VERSION; ?>" type="text/css" media="all" />

    <?php
    foreach ($css_include as $css_file) {
        echo "<link rel=\"stylesheet\" href=\"/style/{$css_file}?" . VERSION . "\" type=\"text/css\" media=\"all\" />\n";
    }
    ?>
  </head>
<body id="<?=$page?>">
  <header>
    <?php
    if ($beta_version) {
        echo "<div id='beta-badge'><span>BETA</span></div>\n";
    }
    ?>
    <h1 id="logo"><a href="/" id="typolib-title"><?php echo PRODUCT; ?></a></h1>
  </header>

  <div id='cssmenu'>
    <ul>
       <li><a href='/'>Home</a></li>
       <li><a href='/manage'>Rules manager</a></li>
       <li><a href='/display'>Rules viewer</a></li>
       <li><a href='/check'>Check text</a></li>
       <li><a href='/test'>Test</a></li>
       <li><a href='/about'>About</a></li>
       <li><a href='/contact'>Contact</a></li>
    </ul>
  </div>

  <div id="content-wrap">

    <?php if ($show_title == true): ?>
    <h2 id="page-title"><?=$page_title?></h2>
    <h3 id="page-descrition"><?=$page_descr?></h3>
    <?php endif; ?>

    <?php if (array_filter($success)): ?>
    <div id="success">
        <ul>
        <?php foreach ($success as $s) : ?>
            <li><?=$s?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (array_filter($errors)): ?>
    <div id="errors">
        <ul>
        <?php foreach ($errors as $error) : ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <div id="page-content">
      <?=$extra?>
      <?=$content?>
    </div>

    <div id="noscript-warning">
      Please enable JavaScript. Some features won’t be available without it.
    </div>

  </div>

  <footer>
    <p><?php echo PRODUCT; ?> v<?php echo VERSION; ?></p>
  </footer>

  <script src="/assets/jquery/jquery.min.js"></script>
  <script src="/js/base.js"></script>
  <?php
    foreach ($javascript_include as $js_file) {
        echo "    <script src=\"/js/{$js_file}\"></script>\n";
    }
  ?>
</body>
</html>

<?php

$content = ob_get_contents();

ob_end_clean();

print $content;
