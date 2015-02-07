<?php
class skin_supports extends skin_objectpublic{


function showSupport($option = array()) {
	global $bw,$vsPrint;
	$this->bw=$bw;

    $this->text_support = VSFactory::getSettings ()->getSystemKey ( "text_support", "", "configs" );
		
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
                <foreach="$option['list'] as $key=>$value">
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        {$value->getTitle()}
                    </td>
                    <td>
                        <if="$value->getYahoo()"><a rel="nofollow" href="ymsgr:sendIM?{$value->getYahoo()}"><img  src="http://opi.yahoo.com/online?u={$value->getYahoo()}&amp;m=g&amp;t=1"></a></if>
                    </td>
                    <td>
                      <if="$value->getSkype()"><a rel="nofollow" href="skype:{$value->getSkype()}?chat"><img width=59px; height=23px; src="http://mystatus.skype.com/balloon/{$value->getSkype()}"> </a></if>
                    </td>
                    <td>
                        {$value->getPhone()}
                    </td>
                </tr>
               </foreach>  
            </tbody>
        </table>
    </div>     
	
EOF;
	}
	
		
}
?>