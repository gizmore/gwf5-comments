<?php
/**
 * Edit a comment.
 * 
 * @author gizmore
 * @see Comments_List
 * @see Comments_Write
 * @see GDO_Message
 * @see GDO_File
 */
final class Comments_Edit extends GWF_MethodForm
{
	/**
	 * @var GWF_Comment
	 */
	private $comment;
	
	public function init()
	{
		$user = GWF_User::current();
		$this->comment = GWF_Comment::table()->find(Common::getRequestString('id'));
		if (!$this->comment->canEdit($user))
		{
			throw new GWF_Exception('err_no_permission');
		}
	}
	
	public function execute()
	{
		return parent::execute()->add($this->comment->renderCard());
	}
	
	public function createForm(GWF_Form $form)
	{
		$form->addFields(array(
// 			$this->comment->gdoColumn('comment_title'),
			$this->comment->gdoColumn('comment_message'),
			$this->comment->gdoColumn('comment_file'),
			GDO_AntiCSRF::make(),
			GDO_Submit::make(),
			GDO_Submit::make('delete'),
		));
		$form->withGDOValuesFrom($this->comment);
	}
	
	public function formValidated(GWF_Form $form)
	{
		$this->comment->saveVars($form->values());
		return $this->message('msg_comment_edited');
	}
	
	public function onSubmit_delete(GWF_Form $form)
	{
		if ($file = $this->comment->getFile())
		{
			$file->delete();
		}
		$this->comment->delete();
		return $this->message('msg_comment_deleted');
	}
	
}