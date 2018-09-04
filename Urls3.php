<?php
$url= ' ';
function ausgebenUrlbeiFragezeichen ($url)
{
    $segmente= explode ('/',$url);
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

function ausgebenUrllangePfade($url)
{
    $segmente= explode ('/',$url);
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


function beschnittDerUrl ($url)
{
    $segmente= explode ('/',$url);
    $x=count ($segmente);
    $firstComponent=($segmente[0].'/').($segmente[1].'/').$segmente[2];
    $lastSegment=$segmente[$x-1];
    $secondToLast =$segmente [$x-2];



    foreach ($segmente as $key=>$segment) {
        if ($key>3&&strlen ($secondToLast) <=27 && strstr($lastSegment,'?')) {
         return ausgebenUrlbeiFragezeichen ($url);
        } elseif ($key>2&& strlen ($secondToLast)>27) {
           return ausgebenUrllangePfade ($url);

        } else {
                $neueUrl=$firstComponent.'/.../'.substr($segmente[$x-3],0,5).'.../'. $secondToLast.'/';
            }


    }


    return $neueUrl;


}

function wiedergabeUrl ($url)
{
    $urlTeile=explode ('/',$url);

    if (count ($urlTeile)==3) {
        return $url;
    } else {
            return beschnittDerUrl($url);
        }
}

$url = 'https://www.missio-hilft.de/mitmachen/hilfe-fuer-verfolgte-christen/aktionen/freeourhusbands/petition/?utm_source=facebook&utm_medium=organic&utm_campaign=#freeourhusbands&utm_term=Alle&utm_content=Indien_10_Jahre_Kandhamal';

echo '<br /><hr /><br />'.$url.'<br />';
echo 'SOLL: https://www.missio-hilft.de/…/ak…/freeourhusbands/petition/…<br />';//seg5 abgekürzt,6&7 vollständig, 8 Seg (Q) <--seg 7 vorletztes
echo 'IST: '.wiedergabeUrl($url);

$url = 'https://www.missio-hilft.de/informieren/presse/missio-magazin-kontinente/?utm_source=facebook&utm_medium=organic&utm_campaign=kontinente&utm_term=Alle&utm_content=Probe_missio_Link';

echo '<br /><hr /><br />'.$url.'<br />';
echo 'SOLL:  https://www.missio-hilft.de/…/p…/missio-magazin-kontinente/…<br />'; //seg 4 gekürzt,5 vollständig, 6 Seg (Q) <---5 vorletztes
echo 'IST: '.wiedergabeUrl($url);

$url = 'https://www.missio-hilft.de/mitmachen/weltmissionssonntag-2018/land-leute/gaeste-zum-weltmissionssonntag/mulugeta-woldeyesus-haiybano/';

echo '<br /><hr /><br />'.$url.'<br />';
echo 'SOLL: https://www.missio-hilft.de/…/gaeste-zum-weltmissionssonnta…<br />'; //seg 6 leicht gekürzt, 7 weggekürzt, 8 Seg (kein Query)
echo 'IST: '.wiedergabeUrl($url);

$url = 'https://www.missio-hilft.de/mitmachen/weltmissionssonntag-2018/land-leute/gaeste-zum-weltmissionssonntag/pfarrer-tesfaye-petros/';

echo '<br /><hr /><br />'.$url.'<br />';
echo 'SOLL: https://www.missio-hilft.de/…/gaest…/pfarrer-tesfaye-petros/<br />'; //seg 6 stark gekürzt, 7vollständig, 8 Seg (kein Query)
echo 'IST: '.beschnittDerUrl($url);

$url='http://www.realfictionfilme.de/filme/draussen/index.php?id=122';

echo '<br /><hr /><br />'.$url.'<br />';
echo 'SOLL:  http://www.realfictionfilme.de/filme/draussen/index.php...<br />'; //
echo 'IST: '.beschnittDerUrl($url);





?>
