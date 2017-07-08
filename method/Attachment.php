<?php
final class Comments_Attachment extends GWF_Method
{
	public function execute()
	{
		return Module_GWF::instance()->getMethod('GetFile')->execute();
	}
}
