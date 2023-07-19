<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.att.com/msapi/onlinesalesorchestration/devices-papi/v1/imei/358612414474353',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: _abck=F5AAC4C6EF531E10B03FF73E45EF66B6~-1~YAAQlG4/F3sIvTiJAQAA5U+IYgprXxREZYXIiQ1c/NGkOEGncbNGzo0bybibwy675MjQVEKDbSn6U+9Rn4asltkPmL9Y6Aa4fLc7JudzVs7noT5Uibhy9TfrpmcgvlCiDWa6bvC1ZUK00yQB+S6awCI7639DwL75oSw//e0II5HIhCGO4PmAA8bsKWgjaDehRxiHuXALMZ1wNNQNa4qFDDSDaxxbXKxk40OhmKgNUacZR3cCV/Ebnv5+HPPswi21UKqcSODiHdC5dX9lRZ/kGgwmoLrzVcf/3MxixrYbKbEpr9D+occCNWR/8vQS+y7L6u1laTxf0icpPcwGkOhR8sa+JyRLskTweNRnUpx7R16BxwPnUOs=~-1~-1~-1; bm_sz=238C14A77774A27A00B8058B8F193AA5~YAAQlG4/F3wIvTiJAQAA5U+IYhSJx3LvyNYQaE7ovcxbHaimb1dfm47LpxYesjVgvqBRgj6RtYwcLW9L5VhFXF/1FOBoy+3RFP6zCml22NXBuvGTIh+H7REfHMCIi2yfGu42/OEZUR8Iuhc0Ft/UZ/HrdV6yhv654gjWXq2LqJyZ6oPYie9WOgUD1f5pMRb0H891/tnIDMFavQWEgA4s+LGA74drQbSsPXhYItiqeeQOiJyN0+JsrjkNeJDMFLA7cgyshIc7vuniO+LoIrf1oZlH3PvE3EmKF+q4E4wJbOI=~4469313~3683635; UUID=64b4df4f-1209-a285-9da5-19bfa0bdf613; idpmgw=eyJjcyI6IlVuQXV0aCIsImNzVGsiOiI4NTE4OGZlMmFjYWIwODRmODkyYmNmMjg4ODg4NzYwOGE4ZmY1YTI2Iiwic2lkIjoiYThkZjQzMGEtNjAzNy00NGI4LWJhOTItNjI5NzNhYTFmNGJmIiwiaWF0IjoxNjg5NTc1MjQ3LCJleHAiOjE2ODk1NzcwNDd9.XkldiSRfKntM1x8PcFEUml-m7L61PCxourZ5tZEQIYw; idse_stack=ffdc'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

// Decode response
$jsonData = json_decode($response, true);
if ($jsonData === null) {
    die('Error occurred while parsing JSON data.');
}

$jsonResponse = json_encode($jsonData);
// Dump array structure for inspection
// var_dump($jsonData);
echo $jsonResponse;
?>
