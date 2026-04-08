<?php
namespace App\Livewire;
use Livewire\Component;

new class extends Component
{
    public $imageUrl ="";
    public $imageData "";
    public $isLoading = false;
    public function updatedImageUrl(){
        $this->imageData ="";
        $this->isLoading = false;
        if ($this->imageUrl){
            return
        }
        $this->isLoading =true;
        try{
            $url =$this->imageUrl;
            $parsed =parse_url($url);
            if(!$parsed || !isset($parsed["scheme"],$parsed["host"])){
                throw new \InvalidArgumentExeption("invalid Url");
            }
            if(!$parsed || !isset($parsed["scheme"]!=="https")){
                throw new \InvalidArgumentExeption("Only https Urls are allowed");
            }
            $ip = geyhostByname($parsed["host"]);
            if(!filter_var($ip,FILTER_VALIDATE_IP,FILTER_FLAG_NO_PRIV_RANGE| FILTER_FLAG_NO_RES_RANGE)){
                throw new \InvalidArgumentExeption("Private/localhost addresses are not allowed");
            }
        }
    }
};
?>
