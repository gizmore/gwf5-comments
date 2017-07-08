<?php
abstract class Comments_List extends GWF_MethodQueryList
{
	/**
	 * @return GWF_CommentTable
	 */
	public abstract function gdoCommentsTable();
	public function gdoTable() { return $this->gdoCommentsTable(); }
	
	public abstract function hrefAdd();
	
	/**
	 * @var GDO
	 */
	protected $object;
	
	public function init()
	{
		$this->object = $this->gdoCommentsTable()->gdoCommentedObjectTable()->find(Common::getRequestString('id'));
	}
	
	public function gdoQuery()
	{
		$query = $this->gdoTable()->select('gwf_comment.*')->where("comment_object=".$this->object->getID());
		$query->joinObject('comment_id');
		return $query->fetchTable(GWF_Comment::table());
	}
	
	public function execute()
	{
		return $this->object->renderCard()->add(parent::execute());
	}
}
