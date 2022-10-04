<?php

/**
 * show
 * show the data in a readable format
 * @param mixed data
 * @return void
 */
function show(mixed $data): void
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


/**
 * checkError
 * check if there is an error and display it
 * @return void
 */
function checkError(): void
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


/**
 * validateData
 * validate $date before insert into the BDD
 * @param  mixed $data
 * @return mixed
 */
function validateData($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
