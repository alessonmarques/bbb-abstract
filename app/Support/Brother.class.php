<?php


namespace app\Support;

class Brother
{
    const PATH_TO_LOCAL_DATA = __DIR__ . '/../Extras/data/brothers/';

    protected $newBrother;  

    private $name;
    private $description;
    private $instagram;
    private $instagramUrl;
    
    private $perfilUrl;
    private $knowBrotherUrl;

    private $knowMoreUrl;
    private $knowMoreUri;
    
    private $photo;
    private $headPhoto;

    private $eliminated;
    private $eliminatedOn;
    private $updatedOn;

       

    function __construct()
    {
        $this->verifyPath($this::PATH_TO_LOCAL_DATA);
        
        $this->knowMoreUrl   = "https://gshow.globo.com/realities/bbb/bbb21/participante/noticia/";
    }

    function toArray()
    {
        $name              = $this->name;
        $description       = $this->description;
        $instagram         = $this->instagram;
        $instagramUrl      = $this->instagramUrl;
        $perfilUrl         = $this->perfilUrl;
        $knowBrotherUrl    = $this->knowBrotherUrl;
        $photo             = $this->photo;
        $headPhoto         = $this->headPhoto;
        $eliminated        = $this->eliminated;
        $eliminatedOn      = $this->eliminatedOn;
        $updatedOn         = $this->updatedOn;

        $brotherData       = compact( 'name', 'description', 'instagram', 'instagramUrl', 'perfilUrl', 'knowBrotherUrl', 'photo', 'headPhoto', 'eliminated', 'eliminatedOn', 'updatedOn');
        return $brotherData;
    }

    function __toString()
    {
        $brotherData       = $this->toArray();
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
            $this->instagram         = isset($loadedData->instagram) && !empty($loadedData->instagram) ? $loadedData->instagram : null;
            $this->instagramUrl      = isset($loadedData->instagramUrl) && !empty($loadedData->instagramUrl) ? $loadedData->instagramUrl : null;
            $this->perfilUrl         = isset($loadedData->perfilUrl) && !empty($loadedData->perfilUrl) ? $loadedData->perfilUrl : null;
            $this->photo             = isset($loadedData->photo) && !empty($loadedData->photo) ? $loadedData->photo : null;
            $this->headPhoto         = isset($loadedData->headPhoto) && !empty($loadedData->headPhoto) ? $loadedData->headPhoto : null;
            $this->eliminated        = isset($loadedData->eliminated) && !empty($loadedData->eliminated) ? $loadedData->eliminated : null;
            $this->eliminatedOn      = isset($loadedData->eliminatedOn) && !empty($loadedData->eliminatedOn) ? $loadedData->eliminatedOn : null;
            $this->knowBrotherUrl    = isset($loadedData->knowBrotherUrl) && !empty($loadedData->knowBrotherUrl) ? $loadedData->knowBrotherUrl : null;
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

        return (object) $this->toArray();
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
            $this->name             = $externalData->nome;
            $this->perfilUrl        = $externalData->url;
            $this->headPhoto        = $externalData->foto;
            $this->eliminated       = $externalData->eliminado;
            $this->eliminatedOn     = '';
            $this->photo            = $brotherData->externalData->image;
            $this->description      = $brotherData->externalData->description;
        }
        else
        {
            $this->eliminatedOn = ($this->eliminated != $externalData->eliminado ? date('Y-m-d') : '');
            $this->eliminated   = $externalData->eliminado;
        }

        if(!isset($this->instagram))
            $this->getBrotherSocial();

        //$this->getBrotherSocialData();

        $this->save();
    }

    private function getBrotherSocial()
    {
        $this->knowMoreUri      = "{$this->getMountedName($this->name)}-e-participante-do-bbb21-conheca.ghtml";
        $this->knowBrotherUrl   = "{$this->knowMoreUrl}{$this->knowMoreUri}";
        $content    = @file_get_contents($this->knowBrotherUrl);

        if(!(isset($content) && !empty($content)))
        {   
            $this->knowMoreUri      = "{$this->getMountedName($this->name)}-esta-no-bbb21-conheca.ghtml";
            $this->knowBrotherUrl   = "{$this->knowMoreUrl}{$this->knowMoreUri}";
            $content    = @file_get_contents($this->knowBrotherUrl);
        }

        $pattern                    = '/<a href="https:\/\/www\.instagram\.com\/\.*(.*)\/" target="_blank">/';
        preg_match_all($pattern, $content, $match);

        $this->instagram            = isset($match[1][0]) && !empty($match[1][0]) ? $match[1][0] : '';
        $this->instagramUrl         = "https://www.instagram.com/{$this->instagram}/";
    }

    /*
    //Waiting to put Instagram Graph API.
    private function getBrotherSocialData()
    {
        $content    = file_get_contents($this->instagramUrl);

        echo $content;

        $pattern    = '/'."\/$this->instagram\/followers\/.*title=\"(.*)\">".'/';
        preg_match_all($pattern, $content, $match);
    }
    */

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

    private function getMountedName($name)
    {
        return str_replace([' ', '_', '-'], '-', strtolower($this->removeAccent($name)));
    }
    
    private function removeAccent($string){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    }
}
