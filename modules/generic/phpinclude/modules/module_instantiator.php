<?php
class Instantiator
{
    //Use require instead in v2.0
    function instantiate_classes()
    {
        global $filters, $encoding, $sql, $dates, $encryptor, $post, $curl, $json, $tokens, $getset, $types, $encoder, $services, $scorpion;
        $sql = new Servicesql;
        $json = new Servicejson;
        $encryptor = new Encryptor;
        $curl = new Curler;
        $post = new Servicepost;
        $tokens = new Tokens;
        $getset = new Servicegetset;
        $types = new Types;
        $dates = new Dates;
        $filters = new Filters;
        $encoder = new Encoding;
        $services = new Services;
		$scorpion = new ScorpionIEE;
        return;
    }
}
?>