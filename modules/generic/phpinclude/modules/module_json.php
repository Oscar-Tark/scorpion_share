<?php
class Servicejson
{
    function set_response($data, $type, $form)
    {
        global $response_;
        $response_['DATA'] = $data;
        $response_['TYPE'] = $type;
        $response_['FORM'] = $form;
        return;
    }

    function to_JSON()
    {
        global $response_;
        return json_encode($response_);
    }
    
    function from_JSON($data)
    {
		return json_decode($data, true);
	}

    function JSON_out()
    {
        echo($this->to_JSON());
        return;
    }

    function JSON_out_custom($data_array)
    {
        echo(json_encode($data_array));
        return;
    }

    //JSON ERROR OUT
    function JEO($message)
    {
		global $response_;
        $this->set_response($message, "ERR", '0');
        echo $response_;
        die($this->to_JSON());
        return;  
    }
    
    //JSON DEBUG OUT
    function JDO($message)
    {
		global $response_;
        $this->set_response($message, "DBG", '0');
        echo $response_;
        return;
	}
}
?>
