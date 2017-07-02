<?php
trait GWF_CommentedObject
{
	// 	public function gdoCommentTable() {}
	// 	public function gdoCommentTable() {}
	
	public function queryComments()
	{
		$comments = GWF_Comment::table();
		$commentTable = $this->gdoCommentTable();
		$commentTable instanceof GWF_CommentTable;
		
		
		
	}
	
}
