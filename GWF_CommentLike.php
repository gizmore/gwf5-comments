<?php
/**
 * It is possible to like comments.
 * @author gizmore
 * @since 5.0
 * @see Module_Votes
 * @see GWF_VoteTable
 */
final class GWF_CommentLike extends GWF_LikeTable
{
    public function gdoLikeObjectTable() { return GWF_Comment::table(); }
}
