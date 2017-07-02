<?php
class GWF_CommentTable extends GDO
{
	################
	### Comments ###
	################
	public function gdoCommentedObjectTable() {}

	public function gdoAllowTitle() { return true; }
	public function gdoAllowFiles() { return true; }
	public function gdoMaxComments(GWF_User $user) { return 1; }
	
	###########
	### GDO ###
	###########
	/**
	 * @return GDO
	 */
	public function gdoAbstract() { return $this->gdoCommentedObjectTable() === null; }
	public function gdoColumns()
	{
		return array(
			GDO_Object::make('comment_object')->primary()->table($this->gdoCommentedObjectTable()),
			GDO_Object::make('comment_id')->klass('GWF_Comment'),
		);
	}
	
}
