<?php

/*
 *
 *
 *    input_format: "json",
   output_format: "json",
   io_encoding: "utf8",
   input_data: JSON.stringify(params),
   show_input_params: 0,
   username: "test",
   password: "test"

 * {
    "domains": [
        {
            "dname": "test.ru"
        },
        {
            "dname": "test.com"
        }
    ],
    "": "test",
    "": "test"
};
 */

$username="account@example.com";
$password="password";

$domain="example.com";

$zone='
example.com.        IN    NS    ns8-cloud.nic.ru.
example.com.        IN    NS    ns3-l2.nic.ru.
example.com.        IN    NS    ns4-l2.nic.ru.
example.com.        IN    NS    ns8-l2.nic.ru.
example.com.        IN    NS    ns4-cloud.nic.ru.
sender.example.com.        IN    NS    ns-358.awsdns-44.com.
example.com.        IN    NS    ns8-cloud.nic.ru.
example.com.        IN    NS    ns3-l2.nic.ru.
example.com.        IN    NS    ns4-l2.nic.ru.
example.com.        IN    NS    ns8-l2.nic.ru.
example.com.        IN    NS    ns4-cloud.nic.ru.
sender.example.com.        IN    NS    ns-358.awsdns-44.com.
sender.example.com.        IN    NS    ns-534.awsdns-02.net.
sender.example.com.        IN    NS    ns-1165.awsdns-17.org.
sender.example.com.        IN    NS    ns-2012.awsdns-59.co.uk.
timecode.example.com.        IN    NS    ns-597.awsdns-10.net.
timecode.example.com.        IN    NS    ns-1934.awsdns-49.co.uk.
timecode.example.com.        IN    NS    ns-1331.awsdns-38.org.
timecode.example.com.        IN    NS    ns-51.awsdns-06.com.
example.com.    1    IN    A    127.0.0.1
aebstore.example.com.        IN    A    92.242.39.102
example.com.    3600    IN    MX    1    aspmx.l.google.com.
example.com.    3600    IN    MX    5    alt2.aspmx.l.google.com.
example.com.    3600    IN    MX    5    alt1.aspmx.l.google.com.
example.com.    3600    IN    MX    10    aspmx3.googlemail.com.
example.com.    3600    IN    MX    10    aspmx2.googlemail.com.
1c-web.example.com.        IN    CNAME    test.example.com.
api.example.com.    1    IN    CNAME    example.com.
api1.example.com.        IN    CNAME    api.example.com.
api-test.example.com.        IN    CNAME    test.example.com.
cas.example.com.        IN    CNAME    example.com.
castest1.example.com.        IN    CNAME    test.example.com.
castest2.example.com.        IN    CNAME    test.example.com.
gca.example.com.        IN    CNAME    api.example.com.
gca-test.example.com.        IN    CNAME    test.example.com.
in.example.com.        IN    CNAME    example.com.
in-old.example.com.        IN    CNAME    web02.iqkarta.ru.
lb.example.com.        IN    CNAME    example.com.
lk.example.com.        IN    CNAME    example.com.
lk-old.example.com.        IN    CNAME    web02.iqkarta.ru.
mail.cas.example.com.        IN    CNAME    test.example.com.
monitoring.example.com.        IN    CNAME    example.com.
old.example.com.        IN    CNAME    example.com.
paymentcallback.example.com.        IN    CNAME    example.com.
paymentcallback-test.example.com.        IN    CNAME    test.example.com.
public-gca.example.com.        IN    CNAME    example.com.
public-gca-test.example.com.        IN    CNAME    test.example.com.
rkeeper-test.example.com.        IN    CNAME    test.example.com.
rules.example.com.        IN    CNAME    example.com.
s.example.com.        IN    CNAME    example.com.
sd.example.com.        IN    CNAME    example.com.
secured-gca.example.com.        IN    CNAME    example.com.
secured-gca-test.example.com.        IN    CNAME    test.example.com.
service.example.com.        IN    CNAME    example.com.
staging.example.com.        IN    CNAME    test.example.com.
static-gca.example.com.        IN    CNAME    example.com.
static-gca-test.example.com.        IN    CNAME    test.example.com.
stest.example.com.        IN    CNAME    test.example.com.
www.example.com.        IN    CNAME    example.com.
example.com.        IN    TXT    "google-site-verification=abc123132213123"
';



$zone=explode("\n",$zone);

foreach ($zone as $line) {

    print_r(preg_split('/\s+/', $line));

    if ( count($line) == 4 ) {

    }

}

//print_r($zone);

$data = array(
    "domains" => array(
        array("dname"=>$domain)
    ),
    "password" => $password,
    "username" => $username
);
$data_string = json_encode($data);

$meta = array(
    'input_format=json',
    'output_format=json',
    'io_encoding=utf8',
    "input_data=$data_string",
    'show_input_params=0',
    "username=$username",
    "password=$password"
);

$postdata=implode('&',$meta);

print_r($postdata);

$ch = curl_init('https://api.reg.ru/api/regru2/zone/nop');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded')
);

$result = curl_exec($ch);
print_r($result);