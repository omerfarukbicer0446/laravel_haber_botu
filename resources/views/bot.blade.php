<?php
$url = "https://kolektifapi.herokuapp.com/haber";
$sonuc = @file_get_contents($url, true);
$news = json_decode($sonuc);
class DomDocumentParser {

	private $doc;

	public function __construct($url) {

		$options = array(
			'http'=>array('method'=>"GET",'header'=>"Content-Type: text/html;",'header'=>"User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0)", 'header' => "charset=utf-8", 'header' => "Accept-Language: tr")
			);
		$context = stream_context_create($options);

		$this->doc = new DomDocument(null, 'UTF-8');
		@$this->doc->loadHTML(mb_convert_encoding(file_get_contents($url, false, $context), 'HTML-ENTITIES', 'UTF-8'));
	}

    public function getMetaTags() {
		return $this->doc->getElementsByTagName("meta");
	}
}
?>
@foreach ($news->veri as $value)
    <?php
        $parser = new DomDocumentParser($value->link);
        $metasArray = $parser->getMetaTags();
        foreach ($metasArray as $key) {
            if ($key->getAttribute('property') == 'og:image') {
                $image = $key->getAttribute('content') . '<br>';
            }
            if ($key->getAttribute('name') == 'description') {
                $desc = $key->getAttribute('content') . '<br>';
            }
        }
    ?>
    <div class="col">
        <a href="{{ $value->link }}">
        <div class="card">
            <img src="{{$image}}" class="card-img-top" alt="{{ $value->haber }}">
            <div class="card-body">
                <h5 class="card-title">{{ $value->haber }}</h5>
                <p class="card-text">{{$desc}}</p>
            </div>
            </div>
        </a>
    </div>
@endforeach