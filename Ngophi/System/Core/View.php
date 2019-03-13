<?php
namespace System\Core;

class View
{
	public $title;
	public $name;
	public $layout;
	public $data;
	public $csrf_token;
	public $validationresult = [];

	function __construct($name = null, $data = null, $layout = null, $title = null)
	{
		$this->title = Config::get('APPLICATION_NAME');
		if (isset($name))
		{
			$this->name = str_replace('.' , DIRECTORY_SEPARATOR, $name);
		}

		if (isset($data))
		{
			$this->data = $data;
		}

		if (isset($layout))
		{
			$this->layout = str_replace('.' , DIRECTORY_SEPARATOR, $layout);
		}

		if (isset($title))
		{
			$this->title = $title;
		}
		
	}

	function Render()
	{
		$this->layout = Config::get('VIEW_PATH') . DIRECTORY_SEPARATOR . str_replace('.' , DIRECTORY_SEPARATOR, $this->layout) . Config::get('VIEW_FILE_EXTENSION');

		if (is_readable($this->layout))
		{
			if (isset($this->data) && is_array($this->data))
			{
				extract($this->data);
			}
			include $this->layout;
		}
		else
		{
			$this->RenderBody();
		}

		return $this;
	}

	function RenderBody()
	{
		$this->fileview = Config::get('VIEW_PATH') . DIRECTORY_SEPARATOR . $this->name . Config::get('VIEW_FILE_EXTENSION');

		if (file_exists($this->fileview)) 
		{
			if (isset($this->data) && is_array($this->data))
			{
				extract($this->data);
			}

			include $this->fileview;
			/*$content = file_get_contents($this->fileview);
			$content = $this->Build($content);

			try
			{
				eval('?>' . $content . '<?php');
				
			}
			catch(\Exception $ex)
			{
				throw new \Exception($ex->getMessage() ,1 );
			}*/
		} else
		{
			throw new \ErrorException($this->fileview . ' does not exist.', 1);
		}
			//
	}

	function Build($content)
	{
		$patterns = [
						'/@(\w+);/',
						'/{{/',
						'/}}/',
						'/@(\w*)(\()(.*?)(\))/',
					];
		$replace = [
						'<?=$\1?>',
						'<?php',
						'?>',
						'<?php \1\2\3\4; ?>'
					];

		return preg_replace($patterns, $replace, $content);

	}

	function ValidationResult()
	{
		return $this->validationresult;
	}

	function ValidationMessageFor($key)
	{
		if(HTTP_POST)
		{
			if(array_key_exists($key,$this->validationresult))
			{
				if(is_array($this->validationresult[$key]))
				{
					echo '<span class="ngophi-validation-message">' . $this->validationresult[$key]['message'] . '</span>';
				}
			}
		}
		return null;
	}

	function setValidationResult($key,$message)
	{
		$this->validationresult[$key]['message'] = $message;
	}

	function IfNotValid($key,string $content)
	{
		if(HTTP_POST)
		{
			if(array_key_exists($key,$this->validationresult))
			{
				if(is_array($this->validationresult[$key]))
				{
					echo $content;
				}
			}
		}
	}


}

