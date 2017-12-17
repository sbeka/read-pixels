<?php
class ReadBlackWhite
{
	private $url;
	private $size;
	private $width;
	private $height;
	private $mime;
	
	public $allPoints = 0;
	public $black = 0;
	public $white = 0;
	public $percentBlack = 0;
	public $percentWhite = 0;
	
	public function __construct($url) {
		$this->url = $url;
		$this->getSizes();
		$this->readImage();
		$this->readPoints();
		return true;
	}
	
	private function getSizes() {
		$this->size = getimagesize($this->url);
		$this->width = $this->size[0]-1;
		$this->height = $this->size[1]-1;
		$this->mime = $this->size['mime'];
		return true;
	}
	
	private function readImage() {
		$im = $this->readMime();
		for ($i = 0; $i <= $this->width; $i++) {
			for ($j = 0; $j <= $this->height; $j++) {
				//Получение индекса цвета пиксела
				$rgb = imagecolorat($im, $i, $j);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				//Считывание цветов
				if ($r == 0 && $g == 0 && $b == 0) $this->black++;
				if ($r == 255 && $g == 255 && $b == 255) $this->white++;
			}
		}
		return true;
	}
	
	private function readPoints() {
		//Считывание всех точек
		$this->allPoints = $this->size[0]*$this->size[1];
		//Считываем процент белых и черных точек
		$this->percentBlack = round($this->black*100/$this->allPoints, 2);
		$this->percentWhite = round($this->white*100/$this->allPoints, 2);
		return true;
	}
	
	private function readMime() {
		if ($this->mime == 'image/png') return imagecreatefrompng($this->url);
		elseif ($this->mime == 'image/jpeg') return imagecreatefromjpeg($this->url);
		elseif ($this->mime == 'image/gif') return imagecreatefromgif($this->url);
		return false;
	}
}
?>