<?php


namespace app\Support;

class Brother
{
    const PATH_TO_LOCAL_DATA = __DIR__ . '/../Extras/data/brothers/';

    protected $newBrother;  

    private $name;
    private $description;
    
    private $perfilUrl;
    
    private $photo;
    private $headPhoto;

    private $eliminated;
    private $eliminatedOn;
    private $updatedOn;

       

    function __construct(){}

    function __toString()
    {
        $name              = $this->name;
        $description       = $this->description;
        $perfilUrl         = $this->perfilUrl;
        $photo             = $this->photo;
        $headPhoto         = $this->headPhoto;
        $eliminated        = $this->eliminated;
        $eliminatedOn      = $this->eliminatedOn;
        $updatedOn         = $this->updatedOn;

        $brotherData       = compact( 'name', 'description', 'perfilUrl', 'photo', 'headPhoto', 'eliminated', 'eliminatedOn', 'updatedOn');
        return json_encode($brotherData);
    }
    
    function load($brotherName)
    {   
        $fileName = $this::PATH_TO_LOCAL_DATA."{$brotherName}.data";
        $loadedData = json_decode(@file($fileName)[0]);
        
        if(isset($loadedData) && !empty($loadedData))
        {
            $this->name              = isset($loadedData->name) && !empty($loadedData->name) ? $loadedData->name : null;
            $this->description       = isset($loadedData->description) && !empty($loadedData->description) ? $loadedData->description : null;
            $this->perfilUrl         = isset($loadedData->perfilUrl) && !empty($loadedData->perfilUrl) ? $loadedData->perfilUrl : null;
            $this->photo             = isset($loadedData->photo) && !empty($loadedData->photo) ? $loadedData->photo : null;
            $this->headPhoto         = isset($loadedData->headPhoto) && !empty($loadedData->headPhoto) ? $loadedData->headPhoto : null;
            $this->eliminated        = isset($loadedData->eliminated) && !empty($loadedData->eliminated) ? $loadedData->eliminated : null;
            $this->eliminatedOn      = isset($loadedData->eliminatedOn) && !empty($loadedData->eliminatedOn) ? $loadedData->eliminatedOn : null;
        }
        else
        {
            $this->newBrother        = true;
        }
    }

    function loadCatchedData($externalData)
    {
        $mountedName = $this->getMountedName($externalData->nome);
        $this->load($mountedName);
        $this->loadExternalData($externalData);

        return $this->__toString();
    }

    function save()
    {
        $this->updatedOn = date('Y-m-d H:i:s');

        $fileName = $this::PATH_TO_LOCAL_DATA."{$this->getMountedName($this->name)}.data";
        $dataHandle = fopen($fileName, 'wa+');
        fwrite($dataHandle, $this);
        fclose($dataHandle);
    }

    private function loadExternalData($externalData)
    {
        if( !$externalData->eliminado || $this->newBrother )
        {

            $content    = file_get_contents($externalData->url);
            $pattern    = '/"config":{"apiName":"function-post-personalities".*"type":"post-card-personalities"/';
            preg_match_all($pattern, $content, $match);

            if(!(isset($match[0]) && !empty($match[0])))
                echo "WOW, Something goes wrong!";

            if(isset($match[0]) && !empty($match[0]))
            {
                $jsonData    = $match[0][0];
                $jsonData    = "{{$jsonData}}";
                
                $brotherData  = json_decode($jsonData);
            }
        }

        if($this->newBrother)
        {
            $this->name         = $externalData->nome;
            $this->perfilUrl    = $externalData->url;
            $this->headPhoto    = $externalData->foto;
            $this->eliminated   = $externalData->eliminado;
            $this->eliminatedOn = '';
            $this->photo        = $brotherData->externalData->image;
            $this->description  = $brotherData->externalData->description;
        }
        else
        {
            $this->eliminatedOn = ($this->eliminated != $externalData->eliminado ? date('Y-m-d') : '');
            $this->eliminated   = $externalData->eliminado;
        }

        $this->save();
    }

    private function getMountedName($name)
    {
        return str_replace([' ', '_', '-'], '', strtolower($name));
    }

}
