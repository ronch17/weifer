<?php

global $iqbc_searchengines;
$iqbc_searchengines = array(
    "AHrefs" => "AhrefsBot",
    "Alexa" => "ia_archiver",
    "AppleBot" => "Applebot",
    "Ask" => "ask jeeves",
    "Baidu" => "Baiduspider",
    "Bing" => "bingbot",
    "Bitly" => "bitlybot",
    "Broken Link Check" => "brokenlinkcheck.com",
    "Cliqz" => "cliqzbot",
    "Dead Link Checker" => "www.deadlinkchecker.com",
    "Duck Duck Go" => "duckduckbot",
    "Feedly" => "Feedly",
    "Facebook" => "facebookexternalhit",
    "Feedburner" => "FeedBurner",
    "Google" => "Googlebot",
    "Google Ads" => "AdsBot-Google",
    "Google AdsBot Mobile Web " => "AdsBot-Google-Mobile",
    "Google Ads (Mediapartners)" => "Mediapartners-Google",
    "Google Feed" => "Feedfetcher-Google",
    "Google Images" => "Googlebot-Image",
    "Google News" => "Googlebot-News",
    "Google Page Speed Insight" => "Google Page Speed Insight",
    "Google Read Aloud" => "Google-Read-Aloud",
    "Google Search Console" => "Google Search Console",
    "Google Site Verification" => "Google-Site-Verification",
    "Google StoreBot" => "Storebot-Google",
    "Google Video" => "Googlebot-Video",
    "Jetpack" => "Jetpack by WordPress.com",
    "Link checker" => "W3C-checklink",
    "MOZ" => "rogerbot",
    "MSN" => "msnbot",
    "Pingdom" => "Pingdom.com_bot",
    "Pinterest" => "Pinterest",
    "SEMrush" => "SemrushBot",
    "SEOkicks" => "SEOkicks-Robot",
    "TinEye" =>  "tineye-bot",
    "Twitter" => "twitterbot",
    "Yahoo!" => "yahoo! slurp",
    "Yandex" => "yandexbot"
);

function iqblockcountry_check_searchengine($iqbc_user_agent,$iqbc_allowse)
{
    global $iqbc_searchengines;
    $iqbc_issearchengine = false;
    foreach ( $iqbc_searchengines AS $iqbc_se => $iqbc_seua ) {
        if (is_array($iqbc_allowse) && in_array($iqbc_se, $iqbc_allowse)) {        
            if(stripos($iqbc_user_agent, $iqbc_seua) !== false) {
                $iqbc_issearchengine = true;
            }
        }
    }
    return $iqbc_issearchengine;
}

?>
