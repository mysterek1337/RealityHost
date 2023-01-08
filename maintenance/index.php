<?php

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RIP - Maintenance</title>
    <link rel="stylesheet" href="output.css" />
  </head>


  <body class="antialiased-subpixel text-left layout-row">
    <div class="w-full max-w-lg mx-auto mt-20 p-5">
      <img src="logo.svg" />

      <h1 class="font-bold text-2xl text-black">Internal Error.</h1>
      <p class="text-gray-900">
        We're sorry, something is not right and it's most likely our fault.
      </p>
      <p class="text-gray-900 text-base">
        If the issue persists, please open a
          support ticket.
        </a>
      </p>
      <div class="text-gray-400 pt-4 text-sm">
        <p>Client IP: <?php echo $user_ip;?></p>
      </div>
    </div>
  </body>
</html>
