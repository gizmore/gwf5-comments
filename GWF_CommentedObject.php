<?php
/**
 * This trait adds utilities for a commented object.
 * To make an object commented, follow these steps:
 * 
 * 1. Add a new DBTable/GDO extending GWF_CommentsTable
 *    This table has to return the commented object table in gdoCommentObjectTable() – e.g. GWF_News::table()
 *    
 * 2. Add this trait to your commented object.
 *    The commented object has to return your new DBTable in gdoCommentTable() – e.g. GWF_NewsComments::table()
 *
 * Your object is than able to easily add comments to the GWF_Comment table, joined via your new GWF_CommentsTable table.
 * All relations have foreign keys, as usual.
 *     
 * @author gizmore
 * @since 5.0
 * @see Module_Comments
 * @see GWF_CommentTable
 * @see GWF_Comment
 */
trait GWF_CommentedObject
{
    ######################################
    ### Additions needed in your object :(
//     public function gdoCommentTable() { return LUP_RoomComments::table(); } # Really abstract
//     public function gdoCommentsEnabled() { return true; } # default true would be ok
//     public function gdoCanComment(GWF_User $user) { return true; } default true would be ok
    ##########################################
    /**
     * Get the number of comments
     * @return number
     */
	public function getCommentCount()
	{
		return $this->queryCountComments();
	}
	
	/**
	 * Query the number of comments.
	 * @return int
	 */
	public function queryCountComments()
	{
		$commentTable = $this->gdoCommentTable();
		$commentTable instanceof GWF_CommentTable;
		return $commentTable->countWhere('comment_object='.$this->getID());
	}
	
	/**
	 * Build query for all comments.
	 * @return GDOQuery
	 */
	public function queryComments()
	{
		$comments = GWF_Comment::table();
		$commentTable = $this->gdoCommentTable();
		$commentTable instanceof GWF_CommentTable;
		return $commentTable->select('gwf_comment.*')->fetchTable(GWF_Comment::table())->joinObject('comment_id')->where("comment_object=".$this->getID());
	}
	
	/**
	 * Build query for a single comment for a given user.
	 * @param GWF_User $user
	 * @return GDOQuery
	 */
	public function queryUserComments(GWF_User $user=null)
	{
	    $user = $user ? $user : GWF_User::current();
	    return $this->queryComments()->where("comment_creator={$user->getID()}");
	}
	
	/**
	 * In case you only allow one comment per user and object, this gets the comment for a user and object
	 * @param GWF_User $user
	 * @return GWF_Comment
	 */
	public function getUserComment(GWF_User $user=null)
	{
	    return $this->queryUserComments($user)->first()->exec()->fetchObject();
	}

}
