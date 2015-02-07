<?php
if(!class_exists('skin_objectpublic'))
require_once ('./cache/skins/user/finance/skin_objectpublic.php');
class skin_supports extends skin_objectpublic {

//===========================================================================
// <vsf:showSupport:desc::trigger:>
//===========================================================================
function showSupport($option=array()) {global $bw,$vsPrint;
$this->bw=$bw;

    $this->text_support = VSFactory::getSettings ()->getSystemKey ( "text_support", "", "configs" );


//--starthtml--//
$BWHTML .= <<<EOF
        <div class="support-online">
         {$this->text_support}
        
        </p>
        <table>
            <thead>
                <tr>
                    <td>
                        STT
                    </td>
                    <td>
                        Hỗ trợ viên
                    </td>
                    <td>
                        Yahoo
                    </td>
                    <td>
                        Skype
                    </td>
                    <td>
                        Số máy lẻ
                    </td>
                </tr>
            </thead>
            <tbody>
                {$this->__foreach_loop__id_53d1c6859127a($option)}  
            </tbody>
        </table>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function ifstatement
//===========================================================================
function __foreach_loop__id_53d1c6859127a($option=array())
{
global $bw,$vsPrint;
    $BWHTML = '';
    $vsf_count = 1;
    $vsf_class = '';
    if(is_array($option['list'])){
    foreach( $option['list'] as $key=>$value )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        {$value->getTitle()}
                    </td>
                    <td>
                        
EOF;
if($value->getYahoo()) {
$BWHTML .= <<<EOF
<a rel="nofollow" href="ymsgr:sendIM?{$value->getYahoo()}"><img  src="http://opi.yahoo.com/online?u={$value->getYahoo()}&amp;m=g&amp;t=1"></a>
EOF;
}

$BWHTML .= <<<EOF

                    </td>
                    <td>
                      
EOF;
if($value->getSkype()) {
$BWHTML .= <<<EOF
<a rel="nofollow" href="skype:{$value->getSkype()}?chat"><img width=59px; height=23px; src="http://mystatus.skype.com/balloon/{$value->getSkype()}"> </a>
EOF;
}

$BWHTML .= <<<EOF

                    </td>
                    <td>
                        {$value->getPhone()}
                    </td>
                </tr>
               
EOF;
$vsf_count++;
    }
    }
    return $BWHTML;
}


}
?>