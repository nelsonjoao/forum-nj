<?php

class Datas
{
    public static function DataHoraAtualBD()
    {
        $data=new DateTime();
        return $data->format('Y-m-d H:i:s');
    }
}
?>