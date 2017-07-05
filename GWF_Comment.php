<?php
final class GWF_Comment extends GDO
{
	use GWF_LikedObject;
	public function gdoLikeTable() { return GWF_CommentLikes::table(); }
	
	public function gdoColumns()
	{
		return array(
			GDO_AutoInc::make('comment_id'),
			GDO_String::make('comment_title')->notNull(),
			GDO_Message::make('comment_message')->notNull(),
			GDO_File::make('comment_file'),
			GDO_CreatedAt::make('comment_created'),
			GDO_CreatedBy::make('comment_creator'),
			GDO_EditedAt::make('comment_edited'),
			GDO_EditedBy::make('comment_editor'),
		);		
	}
	
	public function getID() { return $this->getVar('comment_id'); }
	
	public function getCreatorID() { return $this->getVar('comment_creator'); }
	public function getCreator() { return $this->getValue('comment_creator'); }
	public function getCreateDate() { return $this->getVar('comment_created'); }
	
	public function getTitle() { return $this->getVar('comment_title');  }
	public function getMessage() { return $this->getVar('comment_message');  }
	public function displayMessage() { return $this->gdoColumn('comment_message')->value($this->getMessage())->renderCell();  }
	
	public function renderCard()
	{
		return GWF_Template::modulePHP('Comments', 'card/comment.php', ['gdo' => $this]);
	}
	
}