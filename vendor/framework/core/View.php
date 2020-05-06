<?php 

namespace Framework;

class View implements Interfaces\View
{
	protected $options;

	public function __construct($options)
	{
		$this->options = $options;
	}

	public function fetchPartial($template, $params = array())
	{
		extract($params);
		ob_start();
		include $this->options['view_dir'].'/'.$template.'.phtml';

		return ob_get_clean();
	}

	public function fetch($template, $params = array())
	{
		$content = $this->fetchPartial($template, $params);

		return $this->fetchPartial($this->options['layout'], array('content' => $content));
	}

	public function render($template, $params = array())
	{

		return $this->fetch($template, $params);
	}
}