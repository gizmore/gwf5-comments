<?php
final class Comments_List extends GWF_MethodQueryList
{
	public function gdoTable() { return GWF_Comment::table(); }
}
