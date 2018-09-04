<?php

$url = 'https://www.missio-hilft.de/mitmachen/hilfe-fuer-verfolgte-christen/aktionen/freeourhusbands/petition/?utm_source=facebook&utm_medium=organic&utm_campaign=#freeourhusbands&utm_term=Alle&utm_content=Indien_10_Jahre_Kandhamal';

class UrlShortener {
    public $url = '';

    public function start() {
        $this->url;
        return $this->wiedergabeUrl();

    }
    private function wiedergabeUrl ()
    {$urlTeile=explode ('/',$this->url);
        if (count ($urlTeile)==3){
            return $this ->url;
        } else {
            return $this-> beschnittDerUrl();
        }

    }


    private function beschnittDerUrl() {
        $this->url;
        $segmente= explode ('/',$this->url);
        $x=count ($segmente);
        $firstComponent=($segmente[0].'/').($segmente[1].'/').$segmente[2];
        $lastSegment=$segmente[$x-1];
        $secondToLast =$segmente [$x-2];



        foreach ($segmente as $key=>$segment) {
            if ($key>3&&strlen ($secondToLast) <=27 && strstr($lastSegment,'?')) {
               return $this-> ausgebenUrlbeiFragezeichen ();
            } elseif ($key>2&& strlen ($secondToLast)>27) {
               return $this-> ausgebenUrllangePfade ();

            } else {
                $neueUrl=$firstComponent.'/.../'.substr($segmente[$x-3],0,5).'.../'. $secondToLast.'/';
            }


        }
        return $neueUrl;
    }

    private function ausgebenUrlbeiFragezeichen ()
    {   $this->url;
        $segmente= explode ('/',$this->url);
        $x=count ($segmente);
        $firstComponent=($segmente[0].'/').($segmente[1].'/').$segmente[2];
        $lastSegment=$segmente[$x-1];
        $secondToLast =$segmente [$x-2];
        $Platz=substr($lastSegment,0,strpos($lastSegment,'?')).'...';

        foreach ($segmente as $key=>$segment){
            if($key==5) {
                $neueUrl =$firstComponent.'/'.$segmente[3].'/'.$secondToLast.'/'.$Platz;
            } elseif($key==6) {
                $neueUrl=$firstComponent.'/.../'.substr($segmente[4],0,1).'.../'.$secondToLast.'/'.$Platz;
            } else {
                $neueUrl=$firstComponent.'/.../'.substr($segmente[$x-4],0,2).'.../'.$segmente[$x-3].'/'.$secondToLast.'/'.$Platz;
            }
        }
        return $neueUrl;
    }

    private function ausgebenUrllangePfade()
    {$this->url;
        $segmente= explode ('/',$this->url);
        $x=count ($segmente);
        $firstComponent=($segmente[0].'/').($segmente[1].'/').$segmente[2];
        $secondToLast =$segmente [$x-2];

        foreach ($segmente as $key=>$segment){
            if(ctype_digit ($segmente[$x-3])) {
                $neueUrl=$firstComponent.'/.../'.substr($secondToLast,0,18).'.../';
            } else {
                $neueUrl=$firstComponent.'/.../'.substr($segmente[$x-3],0,29).'...';
            }

        }
        return $neueUrl;
    }

}

$UrlShort = new UrlShortener();
$UrlShort-> url=$url;
$UrlShort ->start($url);

echo $UrlShort-> start();

echo '<br /><hr /><br />';
$url = 'https://www.missio-hilft.de/mitmachen/weltmissionssonntag-2018/land-leute/gaeste-zum-weltmissionssonntag/pfarrer-tesfaye-petros/';
$UrlShort = new UrlShortener();
$UrlShort-> url=$url;
$UrlShort ->start($url);

echo $UrlShort-> start();

echo '<br /><hr /><br />';
$url = 'https://www.missio-hilft.de/mitmachen/weltmissionssonntag-2018/land-leute/gaeste-zum-weltmissionssonntag/mulugeta-woldeyesus-haiybano/';
$UrlShort = new UrlShortener();
$UrlShort-> url=$url;
$UrlShort ->start($url);

echo $UrlShort-> start();

?>