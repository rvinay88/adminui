<?php
  // Build out URI to reload from form dropdown
  // Need full url for this to work in Opera Mini
  $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

  if (isset($_POST['sg_uri']) && isset($_POST['sg_section_switcher'])) {
     $pageURL .= $_POST[sg_uri].$_POST[sg_section_switcher];
     $pageURL = htmlspecialchars( filter_var( $pageURL, FILTER_SANITIZE_URL ) );
     header("Location: $pageURL");
  }

  // Display title of each markup samples as a select option
  function listMarkupAsOptions ($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file);
        $title = preg_replace("/\-/i", " ", $filename);
        $title = ucwords($title);
        echo '<option value="#sg-'.$filename.'">'.$title.'</option>';
    endforeach;
  }

  // Display markup view & source
  function showMarkup($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file);
        $title = preg_replace("/\-/i", " ", $filename);
        $documentation = 'doc/'.$type.'/'.$file;
        echo '<div class="sg-markup sg-section">';
        echo '<div class="sg-display">';
        echo '<h2 class="sg-h2"><a id="sg-'.$filename.'" class="sg-anchor">'.$title.'</a></h2>';
        if (file_exists($documentation)) {
          echo '<div class="sg-doc">';
          echo '<h3 class="sg-h3">Usage</h3>';
          include($documentation);
          echo '</div>';
        }
        echo '<h3 class="sg-h3">Example</h3>';
        include('markup/'.$type.'/'.$file);
        echo '</div>';
        echo '<div class="sg-markup-controls"><a class="sg-btn sg-btn--source" href="#">View Source</a> <a class="sg-btn--top" href="#top">Back to Top</a> </div>';
        echo '<div class="sg-source sg-animated">';
        echo '<a class="sg-btn sg-btn--select" href="#">Copy Source</a>';
        echo '<pre class="prettyprint linenums"><code>';
        echo htmlspecialchars(file_get_contents('markup/'.$type.'/'.$file));
        echo '</code></pre>';
        echo '</div>';
        echo '</div>';
    endforeach;
  }
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
  <title>Style Guide Boilerplate</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Style Guide Boilerplate Styles -->
  <link rel="stylesheet" href="css/sg-style.css">
  <!-- Google fonts  -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300,600,700,800|Roboto:400,100,700,900|Open+Sans+Condensed:300,700|Roboto+Condensed:300italic,400,300' rel='stylesheet' type='text/css'>
  <!-- Replace below stylesheet with your own stylesheet -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div id="top" class="sg-header sg-container">
  <h1 class="sg-logo">STYLE GUIDE <span>BOILERPLATE</span></h1>
  <form id="js-sg-nav" action=""  method="post" class="sg-nav">
    <select id="js-sg-section-switcher" class="sg-section-switcher" name="sg_section_switcher">
        <option value="">Jump To Section:</option>
        <optgroup label="Intro">
          <option value="#sg-about">About</option>
          <option value="#sg-colors">Colors</option>
          <option value="#sg-fontStacks">Font-Stacks</option>
        </optgroup>
        <optgroup label="Base Styles">
          <?php listMarkupAsOptions('base'); ?>
        </optgroup>
        <optgroup label="Pattern Styles">
          <?php listMarkupAsOptions('patterns'); ?>
        </optgroup>
    </select>
    <input type="hidden" name="sg_uri" value="<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>">
    <button type="submit" class="btn">Go</button>
  </form><!--/.sg-nav-->
</div><!--/.sg-header-->

<div class="sg-body sg-container">
  <div class="sg-info">
    <div class="sg-about sg-section">
      <h2 class="sg-h2"><a id="sg-about" class="sg-anchor">About</a></h2>
      <p>Comments and documentation about your style guide. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus nobis enim labore facilis consequuntur! Veritatis neque est suscipit tenetur temporibus enim consequatur deserunt perferendis. Neque nemo iusto minima deserunt amet.</p>
    </div><!--/.sg-about-->

    <div class="sg-colors sg-section">
      <h2 class="sg-h2"><a id="sg-colors" class="sg-anchor">Colors</a></h2>
        <h3>Black</h3>
        <div class="sg-color sg-color--black"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--black-1"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--black-2"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--black-3"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--black-4"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <h3>White</h3>
        <div class="sg-color sg-color--white"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--white-1"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--white-2"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--white-3"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--white-4"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <h3>Grey</h3>
        <div class="sg-color sg-color--grey"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--grey-1"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--grey-2"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--grey-3"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--grey-4"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <h3>Red</h3>
        <div class="sg-color sg-color--red"><span class="sg-color-swatch"><span class="sg-animated">#4dd3c9</span></span></div>
        <div class="sg-color sg-color--red-1"><span class="sg-color-swatch"><span class="sg-animated">#339db0</span></span></div>
        <div class="sg-color sg-color--red-2"><span class="sg-color-swatch"><span class="sg-animated">#2078aa</span></span></div>
        <div class="sg-color sg-color--red-3"><span class="sg-color-swatch"><span class="sg-animated">#3a517a</span></span></div>
        <div class="sg-color sg-color--red-4"><span class="sg-color-swatch"><span class="sg-animated">#3a517a</span></span></div>
        <h3>Blue</h3>
        <div class="sg-color sg-color--blue"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--blue-1"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--blue-2"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--blue-3"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--blue-4"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <h3>Green</h3>
        <div class="sg-color sg-color--green"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--green-1"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--green-2"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--green-3"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--green-4"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <h3>Yellow</h3>
        <div class="sg-color sg-color--yellow"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--yellow-1"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--yellow-2"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--yellow-3"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--yellow-4"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
    </div><!--/.sg-colors-->

    <div class="sg-font-stacks sg-section">
      <h2 class="sg-h2"><a id="sg-fontStacks" class="sg-anchor">Font Stacks</a></h2>
      <p class="sg-font sg-font-primary">"Open Sans", sans-serif;</p>
      <p class="sg-font sg-font-primary-condensed">"Open Sans Condensed", sans-serif;</p>
      <p class="sg-font sg-font-secondary">"Roboto", sans-serif;</p>
      <p class="sg-font sg-font-secondary-condensed">"Roboto condensed", sans-serif;</p>
      <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
    </div><!--/.sg-font-stacks-->
  </div><!--/.sg-info-->

  <div class="sg-base-styles">
    <h1 class="sg-h1">Base Styles</h1>
    <?php showMarkup('base'); ?>
  </div><!--/.sg-base-styles-->

  <div class="sg-pattern-styles">
    <h1 class="sg-h1">Pattern Styles<small> - Design and mark-up patterns unique to your site.</small></h1>
    <?php showMarkup('patterns'); ?>
    </div><!--/.sg-pattern-styles-->
  </div><!--/.sg-body-->

  <script src="js/sg-plugins.js"></script>
  <script src="js/sg-scripts.js"></script>
</body>
</html>

