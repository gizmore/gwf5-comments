<?php
final class Module_Comments extends GWF_Module
{
	public $module_priority = 30;
	public function getClasses() { return ['GWF_Comment', 'GWF_CommentTable', 'GWF_CommentLike', 'GWF_CommentedObject', 'Comments_List', 'Comments_Write']; }
	public function onLoadLanguage() { $this->loadLanguage('lang/comments'); }
}
