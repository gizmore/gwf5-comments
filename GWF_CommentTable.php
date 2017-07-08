<?php
class GWF_CommentTable extends GDO
{
	################
	### Comments ###
	################
	public function gdoCommentedObjectTable() {}

	public function gdoEnabled() { return true; }
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
			GDO_Object::make('comment_id')->primary()->klass('GWF_Comment'),
			GDO_Object::make('comment_object')->primary()->table($this->gdoCommentedObjectTable()),
		);
	}
	
	### 
	/**
	 * @param string $className
	 * @return GWF_CommentTable
	 */
	public static function getInstance(string $className)
	{
		$table = GDO::tableFor($className);
		if (!($table instanceof GWF_CommentTable))
		{
			throw new GWF_Exception('err_comment_table', [htmle($className)]);
		}
		return $table;
	}
}
