<?php $grid = $sf_data->getRaw('grid'); ?>
<div id="grid-example">
  <table>
   <?php echo $grid->render() ?>
  </table>
</div>

<script type='text/javascript'>
  $("#grid-example").<?php echo $grid->getName() ?>JqFlexiGrid();
</script>
