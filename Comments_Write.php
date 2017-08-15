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
	
	/**
	 * @var GWF_Comment
	 */
	protected $oldComment;
	
	public function createForm(GWF_Form $form)
	{
		$gdo = GWF_Comment::table();
// 		$form->addField($gdo->gdoColumn('comment_title'));
		$form->addField($gdo->gdoColumn('comment_message'));
		if ($this->gdoCommentsTable()->gdoAllowFiles())
		{
			$form->addField($gdo->gdoColumn('comment_file'));
		}
		$form->addFields(array(
			GDO_Submit::make(),
			GDO_AntiCSRF::make(),
		));
		
		if (1 === $this->gdoCommentsTable()->gdoMaxComments(GWF_User::current()))
		{
		    $form->withGDOValuesFrom($this->oldComment);
		}
	}
	
	public function init()
	{
		$this->object = $this->gdoCommentsTable()->gdoCommentedObjectTable()->find(Common::getRequestString('id'));
		if (1 === $this->gdoCommentsTable()->gdoMaxComments(GWF_User::current()))
		{
		    $this->oldComment = $this->object->getUserComment();
		}
	}
	
	public function execute()
	{
		$response = parent::execute();
		return $this->object->renderCard()->add($response);
	}
	
	public function successMessage()
	{
		return $this->message('msg_comment_added');
	}
	
	public function formValidated(GWF_Form $form)
	{
	    if ($this->oldComment)
	    {
	        $this->oldComment->saveVars($form->values());
	    }
	    else
	    {
    		$comment = GWF_Comment::blank($form->values())->insert();
    		$entry = $this->gdoCommentsTable()->blank(array(
    			'comment_object' => $this->object->getID(),
    			'comment_id' => $comment->getID(),
    		))->insert();
	    }
		return $this->successMessage()->add(GWF_Website::redirectMessage($this->hrefList()));
	}
}
