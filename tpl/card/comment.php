<?php $gdo instanceof GWF_Comment; ?>

<?php
?>

<md-card>
  <md-card-title>
    <md-card-title-text>
      <span class="md-headline">
        <div>“<?php html($gdo->getTitle()); ?>” - <?php echo $gdo->getCreator()->renderCell(); ?></div>
        <div class="gwf-card-date"><?php lt($gdo->getCreateDate()); ?></div>
      </span>
    </md-card-title-text>
  </md-card-title>
  <gwf-div></gwf-div>
  <md-card-content>
    <?php echo $gdo->displayMessage(); ?>
  </md-card-content>

  <md-card-actions layout="row" layout-align="end center">
  </md-card-actions>

</md-card>
