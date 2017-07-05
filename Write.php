<?php
abstract class Comments_Write extends GWF_MethodForm
{
	/**
	 * @return GWF_CommentTable
	 */
	public abstract function gdoCommentsTable();

	public abstract function hrefList();

	/**
	 * @var GDO
	 */
	protected $object;
	
	public function createForm(GWF_Form $form)
	{
		$gdo = GWF_Comment::table();
		$form->addFields(array(
			$gdo->gdoColumn('comment_title'),
			$gdo->gdoColumn('comment_message'),
			GDO_AntiCSRF::make(),
			GDO_Submit::make(),
		));
	}
	
	public function init()
	{
		$this->object = $this->gdoCommentsTable()->gdoCommentedObjectTable()->find(Common::getRequestString('id'));
	}
	
	public function execute()
	{
		return $this->object->renderCard()->add(parent::execute());
	}
	
	public function successMessage()
	{
		return $this->message('msg_comment_added');
	}
	
	public function formValidated(GWF_Form $form)
	{
		$comment = GWF_Comment::blank($form->values())->insert();
		$entry = $this->gdoCommentsTable()->blank(array(
			'comment_object' => $this->object->getID(),
			'comment_id' => $comment->getID(),
		))->insert();
		return $this->successMessage()->add(GWF_Website::redirectMessage($this->hrefList()));
	}
}
