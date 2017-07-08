<?php $gdo instanceof GWF_Comment; $user = GWF_User::current(); ?>
<md-card flex layout-fill>
  <md-card-title>
    <md-card-title-text>
      <span class="md-headline">
        <div><?php echo $gdo->getCreator()->renderCell(); ?></div>
        <div class="gwf-card-date"><?php l('commented_at', [tt($gdo->getCreateDate())]); ?></div>
      </span>
    </md-card-title-text>
  </md-card-title>
  <gwf-div></gwf-div>
  <md-card-content>
    <?php echo $gdo->displayMessage(); ?>
    <?php if ($gdo->hasFile()) : ?>
    <div class="gwf-attachment" layout="row" flex layout-fill layout-align="left center">
      <div><?php echo GDO_Link::make()->icon('file_download')->href(href('Comments', 'Attachment', '&file='.$gdo->getFileID()))->renderCell(); ?></div>
      <div><?php echo $gdo->getFile()->renderCell(); ?></div>
    </div>
    <?php endif; ?>
  </md-card-content>

  <md-card-actions layout="row" layout-align="end center">
    <?php echo GDO_EditButton::make()->href($gdo->hrefEdit())->writable($gdo->canEdit($user))->renderCell(); ?>
  </md-card-actions>

</md-card>
