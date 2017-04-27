<?php

/**
 * Make request to an API and retrive json decoded data.
 *
 * @param string $method
 * @param string $url
 * @param bool $data
 * @param string|null $apiKey
 * @return mixed
 */
function callApi(string $method, string $url, $data = false, string $apiKey = null)
{
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        default:
            if ($data) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
            }
    }

    // Optional Authentication:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return json_decode($result, true);
}

/**
 * Helper function which help us build sorting array which we can use as parameter
 * in our sortBy model function.
 *
 * @param array $request
 * @return mixed
 */
function buildSortParameters(array $request)
{
    $result['property'] = 'name';
    $result['direction'] = 'asc';
    $result['appends'] = [];

    if (isset($request['sort']) && isset($request['order'])) {
        $result['property'] = $request['sort'];
        $result['direction'] = $request['order'];

        $result['appends']['sort'] = $result['property'];
        $result['appends']['order'] = $result['direction'];
    }

    return $result;
}

function sortingLink(string $property, string $direction) {
    $query = $_SERVER['QUERY_STRING'];
    $url = strtok($_SERVER["REQUEST_URI"], '?');

    if (isset($_GET['order'])) {
        $queryArray = $_GET;

        $queryArray['sort'] = $property;

        switch($queryArray['order']) {
            case 'asc':
                $queryArray['order'] = 'desc';
                break;
            default:
                $queryArray['order'] = 'asc';
        }

        return $url .'?'. http_build_query($queryArray);
    } else {
        return $url .'?sort='. $property .'&order='. $direction .'&'. $query;
    }
}

/**
 * Show sorting icon
 *
 * @param string $property
 * @return null|string
 */
function sortingIconDir(string $property)
{
    if (isset($_GET['sort']) && $_GET['sort'] == $property ) {
        return '-'.$_GET['order'];
    }

    return null;
}

/**
 * Remove http protocol from URL, because we want to store only domain.
 *
 * @param string $url
 * @return bool|string
 */
function removeHttpFromUrl(string $url)
{
    $charPos = strpos($url, ':');

    return substr($url, $charPos + 1);
}