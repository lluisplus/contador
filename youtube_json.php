<?php

// URL de la API de YouTube para obtener información del canal
$youtubeApiUrl = 'https://www.googleapis.com/youtube/v3/channels?id=UCjgHGAoDMD0ERDJctpem1vA&part=statistics&key=AIzaSyCCkCBxRAcKJUFca0thC2kSUkUR9UF-p7U';

// Parámetros de la solicitud
$params = [
    'part' => 'statistics',
    'id' => 'UCjgHGAoDMD0ERDJctpem1vA', // Reemplaza 'UC_x5XG1OV2P6uZZ5FSM9Ttw' con el ID de tu canal de YouTube
    'key' => 'AIzaSyCCkCBxRAcKJUFca0thC2kSUkUR9UF-p7U', // Reemplaza 'TU_API_KEY' con tu propia clave de API de YouTube
];

// Construir la URL completa
$url = $youtubeApiUrl . '?' . http_build_query($params);

// Inicializar una solicitud cURL
$curl = curl_init($url);

// Configurar opciones de cURL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Realizar la solicitud
$response = curl_exec($curl);

// Verificar si hay errores
if ($response === false) {
    echo 'Error en la solicitud: ' . curl_error($curl);
    exit;
}

// Cerrar la sesión cURL
curl_close($curl);

// Decodificar la respuesta JSON
$data = json_decode($response, true);

// Verificar si la decodificación fue exitosa
if ($data === null || !isset($data['items'][0]['statistics']['subscriberCount'])) {
    echo 'Error al obtener el número de suscriptores';
    exit;
}

// Obtener el número de suscriptores del canal
$subscriberCount = $data['items'][0]['statistics']['subscriberCount'];

// Imprimir el número de suscriptores
echo 'Número de suscriptores: ' . $subscriberCount;

?>