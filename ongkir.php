<?php
/* ambil provinsi
include "function/koneksi.php";
$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => array(
"key: a5f49d4171fe06d2a89f0a1efe3e16f1"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response.'</br>';
$obj = json_decode($response);
$jumlah_kota = count($obj->rajaongkir->results);

for($i=0;$i<$jumlah_kota;$i++){
$province_id = $obj->rajaongkir->results[$i]->{'province_id'};
$nama_provinsi = $obj->rajaongkir->results[$i]->{'province'};

mysql_query("INSERT INTO `provinsi`
(`ID_PROVINSI`, `NAMA_PROVINSI`)
VALUES ('$province_id', '$nama_provinsi')");
}
}
*/


/* ambil kota
include "function/koneksi.php";
$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => array(
"key: a5f49d4171fe06d2a89f0a1efe3e16f1"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response.'</br>';
$obj = json_decode($response);
$jumlah_kota = count($obj->rajaongkir->results);

for($i=0;$i<$jumlah_kota;$i++){
$city_id = $obj->rajaongkir->results[$i]->{'city_id'};
$province_id = $obj->rajaongkir->results[$i]->{'province_id'};
$type = $obj->rajaongkir->results[$i]->{'type'};
$city_name = $obj->rajaongkir->results[$i]->{'city_name'};
$postal_code = $obj->rajaongkir->results[$i]->{'postal_code'};

$nama_kota = $city_name.", ".$type;

//mysql_query("INSERT INTO `kota`
//  (`ID_KOTA`, `ID_PROVINSI`, `NM_KOTA`, `KODEPOS`)
//  VALUES ('$city_id', '$province_id', '$nama_kota', '$postal_code')");

mysql_query("INSERT INTO `kota`
(`ID_KOTA`, `ID_PROVINSI`, `NM_KOTA`, `TYPE_KOTA`)
VALUES ('$city_id', '$province_id', '$city_name', '$type')");
}
}
*/

/*ambil harga
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=444&destination=151&weight=1700&courier=jne",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key: a5f49d4171fe06d2a89f0a1efe3e16f1"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
  $obj = json_decode($response);
  echo "</br>";
  echo "</br>";
  echo "</br>";
  var_dump ($obj);
  echo "</br>";
  echo "</br>";

  echo $pilihan_pengiriman = count($obj->rajaongkir->results[0]->costs).'</br>';
  echo $jenis = $obj->rajaongkir->results[0]->code.'</br>';
  echo $service = $obj->rajaongkir->results[0]->costs[0]->description.'</br>';
  echo $biaya = $obj->rajaongkir->results[0]->costs[0]->cost[0]->value.'</br>';
  echo $estimasi = $obj->rajaongkir->results[0]->costs[0]->cost[0]->etd.'</br>';
  //echo $obj->rajaongkir->results->costs->{'service'};
  //for($i=0;$i<$jumlah_kota;$i++){}
}
*/

/*
$ongkir = '{
   "rajaongkir":{
      "query":{
         "origin":"501",
         "destination":"114",
         "weight":1700,
         "courier":"jne"
      },
      "status":{
         "code":200,
         "description":"OK"
      },
      "origin_details":{
         "city_id":"501",
         "province_id":"5",
         "province":"DI Yogyakarta",
         "type":"Kota",
         "city_name":"Yogyakarta",
         "postal_code":"55000"
      },
      "destination_details":{
         "city_id":"114",
         "province_id":"1",
         "province":"Bali",
         "type":"Kota",
         "city_name":"Denpasar",
         "postal_code":"80000"
      },
      "results":[
         {
            "code":"jne",
            "name":"Jalur Nugraha Ekakurir (JNE)",
            "costs":[
               {
                  "service":"OKE",
                  "description":"Ongkos Kirim Ekonomis",
                  "cost":[
                     {
                        "value":38000,
                        "etd":"4-5",
                        "note":""
                     }
                  ]
               },
               {
                  "service":"REG",
                  "description":"Layanan Reguler",
                  "cost":[
                     {
                        "value":44000,
                        "etd":"2-3",
                        "note":""
                     }
                  ]
               },
               {
                  "service":"SPS",
                  "description":"Super Speed",
                  "cost":[
                     {
                        "value":349000,
                        "etd":"",
                        "note":""
                     }
                  ]
               },
               {
                  "service":"YES",
                  "description":"Yakin Esok Sampai",
                  "cost":[
                     {
                        "value":98000,
                        "etd":"1-1",
                        "note":""
                     }
                  ]
               }
            ]
         }
      ]
   }
}';

$obj = json_decode($ongkir);

echo $obj;
*/
?>
