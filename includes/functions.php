<?php

/* =========================================================
   CLEAN INPUT
========================================================= */

function clean($conn, $value)
{
    return mysqli_real_escape_string(
        $conn,
        trim($value)
    );
}


/* =========================================================
   MONEY FORMAT
========================================================= */

function money($value)
{
    return number_format((float)$value, 2);
}


/* =========================================================
   GST CALCULATION
========================================================= */

function gst_amount($price, $gst)
{
    return ((float)$price * (float)$gst) / 100;
}


function final_price($price, $gst)
{
    return (float)$price + gst_amount($price, $gst);
}


/* =========================================================
   AUDIT LOG
========================================================= */

function log_audit($conn, $user_id, $action, $details = '')
{
    $uid = (int)$user_id;

    $action = clean($conn, $action);

    $details = clean($conn, $details);

    mysqli_query(
        $conn,
        "INSERT INTO audit_logs(
            user_id,
            action,
            details
        )
        VALUES(
            $uid,
            '$action',
            '$details'
        )"
    );
}


/* =========================================================
   NOTIFICATIONS
========================================================= */

function notify_user($conn, $user_id, $title, $message)
{
    $uid = (int)$user_id;

    $title = clean($conn, $title);

    $message = clean($conn, $message);

    mysqli_query(
        $conn,
        "INSERT INTO notifications(
            user_id,
            title,
            message
        )
        VALUES(
            $uid,
            '$title',
            '$message'
        )"
    );
}


/* =========================================================
   LOW STOCK COUNT
========================================================= */

function low_stock_count($conn, $owner_id)
{
    $oid = (int)$owner_id;

    $query = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM stock
         WHERE owner_id = $oid
         AND quantity <= reorder_level"
    );

    $row = mysqli_fetch_assoc($query);

    return (int)$row['total'];
}


/* =========================================================
   REDIRECT
========================================================= */

function redirect($url)
{
    header("Location: " . $url);

    exit();
}

?>