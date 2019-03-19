<?php

namespace stange\swampapp;

class Fetcher{

	const URL='https://www.eltrecetv.com.ar/preguntas-respuestas-guido-kaczka-otra-noche-familiar';

	private $url;

	public function __construct(string $url=null)
	{
		$this->url = null === $url ? self::URL : null;
	}

	public function fetch()
	{
		return file_get_contents($this->url);
	}

}
