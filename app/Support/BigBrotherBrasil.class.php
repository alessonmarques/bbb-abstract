<?php


namespace app\Support;

use app\Support\Brother;

class BigBrotherBrasil
{
    const PATH_TO_LOCAL_DATA = __DIR__ . '/../Extras/data/';

    protected   $domain;

    public   $edition;

    public   $lastUpdate;

    public   $brothers;
    public   $totalBrothers;
    public   $totalInGame;
    public   $totalOutGame;

    function __construct()
    {
        $this->verifyPath($this::PATH_TO_LOCAL_DATA);
        
        $this->edition      = 'bbb2021';
        $this->domain       = "https://gshow.globo.com/realities/bbb/";
        $this->load();
    }

    function toArray()
    {
        $lastUpdate        = $this->lastUpdate;

        $totalBrothers     = $this->totalBrothers;
        $totalInGame       = $this->totalInGame;
        $totalOutGame      = $this->totalOutGame;

        $brothers          = $this->brothers;

        $brotherData       = compact( 'lastUpdate', 'totalBrothers', 'totalInGame', 'totalOutGame', 'brothers' );
        return $brotherData;
    }

    function __toString()
    {
        $brotherData       = $this->toArray();
        return json_encode($brotherData);
    }

    function load()
    {
        $fileName = $this::PATH_TO_LOCAL_DATA."{$this->edition}.data";
        $loadedData = json_decode(@file($fileName)[0]);
        
        if(isset($loadedData) && !empty($loadedData))
        {
            $this->lastUpdate       = isset($loadedData->lastUpdate)    && !empty($loadedData->lastUpdate)      ? $loadedData->lastUpdate : null;

            $this->brothers         = isset($loadedData->brothers)      && !empty($loadedData->brothers)        ? $loadedData->brothers : null;
            $this->totalBrothers    = isset($loadedData->totalBrothers) && !empty($loadedData->totalBrothers)   ? $loadedData->totalBrothers : null;
            $this->totalInGame      = isset($loadedData->totalInGame)   && !empty($loadedData->totalInGame)     ? $loadedData->totalInGame : null;
            $this->totalOutGame     = isset($loadedData->totalOutGame)  && !empty($loadedData->totalOutGame)    ? $loadedData->totalOutGame : null;
        }
    }

    function save()
    {
        $this->lastUpdate = date('Y-m-d H:i:s');

        $fileName = $this::PATH_TO_LOCAL_DATA."{$this->edition}.data";
        $dataHandle = fopen($fileName, 'wa+');
        fwrite($dataHandle, $this);
        fclose($dataHandle);
    }

    function getBrothersData()
    {
        $content    = file_get_contents($this->domain);
        $pattern    = '/{"config":{"apiName":"card-participantes-bbb"}.*."},{"config/';
        preg_match_all($pattern, $content, $match);

        if(!(isset($match[0]) && !empty($match[0])))
            echo "WOW, Something goes wrong!";

        if(isset($match[0]) && !empty($match[0]))
        {
            $jsonData    = $match[0][0];
            $jsonData    = substr($jsonData, 0, strlen($jsonData) - strlen(',{"config'));
                        
            $this->setBrothersData($jsonData);
        }
    }

    private function setBrothersData($brothersData)
    {
        $brothersData = json_decode($brothersData);
        $catchedBrothers = $brothersData->externalData;

        $brothers = [];
        $brother = new Brother();
        foreach($catchedBrothers as $catchedBrother)
        {
            $brothers[] = $brother->loadCatchedData($catchedBrother);
        }

        $this->brothers         = $brothers;
        $this->totalBrothers    = count($brothers);
        $this->totalInGame      = count(array_filter($brothers, [$this, "verifyInGame"]));
        $this->totalOutGame     = $this->totalBrothers - $this->totalInGame;

        $this->save();
    }

    function verifyInGame($item)
    {
        return (bool) !$item->eliminated;
    }

    function verifyPath($path)
    {
        $actualPath = '/';
        if($path[strlen($path) - 1] == '/') 
        {
            $path = substr($path, 0, strlen($path) - 1);
        }

        $exploitedPath =  explode('/', $path);
        array_shift($exploitedPath);

        foreach($exploitedPath as $folder)
        {
            $scan = scandir($actualPath);
            array_shift($scan);array_shift($scan);

            $actualPath .= $folder.'/';
            if(!in_array($folder, $scan))
            {
                mkdir($actualPath, 0777);
            }
        }
        return $path.'/';
    }

}
