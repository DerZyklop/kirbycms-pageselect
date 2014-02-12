<?php

global $site;
global $options;
$options = array();

if (!function_exists("makeArray")) {

  function makeArray($items, $layer = 0) {
    global $options;
    foreach($items as $item) {
      $options[count($options)] = $item;
      if( $item->hasChildren() ) {
        $layer = $layer++;
        makeArray($item->children(), $layer);
      }
    }
  }

}

makeArray( $site->pages() );
?>

<select name="<?php echo $name ?>">
  <option<?php if(!$value) echo ' selected="selected"' ?> value=""></option>
  <?php foreach($options as $key => $item): ?>
    <?php
      $seperator = '';
      for ($i=1; $i < $item->depth(); $i++) {
        $seperator .= '- ';
      }
    ?>
    <option<?php if($item->uri() == $value) echo ' selected="selected"' ?> value="<?php echo html($item->uri()) ?>"><?php echo($seperator.html($item->title())); ?></option>
  <?php endforeach ?>
</select>
