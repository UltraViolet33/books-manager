<?php


namespace App\core;

class Helpers
{

    public static function checkError()
    {
        $msgError = "";
        if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
            $msgError .= '<div class="bg-danger p-3">
                            <span style="font-size:24px" >' . $_SESSION['error'] . '</span>
                    </div>';
        }
        unset($_SESSION['error']);
        echo $msgError;
    }
}
