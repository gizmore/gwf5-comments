<?php
trait GWF_CommentedObject
{
	// 	public function gdoCommentTable() {}
	
	public function gdoCommentCount()
	{
		return $this->queryCountComments();
	}
	
	public function queryCountComments()
	{
		$commentTable = $this->gdoCommentTable();
		$commentTable instanceof GWF_CommentTable;
		return $commentTable->countWhere('comment_object='.$this->getID());
	}
	
	public function queryComments()
	{
		$comments = GWF_Comment::table();
		$commentTable = $this->gdoCommentTable();
		$commentTable instanceof GWF_CommentTable;
		return $commentTable->select('gwf_comment.*')->fetchTable(GWF_Comment::table())->joinObject('comment_id')->where("comment_object=".$this->getID());
	}
	
	
}
