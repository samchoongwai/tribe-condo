<?php

    /* return JSON encoded data (for API calls) */

    if ($data)
    {
        echo json_encode($data);
    }
    else
    {
        echo json_encode([
            'code' => '404',
            'title' => 'Data not found'
        ]);
    }