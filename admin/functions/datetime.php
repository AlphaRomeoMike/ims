<?php

    function formatDate($input)
    {
        $date = date('d/m/Y H:i:s', intval($input));
        return $date;
    }

?>