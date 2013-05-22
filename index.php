<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Svpernova
 * Date: 5/22/13
 * Time: 9:53 AM
 * 
 */
$result = dns_get_record("hackmemphis.com");

$host = "hackmemphis.com";
$dig_class = "MX";
$dig_server = "8.8.8.8";
$dig_class_array = Array('ANY',  'A',  'IN',  'MX',  'NS',  'SOA',  'HINFO',  'AXFR',  'IXFR');


if(filter_var($dig_server, FILTER_VALIDATE_IP) !== false){
    $command = "dig -t $dig_class $host";
    if ($dig_server) { $command .= ' @' . $dig_server; }

    // Send the dig command to the system
    //   Normally,  the shell_exec function does not report STDERR messages.  The "2>&1" option tells the system
    //   to pipe STDERR to STDOUT so if there is an error,  we can see it.
    $results = shell_exec("$command 2>&1");

    // Save the results as a variable and send to the parse_output() function
    $output = "Results for $dig_class: <pre>";
    $output .= nl2br(htmlentities(trim($results)));
    $output .= '</pre>';
    echo($output);
} else {
    echo "Dig Error: <blockquote>";
    echo 'Invalid Dig Server field.';
    echo '</blockquote>';
}
?>