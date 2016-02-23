<?php
$pid = $request->element("pid");
$aid = $request->element("aid");

include_once(ROOT_PATH.'classes/dao/albums.class.php');
$albums = new Albums();

$album = $albums->getObject("$aid");

if($album){
   
    $photos = $album->getProperty('photos');
    if($photos){
         
                        $result='<div class="list-thumbs-3 hidden-mobile" id="list-pro-thumb">

                                        <div class="list-thumbs-3-inner lstContent">
                                            <ul>';
                                                
                                                foreach ($photos as $photo){
                                                    $result.='<li {if $i==0}class="current" {/if}>
                                                        <a href="/upload/1/products/l_'.$photo.'" data-src="/upload/1/products/l_'.$photo.'">
                                                            <img width="90" height="110" alt="" src="/upload/1/products/m_'.$photo.'" />
                                                        </a>
                                                    </li>';
                                                }                                                	
                                            $result.='</ul>
                                        </div>
                                        <div class="list-thumbs-3-button">
                                            <div class="btn-up">
                                                <a href="#">
                                                    <img src="/templates/main/images/flex-up.png" width="92" height="12" alt="" />
                                                </a>
                                            </div>
                                            <div class="btn-down">
                                                <a href="#">
                                                    <img src="/templates/main/images/flex-down.png" width="92" height="12" alt="" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="photos-visual hidden-mobile">
                                        <div class="photos-zoom">                                            
                                            <a class="zoom-product" href="/upload/1/products/l_'.$photos[0].'" title="">
                                            <img alt="" src="/upload/1/products/l_'.$photos[0].'" width="410" height="500"/>
                                            </a>                                            
                                        </div>
                                    </div>
                                    <div class="slider-wrapper theme-default">
                                    <div id="sliderProduct" class="nivoSlider show-mobile">';
                                          
                                            
                                            $photos1 =$album->getProperty('photos');
                                            foreach ($photos1 as $photo1){
                                          	$result.='<img width="320" height="400" alt="" src="/upload/1/products/l_'.$photo1.'" />';
                                            }
                                               
                    
                                    $result.='</div>
                                    <div id="htmlcaption" class="nivo-html-caption">
                                    </div>                    
                                    </div>';
            echo $result;
    }
}

?>