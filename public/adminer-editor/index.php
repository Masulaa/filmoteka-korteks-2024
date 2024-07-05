<?php
/** Adminer Editor - Compact database editor
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2009 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.8.4
*/function
adminer_errors($cc,$dc){return!!preg_match('~^(Trying to access array offset on( value of type)? null|Undefined array key)~',$dc);}error_reporting(6135);set_error_handler('adminer_errors',E_WARNING);$uc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($uc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Kg=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Kg)$$X=$Kg;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$h;return$h;}function
adminer(){global$b;return$b;}function
version(){global$ca;return$ca;}function
idf_unescape($u){if(!preg_match('~^[`\'"[]~',$u))return$u;$Cd=substr($u,-1);return
str_replace($Cd.$Cd,$Cd,substr($u,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($Xe,$uc=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($x,$X)=each($Xe)){foreach($X
as$vd=>$W){unset($Xe[$x][$vd]);if(is_array($W)){$Xe[$x][stripslashes($vd)]=$W;$Xe[]=&$Xe[$x][stripslashes($vd)];}else$Xe[$x][stripslashes($vd)]=($uc?$W:stripslashes($W));}}}}function
bracket_escape($u,$Ga=false){static$xg=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($u,($Ga?array_flip($xg):$xg));}function
min_version($Wg,$Pd="",$i=null){global$h;if(!$i)$i=$h;$Ef=$i->server_info;if($Pd&&preg_match('~([\d.]+)-MariaDB~',$Ef,$_)){$Ef=$_[1];$Wg=$Pd;}return(version_compare($Ef,$Wg)>=0);}function
charset($h){return(min_version("5.5.3",0,$h)?"utf8mb4":"utf8");}function
script($Nf,$wg="\n"){return"<script".nonce().">$Nf</script>$wg";}function
script_src($Pg){return"<script src='".h($Pg)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($B,$Y,$Ua,$zd="",$pe="",$Xa="",$_d=""){$H="<input type='checkbox' name='$B' value='".h($Y)."'".($Ua?" checked":"").($_d?" aria-labelledby='$_d'":"").">".($pe?script("qsl('input').onclick = function () { $pe };",""):"");return($zd!=""||$Xa?"<label".($Xa?" class='$Xa'":"").">$H".h($zd)."</label>":$H);}function
optionlist($C,$zf=null,$Sg=false){$H="";foreach($C
as$vd=>$W){$ve=array($vd=>$W);if(is_array($W)){$H.='<optgroup label="'.h($vd).'">';$ve=$W;}foreach($ve
as$x=>$X)$H.='<option'.($Sg||is_string($x)?' value="'.h($x).'"':'').(($Sg||is_string($x)?(string)$x:$X)===$zf?' selected':'').'>'.h($X);if(is_array($W))$H.='</optgroup>';}return$H;}function
html_select($B,$C,$Y="",$oe=true,$_d=""){if($oe)return"<select name='".h($B)."'".($_d?" aria-labelledby='$_d'":"").">".optionlist($C,$Y)."</select>".(is_string($oe)?script("qsl('select').onchange = function () { $oe };",""):"");$H="";foreach($C
as$x=>$X)$H.="<label><input type='radio' name='".h($B)."' value='".h($x)."'".($x==$Y?" checked":"").">".h($X)."</label>";return$H;}function
select_input($Ba,$C,$Y="",$oe="",$Oe=""){$fg=($C?"select":"input");return"<$fg$Ba".($C?"><option value=''>$Oe".optionlist($C,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$Oe'>").($oe?script("qsl('$fg').onchange = $oe;",""):"");}function
confirm($Wd="",$_f="qsl('input')"){return
script("$_f.onclick = function () { return confirm('".($Wd?js_escape($Wd):lang(0))."'); };","");}function
print_fieldset($t,$Ed,$Zg=false){echo"<fieldset><legend>","<a href='#fieldset-$t'>$Ed</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$t');",""),"</legend>","<div id='fieldset-$t'".($Zg?"":" class='hidden'").">\n";}function
generate_linksbar($Id){$Jd="<p class='links'>";foreach($Id
as$x=>$z){if($x!==key(array_keys($Id)))$Jd.="<span class='separator'>|</span>";$Jd.=$z;}$Jd.="</p>";return$Jd;}function
bold($Na,$Xa=""){return($Na?" class='active $Xa'":($Xa?" class='$Xa'":""));}function
odd($H=' class="odd"'){static$s=0;if(!$H)$s=-1;return($s++%2?$H:'');}function
js_escape($P){return
addcslashes($P,"\r\n'\\/");}function
json_row($x,$X=null){static$vc=true;if($vc)echo"{";if($x!=""){echo($vc?"":",")."\n\t\"".addcslashes($x,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$vc=false;}else{echo"\n}\n";$vc=true;}}function
ini_bool($ld){$X=ini_get($ld);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$H;if($H===null)$H=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$H;}function
set_password($Vg,$M,$V,$E){$_SESSION["pwds"][$Vg][$M][$V]=($_COOKIE["adminer_key"]&&is_string($E)?array(encrypt_string($E,$_COOKIE["adminer_key"])):$E);}function
get_password(){$H=get_session("pwds");if(is_array($H))$H=($_COOKIE["adminer_key"]?decrypt_string($H[0],$_COOKIE["adminer_key"]):false);return$H;}function
q($P){global$h;return$h->quote($P);}function
get_vals($F,$e=0){global$h;$H=array();$G=$h->query($F);if(is_object($G)){while($I=$G->fetch_row())$H[]=$I[$e];}return$H;}function
get_key_vals($F,$i=null,$Hf=true){global$h;if(!is_object($i))$i=$h;$H=array();$G=$i->query($F);if(is_object($G)){while($I=$G->fetch_row()){if($Hf)$H[$I[0]]=$I[1];else$H[]=$I[0];}}return$H;}function
get_rows($F,$i=null,$n="<p class='error'>"){global$h;$kb=(is_object($i)?$i:$h);$H=array();$G=$kb->query($F);if(is_object($G)){while($I=$G->fetch_assoc())$H[]=$I;}elseif(!$G&&!is_object($i)&&$n&&defined("PAGE_HEADER"))echo$n.error()."\n";return$H;}function
unique_array($I,$w){foreach($w
as$v){if(preg_match("~PRIMARY|UNIQUE~",$v["type"])){$H=array();foreach($v["columns"]as$x){if(!isset($I[$x]))continue
2;$H[$x]=$I[$x];}return$H;}}}function
escape_key($x){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$x,$_))return$_[1].idf_escape(idf_unescape($_[2])).$_[3];return
idf_escape($x);}function
where($Z,$p=array()){global$h,$ud;$H=array();foreach((array)$Z["where"]as$x=>$X){$x=bracket_escape($x,1);$e=escape_key($x);$H[]=$e.($ud=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($ud=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($p[$x],q($X))));if($ud=="sql"&&preg_match('~char|text~',$p[$x]["type"]??null)&&preg_match("~[^ -@]~",$X))$H[]="$e = ".q($X)." COLLATE ".charset($h)."_bin";}foreach((array)$Z["null"]as$x)$H[]=escape_key($x)." IS NULL";return
implode(" AND ",$H);}function
where_check($X,$p=array()){parse_str($X,$Sa);remove_slashes(array(&$Sa));return
where($Sa,$p);}function
where_link($s,$e,$Y,$re="="){return"&where%5B$s%5D%5Bcol%5D=".urlencode($e)."&where%5B$s%5D%5Bop%5D=".urlencode(($Y!==null?$re:"IS NULL"))."&where%5B$s%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($f,$p,$K=array()){$H="";foreach($f
as$x=>$X){if($K&&!in_array(idf_escape($x),$K))continue;$za=convert_field($p[$x]);if($za)$H.=", $za AS ".idf_escape($x);}return$H;}function
cookie($B,$Y,$Hd=2592000){global$aa;return
header("Set-Cookie: $B=".urlencode($Y).($Hd?"; expires=".gmdate("D, d M Y H:i:s",time()+$Hd)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($aa?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($Ac=false){$Rg=ini_bool("session.use_cookies");if(!$Rg||$Ac){session_write_close();if($Rg&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($x){return$_SESSION[$x][DRIVER][SERVER][$_GET["username"]];}function
set_session($x,$X){$_SESSION[$x][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Vg,$M,$V,$l=null){global$Nb;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($Nb))."|username|".($l!==null?"db|":"").session_name()),$_);return"$_[1]?".(sid()?SID."&":"").($Vg!="server"||$M!=""?urlencode($Vg)."=".urlencode($M)."&":"")."username=".urlencode($V).($l!=""?"&db=".urlencode($l):"").($_[2]?"&$_[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($Kd,$Wd=null){if($Wd!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($Kd!==null?$Kd:$_SERVER["REQUEST_URI"]))][]=$Wd;}if($Kd!==null){if($Kd=="")$Kd=".";header("Location: $Kd");exit;}}function
query_redirect($F,$Kd,$Wd,$gf=true,$hc=true,$nc=false,$mg=""){global$h,$n,$b;if($hc){$Tf=microtime(true);$nc=!$h->query($F);$mg=format_time($Tf);}$Qf="";if($F)$Qf=$b->messageQuery($F,$mg,$nc);if($nc){$n=error().$Qf.script("messagesPrint();");return
false;}if($gf)redirect($Kd,$Wd.$Qf);return
true;}function
queries($F){global$h;static$af=array();static$Tf;if(!$Tf)$Tf=microtime(true);if($F===null)return
array(implode("\n",$af),format_time($Tf));$af[]=(preg_match('~;$~',$F)?"DELIMITER ;;\n$F;\nDELIMITER ":$F).";";return$h->query($F);}function
apply_queries($F,$S,$ec='table'){foreach($S
as$Q){if(!queries("$F ".$ec($Q)))return
false;}return
true;}function
queries_redirect($Kd,$Wd,$gf){list($af,$mg)=queries(null);return
query_redirect($af,$Kd,$Wd,$gf,false,!$gf,$mg);}function
format_time($Tf){return
lang(1,max(0,microtime(true)-$Tf));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($Fe=""){return
substr(preg_replace("~(?<=[?&])($Fe".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($D,$yb){return" ".($D==$yb?$D+1:'<a href="'.h(remove_from_uri("page").($D?"&page=$D".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($D+1)."</a>");}function
get_file($x,$Bb=false){$sc=$_FILES[$x];if(!$sc)return
null;foreach($sc
as$x=>$X)$sc[$x]=(array)$X;$H='';foreach($sc["error"]as$x=>$n){if($n)return$n;$B=$sc["name"][$x];$tg=$sc["tmp_name"][$x];$pb=file_get_contents($Bb&&preg_match('~\.gz$~',$B)?"compress.zlib://$tg":$tg);if($Bb){$Tf=substr($pb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Tf,$hf))$pb=iconv("utf-16","utf-8",$pb);elseif($Tf=="\xEF\xBB\xBF")$pb=substr($pb,3);$H.=$pb."\n\n";}else$H.=$pb;}return$H;}function
upload_error($n){$Td=($n==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($n?lang(2).($Td?" ".lang(3,$Td):""):lang(4));}function
repeat_pattern($Le,$Fd){return
str_repeat("$Le{0,65535}",$Fd/65535)."$Le{0,".($Fd%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($P,$Fd=80,$Zf=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$Fd).")($)?)u",$P,$_))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$Fd).")($)?)",$P,$_);return
h($_[1]).$Zf.(isset($_[2])?"":"<i>â€¦</i>");}function
format_number($X){return
strtr(number_format($X,0,".",lang(5)),preg_split('~~u',lang(6),-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($Xe,$cd=array(),$Se=''){$H=false;foreach($Xe
as$x=>$X){if(!in_array($x,$cd)){if(is_array($X))hidden_fields($X,array(),$x);else{$H=true;echo'<input type="hidden" name="'.h($Se?$Se."[$x]":$x).'" value="'.h($X).'">';}}}return$H;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($Q,$oc=false){$H=table_status($Q,$oc);return($H?$H:array("Name"=>$Q));}function
column_foreign_keys($Q){global$b;$H=array();foreach($b->foreignKeys($Q)as$Ec){foreach($Ec["source"]as$X)$H[$X][]=$Ec;}return$H;}function
enum_input($T,$Ba,$o,$Y,$Yb=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$A);$H=($Yb!==null?"<label><input type='$T'$Ba value='$Yb'".((is_array($Y)?in_array($Yb,$Y):$Y===0)?" checked":"")."><i>".lang(7)."</i></label>":"");foreach($A[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$Ua=(is_int($Y)?$Y==$s+1:(is_array($Y)?in_array($s+1,$Y):$Y===$X));$H.=" <label><input type='$T'$Ba value='".($s+1)."'".($Ua?' checked':'').'>'.h($b->editVal($X,$o)).'</label>';}return$H;}function
input($o,$Y,$r){global$U,$b,$ud;$B=h(bracket_escape($o["field"]));echo"<td class='function'>";if(is_array($Y)&&!$r){$xa=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$xa[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$xa);$r="json";}$mf=($ud=="mssql"&&$o["auto_increment"]);if($mf&&!$_POST["save"])$r=null;$Kc=(isset($_GET["select"])||$mf?array("orig"=>lang(8)):array())+$b->editFunctions($o);$Ba=" name='fields[$B]'";if($o["type"]=="enum")echo
h($Kc[""])."<td>".$b->editInput($_GET["edit"],$o,$Ba,$Y);else{$Rc=(in_array($r,$Kc)||isset($Kc[$r]));echo(count($Kc)>1?"<select name='function[$B]'>".optionlist($Kc,$r===null||$Rc?$r:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($Kc))).'<td>';$nd=$b->editInput($_GET["edit"],$o,$Ba,$Y);if($nd!="")echo$nd;elseif(preg_match('~bool~',$o["type"]))echo"<input type='hidden'$Ba value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Ba value='1'>";elseif($o["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$A);foreach($A[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$Ua=(is_int($Y)?($Y>>$s)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$B][$s]' value='".(1<<$s)."'".($Ua?' checked':'').">".h($b->editVal($X,$o)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$B'>";elseif(($jg=preg_match('~text|lob|memo~i',$o["type"]))||preg_match("~\n~",$Y)){if($jg&&$ud!="sqlite")$Ba.=" cols='50' rows='12'";else{$J=min(12,substr_count($Y,"\n")+1);$Ba.=" cols='30' rows='$J'".($J==1?" style='height: 1.2em;'":"");}echo"<textarea$Ba>".h($Y).'</textarea>';}elseif($r=="json"||preg_match('~^jsonb?$~',$o["type"]))echo"<textarea$Ba cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Vd=(!preg_match('~int~',$o["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$o["length"],$_)?((preg_match("~binary~",$o["type"])?2:1)*$_[1]+($_[3]?1:0)+($_[2]&&!$o["unsigned"]?1:0)):($U[$o["type"]]?$U[$o["type"]]+($o["unsigned"]?0:1):0));if($ud=='sql'&&min_version(5.6)&&preg_match('~time~',$o["type"]))$Vd+=7;echo"<input".((!$Rc||$r==="")&&preg_match('~(?<!o)int(?!er)~',$o["type"])&&!preg_match('~\[\]~',$o["full_type"])?" type='number'":"")." value='".h($Y)."'".($Vd?" data-maxlength='$Vd'":"").(preg_match('~char|binary~',$o["type"])&&$Vd>20?" size='40'":"")."$Ba>";}echo$b->editHint($_GET["edit"],$o,$Y);$vc=0;foreach($Kc
as$x=>$X){if($x===""||!$X)break;$vc++;}if($vc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $vc), oninput: function () { this.onchange(); }});");}}function
process_input($o){global$b,$m;$u=bracket_escape($o["field"]);$r=$_POST["function"][$u]??null;$Y=$_POST["fields"][$u];if($o["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($o["auto_increment"]&&$Y=="")return
null;if($r=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?idf_escape($o["field"]):false);if($r=="NULL")return"NULL";if($o["type"]=="set")return
array_sum((array)$Y);if($r=="json"){$r="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads")){$sc=get_file("fields-$u");if(!is_string($sc))return
false;return$m->quoteBinary($sc);}return$b->processInput($o,$Y,$r);}function
fields_from_edit(){global$m;$H=array();foreach((array)$_POST["field_keys"]as$x=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$x];$_POST["fields"][$X]=$_POST["field_vals"][$x];}}foreach((array)$_POST["fields"]as$x=>$X){$B=bracket_escape($x,1);$H[$B]=array("field"=>$B,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($x==$m->primary),);}return$H;}function
search_tables(){global$b,$h;$_GET["where"][0]["val"]=$_POST["query"];$Bf="<ul>\n";foreach(table_status('',true)as$Q=>$R){$B=$b->tableName($R);if(isset($R["Engine"])&&$B!=""&&(!$_POST["tables"]||in_array($Q,$_POST["tables"]))){$G=$h->query("SELECT".limit("1 FROM ".table($Q)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($Q),array())),1));if(!$G||$G->fetch_row()){$Ve="<a href='".h(ME."select=".urlencode($Q)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$B</a>";echo"$Bf<li>".($G?$Ve:"<p class='error'>$Ve: ".error())."\n";$Bf="";}}}echo($Bf?"<p class='message'>".lang(9):"</ul>")."\n";}function
dump_headers($ad,$ae=false){global$b;$H=$b->dumpHeaders($ad,$ae);$Be=$_POST["output"];if($Be!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($ad).".$H".($Be!="file"&&preg_match('~^[0-9a-z]+$~',$Be)?".$Be":""));session_write_close();ob_flush();flush();return$H;}function
dump_csv($I){foreach($I
as$x=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$I[$x]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$I)."\r\n";}function
apply_sql_function($r,$e){return($r?($r=="unixepoch"?"DATETIME($e, '$r')":($r=="count distinct"?"COUNT(DISTINCT ":strtoupper("$r("))."$e)"):$e);}function
get_temp_dir(){$H=ini_get("upload_tmp_dir");if(!$H){if(function_exists('sys_get_temp_dir'))$H=sys_get_temp_dir();else{$q=@tempnam("","");if(!$q)return
false;$H=dirname($q);unlink($q);}}return$H;}function
file_open_lock($q){$Ic=@fopen($q,"r+");if(!$Ic){$Ic=@fopen($q,"w");if(!$Ic)return;chmod($q,0660);}flock($Ic,LOCK_EX);return$Ic;}function
file_write_unlock($Ic,$zb){rewind($Ic);fwrite($Ic,$zb);ftruncate($Ic,strlen($zb));flock($Ic,LOCK_UN);fclose($Ic);}function
password_file($tb){$q=get_temp_dir()."/adminer.key";$H=@file_get_contents($q);if($H||!$tb)return$H;$Ic=@fopen($q,"w");if($Ic){chmod($q,0660);$H=rand_string();fwrite($Ic,$H);fclose($Ic);}return$H;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$z,$o,$kg){global$b;if(is_array($X)){$H="";foreach($X
as$vd=>$W)$H.="<tr>".($X!=array_values($X)?"<th>".h($vd):"")."<td>".select_value($W,$z,$o,$kg);return"<table cellspacing='0'>$H</table>";}if(!$z)$z=$b->selectLink($X,$o);if($z===null){if(is_mail($X))$z="mailto:$X";if(is_url($X))$z=$X;}$H=$b->editVal($X,$o);if($H!==null){if(!is_utf8($H))$H="\0";elseif($kg!=""&&is_shortable($o))$H=shorten_utf8($H,max(0,+$kg));else$H=h($H);}return$b->selectVal($H,$z,$o,$X);}function
is_mail($Vb){$_a='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$Mb='[[:alnum:]](?:[-[:alnum:]]{0,61}[[:alnum:]])';$Le="$_a+(?:\\.$_a+)*@(?:$Mb?\\.)+$Mb";return
is_string($Vb)&&preg_match("(^$Le(?:,\\s*$Le)*\$)i",$Vb);}function
is_url($P){return(bool)preg_match('~^
			https?://                 # scheme
			(?:
				# IPv6 in square brackets
				\[(?:
					(?:[[:xdigit:]]{1,4}:){7}[[:xdigit:]]{1,4} |             # 1:2:3:4:5:6:7:8
					(?:[[:xdigit:]]{1,4}:){1,7}: |                           # 1::                             1:2:3:4:5:6:7::
					(?:[[:xdigit:]]{1,4}:){1,6}:[[:xdigit:]]{1,4} |          # 1::8            1:2:3:4:5:6::8  1:2:3:4:5:6::8
					(?:[[:xdigit:]]{1,4}:){1,5}(?::[[:xdigit:]]{1,4}){1,2} | # 1::7:8          1:2:3:4:5::7:8  1:2:3:4:5::8
					(?:[[:xdigit:]]{1,4}:){1,4}(?::[[:xdigit:]]{1,4}){1,3} | # 1::6:7:8        1:2:3:4::6:7:8  1:2:3:4::8
					(?:[[:xdigit:]]{1,4}:){1,3}(?::[[:xdigit:]]{1,4}){1,4} | # 1::5:6:7:8      1:2:3::5:6:7:8  1:2:3::8
					(?:[[:xdigit:]]{1,4}:){1,2}(?::[[:xdigit:]]{1,4}){1,5} | # 1::4:5:6:7:8    1:2::4:5:6:7:8  1:2::8
					[[:xdigit:]]{1,4}:(?::[[:xdigit:]]{1,4}){1,6} |          # 1::3:4:5:6:7:8  1::3:4:5:6:7:8  1::8
					:(?::[[:xdigit:]]{1,4}){1,7} |                           # ::2:3:4:5:6:7:8 ::2:3:4:5:6:7:8 ::8
					fe80:(?::[[:xdigit:]]{0,4}){0,4}%[[:alnum:]]+ |          # fe80::7:8%eth0  fe80::7:8%1     (link-local IPv6 addresses with zone index)
					::(?:ffff(?::0{1,4})?:)?
						(?:(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])\.){3}
						(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])
						(?<!\b0\.0\.0\.0) |                                  # ::255.255.255.255  ::ffff:255.255.255.255 ::ffff:0:255.255.255.255  (IPv4-mapped IPv6 addresses and IPv4-translated addresses)
					(?:[[:xdigit:]]{1,4}:){1,4}:
						(?:(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])\.){3}
						(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])
						(?<!\b0\.0\.0\.0)                                    # 2001:db8:3:4::192.0.2.33  64:ff9b::192.0.2.33 (IPv4-Embedded IPv6 Address)
				)\] |
				# IPv4
				(?:(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])\.){3}
					(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])
					(?<!\b0\.0\.0\.0) |                                      # 0.0.0.0 excluded for URLs
				# domain
				[_[:alnum:]](?:[-_[:alnum:]]{0,61}[_[:alnum:]])?
					(?:\.[_[:alnum:]](?:[-_[:alnum:]]{0,61}[_[:alnum:]])?)*
			)                         # host
			(?::(?:[1-9]\d{0,3})?\d)? # port
			(?:/[^\s?\#]*)?           # path
			(?:\?[^\s\#]*)?           # query
			(?:\#\S*)?                # fragment
			$~xi',$P);}function
is_shortable($o){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$o["type"]??null);}function
count_rows($Q,$Z,$rd,$Lc){global$ud;$F=" FROM ".table($Q).($Z?" WHERE ".implode(" AND ",$Z):"");return($rd&&($ud=="sql"||count($Lc)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$Lc).")$F":"SELECT COUNT(*)".($rd?" FROM (SELECT 1$F GROUP BY ".implode(", ",$Lc).") x":$F));}function
slow_query($F){global$b,$vg,$m;$l=$b->database();$ng=$b->queryTimeout();$Kf=$m->slowQuery($F,$ng);if(!$Kf&&support("kill")&&is_object($i=connect())&&($l==""||$i->select_db($l))){$yd=$i->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$yd,'&token=',$vg,'\');
}, ',1000*$ng,');
</script>
';}else$i=null;ob_flush();flush();$H=@get_key_vals(($Kf?$Kf:$F),$i,false);if($i){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$H;}function
get_token(){$df=rand(1,1e6);return($df^$_SESSION["token"]).":$df";}function
verify_token(){list($vg,$df)=explode(":",$_POST["token"]);return($df^$_SESSION["token"])==$vg;}function
lzw_decompress($La){$Kb=256;$Ma=8;$Za=array();$of=0;$pf=0;for($s=0;$s<strlen($La);$s++){$of=($of<<8)+ord($La[$s]);$pf+=8;if($pf>=$Ma){$pf-=$Ma;$Za[]=$of>>$pf;$of&=(1<<$pf)-1;$Kb++;if($Kb>>$Ma)$Ma++;}}$Jb=range("\0","\xFF");$H="";foreach($Za
as$s=>$Ya){$Ub=$Jb[$Ya];if(!isset($Ub))$Ub=$ih.$ih[0];$H.=$Ub;if($s)$Jb[]=$ih.$Ub[0];$ih=$Ub;}return$H;}function
on_help($fb,$If=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $fb, $If) }, onmouseout: helpMouseout});","");}function
edit_form($Q,$p,$I,$Ng){global$b,$ud,$vg,$n;$dg=$b->tableName(table_status1($Q,true));page_header(($Ng?lang(10):lang(11)),$n,array("select"=>array($Q,$dg)),$dg);$b->editRowPrint($Q,$p,$I,$Ng);if($I===false)echo"<p class='error'>".lang(12)."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$p)echo"<p class='error'>".lang(13)."\n";else{echo"<table cellspacing='0' class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($p
as$B=>$o){echo"<tr><th>".$b->fieldName($o);$Cb=$_GET["set"][bracket_escape($B)]??null;if($Cb===null){$Cb=$o["default"];if($o["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Cb,$hf))$Cb=$hf[1];}$Y=($I!==null?($I[$B]!=""&&$ud=="sql"&&preg_match("~enum|set~",$o["type"])?(is_array($I[$B])?array_sum($I[$B]):+$I[$B]):(is_bool($I[$B])?+$I[$B]:$I[$B])):(!$Ng&&$o["auto_increment"]?"":(isset($_GET["select"])?false:$Cb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$o);$_c=null;if(isset($_POST["function"][$B]))$_c=(string)$_POST["function"][$B];$r=($_POST["save"]?$_c:($Ng&&preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(!$_POST&&!$Ng&&$Y==$o["default"]&&preg_match('~^[\w.]+\(~',$Y))$r="SQL";if(preg_match("~time~",$o["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$r="now";}input($o,$Y,$r);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($p){echo"<input type='submit' value='".lang(14)."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Ng?lang(15):lang(16))."' title='Ctrl+Shift+Enter'>\n",($Ng?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".lang(17)."â€¦', this); };"):"");}}echo($Ng?"<input type='submit' name='delete' value='".lang(18)."'>".confirm()."\n":($_POST||!$p?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$vg,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` €Â\0X\0Z\0\0CàĞ>‡‰ \rø9\0ò9\$–M'”JeR¹d¶]/˜LfS9¤Öm7œI[m–Ãı|:¿Ò(„ı¾İnNiTºe6+y<^õe(ÿ,E¯ôòY\$ÿL\$uŠÓıD›K¿Ş÷}>İo¸[›­¶ÓüŞ`*¿ÑãÃıÈãqJ›¦Ëüşs5¿Í…²ƒı¼ÜmÜrY<¤‘ı—¯—+wù|”9°—Ë·ûóM2}ê_ë•¢Éş\\\"ìV\nÿ+·ÜMtÏÇúB›K¥*3y»pl5š¯óI`˜ÿV)”O÷ïWs×ë¾{OôÒIÿAÍï÷sµÛ¹ò»çã‰¥ş£N&ú—ßcíO}~hH”ı@Gùìz¯ºJyG‘şCc¡şN’¤‹JÓÀĞª`ê·Šê¾FCä{Ğ²U@¤i>ŸåYJé²çôE¤åiNRä(ô9Ÿç¼A%ğ!èõCQş^´yæa”®­‡tš¼¯:î¼¹&¤¦Û‡YÔ°”¿G¶¥¨êHÜ/\ngú¢xÌêsª~Ÿä@´%ñy8­å‘ZUä±EOŠa’c“©@:µ\n§;GÉş>9şiš}™@p,®ËÒı6É&ù¼c µç½F–Å‘^–%aR“AQ¦hÓIÌZÔµ9z\\ÈÅ¡`VŸö5ZØçù¬jo›Tœš¦‘ ‡™æ“Å9!–å­^“§¤O×)1É2«Šòlµ­¤ñ.IŸæ~^ŸçQÒtê’¦uáĞs³ËI;Olº›B‘ÊÀ\$ØQÖæ9Ğüq——	ş\\eŠTsà‹Ä™Uµq2H‘—êÖ¥J'ù(E±Ìv˜ĞT!Ñ%EQFPåùv\\Óo¤™'Jt¤”ßGIşI‘D\"eŒ–‡û3-ç	ÀoŸåÑj×&8E@uTICÓTUP›y3Ú¶¹>L^‰j¤¶ÆÑÂbK‘ô#qš¦Dğ8ÍÊ’\\M’dqşlšî\\Ïy^’Ê]9Ì¤ú¥¶í¾Ü¤ñ4—hNkŸ_¥¦‘gû^ÛGQÃ1Ò)‘PQ8še¥MÙşU…sÕ¸bRhÆaÿÜ&]O5VUĞ·-dé2›ú3ÖöŸå™\\UŸü÷@kWgÿ+Ë·'•gZşÒÙ–E)KJ©³|àqP·Êš=ê•ÒŸòO`[%w´O“gşNÊMÀ—PcüS	õ¾ô ÍC!‹§âï…p©¨ˆ½—×ÒdÑğÿ¨S›˜#Ñ!”K¬L=ĞÊ}ß t¡p›4!ÄÕÇü/kÊÃ¶6ºuNãüdŒU2†8ÅXÂDX‰áœHğDòvOb4IŠN<™+ó„q*?7ÂŠWøM‘!‡£XÉã,d‹ÜÂXN(„Ğ–=çÄŒˆ0£K³v¨¥Ç˜Ñã25FæÌÚÇé #\$a&Â„L‰Sd\rÈÄáŸƒ(Ğ—ğÿFHĞ˜Œá–’ß±2:'Mô‘ğ> ¾RXÚcqàëÖ)ÒxdñCpÿ\rah'ñ\0hÿDÈ ˜‡`Ğãl&&B8Bém.ørAeI©Qş2Æ@Ç)Ã. ñn¬Ëÿ†­`œ»Ç|ËÙ‹F<ä¤³–’ZêJÉ[a(á‰KoP\"4D?T”R†»ágLğÜò‚¨JU_#¥¥Ñ8%€ÿu\$¥ğÄAı£ºSÊ†K’óJAˆ8œµf°à¸¬17ÔàM]JŸ&1=¬‹afK†<w\$µÿ	’MIòšTTº—ÄH&ä30Œ?èé6ls›\$DU™ú\$«Th¾¤IÈúâì[5*M¦dÎbDÚ‡PÎL¥sÕİF\0¿'AJp‡-\rG3å_kìí]¥|m’”%`†_,›8Àº¸ÿs…ºE<2rÁ!Ü;ÅÀ|*ÖTTäÍQ-çtïÙ‚”`<¢Gl·¦ñÿJéi9¥ü³GÆLKËaæœ˜³K{\n=Mé¾+ã1h­¹/¨…:·W\\[×Øçèq\\›¬Kaîle¾İ²ëuï)¤v-~5UL?éEá½D–ª[1Æ\\Vé­6À‰¯6gÄ½fæÎªëâ8üIo¾]ËØh[İ’Á‡Š ŠñR)‡ø‹!ìÎ™ùª¥óË•£şÓW[Âã5´’Kàø'Î?ì}‘ô;¥iÒiŠˆñÙ]à3ÆlšFcşcL‹|öœµ^«5‰;*÷»ÃÇ¸¸Q¿åšû&•<ÁYu/ ¬rÙ—\nÖ-x¬8'\r Ñş1†Á÷)#n9‡ú±Vx%·YdI\ntI€*„‡È³s~m¼7.œÇŒ—RjXÔ+^PåeRª×²ø„:J‡e9{ú#';ì£¥u¡2¤‡Rj]M©õF©ÕZ¯Vjİ]«õ†±ÖZÏZk]m­õÆ²");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\næCÉìÆo6ÎC£‘œÄ(\"#HìÄa1šÌç#yÔÜdÌÒ1Ù˜Şn:‡#(¼b.\rDc)ÈÈa7E„‘¤Âl¦Ã±”èi1Îsƒ˜´ç54™‡fÓ4ÒngsIèhM¦óĞ´Ìi:`òƒ,¢·]¯¬ö›YÒÚtŸL0hD*B0\rF&3îìx´™°s‘†'¤æ[É„tv4œíS%òà0XL¨èÙW5ú)ÈY–Ìf®Ò\r^·=~9g0Æ\\@·ŒÇrìQËNnÊ^…ØyNÖj{æo±p®C%ÈÊ‹GS™ Zh¡œ5ZÎ|>:«ø'·ƒé b{“J)Æ“Ñ”t1Ë*uS=^²È2*ã8t(Ú0R,…8¡j:ƒxÚûÀ@9¡\nè@‡1\nJ“­#¸Ê4ŒãBRÉJ Ø¼ËğFÆ‹ÈĞ>#æú¾ïÈJıªÊÀ`Haa„hbC0\rĞ4Ar›&°ß\nBĞÄ54ã\$>À+Q‹A2Do”MELŠ\"ÈÂ48‰©=¡œs5DñLW7§óJÒÍGˆfı*’ï*HjĞú“E£İşÈKÈé1ƒÄ6£Ú¸¯,‹ÒoõLÓtíJ¬A°\\\$Q°|°9-H@Ø0\nxtóVõË(øĞo£ì•Çãí.+ãÜ®âËĞÜ;1DÀ°8e*Áœc\rTä£¨úB2ÜÛzŸÅ\nÅ83=ŠøËK£têÀÆ»¦²u©(ÚÖÀkmİ×…€Óê.ŒÜ¨G;¯+:†2)ã ÷c…n<½sÊ5ª:’6·¢±\nÔ¡)_ğ\\¦6È¤åYL‰\"VV`c\$Lõ¢æ²Ë;Ğk&£…\$ş?ÙXAWÃUˆú4£8÷©	şBÓŞ¡ĞÚ®Œ”æz…Ôó¡©*ƒÀ[O®24<?{3Á6%;Vˆƒ±Vö:\\AÈäˆ	x¡npåxŒ–Fü<ğ[xàÖşğoW.ŠÜèôU[™ÑÃƒsd7”Ër½Ø½F—&	’ÆÉb¨Ã’«¨è]t*7ji®=«dZÖ¹¯Yyô4è:ÙiäáĞe&÷µ¦ÑPèg\\1C0Â:˜’³;°Ş;Ù¹¼5ïCñ n¼ùÃ \\Ü#¨ÒÜ³¾ºœ4{^çÁùÉgÈ7u¿6ËNJ6OÜöC#Û{©!ğ?fşxw!ä7’0öºÉJJL‰48ódpŠÂšL¹ÕÀ€èÃ y”‚pæC[€œ.‡·ˆAltPQ'ÃzŸ¡›l¥=N7¬„ó@m\n/´ñÛcTcí]t»¤×”xiaìD+pÄPÁå„ŠpÆxË×…UJ%¤¸…Á³DaÁ±ˆ`@^ØÙßO©µ¦’E£c)ÅÅ‡@@ŠA'‘Ş)”höUbü!ºAÆ¸Ú ÈT~¬ƒPä‡\\*åØ9Gi¡ä};`ÂË h\r1°éZälx‘ò9H™I)¥Aj•R²WI9!#Ì†“ú[«ysåZb—²-‰™–-ÓqØ‡h7â€LjQ«ÃÊ»\"#lU`¶¦×„^Ar›\räff±V.§Q´Ísnh‚GgÙN€Ôãüª@e´ã%?ãüÿ\$á°‚±IÆ¹É;T\0`ê]¤‚æB\rˆ8œ[ºár2¯Â`\rÒ¢\rCKeF2ÙºÉ\r'[tí˜Ğàá()’ôÙÆ,€ÉM)Ú¸Â Se=*‹±N@+Ü9ª%Piº—¨æn¥:¤Ü‹T}ÄÔM´ÌC\rÓNtˆ†g%VÃ•]‰»V6HÊ’ÀlñÍ?Õ„_Vƒhee,3©Ú¾F× n¤¹¼Íú%^kØa¯«ÅM)Éî_Ìƒa-æ¸NŠ¸B¨-ˆ¯Šv’²…°Ì)r¬J1ÌNˆ¾Uly¡\0Ü#Y´MËµ©µ†ÖY`İEíM´ÖÖ­\"®UH-_€À¸©‡Úã« #ÀÖåÜ¹ıE\"ù‹\rv42Çû¢FLå8¢wZ0]5Sw.•Ù×!…0Ê´QëÍ3E|×%}¹ú«A˜Cè0tìLk3”öPj/æÚókbşN‹`Qš‚ÀQ7Şx¸§‹‚¡_í±åƒ§¦…Bã<«A¼8ğİ@%>Â\nãx[ñ&\røfyÅ îÔ!S‡¡LšsVˆÁG(¸Â¹·	àB\$èaÅ[¹üF\\AÈ8Gï&r;÷‚“orÂ>ê‰bËçi…RZMmğã,¶ÊÅdÃ\"µ<ää;™Ñ\"ÜQÏËî?1ƒuV¯~G,\0ÛÕ£À0c’Ò`ÕĞI’ÙÏ£E¢©PR^fBhU•©ÇuÉ”ÂÒ3”ÄCH¸(& Ôi½:\rtà.äW&5}˜ÙU¤mß—pQ¦šÔNiâ`\ndi#(1Q³Kæôƒ•Ò’¶æ\nÊI,éYf`¹”çı'Ÿ(Óp7Ú`£qÇ\rt\0½ĞéŞUãŒñ\rs „†r:Ä§0Ùˆ;Aáì, Ùv0Øpÿé\r°BPcr“R¨í^m¼.‚Úo\n=¼•\\9´»%F‚¬7™âZì²¬°VØ#àÔå•¥0|Y¢ygfôà?/\"òùÈaMÜ¿˜—Œ×HníĞ¬‘D‘dçæçêjú¤°l\0ŠØnŒAxsÁœ‡€ÚP(3}d#u`Ø'¤„¤¼p@[[¢„¡T*`Z?\\ë!¬„>¤ÁË„ Ìvl¶Š»ß}ìÖz†îÆf3”;„ Ş!(6š‰/&A\08\0¸‚\0r\rp4ìİ{ÂTT/áßÖàîî!\rí¨u§ÜAŸtëH¯Ê8JU°`r°9`´ €j\rÁ -H\"Õƒ•óA¯ÑTH ƒ?¥æõÚş }àqèA˜3úßlÁ~¿aø~2I^€˜ƒ`Zı\0004ù ·ÍƒePÏî&\0p`nÿ8€pìüdŒä%àf\0sïèOäó`hD0\0ûp,ûÏÀ i\$”öÀ\\\0mOÜ[ nDˆ&¬ó`aP\\úp2°.ô0/0ù°P0\nóbVòDöìúdŒû&–ÿ¯Ê¯&€jÂdï˜Ğ\"ioB0\$”&\0a¸ûGJ& @ş &O7@i\$%ï†±\n0/Æbdüo†ı.\r ro<ù\rPå°^ü°Q\n¯Ğ	ï³o`ºó¯ú/\r‚^P}O6@nÿĞÙãóÏÈD Æód— @òğ°ú0ˆü°·	â^Ãğàs\0#\0É\$üğzIQjÔòoºûÂc¯0ÿM˜0O™±¯C [0„ó@ñQÀ@ü`p fú/¦PÏ,ANp|úPNF:ì‘ÆûÏŞñˆóoÔÀl@Úúp…PïÔo@I`c	\$óàpè/‘È%\0ñHÑš”üpuÑÀP±! hï+­\"³ĞA’\$ı\"a_ÔûÏ'/?U6û²DÙ‘Cq“ fdiP\n%ğu¿QÇ\0Àe@pùpÛ#qÕ\0Ãğò\$úo“\npÿDB° ñ\0Ï“\0ì0å‚^óP\"oBÔ0ZúOÏìüñ1	ïa*ò°%âVï¬ıàjùÒ„ù°…¸?/-!²ïBÑé,ÂW\"Ï‘P\nPíEFk/p_\râc+/\$úS/7+/4ÿ_L“qìø°'à`D2%ÏÅ³#ñå\r n×‘›7p1#p…7€`ø³O0·\$o-!2€PÑ½'Ï&02ñ	°N“v/¦ÿ1\$ÏÂioÏ5ñ\nO ipõ<²€¾23QğD1¾ó‘Õ</ù1-âW\r“CÒS®Ù“\nÿ°	\0ôìÂÎ\r€Ø„ Jü d† rìÉP#€Ö¦ÎÂ(Jì ^înêïA N¢4\$”(‹´ï”?\"CtH\rô*†\"®1ep„§÷tox\r|ï9Ó°A“ ãÜü\rADtKBå@ğñÅ\0OCorî´sG`Û/“kôƒÃÜù°ÔEÔ,ï@O(ñK”Fô¢,ïºó’’øRÁ+0şğÒAñ!/ÏP©ƒ\0æ%ëã#sâÿÑ}PPá;\rET»Eæ6\r@Ş*ôh¤UKô0ï§1uI´8ë@^õ:`Âp˜R\0Ú÷ã' ğ T@b\"UaU±´îúdhi1€SR´+èK	OütmJGTÑG…E“Ñ\0qÒùqç\n’ªúÏó/ìöjÿQ«\0R ¯AÒ3ğs.³«Nâa\\¯¯@¼ç\nóï*1/\"aî[/ŠûÏ›0N±ğÿÀÙƒ<°‰ÆñaR¡0QUa/›-P\\Hoap-%/ñ\nsçkUÃÑ¼ôó	•É›\\ö#]6M!Tøfr^\r*%PIZ‘åoKQé\"VE95ı2ğSï\$i+6ñ‚şOšHÑ¶ZïïO'Z“p2ùUµ °M0<¶—,ó“Y1¡[ôµUÛi96-˜PôRÁ8p\r3?7ŞşO'cÒ³`r;Ó``í%°31¥“ÊA4é%¢WhòÁYq¥oGÃó7oa,Å[Qµ7o›Ôû sk_²gi“i,úòrO°i‘½j1CqIÑõ\0/‹!“Ò“]Â^TPÈH¿wM!wññmQœ01µ+’§mR},°Û¶€ÔO?+Tû¯í5pNû²K^·—SfõùhssvÇk71Åf/5cgù\0Ñn@Ùò1zÒ´Ô\0koPI#\0i'E{ÑGñZ\r˜ÿVÏxR`0#!/§\nq¨üc!1³g?»2n³Oj·ƒ„§@pĞ”ÿ@j\rÇ<‘9Oq·~ÿ@e0¿!3P#Ôû¸?YqÙ„Ò¸¾5é/?\0/Úú6tIu»‚¶s c€Di7õ€Àn×şòWï\$÷UmA3kÖR?uó\0rü}WãtĞ_bct±Å2Ï3pı0™ñ×’1rù÷¹;bóVúvû6;%1ÂúãØ7/Ó)Ğ(ó]1W²ñ'Q‘U“1Ñ ² ×v0\0g……ô•tADôAôWBt½WàÑX\"aXu9Iõ<5CCÙT„´EE”KATE4!WÆ6) áRc‰˜ÔcR\$ôk˜cL3:Ô#T4Î÷ğ'€s”úO†°øcğ´çV/\0×3\"T÷4üøÀj)µPÇPÒ%r;ˆ™oLÕJTÕ\$ôr ntá6ùËN²ùe9Öó5Ù+#a2\r'ÑMPo½¯9UûUmQ”ËXÏ{Y Û›quÑñ\0gÄ&ZœöÃO¿µ¥¡õú-[¹í¦ĞÂIZ:ñ:?SÕA—\0†öÚ‚î€` D\" úãBÚã€àmÊ*àæePS€æ…Èj¤Æ`J¦Xá\"´ÉK®FYä>0Œnz¢Ãèª\r:¨ºŠ\0004è3,b,f¢(íªªõ­hŞšÈøÄL¢G‚´Ù3°I˜CG„ó.X¤.ˆ½ãî,¼å¬Â7.jæ{\$]îm²ràmÜV.†åÎéŒ\0Né£Ğ*Šû¨ªêàvuÀÌíàXîH`zONõ/Võ¯^ö ÎödÉ¨€D\0Æ˜ÛhI‹\"ÖÚË¨pi¹ERV‚ªcÅ9¸.ôO-¸.ş›kºîÀÅÏò\0Dá±Ï»™aEûª[ƒ¼¨HLô­\"îbú[ƒCûj¢;ÓEµF9‘¶§¾ôQõ\"ğÀE¿ |”£½[ê2{ƒM\0D	¥Fài…\0h	\0`[ç— E¾Ü\nôsÀ¹³Á³Â\r¤Š0nsid’CÜœIÅø†—”@eÅ¶#eÜRivıÅœKÅünú\\-Ã|;ÀÙûÁ€›7`qH`EÈÃÜ‡¶¼Šò¼‘ÉB¿ÉšCÉÓ®Ü¢œ9É|´îà|ú”zğ^'p	¯c8-	b¢Ò•IP!G*¶@†%¯ãí°:²@ÛC[›	±+Ì; ½\0Ìi²Û(æ,²LØçC!³›1³î“´[HéûPëÛV›[W`ê{dêïK¶Ä)·Xï\\ö·¯i¸…¸›k¸û›¯™¹=dç.Ğ•{©C¬›°®›·×›ºñ›¿¶»Å<»É¿-I;­¿Ô½¶»Ú7\"Q¾?ÂôÁ#‘Ù›ò9÷ÀjEÛ-À%Ûƒ‰É<„÷¼Ã<÷ÜÁï-Â\\)ÂÍ£Ãìü©YØÀ`\rı„’ıœINØ!àlHp I8!¢dı—]éÜ½íÁ¥Ù”ê Ù<½yáº‰ËüÃÌf	ÌÅ/Íèjâ€˜	gÍÉµÎ<æ-DÇ›ÏŒ>è‘±\rÏû±N]Ğ{Ñq²®d2]1ŞtèHFi³¬ÃÒ[C´céÛLêïµ\$_µ›]Ó®ñ¶{k¶àtõ]KÔûy·ÃÕ›†”û‹Öi¹{\$ûœS…iÍ é×=•»›³×û‚ñoñıˆf{ÇØÕ–[·Ûİœ’İ ¤!]©A=ÑÚù¥Û4e™=Ä#ı½F‘™ÜÀñ;×¾İÕÁÄ‰ÂİÂ¿ÚÀËÜœ·Ê+È“vöıÆœMànÀsõNH¼qõüwÄĞ\\úVô?EÈ<>	²!Š'=şøõ|Ró“w„dÛ6ïÏŠ˜°\rwùñÂI?š¼Ë_yÉ¾!Ş)fŸwË3ÌìáåŒ¥w„~ËF´#şÉ…xWtšâª1Ã(É‡ReªræWü­à!¶¾ŒIı…ò[ÿÊ¤pÁ¯›)®ÍK1@Hf‘Á•IèÀ:Q S	°r;5¥ªnbkqTÊ’ÿûè¦À; €Ì‘îª o¡·Ú*˜@r&¡±Glq<\0Œ.¡w6 ñ…÷VŒ™ÿckBh’H(æ´àjOC7y¼C(mpœV\n*1#‘’ÆnÇ<ˆ[B‚RÀÄ9ğ2ŒEÿ€ò… @&â¨³F…(è\n?JÍ¹[³ãŠARğWaÃ¸şçØ»õ°¤v8ñWÄf#Pè†ü:†îk±{Œd`´¡¬ça'³€t˜¡—Íà#™tB¨mC”„¥ÄƒXdr+sP,Adhw²b?‡`®`b[Ê¡\\+HXD90œ„ò¨Ã–]CŠÌY§\$/Xk`„/Á\"‰5½¦|Q`ÔQ²œ\rÆòj\\'CÀB?†ä¬ÎĞ»Uà™Òµ,ÎãF†ü4Š><˜aµgoA,(¹M’Nr¹HkeĞIÈ,T°Ê”*áŠÀ}Ã²p8äÚÀoPiÀà ª”ü™–ypñ\\öó'?9ğI¦ü&øJN„Ù‡œ:Í<ûÏÛ.óc0Á1Ò 3hBà*aø…¹èÇEzkh”ô¡L¶”Ôî—mSÔ8Û«:ˆõYmË©›vê—¯ÔîíÁ{	^İ^·³›UÖQI{H–[†˜ƒ¾!\"µˆÛ•€ë·^ÁîNÁ{«xŠ4·½;!ïË|³ßÛÜíø¾}ğï¡|³äßÇnÅµÜ“vë½bË·¹9İ<³»âÔá§í9q÷§aYôŸ`âcé8Å;‡o\0fÒ1\$€åo@5Œ`Ìã} ï7¡Ê@h‹³‘ Æ+‰((wq4i”à6¢x=Ñ£q;îÊ'9”Q¬d#„” Å¿µNùiyq%>åü/¤ŒÃ£bã7Ú‰\rÆ˜C‹œlúĞFTó‰qTa£’âxË€Éû/£Œã—N¦ñ¢tÈ‡_¼^eØ\"6<1ãSÇÏÆ¼<G_+AWcåÀhÔğ=»x†×¸ú”Üäˆ©½L}¢­GÌCç8è{ÎPoØ,œ†>9[Í]Ù˜h@PÃ‡=¨Ü‚4H÷~B\$áÂN&4¸şŒÑ°PD,ë ˜ö\0âïƒÀÚVÂ@¨ÒrjèÒˆ\$§>:D\$	_Z¯#‘×¼r;‚ìÇÊzâ4Ò'Œ|A ÀH‚APIŒ}äDq¹*¦JÄ8p\nò EQ„üëá8\nÊË  \$m`)Ø¤ŠW©0˜ZI&ÿjiÀ¤2J€à†Â²‘[Q\n~Çı©b·ŒŸ‰@xkñXÄÂrQAzbƒ\$’+ 	\"ªæDå\niCš>\nÒŠ•4ŒÄ)ÉîT’{èdÌæ•Qh“`{’àÉ&oBr§‘,¡B(±–JjF’°‘Äd›!\\jZQAOŠŠ+ˆ2•T©‚,„­@");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:›ŒgCI¼Ü\n8œÅ3)°Ë7œ…†81ĞÊx:\nOg#)Ğêr7\n\"†è´`ø|2ÌgSi–H)N¦S‘ä§\r‡\"0¹Ä@ä)Ÿ`(\$s6O!ÓèœV/=Œ' T4æ=„˜iS˜6IO G#ÒX·VCÆs¡ Z1.Ğhp8,³[¦Häµ~Cz§Éå2¹l¾c3šÍés£‘ÙI†bâ4\néF8Tà†I˜İ©U*fz¹är0EÆÀØy¸ñfY.:æƒIŒÊ(Øc·áÎ‹!_l™í^·^(¶šN{S–“)rËqÁY“–lÙ¦3Š3Ú\n˜+G¥Óêyºí†Ëi¶ÂîxV3w³uhã^rØÀº´aÛ”ú¹cØè\r“¨ë(.ÂˆºChÒ<\r)èÑ£¡`æ7£íò43'm5Œ£È\nPÜ:2£P»ª‹q òÿÅC“}Ä«ˆúÊÁê38‹BØ0hR‰Èr(œ0¥¡b\\0ŒHr44ŒÁB!¡pÇ\$rZZË2Ü‰.Éƒ(\\5Ã|\nC(Î\"€P…ğø.ĞNÌRTÊÎ“Àæ>HN…8HPá\\¬7Jp~„Üû2%¡ĞOC¨1ã.ƒ§C8Î‡HÈò*ˆj°…á÷S(¹/¡ì¬6KUœÊ‡¡<2‰pOI„ôÕ`Ôäâ³ˆdOH Ş5-üÆ4ŒãpX25-Ò¢òÛˆ°z7£¸\"(°P \\32:]UÚèíâß…!]¸<·AÛÛ¤’ĞßiÚ°‹l\rÔ\0v²Î#J8«ÏwmíÉ¤¨<ŠÉ æü%m;p#ã`XDŒø÷iZøN0Œ•È9ø¨å Áè`…v0Cñ9 è8aĞ^µƒMè4­£¨Å\r¡|Ğ7zF[\n¦ƒ(ì7êÙv³­êIÄˆ2ê²,9™ÃŒü#‰–È¨DWÂğªR;…ÂP¦'‰Áşõ¾Îâm©Ñ3ìƒ‚†\n‹\0u­3“œæğ»9ñCw§Ğ2™fƒp{¹Ğ¸Î/Ò	o4Íax¶/ƒ \\.…ã=NJG@º£YE«9åšöaİæ³ß‰mg[Ó¹„ş=zøùŞ{Ÿä4\0æ1CHà:¾>Ôû ×Xö>Û~]\0d‰wŸô³áßsã„!î:%ãÚ9„~òa\nåüj0÷XÑuS¡ôÊ6²ŒdIÈV3„Ì¼r`AĞD‹@’–x9'²A@\\Tƒa3((Š\nPÈ`ğo{eÔ9…¸=	`´\"åÅ‚ˆ	[B{!ˆ:¶x?Ã)'|fì8ô¨µC ?†ş†PuËÜ|é@ÂxR;¦U\0(.5Ê“joN)Ì/97LçA#8á¥eAÃêCA0&#•·«wKÕ¤RG¤îˆ­ZaİªHà	UŠêİ‘ÅpR–b`Wô’àŞ°J\nË!¬MD‚xkVñnOÙ(#üŒòyN#òh“Ğ\"@œ1Ê\0Æ‰#8L2Ú\\r–Q\0r\r±Æ`ÚÙYávb+‰ƒ1æHl™`¸ƒ%³zä€.™ó ÎM »5lšë­NÀb\$Š”2ÒTxH´¤ª`XH§SÜWŠmb)§'>'z€Pî­!ºĞ¸@?VÎÄ=ƒ8\nÔ+µda¡0Ã™7;‹¤É¹ÕçÏ*ª~êµWªwÜ•Rºß*ˆT8CÒ®]ãXn¥­¥'I2¦n\$²Áp4ŞJÉtXæº<¡¥›>àyK)qi%Å°4>àV\nâİH{•J†’âîj“¥1}‡6œ„›JS¦PôC¤¤a2¶\"“¾}³s(ÔñÚ™á^ËÉÀm*çD9Í©Œ«É¸uÔ:ŠAåy¯¥ª¦Tê İË©LÍœ:+pË^‚İVÖJG‡»ffüµ”5¦¾%©y	Ü®’†ËYŠ­[ëŒ­®[¾\$EUYZ•u¢ÓJĞ dA™‡6€[-CHl€‚©)Êƒmì=G¬fæ¥²Ûc‘lŸµ•RĞVùÌ¦xU UÕXR¢«\$i®jÀË»G	Ã2Í¶¦í[T¯'\n5s´á’FYËÍh¥½i\0íX©%_¦€!ÇÆÁÜû\r€ìEŠº¶44Ôô¦•l”tm¶ªÍû93l¾·¸S²{÷SÔêËÀâü*g8¯³\$‰\"kÊHO)åJõ•bÊµ£p¢%\\¹¤P½Òs #‰Ğ)àöà¯B:aĞi‡‹¨· Z^èş©\nk¥©»‘Òv2€°—¶Fì±ÖP“ÙJ²¬¬Ê˜nB¡Ÿ,‘¸Ü§f´·­XÀ5’pBİ`ÀooèÅ’êIô!=8ë¬)ÒcÍa¤ØHã¨¬‹ñîb(ä›ùåJG•aÊÙ«\"¤‰BéF †ùTƒá{¦á‡RËõp*Øe~2Ò^ Ş>v>…ëàñ—%¾^1ò3ğwCX=¾!±gÕT–e=9¾p>” 5;µæuÅ•Òä»+ˆÌ÷…™hMœWZA\rîÄ—µ\\M\\ù3gĞœ÷[Yµv¯qX[»bÌ)¹2­\rûÚWÊÂL+ÅŠŞ¦ez©Íø•A|eÕd9A‡eªÍĞ\\ap.‚@_†±ê¸³ˆ~cpúë¯%-›¼ZÕW[îQIİ7¾ E5£¯uşÈ”[6%PCioöŞâé[1A4ƒ KD¹\$ó«i.	?V¿{ù/äÄ_y]ÿá@£­^ğÙq&#—\0êO<†‰î/¢ÉÎæ‚Ìq\"ëæª­\\WœÁïUHœïyàêWtj¦ºøVÇÛ{¦nåVÈÕfÉ+Î¼tºâ,ÔÄŠ^g:ÅLûUiİû¯šİ»¦e*ÇW•ğ“Õ/-Ú%ï›ïå¬\"8C^Äó¥¯&(E\\6¶Ô¡ïØZN¿9yôñsÖv´é^/B¬³0œRZšû®O\0‰Ú;`N &Q Ÿî;ŠP2×Î’+ŒÙş‹=MŸ tÛZ472ğhLW œ •o†K'ø&îÿ zıH»àÜ§À j†˜?\nRDG*ìÓ‰’-°#<¢ ¦ÊIÄö€÷,P¥—,Z;h®®„\0Ğ#€ÌîĞNËM>I`œ(Eˆã¢4\r‚T]\"êĞV Í\0°XQĞj~ bR`M§ŸN-àRSN,¶\"Œ0 ê	ædéŒ~¼ÆæÒÌy\rœ«\r@‘`ÂQ-\\s\n.Pèâ)¨ÀÌ]à™\0èpÔ\rğØ]à®TÂÚĞÔÛ*}\rpÚ#°î‚Ú-àjE®¾‚mp!É¨f@Í@îW®<cmXÿ„v»ğ¨	èz|KJm\0ó@ß‘W Â‡ ß‹¾‚€‚X\0¤ĞKl<«ˆ!¨N¯ú*€äĞGåEÈÛCÄZ«”§oâÛBñzš Ğ¢åê…\rÑxŠéËçGe‘œœˆHÑNä·H(gjñ‚°¯Â\0x‚‹©oÂÀ÷K@ó11lDÃ\$Ğ ¯²`Â ô®Dv Våü bS‘Ğ³H`‚è2¨®p¨nâ·.èºq´ĞQºJ…êŒñ+«õ*fÄMp«‰ö\r Ûí‚/D*÷ï\"ÃÅw\$o2úç[QéÎF‘ó`M©|î1ÒRåhÿo'&‹5#%jà€Ø>¥ÒjáM¦Ú¯ü²t›è@&rpGdDÊbtsRí\$r!äNº2 qo©¯ö¨{*,DŞÉ¯brM ÛàË`î.Q—Êq°ø§D%Ñ˜İG	!J‚’Õ-’İ¢©+§EDE`{0’ä§©0DEÈ#Ü±¶p(7ó“#2òÜ³bŸd¢óÏ73MàÏ&åysH\"74rêLÂ9-f*Ü‹•/r°öÀÊ÷RÅ˜øRúÑBn*ijê@ònâBèŒ´è€\\FIÒX%x f\$ó‘9J}9 aÏ0qsnFÀĞÚH¦|@úùöE3};)k7ó´|H´²–óKK5©´ÜSdvR†@ñ ¤ â(„ Ú\rÀš¢£&Êî¼ĞÍ*Ja@fp¯’+J‰k­,Ìw _?\"X\rÎN²‚3'5&¥t%«;A´8Lrn–€ß?E’QÔ\0%¢NSkaóÇ8\0Ğ®Ô<¼ÊDU€GŞ¢F8VTDWe7`¬ÀíäçH‰tı²ºÁH”Â‘Ìn ÒÇGJl;HTjN`¶²@H Dsò¯Ê[t¦—ÏÎ((Hš”ex¿Óm7v«yIÒ¾#T‰=íÑ>(™)‹\$_Ô§OÑOQ¤-eğ(*GKdËK´¾„ÄàtÈÂ`DV!Cæ8’Š¾sîDàæi<)3ŒØBıÀèKU;8S é¢ZBó„(âŞ.šGó…°¸ÓDƒcè,®šEÌuTãp‚dl¬7J×ÀÈ3…8•D“KÄ\nbtNSHUt# {VluV¬ZuF\r@ê`ĞÄ]6äZÇŒ˜Ç€][•½\\\rf(0ÁS€åSÍ4É3¢D³—'³W†:S˜ c:¨âÕ Ç…‚b)ífÕò³µ´Ä¢#éÈw5–v›s´,øßrw6&¯ç«æ™\\m0Á\0Úœ\n¼JÀßv6Á6Kdã)cu&œ…—Ré37NÛS¿X€ó5>DUµZ¢:Òõ¯Z'rTµ7Sµk_G[Ä¨ê\$KU‡Ñ\\Òx«¶<m5ÿ#Ã[E¹¶\\Éí0W ¾J*.\roø]à©#€ÊC‹*œÑ5kŠÿg´‚|“«< „Ğ-uĞSŠÓO7TS“^“¦ h‘oösp fœÑÖ8ÉI\\•¬#µ°„8ğı_R{pe'2ó=¬èS@á[·:Îe8Ò•Ëd3İ5¨]r¢ÖªôÎÖˆÔ&DÔe\$ån’W[3÷^‘ö«vTÔ–w)vÜ­´…°X0cmasZ »xmÀ´×Œ§×‘Py¬yz:˜¶^2–bá—9”ê…U¶qo ïof>¦\";­K|3yVh÷ÖlçÉÍµ	0Nà¦o.¯©¶éË%²ÉÍ@OGvJôï7M(€A¤³²,¬‚\"[\0¨×/, %‚¸…ÈÄª³‚àÏƒ*¸«2x}Ë¦š‡²àšgĞßAï!…,ÒÊ,¦ÍÇ–²:&\r,«3_-ŒÔ‡lÛHøo‡8vwSj)V)ñ(ÿÄNÔøS„XHóXMƒXC…x§'/A„XZ^©€|fÒƒi,Ÿ†˜†Ê¸ŠgØ˜®[»‹âÚ­âª@QbLxJ¤€‚‚”\0Ø„j•S æZ€à	øVB§\"ÜæĞ‹c<Ğ¢çtP5uÀÏP\rÒÜ¬‘­‚m„Ò\"ày‘B¡“C“ƒ“ÓèÚMÅnŠåwô^·ù1¶ ÀËNïjî¿x.øñÒ/*nëtI’\"î2¾»‘\"ñÓ=r›–ø\$:kwba.è1>3h(Kom‚5;õ2g†|B\"iºDÔ\rgÊBàX%¤‹ëÌr¦ĞVÍ\0nà\\òF†M¦Üm\0~\\…Í€™ÀáŸ²°ã4`‚.†*\0@Ô'9ö‹ú š¡º dæ	£{¤6êç ¨\n€ Pë†¾IÈÙÜnË›ÀñYÅÓ[¥VXm^oÌÔ¢Åê?g§¥Â<¯°Pÿ@N”ˆ/KÚsàDÄ÷©eêP\0xô‰©Ç¤gÚ}[¥sGä¿¥š²¯´S5ÀÊu²%Ê%Eúø@÷«Ä/§ú¶OÂZe{¬ÅLY)¥)¨ˆ¢BäR` 	à¦\n…Šà»QCLÚüyh7Ÿ8É3\0Ë²\0‘6åƒ!ÀN\"¾\$€[ŠhÔ@Ìa‚àğ ï´àZ™àZd\"\\\"…‚ÈVg²9²[)²ÂhN`°ºmèL°î-¨ÕŸÚ·fĞ»d ÏoXºh\"ÉkÓ¸sĞJºõ¹\"m­÷2ËN2T.ºõ¹uº³ ÇœyÊp›' c)(úİ¦¯èşÏğÿ[É¶[¼`ºg;ÀSZJzK”¼&‘jZšOpé¦°	¦É§@ËªZ©Jzœ(Ó®Â@{­úµ¬8\0_®Å­½\n3¿»²ñ±¤/|u¥0K«Â:IéœßVÂü:YÅ†EmšR‹fän†í4fşo¼wÇ¾‡1¾Çr’N„÷È2sb0£Ù‚<¤dî‡±ÑÏÅ/–eœàÂGf­èôZXÉŒ<I<õ•,b\rÆÇ–®K\r¨ÚJş°\"HÁ±½+qÀ-w˜×P,Ï\$ß«%U¤²¬Ê,Õ˜@ãÓ®LiT0K2yiÄ³=|\\9wÄî2ó‰BØÀø5\nÌ\ràùef˜‹ˆJ]åíÑ³ WGÔåyb'H¥µ¼Qû\\ ª\n@’ Ús#pË8PŸµª}Ö}j\rıo–‰×`\rE R‰MMHJçW ¶nt€Ô\rä*NoÄíæCÎMCÈÀBğ\"€_ÑHëkµR¢…N#]¶d<.à¸à\\Xüe&_G–_Ü×n%—Æ9ÃÆ›Êmâ4ù\\Veg§¾1µà'aü’µÁ±šoĞ\r5âp|[\0Ğœ@Îh ¾tÀP¦bgÓ¦|)¦É–æº l€ {)×ä~ä®ø|†åÌ™×§sz1vtÌFF)àXÎA4y/g—!gğ»hNq•ßhí_jÌ’Óãk+§`¢0ÖwoééSkW~,îé~€ÎP<3‚h²¾ÂóÄ~¯~DXE‘	\"Éºƒ¨kRÉbö\$ıáBİIí¥!IYx‡§F%FTg±6â-X/×\"öRmdöûkXQ‹`ÜFS‰¹å?V¯7UĞ²èœpĞ&ğè•Ø¥›sx@oĞ›|¶˜?MWµ`êié•àÇøÆHBCÖ9ê¥šÇeî;Ú¾ô3…;HP\"Lš5	ğê#´…™^£”Sâ,›ùÍÔ5`Ø#\"NÉ¢÷³B,\$Ÿ¯÷oê&•ÁñêÉ‘n±;xZ- ]‡>¢šÃq1 h€e:¥\0\r[\"Á­*àbwÒ&»¼Š³6“Vr¤ÌôÛ\n¼>ñó¹‘­@â§S¨·Èš”ÑÜ‹ü>,¦43šYÚÜè\r*ô‚ˆ=|ºRÚ0°£9ıil Ğ!SLªõıÁ\$Á˜`dN ÜdíïÆ¨“% 2Ô5Á½2Ìœ(ŒV¯†Š¸•BA ]àE ÄÉÖx*’	dFÒ3‚€ü8–	{f(^àıö¡>õH&Mf’^MÊÀÒ™…\0]ğBšÔÀñ‡\r	ïâU¤•º°ñ*…íôn‘«ŒPtŞã ù`'?\nİ|,`:Ù×ë{€©İx=öè8ÔónHrFÆ§±ZÂpsO\n|Õ	QN¡…,ÊO\\)+\n‚¬ÀŒ Í.é)†©\nhYº0¶,_¸\\‘n/\$CÛ„X\nP(\n“`X,‰Í¹¡¨MpÒ¬§­+à+@ŒëÆŒ8‘Vë5yÈN@˜ñ–'ô#‡dHàÓ\0Xƒ¡–=	¥kÿVÓ õ 	½ªBAúPÕÑÃæ\r(‡Y‚Ödh~‡ìqÏb	›©Ò6‡ÑÆÓAR\0XğÈ‘gÄ|–¡“\r`Á\\‹8äHÉ.§Ş NJ ËÒq°2”\r¬Ô‰2±[PÕ ¹CôJø	ÄV…'¹‡é±KĞ[ÎÖÈ ±H@€KMtî áT †â	ÀVÿö=!ª%'ú \n–V@èŠÎ!Så‰~úug¼´…DWmÉ—É”ZœR-«kbrÂ †iÆ¬=éïÙ08AÕdÃLƒ»ÆàòYRSœ±!Â\"rx…YCĞ\0ÄCFŠŒ‹Ï^®{xÈ¼Å¸»•ã¤³³\r\"ìÅK”Â=;Aáã\0t ¹Làà”\"×•ÁEÑ§ŒX#\nñ˜ÕÆµ/¹|¸İ<CW¤t^® 4ëvÌ6ÅR\"–te€d)˜£^f6¾¦Ìl.›˜&àá`G5×%RJÃMIB™¾Ğ#åŞ9ñT£­ò-Æı•D\"FıXÚ1™­Œø~ßªJñ.-jb‰`ì{Êh³Xò'„ªQâHtzV§°2G´¾!³¤|K* ƒ#GÕ­±÷~cÈ÷H1\n%ß`ô‚d3©’ŒóbYxšºnIÈ•`Ç·€y¼IœLhB\0€=Àl!A™zSºœ\r®MHb\$E6FÏ~IŠÈµ^Æş¯aKùÌ¦Oj*aõ*’Ï“tÀ0-2à\r|2ş@„~©Nœ˜•F6àÄš('`\"CPE\$´ep7—œR^‡@€È&Æ/\$óRz\r\\vLÄÀé?m¶à\"6€¢ İ-Éè\n`q\$Œ™ƒ@›I©!Ò„Cì›€ó'	9jKòv“Á‘¥(Å6Ÿ´\$òŸ?[€5ƒÊ’#“D¤C%)7Å¦Ü‚rŒ5œ§N—*AøÈÌ2¸ì©˜<Bc-IğRò€8^€Â!QV]CFBS´/Õzc¨&à@yI\$øÃ35°Õˆ‚l²Š.HlK1® s–\"¨â†ğ5œ\rÒ¶”´—\$ç)¹kúQjJÜ€E¡.Ğ7Év^\"“ °Rn%™=\nĞt o‡8É^68@Ä§É¦Q °M‚˜xK8`0%†T3 Ãùø”i”qÉ Â:ÈãE„Â\\ád2Õ©I>pÉÒ\r†8øY¢Š¤iÁ„]“UEÂëd`”’Ô§^#2¹âdE—b\0cæL/Y”!ŒO˜T¿şÄ¸Ë¦Üà‚¸ ¤ÂehÅÍ\n`jÎypxB`Ã°+ô@4TØ€ig²‰Î o\0Ä^Pˆ·îSRum„Ò‡(é›gß™Ü¥¥;5yÌ´9š,ÉQ4”Jœú9qÚ'X‘İ¼P#ƒ	üˆÅq8¹?Ê%Á4&Ìæq.YÍ¤:qáœŒ·ç)v“5¬!‡ï!È…Ék8ÂÊ€œ Â{¶§\$IÊKØ®QÒ‘Ù–Ğ¶ ñ't›0~šKÊº¦Y¢æcH) |+&Z\"ê@\nB  DE{À#eHL\"V‘§ª\"ûˆŠy1 ô¤Šj)9Ø¨ÓÜ6¤i¢Yö>ù…sİ-h©ĞƒÏ±»\0^m©d´éö9iz#'EÄùA@)ùaX ãQ0:FŞ0â·ŸCÚUnĞ›ş[bÎÃÊ³Ôä+iHL9c‚vÖ-†!PÊÌF’+d(K\"¬Ó‰¡bƒÔ®dõ‘Æ„’@•Éû_¡C‚ %|Ô;PxuÑ,æY¤<¶	ŞQpbÑ”‹W‹à|b\"cã!ZøsÔğÑU?ªİ[JÙ¶]ú-'úx_9ñ§0ÛvÅ—™ôFƒ\n…°Ê¤XB€¨	q]Ö—FQ–JB‚½…k¿b(=XGºÉÖ’v\"ÚÒâé	C¾TôĞÌµH°6R4ˆi©hÚÂ!^QµÒ\0{£jç(ó°ÒB’C—xkøi:™Ú<É8¬¡ÒHRp\"!¹Òœ#¥[ÔÔd`0¡¦–Æå++šèö;*MÑ¶¨]%Y”,XÂEØP“,¬Rb˜óì8aŞ`=w«IäÚ¡ÑZŒ­¡Q1 ñÄ!Fb\"ÈTœt\n¥ÓÚÉ*b®ğînYñÕhô¥Ù’,ÔF´ZpVü˜EÂ¾¡TÀ|NCë@òzÕ¢½5qÂ¤9ı*^\rÊtq¦éhÉZc„=×ôƒ¦]!Hí×wÓNš¨ÁK'©Ôˆ„N‰™ĞT­êEÈÅùUS%—–8”ê(¯ğUE¥Ÿô—ìÍdCª\rğNû£ê\r´C§º&iz9¸");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress('');}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo'';break;case"cross.gif":echo'';break;case"up.gif":echo'';break;case"down.gif":echo'';break;case"arrow.gif":echo'';break;}}exit;}if($_GET["script"]=="version"){$Ic=file_open_lock(get_temp_dir()."/adminer.version");if($Ic)file_write_unlock($Ic,serialize(array("version"=>$_POST["version"])));exit;}global$b,$h,$m,$Nb,$Sb,$ac,$n,$Kc,$Oc,$aa,$md,$ud,$ba,$Bd,$ne,$Ne,$Wf,$Sc,$vg,$zg,$U,$Mg,$ca;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$aa=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$Ge=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$aa);if(version_compare(PHP_VERSION,'5.2.0')>=0)$Ge[]=true;call_user_func_array('session_set_cookie_params',$Ge);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$uc);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);$Bd=array('en'=>'English','ar'=>'Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©','bg'=>'Ğ‘ÑŠĞ»Ğ³Ğ°Ñ€ÑĞºĞ¸','bn'=>'à¦¬à¦¾à¦‚à¦²à¦¾','bs'=>'Bosanski','ca'=>'CatalÃ ','cs'=>'ÄŒeÅ¡tina','da'=>'Dansk','de'=>'Deutsch','el'=>'Î•Î»Î»Î·Î½Î¹ÎºÎ¬','es'=>'EspaÃ±ol','et'=>'Eesti','fa'=>'ÙØ§Ø±Ø³ÛŒ','fi'=>'Suomi','fr'=>'FranÃ§ais','gl'=>'Galego','he'=>'×¢×‘×¨×™×ª','hu'=>'Magyar','id'=>'Bahasa Indonesia','it'=>'Italiano','ja'=>'æ—¥æœ¬èª','ka'=>'áƒ¥áƒáƒ áƒ—áƒ£áƒšáƒ˜','ko'=>'í•œêµ­ì–´','lv'=>'LatvieÅ¡u','lt'=>'LietuviÅ³','ms'=>'Bahasa Melayu','nl'=>'Nederlands','no'=>'Norsk','pl'=>'Polski','pt'=>'PortuguÃªs','pt-br'=>'PortuguÃªs (Brazil)','ro'=>'Limba RomÃ¢nÄƒ','ru'=>'Ğ ÑƒÑÑĞºĞ¸Ğ¹','sk'=>'SlovenÄina','sl'=>'Slovenski','sr'=>'Ğ¡Ñ€Ğ¿ÑĞºĞ¸','sv'=>'Svenska','ta'=>'à®¤â€Œà®®à®¿à®´à¯','th'=>'à¸ à¸²à¸©à¸²à¹„à¸—à¸¢','tr'=>'TÃ¼rkÃ§e','uk'=>'Ğ£ĞºÑ€Ğ°Ñ—Ğ½ÑÑŒĞºĞ°','vi'=>'Tiáº¿ng Viá»‡t','zh'=>'ç®€ä½“ä¸­æ–‡','zh-tw'=>'ç¹é«”ä¸­æ–‡',);function
get_lang(){global$ba;return$ba;}function
lang($u,$ie=null){if(is_string($u)){$Qe=array_search($u,get_translations("en"));if($Qe!==false)$u=$Qe;}global$ba,$zg;$yg=($zg[$u]?$zg[$u]:$u);if(is_array($yg)){$Qe=($ie==1?0:($ba=='cs'||$ba=='sk'?($ie&&$ie<5?1:2):($ba=='fr'?(!$ie?0:1):($ba=='pl'?($ie%10>1&&$ie%10<5&&$ie/10%10!=1?1:2):($ba=='sl'?($ie%100==1?0:($ie%100==2?1:($ie%100==3||$ie%100==4?2:3))):($ba=='lt'?($ie%10==1&&$ie%100!=11?0:($ie%10>1&&$ie/10%10!=1?1:2)):($ba=='bs'||$ba=='ru'||$ba=='sr'||$ba=='uk'?($ie%10==1&&$ie%100!=11?0:($ie%10>1&&$ie%10<5&&$ie/10%10!=1?1:2)):1)))))));$yg=$yg[$Qe];}$xa=func_get_args();array_shift($xa);$Gc=str_replace("%d","%s",$yg);if($Gc!=$yg)$xa[0]=format_number($ie);return
vsprintf($Gc,$xa);}function
switch_lang(){global$ba,$Bd;echo"<form action='' method='post'>\n<div id='lang'>",lang(19).": ".html_select("lang",$Bd,$ba,"this.form.submit();")," <input type='submit' value='".lang(20)."' class='hidden'>\n","<input type='hidden' name='token' value='".get_token()."'>\n";echo"</div>\n</form>\n";}if(isset($_POST["lang"])&&verify_token()){cookie("adminer_lang",$_POST["lang"]);$_SESSION["lang"]=$_POST["lang"];$_SESSION["translations"]=array();redirect(remove_from_uri());}$ba="en";if(isset($Bd[$_COOKIE["adminer_lang"]])){cookie("adminer_lang",$_COOKIE["adminer_lang"]);$ba=$_COOKIE["adminer_lang"];}elseif(isset($Bd[$_SESSION["lang"]]))$ba=$_SESSION["lang"];else{$ra=array();preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',str_replace("_","-",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])),$A,PREG_SET_ORDER);foreach($A
as$_)$ra[$_[1]]=(isset($_[3])?$_[3]:1);arsort($ra);foreach($ra
as$x=>$Ze){if(isset($Bd[$x])){$ba=$x;break;}$x=preg_replace('~-.*~','',$x);if(!isset($ra[$x])&&isset($Bd[$x])){$ba=$x;break;}}}$zg=$_SESSION["translations"];if($_SESSION["translations_version"]!=2085034197){$zg=array();$_SESSION["translations_version"]=2085034197;}function
get_translations($Ad){switch($Ad){case"en":$g="A9D“yÔ@s:ÀGà¡(¸ffƒ‚Š¦ã	ˆÙ:ÄS°Şa2\"1¦..L'ƒI´êm‘#Çs,†KƒšOP#IÌ@%9¥i4Èo2ÏÆó €Ë,9%ÀPÀb2£a¸àr\n2›NCÈ(Şr4™Í1C`(:Ebç9AÈi:‰&ã™”åy·ˆFó½ĞY‚ˆ\r´\n– 8ZÔS=\$Aœ†¤`Ñ=ËÜŒ²‚0Ê\nÒãdFé	ŒŞn:ZÎ°)­ãQ¦ÕÈmwÛø€İO¼êmfpQËÎ‚‰†qœêaÊÄ¯±#q®–w7SX3” ‰œŠ˜o¢\n>Z—M„ziÃÄs;ÙÌ’‚„_Å:øõğ#|@è46ƒÃ:¾\r-z| (j*œ¨Œ0¦:-hæé/Ì¸ò8)+r^1/Ğ›¾Î·,ºZÓˆKXÂ9,¢pÊ:>#Öã(Ş6ÅqBô7ÃØ4¤-ã98@1 # ÊØ\r1Ó»/<(9\"‘ (=ñhÈå\rëPİ)¯Ãk™#©¨ô´·£¸@¼,(bB1,èÍsl2<Ã*X!hHÏA«P2ÄãĞ9ƒÈï\0  P¤°ìkPö9Ikl Œm‹_?¢ô¨\"…²òLÌÚÔ£Ô2ÓBè¸ĞQ£a	Šr<¯8)ÔèÂ“1OAHè<ÀMéË[\$ÉóÕWÊúØ%¸\$	Ğš&‡B˜¦cÍ´<‹´èÚŒ’½cL©¬Úââ§­~ŸHR=Ô H2ààHãœ\n¾%b{Cd Ã±1;ø3ÑÛ~Ò/Ñü°3 «È†×·ô«†Ë£LˆÒÉ¢ìªBõ¯éó@ó¦)šj”\nƒz5/\rÃÊ6¾£Æ¤c0ê6v2ñBD3ÖîÊÖŸ¤#kdÎØ.OBåhF]˜fY¦l¾g†Tèg³;³ZhCpêÎ°Âd³† ùn^9æ9²^ğXà4È¹Â;@<z~w¥	R£\n½Û\$­µm™@\$cB3¡ÑU˜t…ã¿\$Êü,ã8_#òğë{…á€	+/Wà^0‡×XA?ãzBÌKÃZxöË²ı™?í\r~Âõ=[ò¦ÃŠr(‹d`P©\0\$X—t;¤Ù§ƒC2Ï\$#ÌÎÈVÇ²éÒÎæ?ì¿9Œ1¤‡\"ÌHØÃ07¤	K­íü‚ÿ|hæ8Î¤\"€(Apì\0((\0¤‘DI1¢dŠ âFÏs/jÏˆààÖÌ‚U>@C†•êËK‡Wfx0Â~M7G(ì„0¦‚3vA¸bk ¡\$zmÌµ·RVKIy¾ChTş²MI i8áŸö^M[ñõnU\"E5ÖJI „»’@²İyŸ'Ä8›2¢I !‘É\$ş¯C<güĞã*É2»- €(ğ¦!à†ª,22ØI KŠñjÑTûÃ•àkƒq%9ÁÈÎ6’î@X‘% ƒBc²Gñ \$Qè3Ã`¢\"I82dŒ#Gøs\rÑbw¥â4#5|‘üX3¤ÀÅ“å’y:+x¡&]«™|Ué\\Ó]¯	{Õé»/Ïà”+DÑ/Ô¿zÁ™TME‚™åÚÆ7i‚M×ŠĞ€lqÆ´‚vI+6lQÕºàÒ™QxA\$à—Fw‚ÏÂ¨TÀ´<#\\]ÎlÕ\$&\r3Lù~K_»#›ô2q,‰Ï¥‘x¤Mu‚ú¹!Éqx„¦{O€‘ƒ›/5‡\rEy*‹w/!Tñ›TÂZçs°¤¬ª:éå\nZô¢\r¥œ£°H)bT:!°ñ®y8 \$!&£a(™„VJ“PÈñ¿Saáû—ª2pT\0rƒë˜‘³úD\\Ş1¢QUj«FRüÊŠz¨kq '„µ€­+±h2Õä1×²C_Ap";break;case"ar":$g="ÙC¶P‚Â²†l*„\r”,&\nÙA¶í„ø(J.™„0Se\\¶\r…ŒbÙ@¶0´,\nQ,l)ÅÀ¦Âµ°¬†Aòéj_1CĞM…«e€¢S™\ng@ŸOgë¨ô’XÙDMë)˜°0Œ†cA¨Øn8Çe*y#au4¡ ´Ir*;rSÁUµdJ	}‰ÎÑ*zªU@¦ŠX;ai1l(nóÕòıÃ[Óy™dŞu'c(€ÜoF“±¤Øe3™Nb¦ êp2NšS¡ Ó³:LZúz¶PØ\\bæ¼uÄ.•[¶Q`u	!Š­Jyµˆ&2¶(gTÍÔSÑšMÆxì5g5¸K®K¦Â¦àØ÷á—0Ê€(ª7\rm8î7(ä9\rã’f\"7NÂ9´£ ŞÙ4Ãxè¶ã„xæ;Á#\"¸¿…Š´¥2É°W\"J\nî¦¬Bê'hkÀÅ«b¦Diâ\\@ªêÊp¬•êyf ­’9ÊÚV¨?‘TXW¡‰¡FÃÇ{â¹3)\"ªW9Ï|Á¨eRhU±¬Òªû1ÆÁPˆ>¨ê„\"o{ì\$Ã°Â6\r#\"74ƒA„ä2Œƒ(Ü:\r3Øçª1ŒLX¾ò<_(=Èt§*¢	ãë1Dªİ(‡=éÃ®é®1i\\¬;5JÄºhVÁÖ,M*¥Lij«&î²\$‹OÓr€ÌÃËd4àPH…á gf†)¡Q•kR<ñ‘Jº\"Ïkğø!Ñ2ö•	¢m-:…-{</¼Yq²Si¤èù_1b|ˆ°É;&®Èb-àJÉm'=±û …T\$	²¡•*}Õ=ëŠh½Òø¾¸©v(êb2Ù°Q`b@	¢ht)Š`PÔ5ãhÚ‹cl0‹©¢C×ÄŞÛ˜X\"7î^¥¶t%£4ªeAiÃ(ğİÃ˜Ò7ê©è¹\nC Ø3Í\0ÃCĞc0Í>\rÃ-!²¦¿R+U=ñ_É¸!ëhÇF=m£PÕ5saD50ÛfßÂ°¼ö6\rã½™âéÎéS [¼½! “z¾­…n\$Ì Mğœ.S±°F*ä2”à÷Ú	+¤7¿/X_•XB&blİĞPèçÄ0(ğ8\r4<DƒCCŒÁèD4ƒ à9‡Ax^;ûpÂ2\r¯TA#8_E|ú«kxD¦ÂHÚ85ãm:xÂiìoCz~6¯ø0†³JPâ\r¡…¶¨²~Éñ×fT”Ÿ¶ìcEÂ.tåŠ’fA¥-ı« @îkƒ` F”8 `Ì‚_²~!™à!€ÆÍsÁÖ¹\0Îz'7¦Ò‘°Âı”+Ê~ê46(óâ‘É~-ÅT’°TN¯×ÉüFíÅ…šĞ\r\"gìÁÑRA\n¡Š¤µ!²&Èa€æÍç4;@7°7\0ê‡ò Iø;›àÆğiïRÈŠÃuB<“ÑdS\nA4EB®ÕK¢Œ%µ!£>Ç¢ßcÅO¢U>\\ÛÁFkDø¡»cè\nØ²tÇQÚÅ%RAŠE(çÈåˆ'vˆ\\j+HÍT’x*ëZA3	\$h<™ğ@ëOáºãf¡Ãˆu6H\\3 €Úà|J\n= @Æä„DqˆtØµ¢a\rG@€(ğ¦Ygå¶3«Ó2Ú—ZeîcAˆA	±8Rè’{’èËHyÏ˜Ô(l\"ª[#y˜Ç^3?ÒPµÑ]-³ì¨OÀìÖ’Û¹¾pb‘@€)…˜3†µç`¨)ÄÜ/Í\rÇ™É9“ørP&Ëa`OÕIû!\nìXÕE.~³™—Šè’Uä`D×a7_h¢VVt‹]µYM5´’©„°Pc9\0;€•7°èƒ`+á¤1†µrz\r“‰Á?èC0y©ÄÌ#T Û\$¼+(*…@ŒAÂ\rÁÇºÌŠHLTn,t‚ñoJÈêÄ0äº–ÅßJ­©A0ìÛd\\©-”z³¤ÃÚÕJŠJ’ª\n\riZbÜ+”¬K•ŞˆrD@#?Œ„&únPJA *ò½óÔ{¡)&É²_Ò™”}!/µåmÜôã_šßµêP)†S^ßÔBL[â¹‹ÖÛ–I.jğ­+¡i“aVëéB©0ZKw‡N¢WµØ@";break;case"bg":$g="ĞP´\r›EÑ@4°!Awh Z(&‚Ô~\n‹†faÌĞNÅ`Ñ‚şDˆ…4ĞÕü\"Ğ]4\r;Ae2”­a°µ€¢„œ.aÂèúrpº’@×“ˆ|.W.X4òå«FPµ”Ìâ“Ø\$ªhRàsÉÜÊ}@¨Ğ—pÙĞ”æB¢4”sE²Î¢7fŠ&EŠ, Ói•X\nFC1 Ôl7còØMEo)_G×ÒèÎ_<‡GÓ­}†Íœ,kë†ŠqPX”}F³+9¤¬7i†£Zè´šiíQ¡³_a·–—ZŠË*¨n^¹ÉÕS¦Ü9¾ÿ£YŸVÚ¨~³]ĞX\\Ró‰6±õÔ}±jâ}	¬lê4v±ø=ˆè†3	´\0ù@D|ÜÂ¤‰³[€’ª’^]#ğs.Õ3d\0*ÃXÜ7ãp@2CŞ9(‚ Â:#Â9Œ¡\0È7Œ£˜Aˆèê8\\z8Fc˜ïŒ‹ŠŒä—m XúÂÉ4™;¦rÔ'HS†˜¹2Ë6A>éÂ¦”6Ëÿ5	êÜ¸®kJ¾®&êªj½\"Kºüª°Ùß9‰{.äÎ-Ê^ä:‰*U?Š+*>SÁ3z>J&SKêŸ&©›ŞhR‰»’Ö&³:ŠãÉ’>I¬J–ªLãH	#pì0ƒHÈÅ´PEa\0Æ9£ Ê7ƒMh9¶\r“hŠC¨ù?CÕ´KTÖQ	¡g¦hL¦X7&‰\n¯=¨ÕpƒK*Âi¼Y-Šú±UËD1[ÑKJ&„·£U{+hûôÂa b„£åø@\$ŠÅÒĞ0H“J¤N:+g8Î}½	bè†\"“+¼àš\r‹óuã´¢±+Ï)º’YîJbËcŠ£Ò6#äò'„¬~0„ yši3 PÌ¢¨/©Ä'|¥”Š–•ÑJª¯(2ì¥+j©Áuñz>pS†–-&6® zÎ™®5àV®Û†… S‡F‚ŒNn¨	Bjë=¿‹¡kL^pMÃk«Ùœ©§;ë&,ïTB Ò9Æ#dj·Wƒ”N7r¼¼u^ó(ğ:Xc˜Ò7ÖB>€ì+ãú\rƒ åAeéôó/'ó|¬….%í®ğôÛîMÂ!õpÊ1Ø£pÎƒx@8CHíŒ£=ƒéÈQ×'ñíh6D–\nâO¸ÜR‡%Hj–í3Ú£€‘ÁI6¬”¾Êóçº«3¶ñN:OJ, ¥†¢~İ²î8à¨bÆHÊÛ^Zï¤¦4†¨ûÊóñ//ÑC?tÎCNKû@‡X†˜(\0- !€‹ğï’hI\\¥‰-vB\\PÑ«BÌŒÔ5BôAß©'3ô¿ !¥ûiKô‡‹\0vûŠòMğ›Ã¦£!¨;Jx¸ªˆša	äH…Ä¹mÂRDœËayAg•‹À\\àa¡``zƒ@tÀ9ƒ ^Ã¼Á„2ĞÒò‘b+à½aÈÇFé]8nàˆ·ç††ÉøK\0ğ†}Ñ¦U‹‚BGO„ye>GM—@efÓÉ›4¤.7,åÀqÈA¼T­­Ê¨	yöQÕÒ~£IÓ*rh«•’ˆB5/2H‚\0îÎÃ` HÔ8\"€ÌŠÃkÛ!™Ò9 æCcG!Ì3Y²ù<‡šÁ¤:‡¡4Hèaœ*ù`,%ˆ±ƒcª\$\r±Ì¢¬€”Jgc¤…¢•çp˜%{ıRå¨tB€H\n	„ËPtÊûğ ¸—˜ÒVM[Gk *h\"„j÷ãsH“¨O)ëKÃpp©\r\"¤pä­Ã¸h\r!{H`ÏfÒ5¦êø0‡ThŸJÂU†Í‡äÈOã!¾/¤4˜¤ÑM#{ˆ„&ğ¦’(°I%mu˜è»”:nÓÜR*dŠE²T’¢\n)PU3šFÉVEËQJrŒ®%–µTPÍµ…%—X¦O“Úq¥)Î&²>\$\rëò­®İ¬V£*mMYáLPJ®szW,9RBÈtQ)ZÙ„­òŒ½#/0ŒÓ¯§4»>Û-Ãşµ/ªEàû\\y)Lõ„®H+m!U8’úäËH–Hå²*ÉÖÂÚŒZ*1Tî)Rüz&=,!§ÂŠW•-Ğ”öy©RkEÒËñ±Å„0¢9t-dĞãp@‚¥@“ ®µJö”¥Ë!­t=Û;óğL*KÀ^ÄƒTıîÂZ*,¸¡Xc‡0ôBKÊ*»0ìK†Ó1µs³-ôànØ©1Œ0İy®ÜOŒh† édë6ó=Úô\rQ­ ?æËñ³ıSEƒ#ÛpQ²\r€¬¾2bºúì/k1İ”ìÆšm\\™úú*¦‘~f4ëFbëÓa]° \n¡P#ĞqW%ºePœ¢5Œ-&*J/2ÔoòJ·Ğù;¿ìÇÍ­ºm«¨ªÄ;AÊu‚´î-‘ËäÒ¢)­¶-Åô-£w,Õ3øx‹³ã24‰„=Ä½©æ6“¤ÏŞª?Í)¬ÅH• 0\"ØÃa@E”–®‡\rÇ8ãõr®¹êRª%Rísu‘Êhégo?„©.«wØ‹j¦ã„T1ª„)Œ1Xb/S	X*uÅ4³ı¢E£_ß.?bcCn/Høš+ç&¾ğv:…JDAC¬ıáèÍ0¼†ƒ\nx-¿o\rÓÉµ¢*'‘Ô°Ğ9)<ä}“1mÌ*ÎÓÖqÇ2ã";break;case"bn":$g="àS! \n¨¢\0¿@°xJš¦_ÀÎ:6\0šƒÀƒğP”\\33`¨®\0¾€!à(l	MS,¢ˆ¸†S,\$ğÕÄ]‹)•°d5s @qD<6(R©\$Šiìæ’¦VIà\nxÊ™+\rBÁbˆôÎ\0¦®©!²e4¡M*˜Ï+Vøp@%9…Õ;eºá2S'ë«	½š`€Ob±«M^‹bSÜ%UP²H§´)ëŠx2S‚)äÊzÊ†§Ÿ©Õõ4µÏ\0¿©èh3ªôQ©ÂÔóL<‘¢We–+l¥Á”ÄÙqrû¢'©ÕPP~9Üá•.-Z!N¹äêE“yÔ@h0Œ¢q¼@p9NÆ“a”Îe9ˆã©ÀÈ0Xè4\r/Èè0ŒOªöä”Î›¼İ(%º\0Q°ª±N²!ÎŠ6‚	Ğ¢€'Pº\n†‘îî5*\n`·9ÊzŒ;­{¨€Šbê»¥D5Ä‘—;h&†¦\r¢³(%\"(@;sªİ®±<GCğ¦ô#pÎ©µ0Â–È­jbV±»†îÄò¦Ò¨1ä–£»¥€*Ã[Ú;Á\0Ê9Cxä½ˆ0oXÈ7¿`Ş:\$OèáAR…9ôÉ¶²£zSE-« <ª7Ó3S\"l:ğ†Îº°€N‹s	+Ä²Ë©\$¯\nV†¶‘äràÓÅ\r9mûf®Sz¯9V‹œ;i0hj¸ïqüÖ¹qäÜÆNªé-EDYY–sº¸)ò\n ©³«ƒSwE¨å’ª›¯n®iú!p6HÜ;#`Ò2\$SûÔ9@1C(È2Ã Ó‚tâ« nj©®L«pØ•½V·ÍŠæªŞ¥=ç[*å\n¦Àî42ä¹e*µ—Ièni›GÎ\$SòZ\"SBYågT9záRüß!.£¥êuPS50qr/ÀöA l¦ĞµŒ40N*rš›!7’.˜ çQê™0M,u^Ø‰–‰ ëks¯½7vA\0²­®Ë–Úhö âhñ*ƒ%­Ñ¤|q_8Şák”É%jub7D=Õ£é\$ıµè•<”Ù®‰ÁySºP.qö¬†®\rOH˜…m5áL¹÷œA£^Ö%]êº¿ƒU/ş/k¾ù>_wŞ¦~MÉzS3‘P \rl2\$	Ğš&‡B˜¦pÚcWô5ªŸféÓ‰àvY©…>N+¹ˆRî~Xs§­W°å^CÂ\rÁÌ4†ø6§™nFÊ‰7Àè€Qä<Á…ˆ°ĞÌ˜0n¬i{”Ö­™›Æ ¹‘àô2lY/£Ü|‘ô>ÌH÷©CòTr`¡°7‡v\$^Ñùl0Üà¦DÎöÈ	\0‡¢}è3ÇÊp9Š.\nµx¢Bğ—±İÄ4‰¬AnøŸ!pXÀ°–ÀRrÏ¡Ñt€éÁ«°TBaŠX9©…4ŸƒÀp\r,EM‚\0xO;Àô€è€s@¼‡yLƒd\r©u?‚åÁ{–0eŠAÈ<ÁxÁ\$6‡êX t€¼0ƒè&\rì ıÌ€ÂÏXiR©ü6†dÅa¢Ä‹&òİŠª§r¡\n›A}Z\\uN(ŒÊ@ĞzÃCƒ©ô;Ÿ@Øë	ü3()€Âf‘JD1†3ğÃ0uñP3¥ĞA=Púäˆ0Ì%&\rŒeÇ7UÈ§J	U7ë°‰;Ø_¨ê'\n (MÈ)›ËG-J•!RR±|Ûáå1ÓºËYz;gqâ59Û;álP“ÍKP`ACÑ\rÁÀ:©U.¦C“è1†‰C<Ÿ\n‰†0ÂTJœ,*ÌSˆ‚¶S\nA†›óxêKQL³u®*“¿ãó&Eäæ–âùëYC¤Şêe^Ú;‚(\$ÚšGôKÜÁ[+¥}-µ©5kvmqéÊßŞÜg<F ç´Gl²Å2t4(pÇ©M¸¦3%k…pßl9R	\$„<P@<Qa!ºf CòÄCˆu?\n@3(Úª•Œ2¨§ĞÇMŠ\nXû©Å¸†{K(à\0Â¡\r½gu—«»ä\\ê\r¦¨|®›\"5iÍİ¬o.bÛª\"[;5d‘­+*·*UÌÌkVØ³•{{€Ì*aóXØ©*A˜U€0¢\0f‰@€ùÉ€Œ)lÖa¦^©JŸu.³	L-N4køÒ’YŠI¥7·ÕŒ™\\\r (ñš=>exÒİa^y«´çÅª,Fœ¶ÆZFR²s«ÇùMœd6ˆÆÈ£^J.ÀŞ8ví2VRUOLÊ;úıo²†cEYÆ!w–ãÓQsÇÂš™Ûåj¡ü'\r€®ï†ÆØj}“6](2&XiÁç—°ŠÃmhRæ§§Ğª0-	ø7=2—‹ŞvkYàª³ ö³@§kÔöA/ãBo)}DTS›/g<œõk©AšØ_ëƒ•®ŞŒ×ò ì,á—VLÌ£'åüò\\\\¦ÔÎk.46çhoÛH'ÒLé·löK¶¸\\#ö8s+âùA›ŞÁÛªŠTÕç_Ö;½éÆÒé{³¶XSfå¹Î^ıF6‚‰’¯g+dëijÖ7[ù\ne`oÄµA(¥¹©K©}Š{rÒJ\r…Göb’ÇmìUíâD5ìÀè´ÔæÌÙ-wkM­\0PS§Ö!±-Ş™Ôó„TÅ\\ªí:øë™¶¾0Û©ííà·;ÿáï¥¾¶û×UW_Gû3}æ";break;case"bs":$g="D0ˆ\r†‘Ìèe‚šLçS‘¸Ò?	EÃ34S6MÆ¨AÂt7ÁÍpˆtp@u9œ¦Ãx¸N0šÆV\"d7Æódpİ™ÀØˆÓLüAH¡a)Ì….€RL¦¸	ºp7Áæ£L¸X\nFC1 Ôl7AG‘„ôn7‚ç(UÂlŒ§¡ĞÂb•˜eÄ“Ñ´Ó>4‚Š¦Ó)Òy½ˆFYÁÛ\n,›Î¢A†f ¸-†“±¤Øe3™NwÓ|œáH„\r]øÅ§—Ì43®XÕİ£w³ÏA!“D‰–6eào7ÜY>9‚àqÃ\$ÑĞİiMÆpVÅtb¨q\$«Ù¤Ö\n%Üö‡LITÜk¸ÍÂ)Èä¹ªúş0hèŞÕ4	\n\n:\nÀä:4P æ;®c\"\\&§ƒHÚ\ro’4 á¸xÈĞ@‹ó,ª\nl©E‰šjÑ+)¸—\nŠšøCÈr†5 ¢°Ò¯/û~¨°Ú;.ˆã¼®Èjâ&²f)|0B8Ê7±ƒ¤›,	#s,Äğ(ä™Q,Ò1²nèÜú.ãš\\*²f!\"Ò81âè9ÇÄl:âÉâbr¢ª€P¡/²ÀP¨¶J3F53ÒÀœ7²È,UB„±8Ä˜€M2ScRıOSTå),#ÀR¬¨\\uxb—PìjÚ3ËLÖŒã\"8Å\ric(.nbc,­¨pÇ,#XÆÃÌÒşş±\"(ØFJü	ã\"_%ƒµº%ƒÓb=+º¸ˆÄğpë%vÂ±m)jº²Œ¯ÁuIWzxÛ%B9³jÃ´Œ·Õ?w^¾¤Ø5ğ–C˜Ão	@t&‰¡Ğ¦)C\$,6¡p¶<åÈºÁÚLé)	\"6‹ûOµk›øŸ¶èB›5gàğƒÃ˜Ò7è©p˜ùºd¼Ì3A\0ÂÉÄ£0ÌªÍËû4[•õ\"zB¬1¾XÑ.+NÔİ«˜èÕ¶L »¥ƒ»(—1IHÊô¨Ñ5 Ë%Â°Ãt ­U¡!e‚0…›E Òàw²àÂñKûpœ+¡LÛlˆĞÉŒÁèD4ƒ à9‡Ax^;öv.Ã*Ã\\¹Œá{İhnv¤áš	#hàÓ±“xxŒ!öƒ.6Î6Œ)‹%C—¨«Mğºç„D£hŞ…¦±¬ƒ“Ò5³v—£#‘ÀĞ„;&ıí0ÙP*ïèÌ\\Ìb'!˜ƒ¦–Ãªa˜:¿²XÊ( &È¾¿2\nL` M†Pç'\0ØœŒ|'!ê©#e#Ò}©+àĞ€H\n \$XIP1A„iù×jÈ	)~®\$ı›(ˆ«ØBHP9\"pîlÃ/0ÁÔ?È*BY(a\$¼2™d¬wˆ C\naH#!ÄL¶:÷„á‘9%(k_ûÚªĞÉ½CÒsœ@ z­£=@ØC•F†„èˆ^V	é‚`¡³zw”ã>„\$Š‡–£9pB7\"sdÜL˜q¦©cş†Âdv^#°ÆK,n!À0š˜éIYî @'…0¨Ì!²ØCµ‘â\nöÊâ!}Øâ4hŒ‰²¢!	25—\rƒpf!D1ú¿r:çŠ™ô3è¹¨µ–~Ğa,bíIP @ÂˆLi›šR‚¤3#H\r ä ˆ'œ§p©œş›•.@I0iGš“úg‘e	0°œçĞâ/AÚ	&ˆQŞ‹)ó¨‹ôJÄ1Ï£¾èûÖ`J‘—E’ÂiB— „™Á‹êH²X CKÁ°¬ÜŠÔ;“Y>êutsAÓ€ÚJ€8§ì*…@ŒAÃ;h˜¢†r\\§Óly‘ñ|70¤N›b	›¬bøçRzÀe=b&u‘ŠêœøÌÜÆ¡KN:—Õ¦©å0¤øèùhGƒPu&§AnÍcQè¡‰>)ìúTöûH\r'ÆmJM4še*!]1E\r)6ƒyé˜ùB…[HŠ ÅY)a‰MU ØÙ’²í8®Ëtİh¸5ÁD˜BÿNœé¤¦üÂ°ôb®rãVÔÕóÃPèõŒÙ¶0/QEWô°®\"X";break;case"ca":$g="E9j˜€æe3NCğP”\\33AD“iÀŞs9šLFÃ(€Âd5MÇC	È@e6Æ“¡àÊr‰†´Òdš`gƒI¶hp—›L§9¡’Q*–K¤Ì5LŒ œÈS,¦W-—ˆ\rÆù<òe4&\"ÀPÀb2£a¸àr\n1e€£yÈÒg4›Œ&ÀQ:¸h4ˆ\rC„à ’M†¡’Xa‰› ç+âûÀàÄ\\>RñÊLK&ó®ÂvÖÄ±ØÓ3ĞñÃ©Âpt0Y\$lË1\"Pò ƒ„ådøé\$ŒÄš`o9>UÃ^yÅ==äÎ\n)ínÔ+OoŸŠ§M|°õ*›u³¹ºNr9]xé†ƒ{d­ˆ3j‹P(àÿcºê2&\"›: £ƒ:…\0êö\rrh‘(¨ê8‚Œ£ÃpÉ\r#{\$¨j¢¬¤«#Ri*úÂ˜ˆhû´¡B Ò8BDÂƒªJ4²ãhÄÊn{øè°K« !/28,\$£Ã #Œ¯@Ê:.Ì€’7ËÚnƒ%íBLº³l¢Œ‘+ÜZ®bë\$À ç#.ÀP‡Ló´<ÌCpÒ1Î!4#I†Y¼\n3GµjÂ7;C£.Ò¥*„ç£ @1-ÀPÔu,x<ÇŠØ¡xHÖAŒü—° Rh8ÈÃb;\réHØ6\rãÀñ'¬¨'S{ &ejmM#GÒ(å­¯SòêÊS–ÔÀa–T5ŒàB\n0:¢­ÅÒ\$TDU&ˆ³\$âğìÓ´×?Š…D1Ûã-Â2ŒwËC…ÀH§|Òé=í~ÕñD—år\\ÓšJÈ	@t&‰¡Ğ¦)C È£h^-Œ9hÂ.Û8%ä½@Ôš\"F£}cµ#™äØ¨«±:3y¦\"d:¯É£dÀ4m*Jã0ÍÓŒÒ›Îî&\0007S+!?ì#Ø7í›VÖµè@ËQA¢«C|\n½Øƒ¾Ş˜¹ê¿L'”¦\$ÊlZJhƒÑ´¥ô<HäşC#¢ëš:74â9´Ä4½&\"küÜ\$ĞZ1Yªï7Á\0xš\r Ì„C@è:˜t…ã¿t#éµ0˜.£8^íxq3µ£ÁxD¨‡È¤-OS!à^0‡Ùâ„İ\rõ\$šŒ#Z:–R£’}L\$qÂöWˆê†ö!,\nñeB\n6ORäNb ĞŒ8-¸¹¯%!ˆ¾ğÌ]J¢!™Ğ e¬¤ƒ1ŠQA¼¼hnŒCû Á„¡&ÖŞ¦SŠ¾|Æ´e¤ñ‚3&Ã?dFÑ^:Ü ¡@\$ÜY° D jE”1¾&/è—½ò\náĞXc{çØİD´€‚c¤TAÜÀ0ĞMK»²Tfæ\rT(oÑèo{ÇØ!…0¤2d hu\0¨äÉ¢3aä˜£ÀwÄb’:a„xŒ,ÀQÊÚJ2„Ô“×ìaHª-	Œ1™E>Ia1	\$D<šH|¨\"h\rÏhİ‚(úH	*?!´ÈïŠÌM>ÁbótİY±i&ÈœhfÂ˜T Ê<ûâ0M;2N¤)6ğêr¡|µ6Ep¼È× HÉ¢‹1Îö&YŠ‰Y	që\\YÉ¡%Œ)ö6«‘åF]Á\0S\n!0¤4ø0T†Ê]QÖâq(f”i 9&¨ôf“Ù¬'¯ú)Ù?ã‹W¨yĞR9A×Áš:d¼’PĞOA”ÉQ¡Õì†’VaP*¨£•…0É{GhûTT¹Œl‰ i€6¹X¡ç51L«Ğ•ÛJ9%«—6Òj…, €*…@ŒAÃ`9´Q¹ì]hªş“Ä!¦ILöªè&•U³?W“›Î\"äeu´ÌÉ*Š&†\$Å€ ›JË%oÇi7©©ŠbÙšMmæ<õ!Ä<¢¨¸nXa„aŠtó`æãá£†:”’`Ã(-;?DÈ7ÎZ ÍºÏ³µPï…·IÃqñ…¹u}VÓÛN?‰5Têºe:¢¶Æ5:Á[z~X‹t\"¸Ê°˜ˆ­ÇVáÈÂ³YlÃ”Q²®ˆğ*ğ‚3mI ";break;case"cs":$g="O8Œ'c!Ô~\n‹†faÌN2œ\ræC2i6á¦Q¸Âh90Ô'Hi¼êb7œ…À¢i„ği6È†æ´A;Í†Y¢„@v2›\r&³yÎHs“JGQª8%9¥e:L¦:e2ËèÇZt¬@\nFC1 Ôl7APèÉ4TÚØªùÍ¾j\nb¯dWeH€èa1M†³Ì¬«šN€¢´eŠ¾Å^/Jà‚-{ÂJâpßlPÌDÜÒle2bçcèu:F¯ø×\rÈbÊ»ŒP€Ã77šàLDn¯[?j1F¤»7ã÷»ó¶òI61T7r©¬Ù{‘FÁE3i„õ­¼Ç“^0òbbâ©îp@c4{Ì2²&·\0¶£ƒr\"‰¢JZœ\r(æŒ¥b€ä¢¦£k€:ºCPè)Ëz˜=\n Ü1µc(Ö*\nšª99*Ó^®¯ÀÊ:4ƒĞÆ2¹î“Yƒ˜Öa¯£ ò8 QˆF&°XÂ?­|\$ß¸ƒ\n!\r)èäÓ<i©ŠRB8Ê7±xä4Æˆ€à65©¡zJQ%	º,4#´ãi¨@a—H¤X\"µ-ˆå²º‚	R2\n|â‘mèç\n“HÂï¯£…ï”.Òx»‰Í[Â‰7\\Œ\0Ä0ÂÀMISUõURÔğ²æ#pŞ@@PHÁ i^†/tâÔ=XÉ'CHì	ö;àô\nc*,0Ï P˜˜2\"×½Ã€æô¡kÊŒY–8æšÌ‘Å‹5kHÅÑ\$ÍĞ7¿7-ôCÈØ\"t2D7D•(Ëq(À\\ß#`ó~\\ÔÀİ…ÕxÇ…`øJ5~Áwú5ˆàˆÂæ•Âæ!B	Ğš&‡B˜¦pÚc–d9¶í¾ë¿ÀP´0ÔL|/j¼Úœ'Yü=;R±3M¦Ê†…j˜Êú#l‚6“ø”£3Ã0Ì¡@Z”Ò2ÏömPÑ·„Ş‰\rTñBÓC©¼¾;#(ÎãLĞ”\n:.p”¸h‰İm²åj„íml4#HÖ:kù7\"û=4Ó\0õÇë‹ò4ú5pÛU²‹`Û7Ğ4ñUéÆ¸<‡%ÆÒé.šó<ß!Ÿ¶<Õl;tXÓGØ?UÃu‰÷]Æ8çgÊNÇnV÷<çyÏ÷şIâ%{7¤Pé›Ş14“Š4;8»)ÇêC7à´~9SS'3Kr³“:üW9Z„ÀA«¥[d™\r5yˆ%#÷æıOØ †üPÌAhÑo ^Ã¼!ËQÒ \"TJC8/aÌ•”.Ÿxnàˆ¨à’SeK¡¹¡pxÃ>q(¼‰”Â æLLf´Œ¢ŒLƒ+í†/‰wRàâ\\‚vC^’G¦ÅI+[HÍSUøŠÇ#Ç;‹ æ\r!Ú.\réÚ©—ÀÜy\rBá©¼†— œH¨¡NˆF?'„ôIYy/q]£´‘Z»¡n¢šğáÌ|‹GhàD\nŞ\"áø@\$\0A#NÜimÀ\0RƒPxbRˆH6—3G\"Ü]s2Ü¦‘ÇĞyÈ¤sA\n%ĞôÙÙ\"0.9àÖO\0C\naH#à@³V¡'lü3Ú`°™wÎ„•°—(ˆyÄš”—™Âf¢úf8ª/¢k5‚Óò;Lü€¡şĞk±T¡©ÎÂ÷zDŒzÔ hˆ«‘\$ŒP¤àA–d9’şˆÍ{½(Ä…·¸÷4@×bp‹Éä8‚€`ÏP	áL*(_çÄ;SLş—›ôØççÓûq…¼7šô:ü0iáÔáˆÙ&C’\"‹)ˆ5PQÚg\naD&RNU¥¨¯–ìüE=ChoN¤Ø#ILoÉƒ{8Ä‘æLtĞš²ˆ'GD_*%L¾øs<¡éÌ¡\\Ì}vUàß³^¤ÃHzmÄz€ªÂÓ¬d'æàL™ÌjÊ¢4ŒU×ÁBÕ{_L.Ì,£FiX‚¥³Ö€ÂÚ\"2¿­¦³lnÕÒ=VIXCk!°â‡iêá¿TÔâG3a›\$›?ÍŸ‡¨ªŒR&ªè¢o¿åM	#èGbÎJeş‚¨TÀ´NUô+I)67y·¼+WmØ­£½âõX»Ræ­³Uµ¬ZùÖ«Ø­¯uù·(‰DßkãËò[ÇÙ˜'Î®y‘QånKšC‹úõ¦!º°–G.u›4…ù;Úv­‘òB¬ü‰ª\$9†È3D~3ƒ³*is9	ØĞ‘^ÃÄÚÊÿTE¬¢“²ì+@PC(36ïÔjT¯©c†µ^e—“ë9_*µfÚ¤ê.\0(%‘—~¸Ã{Pß5`ò°é~9/ç#ÒB~\0PT09#ŒQ0f˜K3äÕ£z]Å\rÆ";break;case"da":$g="E9‡QÌÒk5™NCğP”\\33AAD³©¸ÜeAá\"©ÀØo0™#cI°\\\n&˜MpciÔÚ :IM’¤Js:0×#‘”ØsŒB„S™\nNF’™MÂ,¬Ó8…P£FY8€0Œ†cA¨Øn8‚†óh(Şr4™Í&ã	°I7éS	Š|l…IÊFS%¦o7l51Ór¥œ°‹È(‰6˜n7ˆôé13š/”)‰°@a:0˜ì\n•º]—ƒtœe²ëåæó8€Íg:`ğ¢	íöåh¸‚¶B\r¤gºĞ›°•ÀÛ)Ş0Å3Ëh\n!¦pQTÜk7Îô¸WXå'\"h.¦Şe9ˆ<:œtá¸=‡3½œÈ“».Ø@;)CbÒœ)ŠXÂˆ¤bDŸ¡MBˆ£©*ZHÀ¾	8¦:'«ˆÊì;Møè<øœ—9ã“Ğ\rî#j˜ŒÂÖÂEBpÊ:Ñ Öæ¬‘ºĞÀËhÒ2 ¨T€¬á\0ÆŞ©IŠÚ9¯Kâüà;~¶Ãr&7¤Oğ&8«\\b(!LŠ.74(úÕ-	ÃËBØ\"èlˆ1MÃ(Îs¨æ\rC‹@PHá hˆ)§NàĞ;,ãšÈÍ'ì0Œ5B4[p¿‰ƒHÚ4°ÂC\$2@Î¬Â\ràŠ²)(#Sğ©P'ÀP¬¾\r Ìé©QŒğ¦U¬ò€Àtï\"6\no\"Ø‰8Ü:B@	¢ht)Š`PÈ¥âÙ†RÛ÷	J.ÖÕCj2=Lrº¯\nã\$©Wb0¢8ˆ\rè2	¨Üƒ\r÷ÚONªPÙBÈŞ‚-(Ş3Õ*©EÈÔãŠ:Æ\"ú‹ŒiŠâ˜E®¨Ò;)+”ˆûMÊ2ø¾lûVñ/‰<¾âÁpî<±–. 9ß“:˜€âƒbt»4!hA06° İğDÄŒ±	:S€…£\\¸2¿Ñ¾vT™ünàÂ\r	èÌ„CC.8aĞ^ûh\\Óè»Î³Œáz•»_*Vr„J |\$¨óa&¡Aà^0‡ĞH@ç¬im\$ŞºĞ:tÒ¤MJ9LÒl4øg(+ìücZÛÆˆÀçŸº³:“ŠŒÓ?Œ7è@;¦Aìü¡\\“Ÿ\"AiªúŒc@3¬ôÔµöõ\0Ğ˜vC˜ÂçÉRdĞ4Éé:àÄk 0ëcÇ\"©äœ'L»6\n@ âò|  !Bˆêìï,SCÚFìJ‹'3äı<cŒôÁkÕÍ³ú’ w\r¤1¼õ>fM»È1†êP	8Uáä6ãBÂ˜RÀ´±’–ĞxnLK\r\";â”Ó‰Q,%Æ}4:pÌOƒ¢X5½#ºT˜ĞM¸h¨š&[Èˆy`ä	!Ÿ Ş}ëĞ)æğ2‡ê|\rf:Ä¼ †FâgÑKd|öÁ¸¶~‹”8%o°'…0¨@SWˆ„*#µŠÙxÄ6š0ÎHQ]Ñ¯—r„£H)9'dõ°Ò»šŠı\$œ:«b¿a¹ ˜¥‘Ò>HJ	K'	\$)…˜Pj{\0€#@ ‹ˆËSn`¹Æ&¾ı<¡¡´‹¦÷†t‰«6˜s=	TfTÄ«İá¹DÄIÕúp#Áo²\0äBV*ÇX\rÈüÍĞÓ7ÚØ\nhp6°Öƒ\\å®)Šh!%Ü‘Ÿ4&Œ2KÃZ«Ğ©tÆzzšY.B F°2†s¾—Xg›	Å\ncÕÔó\$xMnqQS@J”ºd³@“„³\$Fh¼õU\$bF£X††4ˆ|3ÙH€Q{&r}¹\0£z”Ñ§æüªYã>\\¤üŸÄXŒPRúöŒ>ÇÅ‘‰Ÿ‹ƒYªgA!¡ò`‰ªÑ'Ä`ŸVhºr7†,„ÑÚØ_Â±mæ%‘ô´I]-ô‰á(¹!UÈÉ©‘È¨*Uj¥B*";break;case"de":$g="S4›Œ‚”@s4˜ÍSü%ÌĞpQ ß\n6L†Sp€ìo‘'C)¤@f2š\r†s)Î0a–…À¢i„ği6˜M‚ddêb’\$RCIœäÃ[0ÓğcIÌè œÈS:–y7§a”ót\$Ğt™ˆCˆÈf4†ãÈ(Øe†‰ç*,t\n%ÉMĞb¡„Äe6[æ@¢”Âr¿šd†àQfa¯&7‹Ôªn9°Ô‡CÑ–g/ÑÁ¯* )aRA`€êm+G;æ=DYĞë:¦ÖQÌùÂK\n†c\n|j÷']ä²C‚ÿ‡ÄâÁ\\¾<,å:ô\rÙ¨U;IzÈd£¾g#‡7%ÿ_,äaäa#‡\\ç„Î\n£pÖ7\rãº:†Cxäª\$kğÂÚ6#zZ@Šxæ:„§xæ;ÁC\"f!1J*£nªªÅ.2:¨ºÏÛ8âQZ®¦,…\$	˜´î£0èí0£søÎHØÌ€ÇKäZõ‹C\nTõ¨m{ÇìS€³C'¬ã¤9\r`P2ãlÂº°\0Ü3²#dr– ˆ`ì†|R#tÔ6#ah’7ĞRs¤ ŠÙSõ#Frğ¡Dè	ƒxÎ€T˜çÃh;Úï1“\0ë<2ãšF=!è„<¤€HKWV	h5 R÷N°\\•øbí®C¿ŠĞÄ¢¾“’õ®c\"öÆ0ª28ÜÍàP‚Ş)j‘´ŒêŠÒ#ì`Š¦£HØ\nÖó\n:8c0Ím\rÃC57Í¢Ä—\rKLÆVaÏt§kòY~_Ëdàc\rÔ9·c…a)˜Õ0T¸\$Bhš\nb˜°\r¡p¶5eP»o±mØë³R›\")«òŞ¨bRx7fÈ4aF(ğÅ¡	\0æ™‰‘Ã×9KÍè\r÷•’½³ó²ã}OèÛ!¤ØÇÍá íu©b\rRØ‚›\n\rêzt6@£,DMÖÎÀ Èe\n•î…3MÁh¬†Bî@\\D’\r²öZÒ4š¨ bjş Ğ\" )ÈØ;Ê<­fûğßÀ\rü4€ğÜEŠ…ñ|jƒÈrN;ÊíÑ3Íå¼ğÑĞOÉÒg¬0#ü[ı¬¯3ìU°3c ÃSº¸3ë¥s[eñŞböş7s÷“\$X‚jóAm=PRÁqˆ¥‰÷»Å‡ƒCx‡¡¾€s@¼‡xˆĞm \$0  ÎÈØ/hMn†à^Šˆ>	!´8ôÔ|N€¼0ƒâVŒ(F50†„ôMjVBg9•¦SÍÈ '+™ ¨SŒ‹Ó\$æDê…\0hS%­ÌC¦^Ä\râ9ooÄÚfY»kğTè®¢v_Û#ª†­Øİ†c¨AÖ(c‰a˜:“¶èá\"ètxqÈƒ*¤ÔÃkHä4s)Ør:F(†ãH@JssGQü½›ğxaøt2&q–ÄhdÓ«à‚‚¢\n_‘N#È(Ñ\$iœ¡7jˆüÂ;n‘©õ*@Ãºısğ(3•ôbØ¢ÈczæĞ™„0¦‚0 \n½œôà/‘Ev¨”ƒ\"”4m0ïY–¬÷È_˜@c_åR’nèa>(>‡¤¤NÓØF|çUù™ş—átqÄÉÆMFpó°¶!f+‘Çw\n&²O¡˜û§Bºjå!’³ªÁÈá)æˆ¿½âF\nÑJr” Ùh•!	˜P	áL*Ó.AÈ	‡%7”§j^Pz„4jÂ€QÊIKO)í;‡\"ŒR)ß„óTÒPWâŒº{	d%†pê}ÔAƒ4¬¤å¦ñ54¤D(„Ê\\¸	44*BEÉQ4‡„½j½(Í„JUùAÄ7NĞcDUgF«‘°@ıJBü,°*£9aMa«İØµRªÑ€w°­ô€’ÃÒì[*X4šh¾šÚ‹÷A\rxÀVÖLâäØS±&‘B©Ä’?3C-Z\"rŸT*`Z\r*zGD½6eì}š²5õ¶#’¶é.zà3iÙµu+ı×[L¼;ÎùuKêÈfä •1:âdÆ„”Ç|NˆLC \n5\$f¬³®b-ÂHô¦Ö’€­šV¶ØB\"ŠJÄ-Ù-&p°4\"«´ËZSÈíÉ¢ÜÆ	\"f%¡„6BXŠèsU¥\níXàôÂñcD»†vñ‡2XÙŠrM¶ÁD®`ñuiØ\nƒyÉœ§g+¦Q¶0@*ô˜ßc.Ù›ÆŒ‚\0";break;case"el":$g="ÎJ³•ìô=ÎZˆ &rÍœ¿g¡Yè{=;	EÃ30€æ\ng\$YËH‹9zÎX³—Åˆ‚UƒJèfz2'g¢akx´¹c7CÂ!‘(º@¤‡Ë¥jØk9s˜¯åËVz8ŠUYzÖMI—Ó!ÕåÄU> P•ñT-N'”®DS™\nŒÎ¤T¦H}½k½-(KØTJ¬¬´×—4j0Àb2£a¸às ]`æ ª¬Şt„šÎ0ĞùsOj¶ùC;3TA]Òººòúa‡OĞrÉŸ»”¬ç4Õv—OÙáx­B¶-wJ`åÜëôÆ#§kµ°4L¾[_–Ö\"µh‡“²®åõ­-2_É¡Uk]Ã´±»¤u*»´ª\"MÙn?O3úÿ¢)Ú\\Ì®(R\nB«î¢„\\¥\n›hg6Ê£p™7kZ~A@ÙµğLµ«”&…¸.WBÊÙ®«ê\"@IµŠ¢¤1H˜@&tg:0¤ZŠ'ä1œâ™ÑÁvg‘Êƒ€ÎíCÑB¨Ü5Ãxî7(ä9\rã’Œ\"# Â1#˜ÊƒxÊ9„èè£€á2Îã„Ú9ó(È»”Û[Òy…J¨¢xİÂ‰[Ê‡»+ú ƒºé\\Œ´FOz®³¦\n²¼]&,Cvæ,ë¢î¼­âü¡°­[WBk¹4µF‰9~£™älD¹/²µ/!D(¤(²ÒH@K«­Câ•–êü=A²ƒPX¤¢J”°P¥HF[(eHĞBÜš˜;©\\tÔCÀP’7ÃØ4ŒˆôÄ;LAÊcÊ2£pè4ŞC›eÃ-Csa½×Nò\\Ó\"’ºc!“Nº×48qG^«ì©,Äâ¸“Ò2]‘¹\na’¦r˜ï«Ès…\$&rZ3zŒCÈè2!.yŸNiì\\³‰²ƒ¤¨^zxc<qm%âéÛ8«%%ê£^Ä2RR«:ÒğÖ¶Ğ¦½Ú2mc4ˆ#…BiCzÕÂ…İ)B(Z6Œ#HÙÆI1™;É?\$öŠV¥¼\"*‚¾Nu¡L;ÿ6S™}KËávƒzŒ¼×Îä|şõGµ¥êŒœJ2B@T™ÅHtg}Çnè’‰¢[…éyx‹j½ã‹»º­¼ñóÔì+ÌŸÄ.\0Pˆ4sXÙ7®—Ğå0Ş×¹:_~èÊ<gãpæ4ÿRïÜ |¢a\rƒ äWbşN½FN	±Ê ¬´“²\"vs×\nF;OLß“äˆ„eÌb7Úƒ(c`a¸3‚\0èÁ\0pA¤;8 Ê×ü!O‰Ñì'PŞ×lKËıƒµÂ¾bÂzÌŸCvğh‹éj5ElŠAdˆÛ©°AÌ‚²ô„Ea.zGi”ªgmšèÎˆ8„4èåŠÔ\0tD\0ÕÅ˜pêáÑL\$ñ)Öª®¹\"\n–9QÉÄrË\"QP€Bˆ(¢v‰™Š«ëÅ‚¿Î\\^%Íê0qX~OÙPqB\$äó×R1è\$ ¡âî%â\\“z+±\n¸ˆĞ†bŒeZçİD¥	CâB–SºCyHD9C\$¸½1•|Ü‚ c'u­óàa¡`zƒ@tÀ9ƒ ^Ã¼ÙÁ„2ĞÓ2eà½€ÎGĞÀ_[íàˆºæåÛ¢“>(Q‹)€xÃ>SÂÜ¥8‚Ê|^”Š)ªlğ)ãâaĞ¬‡ÒÌ•2s²¤”!ÍBè¨¸ãêŠKtğCsÈì¸èw?R	<Œ0Ô!Cm?\$”7\$t•(bŒBo0iö&\0îàœàbMáÁ1dÊaHaÌıï‡0êÃsa˜:¹Èdæø ¦áĞ4AêbGƒ\r@_‹ù€0&1 Vä¤•­8ÈUŠbãC‹gV2_Y‰ú&%<å8ŒAÉãpÅquCå@VŠjTÈ¬³…\0\0(.€¦)%pÑìl\n,§9H÷B©‚bMğ¶e4ıRAQª–l7\0êŸSúKÔ;†€Òê¬ŞóDSª¬›Ãa©¸»¤¥HD¢*((†uˆà@Â˜RÀ¹•b“å›!DÑ·±\$1e¸Î¦¬çAeZé!Ğ4ø4SÍeFJä¶*Ó²²¨>eÁÊ\\K”)?I±E»¯=bêªj”!‘Dµ1sÉ•'ç°šĞhz@ëÅÖ®84¨‚\0ƒ7fúb•'µç™™j_éëÓî.æôZÌø\$\nø·¦õä¤SrT(ğ¦.c%ˆDë“Â¨©)0J­°ÁÊT`L¶À%‹Ÿ\" uH:ŞId(¾2ÛàoÙVd²D¬ššEVj;g\$@¾¢©Ş|j”µô‡P¦ô^¯ÔqVL(„Éûe	È ÁRÄJÊ(…pª+7t(±¼ü&{´%&f0É>[™²×g9EÓPbRÑ5ú<¡ip’²9^q«4¾è‘¦ˆFœfº[O¤·» šÁA,¶^³Äü»°‰¯.k×NêÂe¨#³*Õä¡k„…+#˜×¬ß_³(3”*ÏÌ!¿`Ø\nÃóa¯ÏÕ7\\É~G¼r–ŠäÓx§’¿k¡L*²ÁœUy€>tIQ\\j³•z*T“ìèÄDZİdü\n¡P#ĞpQ\"õ9e\\Šc˜nÏF²HN‰Ìp²Eu*üB ë4YK—¢¢ÍUI&OÈ>G¤æ_|è¾‹nÅágIÍÀ0¦‰^á¥1œâòy0å<X‹\0mM¹M7Fğg1HŸeT–êÉx:=A2¤¤×HC](…ÖmÆw÷-é<}yî¾…w2e\"¸»ŠcC™M:'Š„»7JÓ»/¢”Æg^’u™…*iü¡bs°¶.tŒA(ï¦#<ßƒ‰•# å3Å²V¶8ª§á‘iÑâ_7Æ^QÙÃä;ó5n“û¿d!œŞİtZw[ãrË¼â`3ZÕÏExAXÇ½=Nù‹dC5œÈØb¿†}ú/„9œcäŠNkHù¿O¤&_R1\n";break;case"es":$g="Â_‘NgF„@s2™Î§#xü%ÌĞpQ8Ş 2œÄyÌÒb6D“lpät0œ£Á¤Æh4âàQY(6˜Xk¹¶\nx’EÌ’)tÂe	Nd)¤\nˆr—Ìbæè¹–2Í\0¡€Äd3\rFÃqÀän4›¡U@Q¼äi3ÚL&È­V®t2›„‰„ç4&›Ì†“1¤Ç)Lç(N\"-»ŞDËŒMçQ Âv‘U#vó±¦BgŒŞâçSÃx½Ì#WÉĞu”ë@­¾æR <ˆfóqÒÓ¸•prƒqß¼än£3t\"O¿B7›À(§Ÿ´™æ¦É%ËvIÁ›ç ¢©ÏU7ê‡{Ñ”å9Mšó	Šü‘9ÍJ¨: íbMğæ;­Ã\"h(-Á\0ÌÏ­Á`@:¡¸Ü0„\n@6/Ì‚ğê.#R¥)°ÊŠ©8â¬4«	 †0¨pØ*\r(â4¡°«Cœ\$É\\.9¹**a—CkìB0Ê—ÃĞ· P„óHÂ“”Ş¯PÊ:F[*‰#pì¹#\"û4	T\"1±‘«Œ¹³+–·=’\"S#n\$Àÿ§r¨˜7®#s ß%NŠ9PŒª'£*-2³ÍCò¼4ÀAM/˜<£+;¡xHÕAˆ>¹¬0Òa–t3œæ¤HDª›<°Ûv'Q«&<®è‚1Œuj0,³\"§-0\"¬Lˆâ¹âÈ5¶ÅD\"ÌÃKO¶ŠX¼´±¢gNÍW(ÂÓ#WEÅ¦ƒ§FB@	¢ht)Š`PÈ2ãhÚ‹c0‹ P­7 ôßÑQÒçˆ‘ƒú„\nPA¯8ÚEB8ò­£Î#1b kğ6LË6–±˜øÌ3<ƒr²ïM˜»v!¾ÔbT„#Õ¥\rXgCŒµ5MbÓ!.R6·ˆÔ`@ihØ6\rã»”šgš-k	.X”iQA†T¨¢g°ÙKÓ2»˜ÃH0šdäs‚?H@ĞC­\r\"™0òğ•A#œ²€Ó8…Á\0y\r`Ì„C@è:˜t…ã¿LFƒjÒûËpÎ¯=€ñ”D£p^)Ağ’’¤2SŠã}£RPé)Í[p@œiÓ>ÉÎtâ¿C(ÄÉ#)BTÏM7Ÿ³£Q5¢v¨Êh*\r\n&•Ú„»L–zèÛì3-ÒTÔ0ŒÜ\\d##˜ÌIc\\P¯µç†ƒb®C\nJ8IÄî. Øfy8,œ¼¶%\nİCˆyñ\"(*ùHĞP	@ƒ†ôø\0()@¤¤B`Ã™-¾ƒìóˆÓ€A!ç§C€uA),ÚL	{Ë.yO’(~pƒ\n†¡½æ— †ÂF:Ø‚CœåB²‘\r‰œ–‘…ÂoÚâ;5äuÂ’Çèƒl\0Om¼\"‡ˆx`Írm„â¦”hòÉù\$ƒdˆÃ’XØ‹Ïbåü!TŞŒQwÆÁ\0 ’DÃË3\r`7 BsM‹W1ÅH4\$Ch [N©¨~Ü£LN6Dl0š„Â˜TC§ñÂ“’<º‹…\rÊ¥¦èŒ:B'è1òZd™\"DuÉ¤óòŠ0¤)F,–Œñ	¡š3†½Æ¹Ğãİà€)…˜Ùâé*BI†Hä1'\$h3J„Ö“i4RˆÁKµzº¨	 „1å˜#a¨@\n fX7±âÒu‰D_!ëµŞÂ.ş&µ]„­rÑèr©\nôUé€6°Æy%LÔ2’ÄÎ×a)EÇ,”µÂhšƒËCø–@B F â33Z‰¢2”,‹’HOéS¢Z|Ñ’:My©GD}‚B²¬hC†Ñ*˜ƒË#0ñXÅª–‘ÉDÊˆ6Ğã\naÍØU8ÔÀ‘SXÍ^P…0sy± •dÃ*hbj&½Ú¾”¯¬Ô×‹0Ñ¡áA@‚¨Tª’A¢Df\0Uã„zƒ!mÔnÈ)RVhU[g•œ¼E^×ñ5œóÕÓÅ€—m¹xÃæ6Ë‚¥ÏµvÙ&\0";break;case"et":$g="K0œÄóa”È 5šMÆC)°~\n‹†faÌF0šM†‘\ry9›&!¤Û\n2ˆIIÙ†µ“cf±p(ša5œæ3#t¤ÍœÎ§S‘Ö%9¦±ˆÔpË‚šN‡S\$ÔX\nFC1 Ôl7AGHñ Ò\n7œ&xTŒØ\n*LPÚ| ¨Ôê³jÂ\n)šNfS™Òÿ9àÍf\\U}:¤“RÉ¼ê 4NÒ“q¾Uj;FŒ¦| €é:œ/ÇIIÒÍÃ ³RœË7…Ãí°˜a¨Ã½a©˜±¶†t“áp­Æ÷Aßš¸'#<{ËĞ›Œà¢]§†îa½È	×ÀU7ó§sp€Êr9Zf¤CÆ)2ô¹Ó¤WR•Oèà€cºÒ½Š	êö±jx²¿©Ò2¡nóv)\nZ€Ş£~2§,X÷#j*D(Ò2<pÂß,…â<1E`Pœ:£Ô  Îâ†88#(ìç!jD0´`P„¶Œ#+%ãÖ	èéJAH#Œ£xÚñ‹Rş\$Ì’6ƒ°c“69 s`Æ9 Ğ è4¦Cšj) ÉÃO' s|7\$Ë<ø €P˜7­ˆ«ÁBS‚Ş:È<¾†¡”3ß¡#Ô2¢<<©!-<ŒÎ`PòÂLèÁpHUÁˆ'‰ĞÉ\r,–B(Ê6¦Kó\0´ÄkP(\r#Hä¿Å\r ì£GÌ•z¥nP—#!£¥2¦TÊÎ›Ê4zÚ¤ÊI]*ˆE”5¡Ô0½Èò=	@t&‰¡Ğ¦)J¨ÚcÎ<‹²zFŞ1ƒ\$¿ˆ”»d”©kÜ7.H,0-8»Ü<5ƒrt7ãÉ¨™F£dÂ2¬¼š”ã0Ì§­£ß5ĞÔB8—ƒc|yz1ÎnÓLÏ\rDÒ ğj0Aø&C`Ş; É¬àçI–lë%)xÜ°ª6dÄ#~@½²@ÏªbU=º’ØÒ\nv'LHÊš¦ì+ß·±2Âì<VªøÑ8ÁèD4ƒ à9‡Ax^;órI®ArÒ3…ğ§CB˜øÜ„J@|\$£‚/Ã xŒ!ö5/µÃzÓ¸©ÂR©%O}€ö;?E~4’ }{Ÿ¾ª¤O\\êÊöèĞØ.~ä3-2ú0ŒÍdØ¡c9ŒÃ¯·¹!A²×4Ş æ0Ëáß8ö3 Ø•éP)åè¼”(ñ€fh¶,„\r4êéèp „BhU¿T¨RKÓ=îüğæ€ßSL=¦¹ß†ààyœ@ïÈ³0ĞqK[{†µê0Â¸ oF‹\0©‚\0†ÂFmÈ6 ²TÑQ†nÙğ·PêİÛá8'K\0Ö°oˆcPMDtÁBô	‰§´¡H[¢A\$Š“,	)iæ…¿VšœŒWƒÁ˜ø†Ğ@XQ(M°ö†6¤`ãô\r\ríc„ğ¦k	w¥`C¦ÎFßñı®v4·\0@ÎÉ’m@…°²K‰şÒª8ÀĞĞiƒ\\áĞÊGx|{MKRy†ıp@ÂˆL˜ÑJtè0Tƒ,%¦:ÕˆÓì„KÄV¹Ô|ØL3\\#¢Õ¯›¶Ä‚¬W•S‰¯6§\0Zë¬E³`êbÙ1xRñœ›õØa \"™Sh­w*\"j”!Óòpãœ”S“la¬™·…°\n\\Í8Ğyî¿ª0-L1»¢É«¬@•9®ğ@Z‹ò'.D5›“%OOr³˜‹ÚLƒÈ\n1fd¦e´ÒéƒE‡ªúB—Å¡¦\n‡ ÓÌoêaÈ0LÀ„² Şóii?Ô¿¨rIIÔ0eW!¬Ã¶hI‰×\n‡	“5ÒTİzâEŠŠ—¢³]=	mI+ÒsJË=*@åZ¢¢T­¨x€¢\"áLËxREaÔ\0";break;case"fa":$g="ÙB¶ğÂ™²†6Pí…›aTÛF6í„ø(J.™„0SeØSÄ›aQ\n’ª\$6ÔMa+XÄ!(A²„„¡¢Ètí^.§2•[\"S¶•-…\\J§ƒÒ)Cfh§›!(iª2o	D6›\n¾sRXÄ¨\0Sm`Û˜¬›k6ÚÑ¶µm­›kvÚá¶¹6Ò	¼C!ZáQ˜dJÉŠ°X¬‘+<NCiWÇQ»Mb\"´ÀÄí*Ì5o#™dìv\\¬Â%ZAôüö#—°g+­…¥>m±c‘ùƒ[—ŸPõvræsö\r¦ZUÍÄs³½/ÒêH´r–Âæ%†)˜NÆ“qŸGXU°+)6\r‡*«’<ª7\rcpŞ;Á\0Ê9Cxä ƒè0ŒCæ2„ Ş2a:#c¨à8APàá	c¼2+d\"ı„‚”™%e’_!ŒyÇ!m›‹*¹TÚ¤%BrÙ ©ò„9«jº²„­S&³%hiTå-%¢ªÇ,:É¤%È@¥5ÉQbü<Ì³^‡&	Ù\\ğªˆzĞÉë\" Ã7‰2”ç¡JŠ&Y¹âHÜ;#`Ò2#p8í„P@1C(È2Ã Ó@ÉÓtÏ7‰jFÆê/©l»ê˜±s¹ëºo*LÉÌudÍ\$rzK3 Ä+Q'oÕ>à•éò-B>´ÁT„¶Ua0)=NC°.k´ˆZv˜jÆ?,‘¡eŒÀÆ”ï{–ù ‹L!LÂ *;ú²×,	rë‰ÚBUKQô€“#±¤¤§¦ó~XÆÑqR¦‹L¥=OjÂ[2l²_&Ë\rş…\$ÆÂ•û|¯²[\\†ª	ÄêŸØ–<€dUHâJÉû;Ñ°\$	Ğš&‡B˜¦cÎ„<‹¡hÚ6…£ É|ÍƒY¥oí˜\"\r#œ 6BŠ9@Ãv¯¬Ã4V´2¥ 9#xİJ±OÎ1pC ØØ6I)D«&êê&F;xä´µŠÃ1¶¸\"ÂÒ{PÜ2Œt“Úƒx@8CK×¬ôw'Ã:¬47Ã”ÙÑÊß8Ç-M:ë¸d\n<”»¤dl]ÆÁ¡Xé›ICÎFSI\$¯\$-ì·7NhQW,»TÂaÛÁØ3ı’Œ‘vö-fwõ{à4I+õâ7’Fp˜ÇõİÚ\"U\$ºsŠV\$¹\0¨ÊØ¼iLG±knWÑvíä•w¶X[ó:ipâ¥bvKQ`„Ù˜ƒ °Q[&f.ø¥ \\I\\3åkHìÀÂBÀô€è€s@¼‡xlƒd\r§±‚äÁzˆ-•³¶ÜÁCÌM{#‚JÉ\n™€¼0ƒåA]ò?GMÜàÖ HUª0ŠÉå´h•ˆyXädşÉäS	HÔ“CÌÉRù¢\$LÈ*„(\\lFÜ4†ÀØ3  ÚæƒflÍp9‡PÆĞÀsÁÖCº0Î{\$i¡ÈGâ6dz‹Qª=H©0ØÛò62…EO*¥Î¦ÈR.!	€ë+¸ÜÀ	¡T8lÖº—n@PFiÖ4¬ØíÙ9(¾·¬;}%fÅÇÈü£A„áÍÉ‰Âe=À:¢\$H‰ƒ’„á 4†9IÃ<.‘Rt¨°ÂP™@aL)g ÃZ,òÔóKw…Ht8PbDóÊL™£év¥\$¥”×„Ó+Q&eeÔ˜peüÛƒ	y“Áø‹!^0“İ›ÔpàI!¼:¡UçĞâ\rÊQ¹åCªC™†Ğ@aÔ<k“¥†7F„å+DndårÆ®Ó3R6Œm’Í¢Ò,‰i´ƒÏ^¯Åøœ˜\n¦ÍI#Güq¹LÄ’˜œcÄŒØ1Å\$óv6•Ãè¦+œ¹Œ­Ñ77É ~‹\n=®©(¯€¦Bel&Êî™R“N©xF\n“*Š)«j ˆzÎ\n18\"Ãæ+¯¥\\>ò\0õÏˆ~°Dl[T®®Ó“vu’gÛ¶eíòºj–±ëz®m¹‹E0§RÖRİ®‚ŸºD®\\c”˜©2r;TÔò<'jRmz&\n,: Ø\nê´õ\rj‚gÁ¹Èq3oL™c¤`ª0-É¿Ø·´O,ù‘TP8µ]|kìŒ\r»ÄtŸËªIÕJ=i¤­!+ÃN/¬tyJZñØ…8Tğút3§ÔÌV3x‘ÙÜ?½z•áRÎ%v*ğÁ¶õ[Ñ¯%¢µ%r¯[ÅMõfV”‰ÚuHmä÷ä“ÄĞá´c˜odÔÒbÆÁ‰&‚´çÛ×\na“ÊMkéLLi‰Î\r#÷å‡`ÚÌ!É€U™Ãğ”œ)+4–ÀÊ.“}Î€5hÂ°½ëªcWy7[Eàø‹ñõäKe„\\€";break;case"fi":$g="O6N†³x€ìa9L#ğP”\\33`¢¡¤Êd7œÎ†ó€ÊiƒÍ&Hé°Ã\$:GNaØÊl4›eğp(¦u:œ&è”²`t:DH´b4o‚Aùà”æBšÅbñ˜Üv?Kš…€¡€Äd3\rFÃqÀät<š\rL5 *Xk:œ§+dìÊnd“©°êj0ÍI§ZA¬Âa\r';e²ó K­jI©Nw}“G¤ø\r,Òk2h«©ØÓ@Æ©(vÃ¥²†a¾p1IõÜİˆ*mMÛqzaÇM¸C^ÂmÅÊv†Èî;¾˜cšã„å‡ƒòù¦èğP‘F±¸´ÀK¶u¶Ò¡ÔÜt2Â£sÍ1ÈĞe¨Å£xo}Zö:Œ©êL9Œ-»fôS\\5\réJv)ÁjL0M°ê5nKf©(ÈÚ–3ˆÂ9ÀŒæâ0`İ¼ïKPR2iâĞ<\r8'©å\n\r+Ò9·á\0ÂÏ±vÔ§Nâğ+Dè #Œ£zd:'L@’7 é€È‰.ipä¥Ëãä‹®ê\"X9¦¢(ÈÓéÔ[ÅñŠb4¦ÉdG¼cHäÀ£ ê		cdÈæ<µÃ\\õ>(.âîÄ\n£¬2¡¿P-¥#°ê„´ÀÃM1Xòæ1Èø¡pHÕA\0000Œ SÏÑIc”ğCLL(Ó¾)BÂD™\rÑ¨ÉXŠÉcNê¦ÁhàªN‚bØûÎ,p‚4¾ìHÓ^¨i LpJ‰ZcY†[YèĞÒÓ·S\\6\\‚€<…ÔåÈR\r5Ñh]—sUx_´&£sÕ@	Ğš&‡B˜¦€\\â…ÂØí‹Âèd§î¨@”1ÃÄ\\Ó…Î5Ês^Í¥9\$\\Ö–×:y	Â­İ%Hvpš‰€—Åƒd¨ –3Éƒ¸¨J\n	b]¥<ô[a?ê2#Cà<Øã¢< ¤ME¶ÄgYşÔ#ã³X¬@0#™^/í›4À¡\0Ú¦e£(à¶)ƒs’÷4Yl2é-ƒu=¶\n‘C§KFPR™\"³©Åño´îüË´Pzà¿(\r•ë½ï»ûúpe'ÃÜJ;Åµ<v¬ÑG,XóÊĞÏ_2¤ó=v¥=¶äv½*yÓñ=P*ˆÏFw²T?Ã#[Jj\$û¯z\nƒÏ»ßÄw¬xîeº70Qà9»´îŞ*ñ\n<75)\nbˆÑ( „t4&0ÌA^À9ƒ ^Ã¼Äæ0\\›C8/.ğh<\0Ü†J`/E8DhIH<á„3€Z”ÃzkKˆÈ2š'\rTš…PíÈR!€Ò÷ß	(*)•…2i˜¤T†PŠ,2v‡ƒ™„r§u¾RxdÃa .ï÷DWf÷]K\$wnHïÖşNad§¨õ™5íaôik)õääÒH¢<@(&šwrPÙóida@\$\$aÙ¬pql´àRf›£.N¶dH[¨y/ğÕbDVÊ‡\\ëÉC\$ıàD\$ƒÂ`@¶=ğı§£îLË±<aL)`ZAÏ:E\0¸-&zÁÕ!F‚9¬wÜ]É¨KL¥» \"~P_Ù1\r¥Ô9Í¸’]\rR£4ì\rz\0–ˆÈ;-!x”âjŒálLj¶Ø\\Ş\nM³\0@C\$'G‰ÌÅØ…MX¤ŸHeM3Å·IÁ:@'…0¨YŞ-“‚b,’¤ã8•²IÑHÒrŒáÍàÌC99\$RÎj!Ò2ÓÂ±\"d”Es5B˜Q	0¢•B˜0T\n\0éç¹Zo›!\$†dIn(F¤KÉ‰/%'ä 	öxW‘D'up  bºç@[oÀŠ)PÊÊ‰¬¬U°%†ğĞšŞé tSR²®×Ş½k­wpõéLVêı4\0PCJ°›xäHìë#øœ0Â†l´C•\"é5(èU\n’øBóQš{¢2'ıÖµëj«A®l•Ì¨›üŸôØK&œÄ3Db	aw³\0¢`ê×–ètGÂ˜tŞ‚UÌ8¦	´Pk¶²çUI¹‘d›Õ#\$¦-ş²)ãÉ/YM\0£MVeÉç) ½R'l\r2œKv¬Ç1ÃNh;Õ)—8+QûŠ{\\tP(óób®MÉ±WöÄ¶Ğ\n\$+,û52ˆÕWÂoP (?dÀwĞ„Cg™\0 \$*@è! ¡vP\\9A˜6JÑ wM¡’BC×+\\*…€¸";break;case"fr":$g="ÃE§1iØŞu9ˆfS‘ĞÂi7\n¢‘\0ü%ÌÂ˜(’m8Îg3IˆØeæ™¾IÄcIŒĞi†DÃ‚i6L¦Ä°Ã22@æsY¼2:JeS™\ntL”M&Óƒ‚  ˆPs±†LeCˆÈf4†ãÈ(ìi¤‚¥Æ“<B\n LgSt¢gMæCLÒ7Øj“–?ƒ7Y3™ÔÙ:NŠĞxI¸Na;OB†'„™,f“¤&Bu®›L§K¡†  õØ^ó\rf“Îˆ¦ì­ôç½9¹g!uz¢c7›‘¬Ã'Œíöz\\Î®îÁ‘Éåk§ÚnñóM<ü®ëµÒ3Œ0¾ŒğÜ3» Pªí›\"L«pó»pİ\0§\0Ä×%\nJRìÌš”Â£ƒ¨à¡­c\\˜©ChŞÚªQF2B°Ê:¨	;V:À2º6ì\$*¥£ÂÈ.Êª*êÊ˜®+Ê+´BĞ0˜es\nŠƒÈà¥FŠæ0 MÀ'\rãhÄÊ£¢\$¸”<ÃD^ÊBü4Ì€P¤Î£êìœÂÉ¬IÃ ²À£\"8†5*ê\\…2ªK´4¨ãšta‘/×F£œÏ/1JŒ,ÖÅli5QjÔ¹ ¾éP;uÂÌÊã’†Â»QdÀ:µ#`@ÉŒ›ì:\"ôŞ1 C ×Öv ãH7<A j„ ÎC*l†Zî‹L–D@7˜eËğı?€P¨9+‰ÚXÚE‚\rRBqkUl+¢!¸w@Ê6B\$X)£Sv\nI†T!hK„° o<±ö @İ\$cÎ”'³ã&¯\rØ{&Xt)KbèK²¨ãEN94p¡áƒpÂû‰@t&‰¡Ğ¦)CPÔ£h^-Œ:(Â.°Ê˜˜6¼\rL¬ãöíĞ¡©o¡¦4êº½«Ç±úI!*ïš³î‹F„VåVÎ\r	s^¾0©Ğ§BRb#'°ª+Åï‘íI­£ÃX—Ef¸ 2kë84Êı9Â‹Û\$TÉ—8Ş8E<üÈÖåJlƒêb½Šâ\r[È,“®²2frDî Y5ÎBÜõH„ï{ˆëÒôô·S[¸ei×%=­ÙÁû:tÀ³C*\r8\râìlÌz8N×LÔÆ\nT ÛdíSŒµ‘ÕøÍLí\"âq<SNxÄ“î3eKª'£C*è\"\rğ80tÁxw@¸0†@ÚD	É.à½ôÁD|ú^È/EPğà®EJ»5@ğ†|LIèmOÅ5pÂMÊ&FT7\"P«U{é4(µ£ÆÖÚ«M~¤İ“ †nÖó[;*9ÔzŞÑ¢kG±ƒæ	Æn2¤)/F6j²\$!0¨U1Fœ†\\Á±%èìœ¨.\"Ya,jĞä.ÓŠ‘Oïd„…\0êq\r@‚¨E‰Ï%'Ì†âJrHò¶-hGNkH[Ét	ù)³\\ıXábcaÅ8sqM£m¦ö¤ìıIĞT\rá­ô‚\0†ÂF<ê\0¼€@‹Ÿ\n2z,t7±nVIpm3Ä<Ê¿˜˜¢ÙC(³(6¹ÔH\n|Š†Mú1ù_«NÁÔˆ¼CKä4@Óš“VäßK,!Q ”YIVñIÀ„„“¦(íÈ™ÃtjÎ*Ş5¬\\D1!€O\naPŸ78âl5 gU9ŠÉ?l'¤ıñG˜Ï!;„œê“Õ\0šÑKWvl Òh€\"j«E1ø()Ömçt•ƒá¾“	-F	K+dÀ)…˜ˆŠèF\n’\0óA„`·‘ÂÜqÂ}OÄIÔ'q`TÂw%LqP©ıV5p®¡Õh!Ñ¢cMın¬µÀíBçC]Qrïä1*ßk‹®uÔÅ˜Öş™¡¬Ğé“ªÿc+½eÁ±ÀVĞ,¤|ft®ÇŠ^‚Íº7…64ÇV\"°BJÑMFÄ7µÊã>\"Ûé;m–Ê ª0-A PÎ‡,U€,´†¡¦@Ä®2S[öZ´Õ«›IÔ\$D³¢—.I×|]µDú:€£fC£<Vğ1›6*}Â’û½FE—ÚÅÒ€ÒÓõ5dÉËPE]¬qR˜ÜßbaBIE§¬I80‡&.zÃclBÁ’‡Æ”š“ğpeWl‹\"Â’¤sM”tÎ™ô¹(WMĞn–Èİ¼«*ôT‘ 2‚€æ\nRhl;(<-Óv‰yÑ¾+elÉ£^RŒ9°\\×”&b²;? zör ÎÈ\"^Š‰‰§a*¸G„â)Â>4‘Ç”‰”Ô7“á•Ó?ÆàÿàÀ˜rŒÁĞP7÷èÉpdƒPrá\"Vƒ4É¾p’à";break;case"gl":$g="E9jÌÊg:œãğP”\\33AADãy¸@ÃTˆó™¤Äl2ˆ\r&ØÙÈèa9\râ1¤Æh2šaBàQ<A'6˜XkY¶x‘ÊÌ’l¾c\nNFÓIĞÒd•Æ1\0”æBšM¨³	”¬İh,Ğ@\nFC1 Ôl7AF#‚º\n7œ4uÖ&e7B\rÆƒŞb7˜f„S%6P\n\$› ×£•ÿÃ]EFS™ÔÙ'¨M\"‘c¦r5z;däjQ…0˜Î‡[©¤õ(°Àp°% Â\n#Ê˜ş	Ë‡)ƒA`çY•‡'7T8N6âBiÉR¹°hGcKÀáz&ğQ\nòrÇ“;ùTç*›uó¼Z•\n9M†=Ó’¨4Êøè‚£‚Kæ9ëÈÈš\nÊX0Ğêä¬\nákğÒ²CI†Y²J¨æ¬¥‰r¸¤*Ä4¬‰ †0¨mø¨4£pê†–Ê{Z‰\\.ê\r/ œÌ\rªR8?i:Â\rË~!;	DŠ\nC*†(ß\$ƒ‘†V·ìˆìÚŒPä;)IRR1³jÜ§.±8Æ)«È÷H †ŠÌ0Tª6SøÜ2¶Lx ¥'48Ç6Œh­ĞHÃ|*°¤Læò³HÄ<´ M:Sí(æ# R¾7A j„`¼°¸ÆÇ¢ª¢\rÎãbG*²¢{ŒÀ=3˜ïˆ#ÇD€P¦2¤TŠ¾²¢*rÕIƒ( ³´İ¶2Èé%ˆ£sRÇÔc-®6,70Ó\ráuE4İCU°:¡;#<¤	@t&‰¡Ğ¦)C È£h^-Œ8ˆÂ.ÙÖ…e¢­Ã‡qÔâ\$`0£é\n­7]¹Ad™Å#¨¬ìõ7U;>Ê´i»MHĞêGVYó\\|ÊÑi{pƒ#¹İ\nŠÑÊs›¥cƒPÕ òÒ4¼ì`@Aë òÓõz£·†­9°â¦ç~v\$[\$æ0¨I\n¿K°\n¬Ò¦\rÃ­Æˆ›ß}í±Ìªm9ÔI¶;Û.á³ë²WºÔ{Æõ%è2Œ.°º%˜‹g¹R \\q”h:Ò#®´åh¼>¦”ŒĞ¤\$ØÑî¹Ş)¨AœP(êûviÎÅ—İ•¸ÉÒ\rã¨\\Œ(ĞÍŒÁèD4ƒ à9‡Ax^;ûti¼)Arò3…ìÃ°hÜ„J°|\$¤”Ïã|•	ñSqªDôBt|‚RJYâl¥•m¡×4ÎÑĞeMÔÎrRaª1ÈpšB`Ö’ÓÜÕ.È\01yI)¤0†cJr\"Aa˜Ï‚ÎÄ)¡ ›ÁsŞ’]ºql«¼6'fjˆó,sdLõ¡“TĞTA|®m…\0(o@èÒ\$‚‚¬\nMÉ¼*hÀ“²<H ©03d‰¹”£Ûl5:á¸87£\\‚ĞiÆƒa¡?PÒŞ‚¤\$!Ò«w/Cxkn¡)… ŒÛC±WÆ„.Y+I	Tv„©ÃZşa	K3ÉYÚ„PğìJy…+É!%?R~P\\b·\$ˆıFÔ|‰Áu¸”†ê¦*&&‹=ÆŸeÜlI‚ø7E\$§,¶vÙÎ‰!%a2=ÂRÙf8pQ˜Pá)ËêL’Ñ4'…0¨ÙÉËa!œôL™`–^·’‘!³<Vµ-à§1¦n¦yREIi=K „J°D”¡”RQŠè \naD&8ÉÈx‰¸a'\$ì•Èó\n‚¤P:ò¬“Vã2_¡“5%Aj«æğñNK}ÊlšĞŞcJ-(™Jau6WjdLšcrïÑ‹K€ŞU‰¢é¥k­e&¼•B¦ªn2Ôe¾Ñ’a\r€¬1«àÇCc¢´x”¿´\\sèò(+e•Ä\0âIÕMô¼4”UàíË\0U\nƒ‚šIhl0¤)œ:“^\rTI¯R*Câ¢FQÌ_\$\$h±…¨éÍá¾Tº˜ã@T|Él‰ah°©ÒÑ2§¹ÌBèîCÔÇ*–†~j¼ıken™å&t‚~T)(æàŸ\n®ÆÒZ3VìñÏù°oÌÁŸ(6pÎ™úŞ¤_he\\uİ×¥çuPS±±!¤¨ÃÄS2¯²ñ+Pæ­ÉMÀ_Ã˜•N/i¿ÖS£0ØäØr";break;case"he":$g="×J5Ò\rtè‚×U@ Éºa®•k¥Çà¡(¸ffÁPº‰®œƒª Ğ<=¯RÁ”\rtÛ]S€FÒRdœ~kÉT-tË^q ¦`Òz\0§2nI&”A¨-yZV\r%ÏS ¡`(`1ÆƒQ°Üp9ª'“˜ÜâKµ&cu4ü£ÄQ¸õª š§K*u\rÎ×u—I¯ĞŒ4÷ MHã–©|õ’œBjsŒ¼Â=5–â.ó¤-ËóuF¦}ŠƒD 3‰~G=¬“`1:µFÆ9´kí¨˜)\\÷‰ˆN5ºô½³¤˜Ç%ğ (ªn5›çsp€Êr9ÎBàQÂt0˜Œ'3(€Èo2œÄ£¤dêp8x¾§YÌîñ\"O¤©{Jé!\ryR… îi&›£ˆJ º\nÒ”'*®”Ã*Ê¶¢-Â Ó¯HÚvˆ&j¸\nÔA\n7t®.|—£Ä¢6†'©\\h-,JökÅ(;’†Æ)ˆ’7ÃØ4ŒˆË¾;;áÄcÊ2£pè4ÉÃœ.\\‚Ån¢]-iÚqB1\nÅÈh\næÎj®S5éì\$Æî„jL ĞtÖÊ04(Ú€ˆZt˜j¹®S°Dä ·Ãèâvå§ñ>À¦kÂ6èL‰„K¹®Zjˆ>¶‡HÚªÄ’ÚJ†O³_>L°­B—¤º)D (‚kV¤F½fVÔódD\$ª6–£ËØ\$Bhš\nb˜-7Hò.…£hÚŒƒ%9X¥PJ âÃâ Ò9½#cÚ¥ÊÃ“¼7_·ûå+à(ğ:K£˜Ò7Ó‚—§­Zö9ƒcÆÉ!O¤È…NÄ­S¬•¡%8!âpÊ1ËãpÎƒx@8CHì4ßÃ<·›¿O•öùï¬œ6;rÜ¯Md ¦±RVéŒ:–ß	Ü•¥¶Á**L>ÁëH5[Ñ2kPdÓ´å!”ø'®là„Í\r:pÄ (\rXÒl<|ÉNğzä\$ócŒ×Ú-š¡Ü; ™´¡àÂ\rĞÌ„C@è:˜t…ã¿L# Ú4åÏÄ3…òïc…á¸xÜ„JX}8¤¬Dş”aà^0‡Û2l×åÖüÜì6‹O¤V¡ [0 oéí­é0P:¥õ8¨4=£aÛ¾x6Ú8;ã3Ä6çãÍ†`C˜ê1Œoˆæƒ«ìiÖ>ÒC4|„d0¿D°–’â^L±‰sAø×f¸ˆ&ˆ2(Á\0P	@‚–\nM2}ï‰ò% @ĞÜ¸s?öØ{]`p§ìşŸğä”C¸h\r!º°ÎçŸií†é`0‡SØ€šëÇ!„†ãš´YA&_uÀ­.]‰1Ğ\$—‘\"ªëq&á8rKÖ›5å©äC)\n#„Ìš­bHŠY†MæÇ¨½£Á‰z\0´ º§X•Hã6Äô–‘¬H	Ù3.\nWB¸Rœ*Ò#¤>e­(ZŠõ‹Ä,…\0Â¤v#„”‡ˆşóLÁkYæIZ)JôeÄ{”IĞ‘‚Ù`Óô6ä€Î«ôöZÓ@‘¡*BBL@Ä²z8ı°´ÔĞ›Ù\"€yj\rz“ƒšÊÂIP‘¥g&G8ËZ„`qÌ¢@[š!GM¥@Î©¡/|ìQÈ„”³\0äûZz9¤õ>-<KSÉ·1fØ¾±×_9OŒÈmå³;\"^šÎì3Ğp²ã!Š\$ËEªÅ3P¬[%2FŒ¢/X¢Q(ÅM„Ö7OÒş`cÊ5+q¦ „Ô‚Ğ!kŒ­8QY)ˆa/Gõv´e½M7è‡ãW¼ÿjÆ~£\"D*õ5bLÃ+LÈÉjÖmÄA>c?*ZtWTÂ¡âZtá¡„\nÁ 5zˆTÓO”B‰SDŒ ,rp¯4­LT¢ ";break;case"hu":$g="B4†ó˜€Äe7Œ£ğP”\\33\r¬5	ÌŞd8NF0Q8Êm¦C|€Ìe6kiL Ò 0ˆÑCT¤\\\n ÄŒ'ƒLMBl4Áfj¬MRr2X)\no9¡ÍD©±†©:OF“\\Ü@\nFC1 Ôl7AL5å æ\nL”“LtÒn1ÁeJ°Ã7)£F³)Î\n!aOL5ÑÊíx‚›L¦sT¢ÃV\r–*DAq2QÇ™¹dŞu'c-LŞ 8'cI³'…ëÎ§!†³!4Pd&é–nM„J•6şA»•«ÁpØ<W>do6N›è¡ÌÂ\næõº\"a«}Åc1Å=]ÜÎ\n*JÎUn\\tó(;‰1º(6B¨Ü5Ãxî73ãä7I¸ˆß8ãZ’7*”9·c„¥àæ;Áƒ\"nı¿¯ûÌ˜ĞR¥ £XÒ¬L«çŠzdš\rè¬«jèÀ¥mcŞ#%\rTJŸ˜eš^•£€ê·ÈÚˆ¢D<cHÈÎ±º(Ù-âCÿ\$Mğ#Œ©*’Ù;âHÜ;*\0ÈhÓX9`@1©›œ4Î#›\0ÁL\$g.HƒdŒ=?ÒAf	IC\r\$±	B®8: PŠ6¾Œ ô=’))˜dĞÔªêÌ\0Îch:5b\rWÖ5m^>ë|\n°\\•øb	kˆçLÕÅä4;ÒRŠÎÃ0½Ê`Ä˜©ræÅ¾£\\«#£Àb–-cmq	m›şş Ní4£jQ#ÉJ>6PÎ<B¼‰óGb-ƒeîúÖC-áyG)@×‚Œ`]Z³ø[jÏ˜yyƒbX¦xâøv!‰Cj	qI2Ht8ĞÛ)‹cÎd<‹¡pÚ€Â9;cbK*(.#mO3Â¡5ªf‹¢£Â²7cHß¨&âb‚íIKÓ5ÛZ7ŒÃ2€…Ps²5b6´½2!êhPÆ:=ÍË`Ù6°Î¹6Ú\náBÉ€ÙŸë’o«–0A>”Ã–ã°ÂÉ!JSl5Kã X2­³OT;È]\rC’şğ?‘ƒaD”ç¦Lúâb4)0z\r è8aĞ^ş]{\r«º4Aƒ8^„yzr¨êaxD¦ÂHÚ86Ü€èã}¢2LÒ/¹^, A¶Õâ…9Ñ°ÛÆ|z¤Œ°'ê¨çè\rÑZİØ9Ù+F±Ã’„ræƒpi8ÇÀÍ“ŞÔ@w6¨åÏäa’Na„3:d0Ã…a˜:ÀpŞË¸ ‚FhàÓ¼d“Ú}9*\0006(#^\\:/#HÉvŸPœ]áÁ“,`«¬³8g‹Û&æø7» @@P‡(Â`PSZufğ0¸¾r\nLCš„/£Z]Òru†ÆiîäôBÔöR|b\$9b®hÕQ)… ŒLÓS ‹M\$»\0–Ä™åtR .CæPÒ5'èâ€dJÑRiJ&ÄBVQ 	É”'3\$Ìù‚0Ğ\"ÂnHˆy4à€2%£\\…ÈBs3G¤êaJPfAd€ šŒ#2lù:œ„‡[¹7>\"é‘`ÖL\"xO\naP˜ĞèdÇÁ¬ÂàçÕö<å¤§,‚û*r±ƒN”AÏùV3'vM5Èî‚\rÛ>^Ó€1G @ÂˆL&FÔÖ›Bb‚¤R+ió½t6ùæLËN™É¹ìJ@¶TD±’šNfQAXæe’4ª^z™NİYSxŠ]ÊËºbtõTÒŠ~sŠJ5b”ø£Ô\n’MÂt>`®i†Ç7ÚœàN²c¾B.C4CEäÜ#QB\$“ÊS…!T*`Zùx«á¸3ÓÄæE“Á=CLğÿÓ¶)^(í{/a²¿++^İ}tdx\"HHt~'ë°íÀ™À^ËêV<~°€¢òJçaKIK\nÆT¡ÓP§Tı.Å?c„PĞô‚œàñ‹\"¥(­H(Šr¦ùd’™­B(³ÓU\rô-“‰x„\0PL¹röº\0£°oP\0u`GŒ1,şÌ4ˆíVs¶µı†A•şõŞ£Öe›yrX…XY Pô¦ƒÅ‚OZÁ&2*±1ã&6apµ®/§|) ÀŞÀP";break;case"id":$g="A7\"É„Öi7ÁBQpÌÌ 9‚Š†˜¬A8N‚i”Üg:ÇÌæ@€Äe9Ì'1p(„e9˜NRiD¨ç0Çâæ“Iê*70#d@%9¥²ùL¬@tŠA¨P)l´`1ÆƒQ°Üp9Íç3||+6bUµt0ÉÍ’Òœ†¡f)šNf“…×©ÀÌS+Ô´²o:ˆ\r±”@n7ˆ#IØÒl2™æü‰Ôá:c†‹Õ>ã˜ºM±“p*ó«œÅö4Sq¨ë›7hAŸ]ªÖl¨7»İ÷c'Êöû£»½'¬D…\$•óHò4äU7òz äo9KH‘«Œ¯d7æò³xáèÆNg3¿ È–ºC“¦\$sºáŒ**J˜ŒHÊ5mÜ½¨éb\\š©Ïª’­Ë èÊ,ÂR<ÒğÏ¹¨\0Î•\"IÌO¸A\0îƒA©rÂBS»Â8Ê7£°úÔ\$Ã´Š\"	C™½\0Æ9£\"<¨A0°Š2\r#£Ğ\n4Pç +Pš•£X1¾¨´J9\r©Ê<£t„“&Cª2\$ÒËš<¦\0S ˆZtjqÄ°'(¨ÖºN¢\"*Mºüë®Š&€Àòã.4\rpë(\r€SÖÊG#¨È:Ô¢`ÂÕ0Z%Ö-TîˆTc(ØšLZ÷]Ë;(6¥¯¢\$Bhš\nb˜-6ˆò.…£hÚŒƒ%<´¤­š\"/M;¤j=qB·*gr£Ä\$½¬°³Ö3.6CàSÄ¦LpŞ3ËHÜ2®’RP	uĞê™Q.1®ã;8É2Œ³0ÍO¸ä:&í+æ¡\rƒ`Ş;Ê)l/^¥l¸@5áI–\n1cô\"¼FM!Š3)lĞĞ¦oÓøÿháXä¡\0x€Ì„C@è:˜t…ã¾´(cj”Ï@Î£Û%Ü^p^)ğ’Õ³\rÈèã}tÈ#@ß<KTfXK,’Q6às“Õ2¤)†˜\r,Tê›ÆƒHÌ–ŠƒC0âJË2õÚOÁC3ĞÏ\rè”WÆ˜c5Y\rùâ‚;Ë)+FÇ&(ì(JSÓ*¥¢,!wñªƒ\0·NÑÆŠ@ œ'RÅVå'AB©ëcÊrÒ‡È\"ÏWÀ(=¿Èê?)^†9O»H1¤ºğÏ©&Š-'.®‰\rùb‚Â˜RÏdÀĞ´X`V\"à@è“b¬V%ÑUc0Ì–èu\r¨()Rœ›PªƒOA‰%‚zOÉÌ@(\rÖP©-	\$<<˜‚vøs#ÍğÒt C©0#a˜ó†Ğ@C#^`dÍÛ”ÆÈ¡ÓöD„Í£Ø€O\naP§’‚ŠI'&'¦ª4\\ãVñB.%5Æ\"dNÒ€k*<±àÌIB… ÃC`ÆlLó\"(e	<± ¦Bd2æ8Ë0Œy9O\0ü8‡RHrIo9Ex¯™RX1jJN'3‘(|%\rJ³Ôá'CJä”ì¦TœBøP	h%O	NO4J¬Q|6¸Csd\r#FDdCk{rAæKĞ\"ÈáÕ#n|„\0ª0-\r79¤GåÊx•†–Y«òw%H\nñQÖ¼·\r1rLóH3nU!AI]2}]ñf;h5QUÅ	qP19&R8‰ƒ©ƒ\$¡¹›8Ò+‚`osEï-àHJĞ:EÂ\0¦€A\"ö\nl*`¸å~­çY¦faˆ%å\$”ëÂlh6úˆ¢dôi(Š¾|«¤[>¹”\" ";break;case"it":$g="S4˜Î§#xü%ÌÂ˜(†a9@L&Ó)¸èo¦Á˜Òl2ˆ\rÆóp‚\"u9˜Í1qp(˜aŒšb†ã™¦I!6˜NsYÌf7ÈXj\0”æB–’c‘éŠH 2ÍNgC,¶Z0Œ†cA¨Øn8‚ÇS|\\oˆ™Í&ã€NŒ&(Ü‚ZM7™\r1ã„Išb2“M¾¢s:Û\$Æ“9†[p’š&‘Pá;PmB†@a3Ú­Ã”„âu¨Ü„+¡°Ùí§köÈÙ´¨rC¥¬ëµÙÌ\$6³Ó„bsæÃ¤cÁ¹hfÀ¢)²ek¿-f}ø(ªs¿NPM,3w#ÂlÔ¨É‡Y:Èä¸ƒÂÑª8Ng{A’Zï¦J`5ÉRŠ¦©#(£)*Z‚¨*J @µeZ)¹®ØĞ2B Ò82ˆÒ<7%q\nÚ6ïR*ª-ãª(ˆB#ÜáBü!;€¤2Å‚8Ê7¢ËjÁÌò01´¨ĞÜ=\r+k(ù\r£¬%¢*ô‹Nò¨‹C‚ƒôşC  ÅH²%&&épŞµ\$¬èäœÑ\\8',ƒ²0Œ©šÌŒ\0Ä<ª€Lù?P\nˆšI¡xHÑÁŠÁ/«:Æ74ğà¤™N¬(Ÿ0»	s¯3DâØÏ3Â§(üb¿	íx³0+Ş¯ãs2¿Pc-XÉ£‹]v¹Ôû_U¶\ru&ª‰hÂ'cx\$	Ğš&‡B˜¦ƒ ^6¡x¶<ÜƒÈº\nÎ;~ëCÔ÷0¢#¹£éZ`£F¬øÅzµWÀŞú i\rñ¦‰´H–»Jœ8æK\"˜Ë¸ï<ãhÂò#ê0‰p‚İ\$˜œ8³ìãî²ãK2-Osâ§˜eK8Á\"‰Û`* «)-®Më2ÊÃ0äõ‹\"j˜„dÖµ…ˆc,Ò±º\"\"Ëí£Êµ¨³èÚß%€NiÄ\r\\Wxgk^} hX†‹£ÚN†ËŒºjôÅê“†’Ğz¸Üõ\r/ûÕ£0ÍY·íSÎ†£ÆÃøªwƒ\$)Mõ:HÃ2·«èå¡íû¾£Ä¥ÉƒòÌîJ7%OÊ›–¼Ü}ˆ‰€ĞÒŒÁèD4ƒ à9‡Ax^;÷uŸ»0ArĞ3…éX^2Ş>„J0|\$£‚A=\"(xŒ!òŠ9ãˆ A ¯(ÄÜ“\"¨Ğä×åóxÃ8Ë˜GÃàÑË;\$pƒŠòŞ¶rªó¬ıLHR)ãb…6Ğê½ˆÊÿ#)£&Ä¢“ƒ\"G)å5…²B’*JI‰9*°¦\n‚Šrm4§3bv€‰òB)ø‚\0 ƒ„>§İ•\0PQI1gÙ/²ìÆ:1\$b†ĞH‹«?A½Ğ³ÇïdG42†\"èıŒ!}ô”30ŞÈ¨ aL)hCÒ›‰ía\$ÖŠLŒQ\r&¥™³Vº_^‹y…Æx3ìşs_<¨1TFs\$e#iî.!Ö7˜¸å\rXr\"d¬„Èğ‘œ,†R9WÍ¢Rl­qÔ£‚€O\naPF°ÒS=²˜Œ97¨y_Az4®Õ“ 98IñÜ’Oıí’Ğ¡&ÍÑ\"G”åy\$ˆÑ@)¡L(„É#\$ĞF\nÆ™Xò‹“ç#¶Æ,’«ÓEiÜë7i:SÌë3çHÑÎó©:ˆ°o_ãÂşGu9’)0VÏ©PŸ\rdöPEè*nt%<'¦ò‚1“ŒG46°Æuƒkp‡\$’¥\"ĞÉğm/%îe´d4‰	H¦~\0ÁzV_	€U\nƒ‚Z ËI0&GÚp#5‹PdR¨pÑfª‚A1#è5‘&3’vö_‹Áz§qˆ¾Tä‘Ù¯TÆ•U¢\$w•#‡X7R*ËKëé{ôŞešcPTÈÅ&4¤´‡Ç<Fº–f¾‘\$ô´’ô¢TŞ“•rU!‹1=iTƒ±ŒXgCu82ª¢ÌÚ1lc¹÷£\r˜r®)ÆU4\n‡KœI¬%Ræ€";break;case"ja":$g="åW'İ\nc—ƒ/ É˜2-Ş¼O‚„¢á™˜@çS¤N4UÆ‚PÇÔ‘Å\\}%QGqÈB\r[^G0e<	ƒ&ãé0S™8€r©&±Øü…#AÉPKY}t œÈQº\$‚›Iƒ+ÜªÔÃ•8¨ƒB0¤é<†Ìh5\rÇSRº9P¨:¢aKI ĞT\n\n>ŠœYgn4\nê·T:Shiê1zR‚ xL&ˆ±Îg`¢É¼ê 4NÆQ¸Ş 8'cI°Êg2œÄMyÔàd05‡CA§tt0˜¶ÂàS‘~­¦9¼ş†¦s­“=”×O¡\\‡£İõë• ït\\‹…måŠt¦T™¥BĞªOsW«÷:QP\n£pÖ×ãp@2CŞ99‚#‚äŒ#›X2\ríËZ7\0æß\\28B#˜ïŒbB ÄÒ>Âh1\\se	Ê^§1ReêLr?h1Fë ÄzP ÈñB*š¨*Ê;@‘‡1.”%[¢¯,;L§¤±­’ç)Kª…2şAÉ‚\0MåñRr“ÄZzJ–zK”§12Ç#„‚®ÄeR¨›iYD#…|Î­N(Ù\\#åR8ĞèáU8NBHÜ;#`Ò2CPCV9X@1C(È2Ã ÓNq1°d:?EüË3–Ç) Fª„Š>\\Ñ+ùDª‰yX*åšzXáÎMEª9eY’qg%\ns“et]‡1H\"Uú«‘ÙEH÷u«jİ¡ bğ§¥!8s–…š]—g1GO‰H ’ÔttA¦4:òDØ¼‘d­É„%ÁÌE?4ŒU¯%¹\\råÑÈ]/J	_X1n]œ…Ù0IŠ2‘’\$ç7HA‘bIg¹ù~ËMšˆœäy},EÒ”ó=§³Øu1ÁÒ0cÎÄ<‹¡pÚ6…Ã ÈªVÚ-r3’ÛI5-IVnmb£»n£(ğá\rÃ˜Ò7ğ15a£—hØ:M#L5MJ3ÔğÜ2ÖJfŠAİº?l¥\$Í‰|'.1ÕÃpÎİµí‹fÚ¶õSa7N4/Ó£`Ş;ÕNe“Ï¥ÿGv£åÚT–èâ†Yê¤á>ø’lA ¬o=eÙ«\rÀZ:ÄÌ@ÈDˆ@ÈØ¸›¸U\$@9ÄQ\$<MS„àÂÔU#0z\r è˜:à¼;ÀP\\C m\r.] °ÎÕdoê±Á8@^Šˆ>	!´8`Ú« <á„7X>qz 7€€6†ÖkJAµËªÕdñ”+ÈyDqæ4r|\"O2ÄZÍ5ï¾Æù@PT\r°0º‡ƒ¹µ\r€€1Àà‚2ƒê€0†gÒ†ƒ¨cfä9†`ëİĞg`‚(œCwĞĞaƒêùÂ^‰=F(Í£qĞL3Æ€²bx@Pj±í#dp/Hxˆ*\$<™¥ŠñÔ¨‚%0äA–\$˜aúÕ¦% ˆ`nŸ¸sDŒF³‰pp¨}¢0ä¨¹Åa¢Îÿb¡ÃŒ0‡T\$sXÂµˆTÂ˜RÎ%EÃÃ ‡(†­% =ØŠÒ*'/\"¹6&áÊ#Å|GS8Ÿ„Î»#&C™:aĞ-ˆiÅˆOÍvöI‡(¢!	j–)¾ø§\nGšà(\$‘`òãÃ\"Ÿvê„7B£Šn•Hq¦å†dA\0A0-FõX©İÒîÙƒ˜xS\n„q¶“r`Ê	5\$Ü@Á#’Ü×¦‰œ_‘ò˜“„º Áğ¤gÂC-\"-ºP+S]\0ôí Íê»B\$â4¦b c|î CŠ’ø0¢\0fv\0€Ú?pŒƒ¢²¶!é[Ghú¡JŒæ-Õ¾¸hïaOt²OÆ·—â‡ÂlZa,³m ÄD¨Øk\"I‡1–31îÙÅÕdì­—´<7XcSÁŒ5ªTıÔàl£n²BÒƒÍ9¹†ÙŒ†b¬­@ÁT*`Z8nvùÕÀJ¨Ù&{\"N¬iôX¬Ğ\"\$p¿9³V8éc¬|OBlbd1ÓEó1„‰™¶( éÂˆçáÎd‘”RÓXA(¦Ì‰“!d}9ËŞÑÏ¹/\"ütâc„ÌĞªÂXSa~zÏiEM¸\\Ò~9Å©/B£	Ì'„ãB3lq2Ì.&sÎmgòÁ„Ä»—yG‡™ÜÛÄVµĞ/æ\0•*‚r¼‹ó²C7=€\n";break;case"ka":$g="áA§ 	n\0“€%`	ˆj‚„¢á™˜@s@ô1ˆ#Š		€(¡0¸‚\0—ÉT0¤¶Vƒš åÈ4´Ğ]AÆäÒÈıC%ƒPĞjXÎPƒ¤Éä\n9´†=A§`³h€Js!Oã”éÌÂ­AG¤	‰,I#¦Í 	itA¨gâ\0PÀb2£a¸às@U\\)ó›]'V@ôh]ñ'¬IÕ¹.%®ªÚ³˜©:BÄƒÍÎ èUM@TØëzøÆ•¥duS­*w¥ÓÉÓyØƒyOµÓd©(æâOÆNoê<©h×t¦2>\\r˜ƒÖ¥ôú™Ï;‹7HP<6Ñ%„I¸m£s£wi\\Î:®äì¿\r£Pÿ½®3ZH>Úòó¾Š{ªA¶É:œ¨½P\"9 jtÍ>°Ë±M²s¨»<Ü.ÎšJõlóâ»*-;.«£JØÒAJKŒ· èáZÿ§mÎO1K²ÖÓ¿ê¢2mÛp²¤©ÊvK…²^ŞÉ(Ó³.ÎÓä¯´êO!Fä®L¦ä¢Úª¬R¦´íkÿºj“AŠŠ«/9+Êe¿ó|Ï#Êw/\nâ“°Kå+·Ê!LÊÉn=,ÔJ\0ïÍ­u4A¿‰Ìğİ¥N:<ô‰#pì0ƒHÈ‹Œ£íX„xäcÊ2£pè4Õƒ›OCÇªS¿R®ÒíJÇMœxİ¯š: H”Š³ÓñbœÖ¤Jã%/üõ¬ïŸ=‘•Û	,#t·2µ¦ÕğÇpÚhÑ|ÚÏHH…Á g€†*ıh^ò:2Š‚‰)MdâşHP”5Ã¸UÍŒ \rì +œgÓó½6Ù§/Œ½…\\ïüHÿ“ArJ¡.ÊuK–&öCB(2s\n6hõÆşX‹»­vËJT…D(ÍA)Mk¦­8î “êIè’·R“ì…¸0eºÇ%áÒ\0İû1İtRR·³î›^Î.¨kw—éêU2€E„º¼9â\$åİ-¿ü¿ÂğoÒO1*²æ“4êuN\rƒ å¼¥¼v¬§ÛŠ\"OÁ#nuSjí_EÊŞS“Cª)VŞ3j4)¾—Ï£Ú*ğë“I-«dß2OÃn­l_gQÉ;®ÔõÚ3w>´Ø29è=‰-¢›§e|¿øõÈ©#&kün5Çİf\ríÍßH¶Æeo³É>T—«×®í3R´dÏtÊJ#ârË}R³òˆÆÈ¬7p\r…*wÊL\0a5b¨Æ\"ÿHñº:æü9â³Ò‚ZG=é›Ö°¾O3.ªšvî`	o±k\$c”z*sï)ÛC–d \r\nè3ĞD tÌğ^â€.!6†Ü¬Ar¶à½^ÅÀğès\r!¼7ğDWÁô;6eØ\$Ô>nÄ¸<á„@èà¥O‰l+ğtªº4u#±×>%\$ÔÊÓ—cR§ˆØ8‡ğ§‰)×7­&)T§`cÑlñÁ&V÷ YUw‹O”F(šc²£|Æ)>@¸b—@2Œ³ÂqéÒ©E¥@8Å)ëû)N@ã¹('—êêYâ©(¹z³V´Gæî\\ÉÔv|Æ”¦úT”F—p |šuª³á²äL¬’·Ô”ù;Í2ññr’<ÁÏ»Î™åÁá/DÕQˆ|®2ô‰dÙKeF„0¦‚2U–êU}Æñ0ûÎÄ)“µ}‘çæx&lÅ„D6ÈVƒNq§£b\r‘5Ö§TyNZ&W›>Nœí\\jp¢.2¦hI)¿YòO8=IÉİqK OÉº Ë1Æ.ÍeGÕ	8ó^%VLÌD·Îçpçé=T^õ@©•£Ç6z@ƒÜM!AóÜ=¥ú‰øP	áL*R<n¡U\\j0wÁŞªÅ­p¶P™ßa<!'‹1<:b¨ùG¯Uò¿/qì¼¥aQÌ‰Ïh]²(ÅÙdÀÛŠ|yfmVkHù'eWÄ†*®Á`¨(’™y64ÙÑñ%“;‰‘vuñ»ûvoTé;y³V	ÃN»ØZñš†õ\r”CSaäÒ9¤r—*h<Pêæº÷í5â:âÍ©®×©\n›²<k!*_~×`öŞT‚xÏù……çÃ(=•DJ\rÍÀV¤	9ü·Iø€2&*¾›@˜‰’H¯	(SÒk5\$«ì»G”ö½¥ñ!\n¡RˆƒƒO\0¹ÇR¾¶¶í[í12j§Û«s,•'v†’[§Sğ3NWÔœßƒ\\Â—İ8†JVœÕ\nHŒ\\Î¨«©¢À…QB8QØÜêgvV’—«hdéò·H>R±·?DRi¨ Lfâ0…İ*?ê•2×ö“F³m¢Â—ˆ¥*\\&”ÏDÑ°÷,7Ì\$¼£É–R¤€N¶CqLwIûMV(ç:è‘æ7âí™q<ú©²p§c2w¡\n1 9	|)ó<q±ë“FÄ–o §6__š™JO¦®";break;case"ko":$g="ìE©©dHÚ•L@¥’ØŠZºÑh‡Rå?	EÃ30Ø´D¨Äc±:¼“!#Ét+­Bœu¤Ódª‚<ˆLJĞĞøŒN\$¤H¤’iBvrìZÌˆ2Xê\\,S™\n…%“É–‘å\nÑØVAá*zc±*ŠD‘ú°0Œ†cA¨Øn8‚k”#±-^O\"\$ÈÀS±6u¬×\$-ahë\\%+S«LúAv£—Å:G\n‚^×Ğ²(&MØ—Ä-VÌ*v¶íÆÖ²\$ì«O-F¬+NÔRâ6u-‘tæ›Q•µåğª}KËæ§”¶'RÏ€³¾¡‘°lÖq#Ô¨ô9İN°‚ƒÓ¤#Ëd£©`€Ì'cI¸ÏŸV»	Ì*[6¿³åaØM Pª7\rcpŞ;Á\0Ê9Cxä ˆƒè0ŒCæ2„ Ş2a:˜ê8”H8CC˜ï	ŒÁ2J¹ÊœBv„ŠhLdxR—ˆñ@‹\0ü‘n)0 *ê#L×eyp0.CXu•ŒÙ<H4å¤\r\rA\0è<\nDjù ÂÉ/qÖ«Å<ŞuˆzÃ8jrL R X,SÜú\$Ã°Â6\r#\$KĞxA	ä2Œƒ(Ü:\r48æ ½'Y(J¤!a\0ÀeLÔÙÓšøu½çYdD¤Ã—!e»6N±ga0@E¬P'a8^V2^uVÉ3ƒ•§YTT¼Å9˜”“ú3EU¡hŞVs¨A b„ÈÏÅ“šA‘+ÑTT&%–…–5ôJeYy¬ÅìØ Œ)P¤:½-¡x½ly)’ÖO0Òag°¥•à[)‰±…±8qik£#Ü™xLœÚ¼ØiÖA°MS-&V+êÀM¥„Ş…GYlBHúB-:(ò.…£hÚŒƒ\"ôÜ·u× #Ø\nNÈÄ\\‘%I‚ Ò9Ãd8ªQó\r-°ìq\r!²£ÀéKcHŞ7SwqR—`ã`è90²YÚJ‡Z³\\4M[”v‰e9ØöI*¾“d!îcpÊ1Ó´Ä7„€ä4¾›ÏJs±TC¯ÄC|IC]( ¯\\k7Ç°ÄSª–.©jæ)ë“&qÙ\n„µÖ¦QÚd‚K÷¼2€ó (UZÖíò#¡UÔ˜&Ã[|Ãqta€ÓIÆ!\0x0„E&3¡Ğ:ƒ€æáxïı…ÃÈOªÈH3‚õ-›spnA¸‚\"¨‚Hm\rˆ6©`èxaÈØAPèzŠp6†Ö‡J+Ağ•Ë)u8!G,†.2Æ\"‘I+ÂUb-\"hİÙ™A\n¡1Á\0w\r!°6\0Ä‡(rÈJ\n¨ Âò%¡Œ1¢\0æƒ¬Mu¡œúÄ˜RDD¡†\n©Ñ”Èln£µœãŒj]ñ¬\n (hêtAT&™:ÁrQ~+e|ÁB<YÒ±Êˆh>\"ØÑd]–Â€Üª+E¨¼9( îHc\0003¿8œ‡\$ê‘!Õ\r©Á<P»b@™„0¦‚1Ì@›¡<KbĞI£Ò¼(ÉCZ{)-N\nhQî¬E1*LÊAJc®<˜ÎpÔÒB:¢ñŞIUA)3 ó¤x)ÒI/h „’:CxuCª%Ô¢D6¡¨D*L8‡T@‰2\r € ¿ø˜dê\rnµ\rÆ—P‹A\n<)…CÌÔ\rr¡hóBÖ+\rx¯8RsuJUM)åFz#‚úk‡RõG¤å²8‰—5¼Üóå­ÏÂE1A\0S\n!0ƒ7S0T\nĞvˆgvõÄ¸¬%d´—ÎTXZ«Š/¢].8™²{ÏÑ›ˆv„¨ób	\"«5g»v\"~OÜífNüÌWµœ©™aî\$‚	jñaÊ!Y–¿E`£ÉÊd¬œšWËJ¬UŒ³ÑÉ·°Ø\nèÜ©\rj=¾Å(s›ƒ°„4†`ó&Ã¡AÑ-Ùh‰\"|›A¡T*`ZpnvĞû6,	™.ŞmW<&L•ƒ5†ÀÇ:üÕ˜1¿&åãİ§N¹…çäDÁÔ-ÕMædÍ™Ôá[Ä•~½X±/‘HÊMyİ3«D@ÒOR¥k56j4ñ(´Dq&)ƒ®”-ºrÏ¦Ø¥dg‡53\"°z83Æeâ'à:Å<›bv¬åà\$Î\0²¥bÍ…Üû¢À\\C`ÒìT0ÁjÅ‹Ğ‚1ì»!-kª(‚KZ×pÙÍ©³Q*D1u®Ü˜”‰¤] ";break;case"lv":$g="V0šDC¨€Êsˆ‘°Òe1šMĞ³¡Ì~\n‹†faÌN2šOFC)ÚsCÍ³#&t &È)Ôõ2œÓ“¸F™˜DÓ	®m…› 2‰!&r”8	A\0”æBŸP\r&ÉA¸Êe£NgItø@\nFC1 Ôl7AGC©­Š¡ÎF–\"%I7C,õ.Œ'aĞÂb:Í'Å#)’ø£—D™,<èoÍ±bÙ¸ÈuŸ¦ÚîŒá2šŒ2ŠQ‹@ »›ñ¸ü S0™ö±Mÿ†˜MØÓ©Ë_äi2¹|Ï…Š9Rœé—?0èÌ&Ó[w0âDL:NÆ\n€\ræC(™ĞGÌ§«úˆ\rf!xb•o¢|Á0Œ0ÊÄŒ¬Ä0«Œp@8#Ş‡'ÂHô¢\"CxÔÏ@	b\n77P à¥.ïëT6¡ãjª9«)šP°!Êø\r#Ö¯#Ï»¼Ğ!mS4µíûÄ4¬…àÒõ°mZPí©CJŒOêö2B¡ˆUjàbC(Ş6»ËÛdÍÃ´ 4Œ‰Âtœ„Ğ@1L¨Ê7ƒL!L£è5³êƒìü,„Ô\n¬/,3Œğ ƒrÌ¡éBˆ7IbPÂå)‰âŒŠ£l\$`HKQ 3ÍMTIÊ¥ÀPH…Á gZ† Pš°%d›Ğõ\rC(Ä5¹¨X@;3Õxœ7˜¤0Ê6³BZ93õûêûÅ•90¥\\ÍI1'^Ï(8\"Â‹=eË)rˆ\n	T¤ÕÉbœ²mŞ9ŞòÚ*ªÍ£-ÒŠ…ÀM—~_7òS ØÓ‚à÷íó…à8r|ÇãÈ	@t&‰¡Ğ¦)C È\r£h\\-ŒùhÎ.ÜÉJ„¢èÀ¬LxÙªÓˆäƒ1CwçÚ Ê<“º7Óã€9(«–6ƒ%@‘šÆOØæÙ©k!&Ÿ\niÊv½£ĞÕx«í”&½ÙrûJYğšõrÅÌSÁÀTÛŸmšL¥_¤ê\\¾ÅMZ\n9È÷ü)Ÿ¡Ã+\$	©pÎ‰DQ&1à\n%{ ø/®ÅÓÂ©ÜC¡ñ|jQÇ„'Ê’|½0ïBiw9†EƒuúIå@OGÁôÎ…-Ã¯İ_õĞœ+Ø¥MG)ËsÇ5İÍ½ï•júÍÒjAWË¥#ĞÏ »1\":±lJ&œƒ-“h€¨ÉN®ÍâBtªŠÍQ²9E	¾ÒO‚i³i!È¸õbM\$ImŒ‚à@\nhN¡˜‚ Ğ p`è‚ğï	Ásw¤ä ÎÓ¼0i\r(4´À^Š°>	!µ¬ôîØùŞ€¼0ƒâ†Ì²/‰EçH&øÈ)¹yÌü‡µÆAS!Ÿ2Í‘ø\$\$Ìr.\rD,1/s¸ÕègŒ(\n­Ôßª¨¡=vj¤ß³§yÒ8AJ *î€ä|×NQKÊ]äd4 @@P1&ê/¡üb\n.DÈ P¸”XİAAV0@ÆöÚxÓâ‰BÍ\r¯—F~`Ë5ïğñ„ÕÉyŒ«åèz~ ”%)… Œnò?i°Yˆ±7p‹Ğm ¬ÉcğÜAS©\"aç9»xÔ¥šˆi)(¿2êëUIBŠ¡½®ŒQ|‡’tQ.Éê“¬O”Òaâ1¥)ƒ„VKn²I‚\0‚!Xr†96ÂN\\ÊÓ\rˆñ;ŞÍğP	áL*Dx´Aãİ6t\r'	“¯yîÉé)	öˆ\n!‡4V“¦8êCés¤“Iˆ\0Ó0i£L@‘ä‹Éñ\0jÀ•Ã3/I  \naD&fMI¸slÄğíºJaãw©æ}©åÔÍCÑ`†n³/ó\0‘%k3AO\$óEH|;óm\r!Â&¾ICŠ­E‚\0šú@kúys¶º°[_Ø‹­³l&Ë_—ôÓ%ËQ-™øSOIŸ\rª†À@\nĞ›’¤	uâAo6ÊÑJŒQ’3P¨h8§ä´I¢³Æ†k\rœ%å	†T\ra®b1Ö6Ücgc®I™W‰Dø\ráJ”‘ìØ3ëcìK%+efIÔúäˆ]F6`):™fæK×˜—‹ŠÎ-é¦óë½–yí}V‚\0Exğ\"¬¤¬@ÛÂa5°um7£¥‹*…\0Sš·“õ2PCÑ‘Pª‚ê`ÂªÍ%Õ6x‚ãVbK™šX	gÈ‰ß\0ŠQƒƒwm7\$+´»XîÉ'K7dú…,DG¨=	A’VXİÄ„×I¼gaÍşA€Aƒ,ƒĞ‚BHM\n!Q…ºà^ºC˜w/A’Ã”ÔHXk%!ºh)Çz‰Aw\$!Ò!ÄP\\";break;case"lt":$g="T4šÎFHü%ÌÂ˜(œe8NÇ“Y¼@ÄWšÌ¦Ã¡¤@f‚\râàQ4Âk9šM¦aÔçÅŒ‡“!¦^-	Nd)!Ba—›Œ¦S9êlt:›ÍF €0Œ†cA¨Øn8‚©Ui0‚ç#IœÒn–P!ÌD¼@l2›‘³Kg\$)L†=&:\nb+ uÃÍül·F0j´²o:ˆ\r#(€İ8YÆ›œË/:E§İÌ@t4M´æÂHI®Ì'S9¾ÿ°Pì¶›hñ¤å§b&NqÑÊõ|‰J˜ˆPVãuµâo¢êü^<k49`¢Ÿ\$Üg,—#H(—,1XIÛ3&ğU7òçsp€Êr9Xä„C	ÓX 2¯k>Ë6ÈcF8,c @ˆc˜î±Œ‰#Ö:½®ÃLÍ®.X@º”0XØ¶#£rêY§#šzŸ¥ê\"Œá©*ZH*©Cü†ŠÃäĞ´#RìÓ(‹Ê)h\"¼°<¯ãı\r·ãb	 ¡¢ ì2C+ü³¦Ï\nÎ5ÉHh2ãl¤²)nhÜ;%ƒHÈ†>ò{~±„Œ2.(êYKÊö5´+\"\\F±»l¥-Bœ”8?Æ)|7¦¨h ²%#Pêï¯â‚€ĞÉtF\r4s¾•-Pš–—±C\n¸µ³;Òì¨\0MJTã:	UTÈ è»CË>2àPH…¡ g^†®hÊ®\"«û69£ITcbÎ¿ŠHÒ¿<¢bUTFƒ*9¥hh‚:<sÃÊ\"tQ1š¤B\näÅ»D½–²8ñüFá¼®uï§3<•Ip}.×Åú· –\"	`…›†0à÷ıˆÆKÛÓe	@t&‰¡Ğ¦)BØó‘\"èZ6¡hÈ2]·®âŠL½I©³X¸D¡Ø¸æìªu7ùøÊ<.crR7èÉ ¦å±h YL{#2£xÌ3YÊ•4¾ò­¿FÑã:ş!é\nÇŒí;0Í3Š\"õÁ){TËÁIbD;¯I %¥Z^şìü@ÊÊJ£Œ£hß:\nlı3Å„uœ¥S‰}Z¶%75›S4|,ÊÃŒ³f5\$i-&ûÜğl9Lúàßo!\0yˆ\r0Ì„C@è:˜t…ã¿„# Ú³¾árÆ3…ë›¢.:8Ü„IĞ|\$£‚á™à^0‡ÙÌ¼ÔQP@•£PÜ8>éZ„¹ktlvˆßãXón´öJ<1o®\"0¦›@Eá Ê†ÎZ@ æp6*Ã*ûf,iy3†Ì\\ÍúÈaŒÏ‡0Ì`i\",ÇÖšƒO`aKÉµ7§À¡‡-¬Aí\"\0Ó\\32Ëh!ƒ.†Êâç~©u…\0ô6DHì S\0Ï» oä0ˆÁÄ6}MC \rÁÀ:¾²€ƒ„\n5!Œ4>rÊî t'2¡ŒÙ‡0Ê„’’Ú%'| \0†ÂFmDh´\"`@ƒn&n}Ã°S‰ƒ“Š%ìÅ.—T^ÍúAFç,’c|aãè%\$¬–’òà™”1`\r¨íÇØ³‘ÙØF\$ÙÍ<TÌ•ÎË>N\$…‡“ 	ªgn‰¢ABsTqƒˆu3è(3ÚÆyş,ŸPÆH£t¾%äDÏ@ êÙ´@'…0©.‘q1 €)‡RW(OŒ±œ47JÒŒHÀ FÇ¥sË™`iˆ¨nÅ•¾0ÆãÊ	.?ÁÑû¡¢tc¥¼l>¦Œ‘<Yä«,ä\n!0¶ØzX\0F\n‘\"@¦rT‚»ê#ó4\$ÔIMnEq—(`è¤Dz_Jisgë 5¬”g5‰<r_Š­Pª4LT•5`ÕêS ÒÀªMBµ0Å±@†¸`+™á¤1†¶t}X‚d%¦TĞ¾uC0y}Dö‹ÚK8 \n¡P#Ğp}ƒpc¬ç|’UJrtÈÑ)ŠÀé´Ò<F,	`Uø®#»FÏôp#¹.±ú¸N!p.DmÌZÏZ@TçÅ°5¢, rH)Ô<•Äˆ“y|Z„8±–ÂöñÎ)Ç/¦òÜ¸N¢B¾B[\\fÜQ–)'ä2I@}qG\\ÒÃt%qßYd¹A¥TOQ\nU’ÆÈ—œ`õ(¤LõPª›{CM„½ŠÑÆ—Î^1\"p§¸\"’Š@ºÅÿ-A%aŠŠG¤c3Gvh¹¡ñ/®zq³‹Êœ*3Ê";break;case"ms":$g="A7\"„æt4ÁBQpÌÌ 9‚‰§S	Ğ@n0šMb4dØ 3˜d&Áp(§=G#Âi„Ös4›N¦ÑäÂn3ˆ†“–0r5ÍÄ°Âh	Nd))WFÎçSQÔÉ%†Ìh5\rÇQ¬Şs7ÎPca¤T4Ñ fª\$RH\n*˜¨ñ(1Ô×A7[î0!èäi9É`J„ºXe6œ¦é±¤@k2â!Ó)ÜÃBÉ/ØùÆBk4›²×C%ØA©4ÉJs.g‘¡@Ñ	´Å“œoF‰6ÓsB–œïØ”èe9NyCJ|yã`J#h(…GƒuHù>©TÜk7Îû¾ÈŞr’‘\"¦ÑÌË:7™Nqs|[”8z,‚c˜î÷ªî*Œ<âŒ¤h¨êŞ7Î„¥)©Z¦ªÁ\"˜èÃ­BR|Ä ‰ğÎ3¼€Pœ7·ÏzŞ0°ãZİ%¼ÔÆp¤›Œê\nâÀˆã,Xç0àP’7Ã\nÚ29£ìèx@1C(ÈŸ!S©Øé	Íê8DÑB0	o˜@£\rˆ£&\réË’¿S„ä¾£lÂ‚6HÎzhÃ¨\\˜1.xĞt+ô&ÀS5A b„(Br'qª0¥³8…7é3¤ÉBBˆ)zÜ(\r+kˆ\"³“ãå\"ŠnÔ2Òcz8\r#’oT¦ã¤aA€Ê¹ğzt4,`’¾Ê\r„µ	@t&‰¡Ğ¦)BØóq\"í@6…£ ÈV’tùB#ú\rº•(VJ01^ªK÷)^ã(ğçÉ‚Ó-Šiô`ŒCd?V (ìİ'#xÌ3-£pÊ’ŠXÂ›Mó‹/e¢ƒ•Øë·­úp¡3\$šÇz˜³¨g§©û\0’Š„Ù	¯N¢72C„Ï·cfE9£yr¤ab!X z2õ5¤L²ŠŞÆ°Š“&\r­€è’ÎÙÛ0®‚è›6OÓ-f¨óXêÉš’aéS»•<²ÒÚ’Í66±³·c­Œ–„‚‘6îp@ cDª3¡Ğ:ƒ€æáxïÏ…Ê&Ã>xÎ§İFŸ`Ãp^)AóÆŒ0à^0‡Ò\rFÎ4³Û\0ê6CzÍ•·o²aSm—!6v·¸Â1¡H@;Ö(ú{æÏ{9&#3Ÿ|¹CÆıc0êï-O¶4ŠGêûÂ,ä§*Êãt²Ùp.HQ•lÊP±»\n (3pAJ+<´<rrÍĞÙVgU*³\"†D+ë5æíûÂ6èA2Al4ÆRgrí¥Ä½Wtt˜ÙoxÄø0¦‚3‰\r%DŞ‡lĞZÑÍ 1öbµRQ–(ÁœØ£rŒòz4qF=z†% e–ŠLiÌá…oÚ¤B':Ä0‚Q dÜÆD3ğ!’Ò_-Ñ¬b„ly‡2:4 İÙ³†n`h”eCâ©òpA@'…0¨âYòJhéi‚\0–C±9„	Á4&B#Y9‡=cUüb˜‰…\rëÖB,FÑ*V €)…™‰É=B+åZÉ£,‚¤\rF†Ñ—ÌTÚe“!Fd”\$§é0³‰Ù AµéÍS!5Û‰;3\$Ô©¨Ÿ—¼['m1é¨ƒ_5¢ÛçWeÑ-„4>Xc-¡¡À3TQŒ³¾#fqÑ\$3.Ìã3]ò9¼Ş¨TÀ´YÜa‘\$ê\r30966NØU‘B5†¹›“ĞäÚÎª°b )àS¢`BAÂ )£œGf˜Ã†4\rŞ¿ç~d\rI„ŸäfH6@ŞQXe‹ÈÍx'ˆjU*ª‘Ë—BÖM'Û¡Òe‡é’”²(Ág¡É`+\$ĞÒŒE%è¤c\"€”Ê9]î	­“JF’£u¯|Ã‘òÜUÙª`";break;case"nl":$g="W2™N‚¨€ÑŒ¦³)È~\n‹†faÌO7Mæs)°Òj5ˆFS™ĞÂn2†X!ÀØo0™¦áp(ša<M§Sl¨Şe2³tŠI&”Ìç#y¼é+Nb)Ì…5!Qäò“q¦;å9¬Ô`1ÆƒQ°Üp9 &pQ¼äi3šMĞ`(¢É¤fË”ĞY;ÃM`¢¤şÃ@™ß°¹ªÈ\n*ÑĞ:í|Êm0˜ÍKÄ¤ß=™B¥F€Ã'•K™Ï.O8èRx¾çwE™ˆĞÙ‘Ê‰9C\rÛİÖ¿E°›#–9ñ—ÓæoÁEhiŞ?ÅÈ•5÷Ûùˆäu4âã>TÈ@f7N€¢%Y´–X¸²S)×6ƒ!»BÑêhä®+Ã¢jò¼ïH@¸Mƒ¢é½Ã(ğ¢jğæ*ƒš°­%\n2J× c’2CÌb’²O3Ğ†JPÊ™ËĞÒa•n\"X:#‚HÉ\$Ì#\"ú‰à@à´ƒPÈÃ¯CÓâÀ™¢Ârä1kûN.ã(\$Ã°Â%-°äá¸Ë°@1ÄÉ“64ÌqHŠ2\r#¢íÁ±€æ75ãh+Àc¤\n»Ib\nN6£³s\rH£œQd–'+Ã¨î¨¥sğJ”ŒCÊVÓi=C½²! j„XBÒ~å.³DÆí»®úÈŠk²W9jÌ|äBÆÒGâ\\4¡k@4¯¢³xŒ8®@á&\rJ°îHRÆåÔ#-'\r=?K%@”ÜVxØ©ÍE¾šÃ¨\$	Ğš&‡B˜¦ƒ%œ6…¢ØÕƒBë%)Ê›l¹XõÛ–)´C\nrª¨\$êMC+‹Èğ¼©\rC¸â)Œ¯I¨˜¿XØ:LÃ4ã0Ì/i¨¦†Í(ÍHÑVàÄ½Nƒs¦OƒŒ¸íh(\nôt2ˆ¨ªlê;2NšŠ²ø÷¾6C†×PôNª¼èÉ˜Yª)‰í,‘/KÚ‹P«ĞêùÀNÂá£»#ä¯lîvµ¯Nß¦û”ÓºÒ´¾†7oJ¢S¾Şª&t:ŒcH9º-pÍHQ)¨«K¶Íª½¬\\Ã’_&şl[¦íK¹ÍˆA 2é»øã@M%3Gf²àÂƒDÃ0z4c£ráxïí…É8†…Ë°Î¦&E†+^*¡ğ’6¥Ìúf•¡¡à^0‡ÁİŒÑ ĞÏq§@\rašôÖÉa 9LéÑ²B4@	4&‘Â rGÌ0D¦ª	ºğô˜ØĞt,ş TpSä\"®Ñ:@Ş¹\\R‰8/õıA²:qEÇ¤†£&E‹ùÁBÈ`¯(\"¢KÁ,\n (2ˆI¢=!ˆ×œ`PUAI5§¯3&ÍšÈ*%ƒ7ŠCo@D\r¾›X¤p`	vƒìY¬R0PS g)… ŒO X [„•¿œhÊÙ‘;wMİ“RnNIÙ=9És)#‚HÑ1éAR†¿ò6‡I¨A]äÁÅëÚÑÂN\0€ †G¿!ƒ(b dp2æŞP\\A,5&È0¶ÇŸ-L	,7G¡Ï\0  Â˜T²Ô“; RÊl›[¬¹¨jAŒq| á¤”ÌÇÍ]ŒOì©†2ÄC8uE¯: @Í“š80¢i#Dh„:’â`›¥SÏÁR&œNš¨rWç§Ëù„Ï_S.Äï\$£ˆMBMQá”Ù’Z0¦XË\\„e\0002UBLûhm´u.µ0gÊ¥„Ô!³\0Ø\næ¢\ráÁ#œÒ 	¨†Îø‘¥ƒ.Dú)lŸÆÂB F á#†éÌq\\l\rE‘Ãšté1)2 €ä’80Å{ğWÄ¸Beiò:(µ´Ğ—é[H¹#dt’áJƒ¬E`,ROGM±Ë,Ş“4–ˆììGõÅ'„_5ÙÁ!VPä‚&9PU?„îúŠ‡¨’a‚mlGÚ1”%¡£!µÆD(KÔš\\Q!ü;p¼¹G“(I«/D„B±ú]\\Y°LDâIúG\rYâ»1\$¿Z¨UÖVD,àÍi½\r±Œ5„t\">dJÊ&9@";break;case"no":$g="E9‡QÌÒk5™NCğP”\\33AAD³©¸ÜeAá\"a„ætŒÎ˜Òl‰¦\\Úu6ˆ’xéÒA%“ÇØkƒ‘ÈÊl9Æ!B)Ì…)#IÌ¦á–ZiÂ¨q£,¤@\nFC1 Ôl7AGCy´o9Læ“q„Ø\n\$›Œô¹‘„Å?6B¥%#)’Õ\nÌ³hÌZárºŒ&KĞ(‰6˜nW˜úmj4`éqƒ–e>¹ä¶\rKM7'Ğ*\\^ëw6^MÒ’a„Ï>mvò>Œät á4Â	õúç¸İjÍûŞ	ÓL‹Ôw;iñËy›`N-1¬B9{ÅSq¬Üo;Ó!G+D¤ˆa:]£Ñƒ!¼Ë¢óógY£œ8#Ã˜î´‰H¬Ö‹R>OÖÔìœ6Lb€Í¨ƒš¥)‰2,û¥\"˜èĞ8îü…ƒÈàÀ	É€ÚÀ=ë @å¦CHÈï­†LÜ	Ìè;!Nğ2¬¬ÒÃËtl‚¡RÒn*–™­ĞĞ¾8ÈRØ3ÄÏ¶Ãp(@0#rå·«dÄ(!LŠ.79Ãc–¶Bpòâ1hhÉ)\0ÏcúûCPÂ\"ãHÁxH bÀ§nğĞ;-èÚÌ¨ #\rRûÿ0˜ÖÅ<£(\$2C\$¹P8Ù.¡hà7£ôû\nƒJlŸÖ+êò3ËŒS=)µ¼ µ# ]?Ïc-” 6`ÉgQ\r5V\$Bhš\nb˜2éˆ¶Ó]+L.Ø5šøPâ\" »/0Ìf€©w¢0¢Ş÷°Ê<\$r7àM¢¡jRŒ¡jf6£Bv<·ÈŞ‚.PÌ3Uê«&°dĞ´ğ‡‚\"ãf¹&Cx@í#²”¹Ïu»~Ñ*ó¶/Bú”B¨é9X’ØA 6#ÊÁ¥&05¹Ù(Øp[£ÁTã‘ÍY{†7O¶ÂV¨U´Ê9Z(¥ªYÁ\0x0„B|3¡Ğ›˜t…ã¾ü1cjØ½-8^¥ğø—ÁxD¢‡ÂHÚ8/1|à…xÂBzÈÆ7×°ÌÒ8c8Ôµlcÿ6²R›§jt\\Wá\0ÚáÑÓV9Ôã¨Éš´ÉH¨ÌÂ9PÓ‚ºi#XåÑQ|ö0ŒÖ¢\n:Œcî9ŒÃ¨ØNjg”:\r	—ˆ9Œ1xA(¯²˜Ó*¥+Šæ¦d¹”, °ÿœ#	ô~è€H\n\0µú£b~³À(( ¤¦éŠYsA%Íá“VÎ[€s@hÂ¾b0[ƒ%eè¶‡’Hc|®3·w™ŸXa¥”…PÎCa~e)… ŒÃƒy	)]c'¶ºï	‘0df2TK	q0B)À·=ğÌOÃ¢`)½';Ä¤ÕšÀn‚h-J¡—âDCË I-­gÌÎIğq§ÜçcØLBdpD^’˜Ó‘Aæ‰\0AE>iù¤‹ÁËw@H(k‰!…¦±Ê‹>24ÆàXSM‰CŒ®ÌÀrèE¡­‚`ÎLPs\rL9—â|Ô‹L1Ä5™\"8G‰¹\"\$…ÒD¦B`-\$Ï}™7\0Œ‚3M.MR:’é Ë 4ìÅ—B†ÎÁ [Jn¤HäÒ(›‘~Móàs“Q)P	áà\nVdˆJÎZĞ¡Ê‰ìgÄºhŒ6°Ö‚HC^4åÑ'çBpÊYª>…-\r›'lîÔT*`pÃƒ(g<¡¾yäÌSi#3PßÎ©÷JJS¥‹Ql¹|UÂ³#ÄØ MI¸qÆ%r~G¥œ|G¿cÀx!}© ´ÙHâ0ô\r-¨4L‹êh¡ÓAh¼€É¥m[!€À(ƒ OÈÁ>?a°øÎ%‘Ji|İ:ÁX·u<Ó’b¤µ›)ç%aU,e¬Äd×—ƒ\0±xJõè\0";break;case"pl":$g="C=D£)Ìèeb¦Ä)ÜÒe7ÁBQpÌÌ 9‚Šæs‘„İ…›\r&³¨€Äyb âù”Úob¯\$Gs(¸M0šÎg“i„Øn0ˆ!ÆSa®`›b!ä29)ÒV%9¦Å	®Y 4Á¥°I°€0Œ†cA¨Øn8‚X1”b2„£i¦<\n!GjÇC\rÀÙ6\"™'C©¨D7™8kÌä@r2ÑFFÌï6ÆÕ§éŞZÅB’³.Æj4ˆ æ­UöˆiŒ'\nÍÊév7v;=¨ƒSF7&ã®A¥<éØ‰ŞĞçrÔèñZÊ–pÜók'“¼z\n*œÎº\0Q+—5Æ&(yÈõà7ÍÆü÷är7œ¦ÄC\rğÄ0c+D7 ©`Ş:#ØàüÁ„\09ïÈÈ©¿{–<eàò¤ m(Ü2ŒéZäüNxÊ÷! t*\nšªÃ-ò´‡«€P¨È Ï¢Ü*#‚°j3<‘Œ Pœ:±;’=Cì;ú µ#õ\0/J€9I¢š¤B8Ê7É# ä»BHÜ;'ÃHÈŒDã´N?!\0ÆÈˆ€è»\rƒ›\0Á)Ã“À˜È/¢>ô‰R7·c`Ş3¸Ã˜Òå¹£\nêå¯d9T€œú Lƒ\$2\"s[ş5€HKQ1nMTTŒ¨î/JZ°\\•¸b\ncĞê5±`PÎ2HzŒ6(oKÂñ•äÂB`Òº€R\0á¾hL¹Ø	ˆ\"…©èÒ6HÃ;Œr,nÚ­’Rb²•Ø\néA6‘0×¨æ”£Ê|Ö2Ü#\rÆ7ÕøùÅ—şq¦¸(ó}Wîãáilƒ£¯x\$Bhš\nb˜	¡p¶û¾âè(\röéxÑ#Ëpˆ¬¯£d¨N“ Y´X9ç9û< ãu7èÉµ¤ƒ7CdÄò ¨:8Ã2E¦ÂœNšO×­F0Æ)xJH‚@Ñ¡pe]3ˆ\n›\rO¢<äê«´£xõÑZÃvÑC)ZZ:±MÈÇº³Œ¨Äkû’>0…ˆÇYŒN4ùÈp§‰®® èåà—\0˜ğH	¹ğèXåÅq”_»r#Ÿ'Êµœ½su8AÎ®B ŒœñÓğÜGWÊu±»Çö=Ÿ-¤vüÒƒİwƒ¢m¯uŞZW·²~‡ë((Ô ãÈÏCb<Œ§¯Ñ´y3´ó	o®0¦6Ê¥\rB‚3¥5t>ˆJæ@¸Â‚€f ˆ4@è˜:à¼;ÁP\\¹œê'Çä3‚ğàxeh„A£†à^Š€>6KN’äìaAà/ ø¡/Àæ—ƒ»¥82!r äKê? Á„‡!ÂK\nC%\$Ôõ×ÎP²\rá‰ˆWÎ›Á©à€(€ M‚ h@A„1§vP—l\$È† Ì~RJk!™Œ ÆÈ(sÁÖ55ô­£u(9©\$œÍ*vO	è¼£Ş‘2(qà(b‹µÌ‡ËœD¡éÉÃA\"ò%äÄ™—e2¼[£i]ëÆNÒ0û¤ÉÿPåÂÊPTKxŠ(ë	“±#\n'@EdD”\rğn5QŠd–´ƒĞ‰“(A 4º’êàlk™r0–È˜ˆyœˆ‰©C¾STËH€ aL)hŞq¬|¬@0¡ÈŞƒl|'¹ø=)'YøJOAİ“’vOIü9\$IH1!pàeKø QL“¢ä‹Z15òéò¡ùÚ™«#	‰¤\"äC\$#¯©I Òk\nrp>A¾Vˆ‰:x.‘˜<Xƒi[9éÀ1)‘2S–ÑJ–®¤6WŞßu.eÔˆC\n\0f\r*0†0òª³?zõE°ÖjB˜Q	ì˜Â\n\\ƒ¹¥*( ä×Km. €#@ ê¤âkJp±:ò\\M‚‘‘BEÌ7Ä¡†RæÄX©¤¬i|%%Ìœ˜DÓf]”V%O³‹1cµ&Õ\0‡‘úî”òt5R×0‹aeŒ³µ¡¦×¦»bdÕq6iˆ6°ÖUHüòŸu!ûÄN@áÉÈ)Çt¤“`–bl5f\$³åGd6R‹a|!Í!E\0ª0-ÚÛ©ûj,mAaÊé·6	{P•&³/ĞARf|¬+Ëa·âàkßf‰Uœ°—ÑÇ7Bm8§Pò¾‡E2:‡*[u.Gø×›¨y(@e”áDXÙ \nºK@*¨XÕÉ!Ç4Æ¢bÜónÙãŸ}çwT—®”Œ‹.<Ì2F²Âyg|)ÒB€¯Øt#ç¨öIÒ„sØxt¬å»EVcíÀyËöüÊcv“#%˜I¡Í•U IÕóZ¡'\0_CÔsÕşB&™\\€jÎêpæ'pèØ×bu£5CÑÿÌ\n}Waâ'Îp";break;case"pt":$g="T2›DŒÊr:OFø(J.™„0Q9†£7ˆj‘ÀŞs9°Õ§c)°@e7&‚2f4˜ÍSIÈŞ.&Ó	¸Ñ6°Ô'ƒI¶2d—ÌfsXÌl@%9§jTÒl 7Eã&Z!Î8†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M‘ZÔ»	&))„ç8&›Ì†™X\n\$›py­ò1~4× \"‘–ï^Î&ó¨€Ğa’V#'¬¨Ù2œÄHÉÔàd0ÂvfŒÎÏ¯œÎ²ÍÁÈÂâK\$ğSy¸éxáË`†\\[\rOZãôx¼»ÆNë-Ò&À¢¢ğgM”[Æ<“‹7ÏES<ªn5›çstœä›IÀˆÜ°l0Ê)\r‹T:\"m²<„#¬0æ;®ƒ\"p(.\0ÌÔC#«&©äÃ/ÈK\$a–°R ©ªª`@5(LÃ4œcÈš)ÈÒ6Qº`7\r*Cd8\$­«õ¡jCŒ‹CjPå§ã”r!/\nê¹\nN ÊãŒ¯ˆÊñ%l‚R½H(š’<	hÆÎÆîrV60ïKÚIs²8Ó\$®\"PÓ½.t¬ã	¨\né?¹H#&ŸG\"pŞ;#2ë>Ú!Ã @1(HÓTâŠ-ˆıA j„XB‚l1´88¸cepƒ„`ŞÇ/rê6Bxå8±âcØ„B¬ì\ni(Ê1®+ËŒ\"…©àÒ½ˆ’ø‚®rä Êä \"¥)[P\$öÒL”%Q²oOÓHÃm¶W‚W!'ÎºG\"@	¢ht)Š`PÈ2ãhÚ‹c\$0‹´_j9®Sq!J,Ëª	rZ”cê{eä*äL9Ú³­”¯0ÀPØñMJ–@ãxÌ3=w*qhIT”œ ãkÚ–²i°!¹·(ÆçÃ;fÕµ¶ÛaMAã£dŞ¿Pbõ_î¢qAiLº9hËËpæ C˜êƒ\$	¾È²êààšÆÃXÃ0İ)‘ĞĞ<nÕRŒC\r³Â))c¯Û¼àâ43£0z\r è8aĞ^ı]m(8\\ºázQÕ]ª„J€|\$£ƒ_'9Áà^0‡Ù0A'‰ı4Úwã×0d‰´'©@èœ[óV•Ç£*H6,¤ç­Ó¨¨™ z}ªöÚLÂ#¨8ÌºIÔĞÂ3qpÇ¸c0ê“WË»ûòø-Ü}RqN99§R,eÃB1eD¡º œ Ñ	7åÖÀÄP‚‚€H\n5¬·“d\n\n€)\$åy˜°æG’\$\r„áïwl”pp\$‡ı\rCppO®%	¡WÈo	“¿.ÎeM w‚Ìr°°7¼súÂ˜RĞà;#ÖR‚è^'\r>ÇîK‹„'o:%€ ¢pÓ“@å¡”X%	Ú<}-¡ä¤>_ˆ1‹_€Öü†C\n!ŒŒ˜œ’\$M\"M-u5ç†o\r‘Wey\rbC#¥%±ş†5|‡Ş	½†A2…\0Â¢#JhÜ2Åä:V‘Ñ,%ĞÈHY.7ÄğŸ™ ]Áº‚DÕ1†’ÜÎ`n&Z†eÑ[5‘&8ş›e|ˆ›.À€)…˜†š° ^ €#H6OTÑEk0Õi,šš¦JXÌ¼BJ{Sr†ß˜£LW‘8ŸfÑÓ)Ìì3o½1ĞéBŒ‘Ô5~\0 †xƒ`+“Á¥]Î\"‚ƒ˜oFv]å|Ka’V\$éÜ0‚Õ|‹\r{¿CÈ1ôC`ª0-œ79üÔIÂì3ª\\ŒÎ¢è`¢Å¨sÖ;Ôb¼ 1})Èñ–B¤ÔÅÖªèÂÄrbLXf,)i™ĞæAr_Kµyg½@Q«\r\08ÁU?¦r¯KÀkŸµÄÇR‚XAÓg%„à&ù°Q©!¸0@*Â£cÎ¬JúG#]32Š—\r‹÷©fŸ;S^¦*©•*Ñ(´X¹	”Y_-cÒ éÆv–ÅX›pÇ‰kåäÙUÃ\nE-õ^v”Ú@";break;case"pt-br":$g="V7˜Øj¡ĞÊmÌ§(1èÂ?	EÃ30€æ\n'0Ôfñ\rR 8Îg6´ìe6¦ã±¤ÂrG%ç©¤ìoŠ†i„ÜhXjÁ¤Û2LSI´pá6šN†šLv>%9§\$\\Ön 7F£†Z)Î\r9†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M‘‹ªË„&)A„ç9\"™*RğQ\$Üs…šNXHŞÓfƒˆF[ı˜å\"œ–MçQ Ã'°S¯²ÓfÊs‚Ç§!†\r4gà¸½¬ä§‚»føæÎLªo7TÍÇY|«%Š7RA\\¾i”A€Ì_f³¦Ÿ·¯ÀÁDIA—›\$äóĞQTç”*›fãyÜÜ•M8äœˆóÇ;ÊKnØˆ³v¡‰9ëàÈœŠà@35ğĞêÌªz7­ÂÈƒ2æk«\nÚº¦„R†Ï43Êô¢â Ò· Ê30\n¢D%\rĞæ:¨kêôŒ—Cj‘=p3œ C!0Jò\nC,|ã+æ÷/²³,»\rŠ¢,…¤ï`1´qó¢—\rŒxÈªKãë#ËKĞ¦•µÓ»£*³b`Ş¿¿êxäÉZŒ\rêüºÒ¼«ĞJ2òƒ4½3M¶àPóP¿€PH…á gT† P ÓŒc­&Œh…„bÁKˆ=\"…Bxå92‚bŒ© P‚a”ë¶öŒkËÍˆ¡jz4°oe”‘®Šô Ñ£Ä \"¥‰s7O ã\r±\rãJUrŒ*H]NÓM°ÜËâyw¥·‹P#=ô	@t&‰¡Ğ¦)C È£h^-Œ8¨Â.Ùí­¢è:­ê’‹ˆŒûˆï+	Š`•äaK\rd±:V9ÚSµŒ³1ÀPØòMSX—»ÃxÌ3M4k6HNUÔÍˆn…1ºC;r6vÃmLB£pá?k]òòró¤­í2ĞÈèS\$Şèi\n²Õâ0…‰5&é…t3£([?‹´œèŒ©ÈšÇ É€á	Â¶\r¶Î!p@-kF3¡Ğ:ƒ€æáxïÏ…×Š£FÀkàÎ¥}@ñf€^+ğ’6\r®ş:xÂeMÄœ:(Àè Œ#[¼©H”Z}G8ÍÚøßò,ÆÕÇ£+`Û½íkl2w’t4;Ã™i½°”±MóEËÁ\0Â3p°pÆ…\$c0ê”îìÊ©\r¼}Òq	N*9:'b2gCB3eÆ]i…\0ˆœŠ%0Î± ° ‚j­¼Ü‚°\nIQfFfH9’ÂI‰A9\n€Ñópô\\9\n;çıà<pÜª\rpäÄ©€îpCı*!Ë¶7üBC\np\$è7¼cşÂ˜RĞÌ;4Ò¼ä_§v(·îŸM‹~QÑ,(DæÇñB(…àÆOãÉ*%M˜fÌŒx C\$Áº!¨’íÙ\"v	\$T<š´HššÊk;'\0á5nYÙ§!2:5q\rOøcWHà'âXP	áL*\"D¤‰ë0_À€3¥S²àA]Ô‡†£\n1ghŠ1¾éhÊ™vD‘¸è\$ğ•Va…E¬æCFóşnÕÒñ—Áˆ¿\0¦Bbj@~‚\0Œ É>Sªô¤’kI´œ„ùbiú•]‹¹S÷§r“&y¾àèuIŸ½JvJ¾Wqà3/yO,‚Bpf=ËùyĞ×YWÛï¢l|œ„3Ê\\š\r*Ü‹ğÅHâhCN*c&UÑ9Ól6¡ôú_ĞU\nƒ…ŞÃy’\rÁœœ©ãGAHåœ>Š/CE<\r2C}kî¥ÅıŒ)nMª“0Æ–‘Õr\$ìÆÄ¬jiÁå††TàmÈS€Wµšd½@—Œ™›\n¥N€³Õr`].{4±È”s\$#{'4pÁÂr¡¦‘G…¦ôÅ\0«!PPP(j!+1tÍÊ1zK©›Êº€í'²–S}†úk*‰Oìhƒ@ÕÒÓNáâ\rŸiSØBCö&SGSn+!G&,Æ«ÚEÀ";break;case"ro":$g="S:›†VBlÒ 9šLçS¡ˆƒÁBQpÌÍ¢	´@p:\$\"¸Üc‡œŒf˜ÒÈLšL§#©²>e„LÎÓ1p(/˜Ìæ¢i„ğiL†ÓIÌ@-	NdùéÆe9%´	‘È@n™hõ˜|ôX\nFC1 Ôl7AFsy°o9B&ã\rÙ†7FÔ°É82`uøÙÎZ:LFSa–zE2`xHx(’n9ÌÌ¹Äg’If;ÌÌÓ=,›ãfƒî¾oŞNÆœ©° :n§N,èh¦ğ2YYéNû;Ò¹ÆÎê ˜AÌføìë×2ær'-KŸ£ë û!†{Ğù:<íÙ¸Î\nd& g-ğ(˜¤0`P‚ŞŒ Pª7\rcpŞ;°)˜ä¼'¢#É-@2\ríü­1Ã€à¼+C„*9ëÀÈˆË¨Ş„ ¨:Ã/a6¡îÂò2¡Ä´J©E\nâ„›,Jhèë°ãPÂ¿#Jh¼ÂéÂV9#÷ŠƒJA(0ñèŞ\r,+‚¼´Ñ¡9P“\"õ òøÚ.ÒÈàÁ/q¸) „ÛÊ#Œ£xÚ2k<7ËèÒ2'#’v¯/XğŒ®êú9²ïñ2±	ÂC0LT¸¡®£\r@³¢`Ş3ÆéÀà™¨£u##´«û@Ö+©Äï´¡-7ÊÔ\0]âCÊ°A@PH…Á gf† P†‡¤5Jî¼ ,;ğı&oè§ZÏú˜:@CZ€À¢›(2×®ˆ 7¦]×+AãpÒ”4¢\"p6TB…^š'ÒÈ2)ƒ,/7\n ¥±[!„¹6ŠŞÀH‚ŒØsˆBØ“Ü6¨c^J£¨Ú	@t&‰¡Ğ¦)C\$N6¡p¶<çÈºé^lÛÓ4©®Zp©X*õ#¡**u¢GtŠîRô”Ø£uM‚3ÃböËg”RfÏ ‰‹Éi;•t¬½Œîp87MàÊßQøä:)ÎL6\rƒdğ§°Z&NÊ´1´ã¯¨Ë3z†Ğ¡(|GCÀá'1A`Aí£›®;:îŞÕ‚ Ğ¼c[§¢l*ı£ñJ9Q.òDá\0x–\r Ì„C@è:˜t…ã¿Œ)Je\\9ËÀÎÒ>€ñiãp^*Ağ“7²³úã}¤¨”\0Ğ7ÑÚ5§Òn9Uµ{š¬\r<”s@Œ£ê™!º\\ª‹Âö dô*‚p•RùÜÜŞc&ûØËğ<\$p3:ÃâŠÀsÅ\r¿tc9À€Ä ¥'h«ÃJ“'¤i’pÓQê……`Å›XRá×^ÁŒƒ›ˆ`BIÂ\\\nÀ‚¤\n`\$`g\$–4DUÜ!8ï´7Bë‘49Œ4BïŒ8Šj80‡SBOBS\nA·>ÃRù	‡°ğ JAš'D¢Â¶LJJE(äy.’UfkRáMCëÚ9ÀvVX!ğ®¨5€ÂàÒ\"áäÙ:eŞÍn}' §@âa¡-Aäx ”¶¾W¢™mùs’ˆó©+„50 Â˜T…¦-¸3Úy#¨Tb\rÒ±2>Qj®Bì´Ì^\\\"J‰ı@”7DKˆZTE¡”ƒ™“ÈÚÉÚ?j-b2†ßŠS”‡\r´)…˜VÑÉ»%*9(œ\"oD­iV¢TY=VG’”¨ÀÉc’ÄÑ‡'< èQ€¡‰‡Èê\$V¤2\n3E”P¶çGHah”Efb©#£åô’\\Jâ\"ÀÆ®Df,ÆĞm¦´ŞjS£T­\rthP!°Ë5îÉºÁ\nx05V@‰£”7ÌÔD‚Clf+P=…P¨h8GDšŸbz°”†QÂ!±Zá\\™nÆFšb8G¢±#4&U+i¨fb‘’2€(&Ô0òÌJÂ5hÕK§…ø‹CH\n<&ikbúÚÒš„ºšUÕïLSˆ#’õ1”7ôpK\0l`€a\nº¹M—¹BìªiãP˜ÅTVúÄu?‹à\n&©¹Q@ŞV z¹f(š‘5NêAäW÷^£È‹2º¬!‹I¿*ã¢\\² 3Ô	»™Ğ‡b\$†9FLÊ€ ©b‹ñ€§…vÌ€";break;case"ru":$g="ĞI4QbŠ\r ²h-Z(KA{‚„¢á™˜@s4°˜\$hĞX4móEÑFyAg‚ÊÚ†Š\nQBKW2)RöA@Âapz\0]NKWRi›Ay-]Ê!Ğ&‚æ	­èp¤CE#©¢êµyl²Ÿ\n@N'R)û‰\0”	Nd*;AEJ’K¤–©îF°Ç\$ĞVŠ&…'AAæ0¤@\nFC1 Ôl7c+ü&\"IšIĞ·˜ü>Ä¹Œ¤¥K,q¡Ï´Í.ÄÈu’9¢ê †ì¼LÒ¾¢,&²NsDšM‘‘˜ŞŞe!_Ìé‹Z­ÕG*„r;i¬«9Xƒàpdû‘‘÷'ËŒ6ky«}÷VÍì\nêP¤¢†Ø»N’3\0\$¤,°:)ºfó(nB>ä\$e´\n›«mz”û¸ËËÃ!0<=›–”ÁìS<¡lP…*ôEÁióä¦–°;î´(P1 W¥j¡tæ¬EŒºˆkè–!S<Ÿ9DzT’‘\nkX]\$ª¾¬§ğÔÙ¶«jó4Ôy>û¬ì¹N:D”.¤Â˜ìÂŠ’´ƒ1Ü§\r=ÉT–‚>Î+h²<FŒ«Æï¢¬¹.¥\"Ö]£¦„-1°d\nÃ¾å“š¿î\\İ,Êîú3ˆ¡:Mäbd÷¤ÚØî5Ní(+ú2JU­ÌüğC%á¢GÖê#šë\nÇTñæšä,ôóµ`	#pì0ƒHÈ‹Œ£ín„xäcÊ2£pè4Û›~àÃlJJ@#\$Â_Ì“­T–USî*6 OÕ³r¢é Ä8Œ“ÎrZğÄì¤ô©\r\\³É7íğëÔõ£˜ÛfƒX¾¦ N@Õ§OÖMäj«î÷Ø%„’ÆA jp£8%†¦HoLŞGdKÉx•Z,ôrhróù\$BaAMØ„|M©ª{£`Öt[ \n¤Œ¬jjD_&‰ıa‰­D†©ù–¡¾ŠZî;*Š¾Ù*”¢r¾Íä^{\0ÖµÍ˜Hª‰})¾ï>W¬^OâÕR_ÀI¡Ä,\\WÄñÑg!>ònÏ*§K<×8¶qpA¾oIôÎÚœ£öÓÍŠñ#5™N\nI9à@\n2–wP^ÂÚôYùâì‰‘HñöÄË\n‰µ@¨âå??‡¡û‹²\$ô<3J^úšŞ.7tEÚ¨5\06ƒ”ˆÛW‹PHÏ›á1F	òŠQCÓO'Á¡'Æöâ‰5ÂéÄÒûÈkĞC«ô°bœÚDúƒéˆ•!5Ng_!YdœGÀcx¡ŸĞiD½:ÔlLMƒÜLæˆ¶^pÕäKÍ¡——r2xOE0÷’±QáÜåÅµ¢¦¥‰°ƒs-E§¥T±DMzØ¡åZ±aÛ9\n–ÁH™E„DgĞ7D–\\¿Ê4<1>Å(©Ï¡‹ùÍ _š43ŒEí1CˆÎXTj‡±¶ Çå‹Ô‰Qâ&!âPÌSrqZA)Ç÷\nÉ\\r0ñPEwÂÅXqÜWÑi)øJCSÉE«àí˜2‚}Â~9Åxá‚ÂzLP²}“«õñˆŠE”ybËı{ËG‚«ZQ¬u6—–0ŒDÄM @0f ˆ4@è˜:à¼;ÏP\\C m\r!¹n‚åÄÁzé !à:.æCxnàˆ¹á pá!7‰MxÃ>†f0Ò?ŒÚ¡úF e0°‹á«i3Ä”GÁÒ¨óT¾)³\r!E\$XMYDï‰ì·	uW\rv]#Šs²šÓy1J¸ÔS‰Ne	*È·Z¦¢°<JXÍR€n‚)RuJ(x<Ö¥º_¥äÌºSÊ‘ßIÚnèXZk0È1ÙO¨1=šRóÔ!ƒ}UÍö>§\$DM%¸S£j\n).¦¨¢\$ÔÍ\r<Ü“5EL(*{h»£êF9znu©;‡ibÈ#«jğ¨Šeî°¥Š°C\naH#ØÚì¢#×µn‰ó7äC%™*FyBº„áCĞ”«Ê’—/İE¶åå1“\$¡Qİ‹í>²ÔSÖ„ëÃ/ş\\DF›e¡{k‰éF‘+T&•<“¹Ò ƒÆ¤\$¢•Ã°„I5†|Ïµ»1˜ãvaRq@R€´!ıšÒíHˆÀkÔ0™Éí#¦à€O\naRmœ&ù„,—J><:ƒäJ!‚ŠÄƒDELK3‹¤‚a>À˜ßY1ªlAkD›˜bTÉÉô%êY²bšr\r‘ø–ê á¬Š”ülúu!I§¬##×òÄ\n§0¦Be¾oåTF @‚ PWg]‹¾r“Ù¦”X/HbM@eÔK’×è†#5vIdŒèÓ°Ç‘DHNJ\r\r,åŒ}Ôˆ¶µ4ŠÊ!ñ,ÄŒº²ÿa±µMJıhñõr)IzÅS‡'µ¿×&Fk²Ï¬‹Ş¿ÑÊÒö½;Ø‰£ÀC!°Sh^áÈÊúÛæ#—ÎÕwê>Ú×“ÔTÇrÀÒÍ¤ÑrQòŞ›)2NaõhWŒÁ²ˆ–U\n–ô'Q !TĞz®?Ì5>êF‚öÏ÷I”>ìğ¾M/*‚-ñ*ŸÂtã;Û)¤]f¡‡…EKZÛU õİOğˆİ¡@—©2ØûAf'E#©8¹ÚÍ´Äè`¢Uø\nC'âr’Ô¶ïé{\0²ıÅwê»¶šd—¼\$œ¹…Ç‚_lE@«İÚñˆÁ„.ôa-%ğ„ƒÄ]r»‘­4¸±4½?ÜÉ‰,K\rÈPá„4r³rĞîUÒXJNCÍ;æÃrÛ™?\$ÛD•ñ™2¨<ïš8oM±’Ü^ØÓ¬ğíV“‘–Íuøûnâ<Š(³#tÑæ?Ä›FŞ~á‰G\\km\"+Æí}f„«rhh“’Ñ‰;`°";break;case"sk":$g="N0›ÏFPü%ÌÂ˜(¦Ã]ç(a„@n2œ\ræC	ÈÒl7ÅÌ&ƒ‘…Š¥‰¦Á¤ÚÃP›\rÑhÑØŞl2›¦±•ˆ¾5›ÎrxdB\$r:ˆ\rFQ\0”æB”Ãâ18¹”Ë-9´¹H€0Œ†cA¨Øn8‚)èÉDÍ&sLêb\nb¯M&}0èa1gæ³Ì¤«k02pQZ@Å_bÔ·‹Õò0 _0’’q–^¡:S\rö¹Ú0n4Ó&b	®´a6OS¦“¡5\$7ü\n\n*ãò8Î	¿!’Ö#F¹+o;I”³ÁCvÚ8.DXíÜ¢1û*…†­àÍ—ÉÙÌÂ\n-L0<a+æy5ãO&).3:=.Ï@1ØÂ”ˆƒx¶¢ÈÂ42#JB–\r(æ%\"€ä¡<ãjxıŒ£“B¥«z’=\nÜ1º\rHÖ¦jŠŒª*ãJ²­Œ©H¤2¤ï˜Æ2¸ƒÎè´)øæ5˜eH@:#€ò„cÏ½â\"`­CÈ³œ0¡¢ê˜K€¦Ô±‚8Ê7£(èÌLèàõ‰Ñz†D)ê(Ø¨“”\rXæè-ª˜ˆ#Šà\"ŒƒKt9B€Ş:ÈElˆŸÀP‘\$lø6&›÷B äèÓ’RÖ4Ï´êrÔÍ®‚v8C[ŞŒ\0Ä‚€Mi[WÍuZÖíË &pŞ5\0HÁ if†/ĞĞŸ¯5Œƒ*‚Ÿ§¯È2\rïå¬-\ró[SD±‚b]EBÖÚ½â´›)ÚÂ(Zù#àU¾¡53…)MD³HéM<é}\\£!&á6¡=s’›ZŒ·¸Â…ÀNØáØN#\$âa+|\rŒ.4›¤8|©9@™G‹¤²RĞ¤£Õ,\$Bhš\nb˜2Ãh\\-Z(ä.¿C…è¢’»Ş-5©ƒ!©Íbq=&£zÃcÓÊóUZ™ªÏÒœ”Ü\0Â6ÉãdÖ‡DcxÌ36(Â£:Ä8ERPÓÌd44£J]“ÏcKœôåB-Ô=ÁÂzÊp0ÊØV¶/*yJ&ƒxÖ:Ïã¶ÂïcÄ!’At¬¯É@B6®£ªµŒÃX+Póv£•Ït‡GSô½?Rˆu’_]c:=Š-]öƒwm“w<ÇwŞ—Üï?ĞøtİUdõ?‘·]˜‹v^„¾]‰M¿âğk\\ò2Ï©E¯c'?»tğŞùk<¦À0º‡ˆ§â#=Éí\nÔ<ëÎŠN¡4úb\\ h\$(U*@å\0ÏX.\0ğ‹@Êè\"\rĞ:\0æx/ğÌÇ¢ˆAqà¼1‡0^UÍnÁ¸‚\"œ‚HmMæxœ•£rAà/ ø0\"6RJs¨0äå'>HIškT½şD4÷s”Š®€½«`òQ‘9I\$¥w/*‡ÑR¯\$/ 8#ÁB±œcŞo‘ÈVÃ0t	šH®ÑÒ'å\0Ğèi:¢éB»BR^_É—k­|V¶’›MJ\$\$­ÔqÌ±LE=¸¡†/Yl›<ÒvB\0PSI)\nÏ8H(¦\nbM!=\"\nŠTY;%âĞÈÀÅÎ™¤§8º¨ó8F`œ¯yA¬œ‚\0†ÂF„Kìò›Fˆ˜m° ŠA˜Üg9hFÇ\$æ|‰iŸ&QpäÔïÉ³“•ìµXxDÀ½<¨ŒµÀÔ<ÙÔk/dü†>HšHHÔ¨#„Ù‘†TzØâ(!’’WP@Ã¡6DEøˆ>R²[#ûû`YÍÓÈ€O\naRQ´êšCqåQE1¦š,Ù]u	¡e2\rõÊRQPf.aÔæÏPÕ(ÃKa5É.Q\0¬¥\$P \naD&ÅQâ¨Ã™‚ù5¢FfŠh\rè°¤„`¨I.qª\0¢A§bH]2£˜Èe”d­‰¹Ş'È—k¬H±=f°×S`l¥p¡±ç «dñÂVhƒ«Uaguˆ\$8;&ğòi§²%!\r5†ÀVzƒHk5ŒÕĞY¦#J¨5ÄM D~ˆÃÕ@2HÈ©‘IÔÏ<n(‰\$5ÀtIÔ…\n¡P#ĞpJgz\"fêìM¥vlÅjhL^\$E+’Uç-¤Í¶1–6Houä,°42Ñz)\n†\0Á“Ğq#±~\0´³&|UYŒE\nR—\0¬×…)#IáÔë™&\0ìj·«	\nµŒ“ú2-Åı0A‡	)Š\$ær·µ#¦x ¡”5¿¦Üj(^j \ni­b«\"ÔÄ*rA2©ÄçBPº%sÖ”Ì?—<¯ò©šWÊìÌ¿¥†ÛTşr€(%’Îc(xq *\$æµä´ŞÉi8êÌ\n’\nT8Áğ¤şL!Ÿ¢4ó—òN";break;case"sl":$g="S:D‘–ib#L&ãHü%ÌÂ˜(6›à¦Ñ¸Âl7±WÆ“¡¤@d0\rğY”]0šÆXI¨Â ™›\r&³yÌé'”ÊÌ²Ñª%9¥äJ²nnÌSé‰†^ #!˜Ğj6 ¨!„ôn7‚£F“9¦<l‹I†”Ù/*ÁL†QZ¨v¾¤Çc”øÒc—–MçQ Ã3›àg#N\0Øe3™Nb	P€êp”@s†ƒNnæbËËÊfƒ”.ù«ÖÃèé†Pl5MBÖz67Q ­†»fnœ_îT9÷n3‚‰'£QŠ¡¾Œ§©Ø(ªp]/…Sq®ĞwäNG(Õ.St0œàFC~k#?9çü)ùÃâ9èĞÈ—Š`æ4¡c<ı¼MÊ¨é¸Ş2\$ğšRÁ÷%Jp@©*‰²^Á;ô1!¸Ö¹\r#‚øb”,0J`è:£¢øBÜ0H`& ©„#Œ£xÚ2ƒ’!\"éÊl™¹	ôŠ_!ƒX@¤Ë+\0001¥Îó~2Èü³<1@Ó2P@ÊIš@@£L¦“>@P¨ÖHó';1ñ œ7Ã( Ê2Ic¢\nIˆè„´e0ÒÔ’Ò¡KĞ€PòÍK@ÁpHTÁ‹¤ë¡+àÖ£Iât	ã\$¬×8ˆÒK>Bd’F‚ Êà(Î“¨õ/‚(Z6Œ#JáZBÓm2F“«ÀòÍâ‚BP·åµ9!j*\n¶]š»6øØ…¦ê¤5r\\Ör­t§·[d9²TˆArÙ–pÒ^—4\\W}÷x¤²^=%P\$	Ğš&‡B˜¦@ch\\-½oX»c.¬¢‰ljÒ®Œ¼4Í£WÚ<Ô(ù`å•ßcÂ7@ã~pÕ;hğÚ¾\r’hÅ1’¢3ÉÒ ÕI£,ŒîÖ³º)7ˆyÒ 1¤£pÎÎ2H;,ÌPùøÍ´¯¼¶6\$½—ÎŒ¤¦›£˜á§(öx›`¯Yu…Á\nÁ|kĞ‹F§?Îè\n^&¾(fÿpšÅËÖú&í`Ê3¡Ğ:ƒ€æáxïÓ…Í¶~¨Ar43…ğc›AùÈÜ„J@|\$£ƒ/%Ã xŒ!öiD¸YŠ\"H½Vb¡àÀœŞ]¶0ğÓI\"M%\rã8Ş„Áê´ô4 C°4çA\0ïg\r”Ò¹C25%ÂƒÍÇ\"ƒ¨Æ˜ˆf¯ÄÓûÃ£\$9†–zAä”‡2^ˆ)½>†…b¤ƒĞú<‚V	Ğº„{\rø\$\0@\n\n@)#¤™?`Şny/\n ‚›36»Oò`8æŒààOéÿ@!É\nsHØ#?î}ùDH [ŠaJ%Ù)ÂTKN@C\naH#7Õ´uÖé¢~ÁÈ6À4€¹Aá¬Ö‡DFLI™5 G],ã\$}!±¸Aá¥‚	ŞH)ò\$H>·äà\\„&„)K³^H˜y1dœ4¡BĞ~z-”‚‡êf‰øf=„p ¨‚Üz¢!Èd€ù6ÊŒÊ ¤äµÖH†!XP	áL*7Ğ´ôƒQ×QÑìPÇÒ@Èàä*KŒ<ÉCDGR2…hm¡É°Æ¸Lù 6Émîµ°¦B` Ë8n‚¤.!hQ²~óåRJjaÈ™ºÖÚ¡ÔK\r'PÊ@Ğİ.¨Lo\$õ	•)AçúˆI…!‚‡bÿCÍR†xäf¡¨”v!N ú8»K/J%yÒB7I¤_0Š•¤ÅÿHé)Ál/ª@¢T!/i46°ÖN’Ô5/E ŸB°êoÈYF%áv<ÆâOË¬C\n¡P#ĞpËƒ:âH´ıOP¡„0Ó}€ZÊ/©Šî_U¨’†:o[‰\rp*ÉƒWCK€Mx¬Ò‚×3]QÛ#fÎ‚’ä]²o	µˆ3’Èm‰‹ã©¼)gÔƒš+U=C4NI¤XÎI£@­q£EºÕ™ÉÛRÉé%%á07Î23M\n4·†ØèDšBÖ‰¶8(Ğ!—`@kCÔ.j*ÃVµ)uk¨iS5ù0]»aÎ%‘k\n²@CáÓ†È–¼\"P’«,ÜĞBö°ÎYÖÕöFZï†0";break;case"sr":$g="ĞJ4‚í ¸4P-Ak	@ÁÚ6Š\r¢€h/`ãğP”\\33`¦‚†h¦¡ĞE¤¢¾†Cš©\\fÑLJâ°¦‚şe_¤‰ÙDåeh¦àRÆ‚ù ·hQæ	™”jQŸÍĞñ*µ1a1˜CV³9Ôæ%9¨P	u6ccšUãPùíº/œAèBÀPÀb2£a¸às\$_ÅàTù²úI0Œ.\"uÌZîH‘™-á0ÕƒAcYXZç5åV\$Q´4«YŒiq—ÌÂc9m:¡MçQ Âv2ˆ\rÆñÀäi;M†S9”æ :q§!„éÁ:\r<ó¡„ÅËµÉ«èx­b¾˜’xš>Dšq„M«÷|];Ù´RT‰R×Ò”=q0ø!/kVÖ è‚NÚ)\nSü)·ãHÜ3¤<Å‰ÓšÚÆ¨2EÒH•2	»è×Š£pÖáãp@2CŞ9(B#¬ï#›‚2\rîs„7‰¦8Frác¼f2-dâš“²EâšD°ÌN·¡+1 –³¥ê§ˆ\"¬…&,ën² kBÖ€«ëÂÅ4 Š;XM ‰ò`ú&	Épµ”I‘u2QÜÈ§sÖ²>èk%;+\ry H±SÊI6!,¥ª,RÆÕ¶”ÆŒ#Lq NSFl\$„šd§@ä0¼–\0P’7ÃØ4Œ‰`àAfcÊ2£pè4ÖÃšÖQÓOÒ\$Û½t«B«K!|ø5HrH¥)Ñl¸¤„ı^œÌÕA Q1O;å:Üo­Ì¢6Ê]w\\-rÏ(¨`{ ŒûÏ2ßw½üœ,2I.\$‹˜¡pHáÁŠ×q?5r0Î–w3>É(&2–¿ÆƒRš(	µOĞjCöóÕ7NLh×1 ™æ	½É\n±Œë>Ö2)!*‚…ÓªÜDL©!=-¨iB#’–W0“Û°æP˜Cjú¨×ß‹« ò®(\"Æ]è:Ô5,/+¤ì Ój`:¶ö¦‹¦¿°ìú\"Äˆ\"»vĞ¶–»f³³â–ŸîšÈ³oZZÚ Iã:ZB@	¢ht)Š`PÉ&\r£h\\-=ò.´YÍñSd¸˜î Pˆí»ÎX@´WÕí‹Ø¸=¥Ú£Ã®7cHßà-jT¬·C`è97-Ø@0ØUğÌ3VãpÊğ©Ää‹èÒİaƒ~¬1Øğ› â8ÎC”æXn,Šç»qüƒ[\rƒxïa¨MBxŸ5Úº“Å£ß6å­•¡¥äDMaC+‘,“W›Ù!‹±B.EÙ Cn1¥aÆÔruÕêGi%%¢ğğJÂI€€z°ƒ0=A :@àÁĞ/áŞàÂjF\0¹†p^±b;¾X¯á‚ğDZğI\r¡Àå†ÕŠà/ ùÙœø¬vCz¹: €6†ÖpCJFF•ë,dšÊ[QtU‰<ŠgŒLO‹ª\"ğ?ˆ2T<,Ø‡ ¨a|	s”\0b8!Ádg•ÈaĞ!0Æsƒ˜f²Aú†t\$\$qÙ: ‘¬°!TWY±e>Sm3«€hHL’áKén\r@0©Òé7 €(€¡.ÜºN½ÄMî¥Oi>K²D=ãƒšG“à‚S˜Ğƒ€uHÉ!%%rÎĞc\r4†xi\$NÄ¬a„:£¢ÖQgTéÍ„0¦‚2S€\r…Šd4PËwkPl©‘ÊEábj”Ò•ô=0›)£¬Ò-“:ArıR'¾kÂ¤4J¡cPÓ-±CBAqN ÉE•Š¿ÛºjVD„<¼àÈ®’º\rÑˆíõ„C©ÎH!™Ğ@bBW³™7ê¥[ñHç6›:|”DÌ	áL*LY¤.›\r9])bhÈ#GII7¢Nª·­ŠwÙJ¨ÔY*RZ¨T\n)ÂôhÑs%k›12V,š’Ô3Y“úŠ§Ñt¡£y>ÑqÓ~°ıçÉê˜Q	€€3>°@rapF\n“<0Ô¹ÉÒ,äªuU]%xxS)Xk´„‰b«ÈŒÉ7–à”{‡5L‘¤?†šåŠšš¥Ä6µÕ2”%ø¼×-Ï&ª1Œ“÷L›[m¼¸ıDï*Î½\röõKÂ‚n%ä-×œÆ” †òÃ`+,”ì™¦'ak5‡.Ä2?¸;¢¶i•A×Ùúd”äEÁT*`Zxnq…	{¼®l4\r!ç•9*bªß±F	€íç*|±²˜	<Ûâª{‹qº¡ŸäÔÒ”èêW–Ä€tôpÍ˜¶vAH¨\n	¸3“]\\zùËhh4|Ğæ5l™i\\ˆğœLËyg9'œÔ¼K¦Çv!¬µDWqJEåªVæÕ.×2Ì+yárç£Ò¥X¹ò18ƒJò¬F€¦UxéQv™HaÆ3õc!a§qÚñV!L2œ·È°Ô™å'Ôî¹ …Š‘O5sY\r\nk±‹Tñæ\0Öârk:4˜’'İ„××0 Ô,";break;case"sv":$g="ÃB„C¨€æÃRÌ§!ø(J.™ À¢!”è 3°Ô°#I¸èeL†A²Dd0ˆ§€€Ìi6MÂàQ!†¶3œÎ’“¤ÀÙ:¥3£yÊbkB BS™\nhF˜L¥ÑÓqÌAÍ€¡€Äd3\rFÃqÀät7›ATSI:a6‰&ã<ğÂb2›&')¡HÊd¶ÂÌ7#q˜ßuÂ]D).hD‚š1Ë¤¤àr4ª6è\\ºo0\"ò³„¢?ŒÔ¡îñz™M\nggµÌf‰uéRh¤<#•ÿŒmõ­äw\rŠ7B'[m¦0ä\n*JL[îN^4kMÇhA¸È\n'šü±s5ç¡»˜Nu)ÔÜÈjÎÖ\$õ·ÌÜ¢Œ‰ ¬òŒÜ¼o*H©#²¦Ÿ”2òùJ@¦)êŒ—Ê«¿Œ)›’:O*êë¼O\$\"”C ò8!`Pœ:£lb\"41£rİµ£KÎ!#ªPé! ì…¼8Ê´¢ÌÃ;.ò…ÈèŠn(È™'«€æ¾¸Ã;â¼0LVÉ¨ChÜ	‰»ı\0MŒ;B‚6Ä2â®7\r“ÜŒñòƒ/\0J’CÊ>Ğá`PÔÁÃ(ÔˆZtØjä¦ïo*®d†ìÑÎà¦ß0@P„2Œñ,\"9Ïë a£¢2RO<R\r”¸‹<&\0P”³Z5µr`0Œê+’5#ÖÁÑ£-ˆ6’1@¬Ò.9Ú–³BQ]·n²tuÂ4Üw-¯-¦ƒpêš‰Ğš&‡B˜¦8òÆ¡jFWö\nøDq2C)ò½ Ò*.8#Pº­‰³¸Šz½!<Å	ƒJˆëÔÎ» ¤×ÈÌ3@´«e*F\"dä”²Ä9™Íj3Ç«Ğ@Ë³,ØÒÁKz}vµÖ‚Ÿ”¨øè§³á\0Ú2º¶M76’Ï¹~É…Œñl9 å²‘7#l.’\r¨îstÚ®¯d±[ˆç®kÉÁ?P&Í´T*¾G¶íúÕìÓ±è+Y{%C¦ÂºÀ.HË½#|o\$©¸àÑ›,U>mœšRğÍŠj:Ã¨ÈşMõê-v Oç?È…Á\0x”(Ì„CCD8aĞ^şH\\‘n4ªø¢Œázeéú«ÌÁxD¦ÂHÚ8&1²<ÁxÂcX”-	 Íª´(º3³¥2Ş/;Ï(ódÒ7Ü¦æÑnäè%PÆ)4W\nè¥%´ËJ64	œ¾÷èÆÃ1§}D•®¯4öäÙûV/êºtøà s4…º˜ãìØúdF\$” ÓR€H\n\0¶²ËI‡Ø«‚˜\nYa†*ìº RêcİšCÄX‹£bôˆYâĞ*îtş“\$\0E0!D]k x\r\rSágî¨'–åL[A\0C\naH#CÀŞB‰˜ \nkÈ”˜`äCª8¤]BlN˜ ^ÈÔÎÃÖ¢…ŸzÀ\"æ±QµÈf³¹Wî‘Ãš±l˜Ñ4	í¸‚'²>A£ãI*PX9e]PÚÈ@á2<Ó:AÅ( Œ¤‚ŸT\"b rİ5Í\"hxS\nŒø sY+\"Ew!4®GêìØá“Ò€¦0`ÒqCY=HíLŠYvI‰8%m“Ç ¢i/[†h”„`¨ÙÍ{ê°Ô?b],’˜rJ¨ˆ\" pæ¡]¡­ZÀ«´ZM(*„)qÃ~l”+s“XÚQrI(=]«¢Ã?EIèQ´„Î¹ÊH¸œ(^€(!¢@Ø\nÃZ\\Í\rŒÅ@@Š“ş~,°óOÒ,†X¤”ñ-…P©AÄñ(©âr(ÓIàiŸh´ÁQuÒbÌlÚ]µh8OÃB—ÀPK¨JS@R°K±¯&+(BTS•*!K`(¿b{\0NºZ8æ\r ¤>`˜…(@7GŠ„p©E?µ6rS˜Y;²³¤ë…9Š¦!:&¥ä”œXT©	£õ€2Uú®ŒB±p<á->” CÅe«‡!ï[£Nmœ)¦tô*¹#³\\«åaVõÔ2„\\\0";break;case"ta":$g="àW* øiÀ¯FÁ\\Hd_†«•Ğô+ÁBQpÌÌ 9‚¢Ğt\\U„«¤êô@‚W¡à(<É\\±”@1	| @(:œ\r†ó	S.WA•èhtå]†R&Êùœñ\\µÌéÓI`ºD®JÉ\$Ôé:º®TÏ X’³`«*ªÉúrj1k€,êÕ…z@%9«Ò5|–Udƒß jä¦¸ˆ¯CˆÈf4†ãÍ~ùL›âg²Éù”Úp:E5ûe&­Ö@.•î¬£ƒËqu­¢»ƒW[•è¬\"¿+@ñm´î\0µ«,-ô­Ò»[Ü×‹&ó¨€Ğa;Dãx€àr4&Ã)œÊs<´!„éâ:\r?¡„Äö8\nRl‰¬Êü¬Î[zR.ì<›ªË\nú¤8N\"ÀÑ0íêä†AN¬*ÚÃ…q`½Ã	&°BÎá%0dB•‘ªBÊ³­(BÖ¶nK‚æ*Îªä9QÜÄB›À4Ã:¾ä”ÂNr\$ƒÂÅ¢¯‘)2¬ª0©\n*Ã[È;Á\0Ê9Cxä¯³ü0oÈ7½ïŞ:\$\ná5O„à9óPÈàEÈŠ ˆ¯ŒR’ƒ´äZÄ©’\0éBnzŞéAêÄ¥¬J<>ãpæ4ãr€K)T¶±Bğ|%(D‹ëFF¸“\r,t©]T–jrõ¹°¢«DÉø¦:=KW-D4:\0´•È©]_¢4¤bçÂ-Ê,«W¨B¾G \rÃz‹Ä6ìO&ËrÌ¤Ê²pŞİñÕŠ€I‰´GÄÎ=´´:2½éF6JrùZÒ{<¹­î„CM,ös|Ÿ8Ê7£-ÕBHÜ;#`Ò2\$;Â9P@1C(È2Ã Ót\$© ×u¥^ÄIC-ªÖ†o~ÆÁ@«8VZá“õŒt¥%*T,Ø_õ‘]+%’].«I‘m‡|\"–Ú£¨ÇZ¡‡iUõ©]XlTÒ‘Ök\r¢+¤\näÎÆW6dhºFWŞó€êW\"#sCËŞ<€PH…á gÆ†*û„›G6ú\0L©Ë\r¢¦Óq.u¨ÉĞ½Ç\"-ºÚ#yÁË=0_àñ\rïÓ±ìP¥ì‘¡!^Ø ‚à\n?)ó­éR«Ë«_ßµ±®İØÇV…­³àÇİ•×ï·ÃóäYğÇ±Ùo‘W»áx7lµŞO¼².8C{¤ØH]½î¾h§xqŠŞ®ß=Æ·CêjM¼¸¾ÆSŸ\"0àg¾•PÁÍA \$ šAĞS\n`(2@^Ch/aæºä‰¶Èy³“z¢JAJQ¬è\"³ü{ùğdÌ²%<É”ğeT±QªVbÎà;ï-ì8ØÅÙİ,¥’†`ÌÇƒpe8(ˆ‹B¬æëM‘&vŒgŞÚK„Ùx€ †©bÈceÉ\$øSÎzOYíeG™>ö“Ã(aİ•ã<ïWy)'\n¹Ó …¤£ŠDhZq.È¶×]ò‘\$éù;3@-ÙëèsKHš9²®d¤¦sBşH–öşŞ%A}Ë°ƒºÄJQÊ³)	1°¯¶¢U™^	©Àû²DüÔ‚LÁà8–R Á\0<'y”†`zƒ@tÀ9ƒ ^Ã¼áÅ6¤„Î“Pgì²uÄ5D©p/F\0“N{«-€¼0ƒèr©ù\rì€ùP\0ÂÏiO©œ6†²ËP½”…­q\\h*“iEIÚ‘^×ˆŒi4¾inà‘(+ÁP4 Ã§€ ç¬6\0Äxƒ‚gÉ©Š²\0Â¦*yaŒ÷‡0Ìi©Cé\"™P Ğ|ii ,U“ÌöXË™„[Rì%Hˆ„¨C›ÔRE ”*s¬oq¹\0((€ R(Ä*îî¹ ÷V¥œ\0h&³szoÀU,Lô\$øM0æŸª  ©‡æ„†ààSêP!Ésôê|åóf›Š¢ÃuN%x!…0¤ŠA³0Ô}£À§Ñ«AZ”Ë0…3,Ty¤4rÚ9äl^+\$€Ê\"ß+CcpW”¨UÎf¡§İ.i­m4f7Ì#\nB¶W\$¥ ZØÒıíø®\\T§‹–èíÒSI¤êæİËˆ´t«6»Çhï’SÄ½wåã.¯İø:·H·½¦syÕƒ¸¥x\$‘ğòw\0dcò†ê~ƒ)!Ô÷§€ÌšCh !’rÅ–Ic(c(iÆ¨Gôü{,î	œ¹×%4@'…0¨…!Kxä\"Yß:=\nˆ‰»(aw·{Y¦ê¢Æ´Æ•Wã~‚Ø€öİ®Ë¶İ‰øcT¡˜4†pêµ1ÂL¦˜Ì”›B)©\"cµ„-e(%¢‚	¦³( \naD&ÉTÓÁR·Ğæ@M:|±X{2äÈÎl}hi€®·@“î¢½Ñ&èeq¦T›Ôw[O!”tsrû©Ô{Q]W©oŒU¦á\\ì·+@I>á¶³ x\\”.b/¸zŞø ­NFß®š×º¯NÊÉ'‚Ä}Íİ¬ãe‚ı\nFÒyzûVc:õE³†Ø‘[j\$íÄyE…¤Y°â ÒÃ[%L³MÌ9h\r!˜<é2¼£Í\0´Iâ›Ø¤ÊB F á3ìÅ„’I^|2×:Ôõ	Ú!Éè–ål	ìÃtØ®õGQİbÜ6d°ÔÏÏÅÍRƒÎ¦¡\\Ôs9Ñç3ÉŒbäéó•ß~ZSïn¶oõ~Ã€ FH\\2û»xJa…ö†fõCËF¤Ü›V\nAùU‡µP›À¸!_‘ŸçW²±\$ÄK³:#¬\rÎÁ@R¡³4ÄfŒ‡İR&Ûtà ÕÛĞK;Øx'Wtš²Cbf~—×JL¾üUà:ª§˜_‹WvMÄíÙÂˆÈjjNI»Òút’ºVOî{P›6îA)£—¾»•LsáÇ`¯š¯ŞpnwZZ¼{/kG	dreI/ ä’OÂC‹-Gî­±r|Gjîœúô~\rsĞ´)ïÿWåÌÌ`Oí¼Ÿ7ßsä‰(¸ò¿øñÂ\"zÇZùoù®îg@";break;case"th":$g="à\\! ˆMÀ¹@À0tD\0†Â \nX:&\0§€*à\n8Ş\0­	EÃ30‚/\0ZB (^\0µAàK…2\0ª•À&«‰bâ8¸KGàn‚ŒÄà	I”?J\\£)«Šbå.˜®)ˆ\\ò—S§®\"•¼s\0CÙWJ¤¶_6\\+eV¸6r¸JÃ©5kÒá´]ë³8õÄ@%9«9ªæ4·®fv2° #!˜Ğj65˜Æ:ïi\\ (µzÊ³y¾W eÂj‡\0MLrS«‚{q\0¼×§Ú|\\Iq	¾në[­Rã|¸”é¦›©7;ZÁá4	=j„¸´Ş.óùê°Y7Dƒ	ØÊ 7Ä‘¤ìi6LæS˜€èù£€È0xè4\r/èè0ŒOËÚ¶í‘p—²\0@«-±p¢BP¤,ã»JQpXD1’™«jCb¹2ÂÎ±;èó¤…—\$3€¸\$\rü6¹ÃĞ¼J±¶+šçº.º6»”Qó„Ÿ¨1ÚÚå`P¦ö#pÎ¬¢ª²P.åJVİ!ëó\0ğ0@Pª7\roˆî7(ä9\rã’°\"@`Â9½ã Şş>xèpá8Ïã„î9óˆÉ»iúØƒ+ÅÌÂ¿¶)Ã¤Œ6MJÔŸ¥1lY\$ºO*U @¤ÅÅ,ÇÓ£šœ8nƒx\\5²T(¢6/\n5’Œ8ç» ©BNÍH\\I1rlãH¼àÃ”ÄY;rò|¬¨ÕŒIMä&€‹3I £hğ§¤Ë_ÈQÒB1£·,Ûnm1,µÈ;›,«dƒµE„;˜€&iüdÇà(UZÙb­§©!N’ P’7ÃØ4Œ”Ü÷AâcÊ2£pè4ãUú³pÙNK¶ä\"ÎUßr£±ÅÁq94œÇt!JÊ]Ã•…ÃPè7Ö1§µ‚Îé'ñ\$!-\"\nıh€rRz[‘Si¦çŒ~£CN³*©œ£#¸VK·­¯µÛ¬ãªœ4—* PòşOˆ¡xHğAŠ²6*íw|Ûë¤Lí£N–7:UbìÙ`\\k+lÊêüä•ŠÊ™Ñ[Ší:®íèŞ,°±d0ïØÎjvÊ«8gf\\hî¼ºŠu‡«½V´+.Ãº®,maÕ2l^íøó'›ë¹œÆSÙîúº®ØÄH\$	Ğš&‡B˜§xIÊì)c-Óö(P^-µeÁj.õùÏ°ÒÖ9;Eâ”DƒÊ¾dL…”ÀƒŞb \\\n¡á†àæC|Aç‘Rµ§\\ rG õLÈƒ0fca¸2œSš\"ÊÜZI¼÷dÕN \rI\r‡a`ceiXÿ#è}ÁúdçÍBÔŸSû\r¼;²r°VQd7t\$ö\"6Èå‰û˜Y(i®E>ŞÙX\ngòÁ•RÜš²,'«\$‚,Ç¶ªbê'-u¦¦Ø¡Ü_\\ğŞ\$XæÛ6êä¬ÔîY\n†j!E&ĞğK&Q`€ÖÉƒ0=A :@àÁĞ/áŞVàÂjUMÀ¹8†p^Êe¼e1´7ğDbğI\r¡Àü†ÖRà/ úLdØéÿ´0†³ŞT*nš±•=ÕjjÙS¥UŸ+“#\\“ƒ¸¬@Ğ{ÃB`€;Ÿ€Øï	¸3'ŒÇCf’\n\0:†0Ç0uñL3¥Yé6Aşê\0000ÌfI&¦;,\rŒ¸ÆÔtõUk–V\np< t–\nª.…nR2P¬ÊÛ@\$\0@\n@)U/¼¸+zNÛÜk™Í.’¦UJ¸\nÉºkŸÙ<Ô59ÍpÜª…Pê\$91Ğî‚–!RO„\rDÃa©â0FØÁÎúºVqÌ0¦‚1&9GX€=\$”l#1hU/Tğ»÷¯\0Š‚a·¢ÛÂçAæ=Î•ÚCJ–SÖV±ÓÓ4XTêY*«ÒØ]°±KŒæ·WdzR)—Ò‡h…ÕñX	\$”<@äPcÁºh ƒúÉƒˆu?‰ü3'\0Ú°–L†ª¦ÀÇÓÅ‰êı û‹,C›§‡JÂ9k\rOìi[+¤ör‘p]2ÜµÄ)T“;eO«›lÕêÚ+*PQ.w²£¦;Æ\" UntVa\\óÂëUŠĞgõ¹P{}ZSbŠr¼IàÄC<è\n!0h’¼ÁR›‰Tæ„ªw2ç1àäÈ ÚHƒÊÆ¿Xä²m£±±{‹bÈ#¥²£œÔs69¸d‚°	|m‘ÏŠ7¢¸‘5ıH²íd, şZ©ÉM¸ñ×Ü°vİ;Yu4½	a¹—ryYÍÖ†ÀWuÃHc\rwğ€úàóN34*emÄÒ°±8m­iş|Õ4ØB F á6†àÇ4¨g+\0•ºœdš¦1éÛ+¹¨æŞxÑ—©5|³¡%æe¸ìùÛ85Qª‚n˜Áåä—sÚ•a¸)LjÅ`çNz+¢`ƒˆÃtÌ×(LàØ¥•:x\\@Œ¯[A°¬øs™ÍŒä	ÂˆŸ„BZ¿¢*V`oÃµ8§”ê·Œ¯Ó%e]£F¾–ƒ`qÎ•¶)‚vÌ &œÛy˜\\\nt¤OÌBdåe\n9Ø`lE™Y¼¯]ÙGyšc‡Ln*=¦»¬ò›ÈFú´á9=<EÀP";break;case"tr":$g="E6šMÂ	Îi=ÁBQpÌÌ 9‚ˆ†ó™äÂ 3°ÖÆã!”äi6`'“yÈ\\\nb,P!Ú= 2ÀÌ‘H°€Äo<N‡XƒbnŸ§Â)Ì…'‰ÅbæÓ)ØÇ:GX‰ùœ@\nFC1 Ôl7ASv*|%4š F`(¨a1\râ	!®Ã^¦2Q×|%˜O3ã¥Ğßv§‡K…Ês¼ŒfSd†˜kXjyaäÊt5ÁÏXlFó:´Ú‰i–£x½²Æ\\õFša6ˆ3ú¬²]7›F	¸Óº¿™AE=é”É 4É\\¹KªK:åL&àQTÜk7Îğ8ñÊKH0ãFºfe9ˆ<8S™Ôàp’áNÃ™ŞJ2\$ê(@:NØèŸ\rƒ\n„ŸŒÚl4£î0@5»0J€Ÿ©	¢/‰Š¦©ã¢„îS°íBã†:/’B¹l-ĞPÒ45¡\n6»iA`ĞƒH ª`P2ê`é	#pì¶\r#\" %Ã@’„äç&# Ò¶kºò½¶ƒHÇ!Dğ²} P¡\rğL\r++˜¸ãCÒ ÎBÌñ	ÆE‹RÊOXò:4\"lÁ5*kw=0e‹¦ÁpHRÁŒ†áCC4SŒP‚è#®¢Ú)¨+`Â	ƒJÔ¥++,åŒ¬Úú¿›##Hâ<˜µNê¾¹.˜^£®2×£È#vJ@ç…ÔL¤0µ–esg£6Š^6Z€RËW9îX¦‚ t9¢\"Øów\"èZ0Œ!hÎ3B²_)ÖÂ Ò9±­t,&8\nˆøËÊ<C£ràÌ5eÿÅàPÙ%F¦£ãhÈŸ,©ğæŸBãÒN)£pê§ã\$:|5ä0‚<ÁcÙ—ŠÖ©ÂĞ9bù0ìdÈ¾vOÂÑâj„%’ª@‘¼ùkÃõÊéØä:·#76ÃrDø8è°ácå«E Ò5¢ã›‚á„èÖáÊÈîÄ<´I8Ÿ­k”ZË'ÃÎ±¹6NŞÓ¿p\rÈçìŠŒâ2¡`@6/ ÍnÛÂ1:,« Ã³ÃŠ\\c4¶ã |yy- Ü•À:…Áœ–3d®6G™O¥â.4Kc0z\r è8aĞ^şˆ]l ;L’Œázcía‰7áŠ@JbgÊeAà^0‡Ğœ*íäœ`ë­·(ít2ªn;>â÷qçpÚI2>VD‰Ë\$.„ÕrA3\n„6r`GÜ1®=n\r¸b.Üh kÂ´2óë[™D¡ÈÍ†S’YRñ\$&L5Â’NP(ngÆ‰ìH[\n (ˆp—‘yo@€PRñ›T\$}”â TŠ l\$áP4+ó2|[‰û2fd‡H«P?k°ÿ\$¤ÔğcG3¼’lk¢ñ®fÁÔö’t	C‘4` !…0¤¢8j3ë	Ú„bJL\\&sÄírRJÈN‡èµV®EÕS­P.ú\r2b¸	óµ	eÍ4ôABH)Ÿ4BNb¢º € †GªG<C[ªø9>c¢{N1£Dñ€–ª¤TûgÁ¸“±¦¦‹Ày/`(ğ¦\ri ÎY§7È4X»\$tED‹ #‚‹¢½#È”ƒ! êC;)wh(â:'H… ñA*CÙ;ÚÄĞ“H^@µDÂˆLrE*NPC’g b¢7çÕ•ô@Ôù®8†0áÑòßMâ‘>‡@’NiŒ!†HÊC…ÃJ\n94•\0¥&áHÑ &ÑkA£YMéKû§k„!*)Q\"‚uğ¤Ë™“6K\r/l@€!¤°Ø\nÙñP30‰! @B F á	†ğÈ‚]ë\$A¯õ›‹MT8£12¸I>âéêØ3õÆ”×3]P\\ mHÔ¸—3ÛSÍšå•DÙ ƒ8é)H%• à,a|àO¯º“\n…MxÊÌ¶5Ï3\"d…\r\n\"‰ôÛSÓTjÍa§Nš\n_ÌÓ‡D’£ŒªÜAn/9a+ePy§êÔ…5jgh\ráÀ‹' ˆÌk´´…¨Ğ”ÇƒnÙÓ-ö¡Ö»k=,!r¤&¡Ü'^^\r³ù´È";break;case"uk":$g="ĞI4‚É ¿h-`­ì&ÑKÁBQpÌÌ 9‚š	Ørñ ¾h-š¸-}[´¹Zõ¢‚•H`Rø¢„˜®dbèÒrbºh d±éZí¢Œ†Gà‹Hü¢ƒ Í\rõMs6@Se+ÈƒE6œJçTd€Jsh\$g\$æG†­fÉj> ”CˆÈf4†ãÌj¾¯SdRêBû\rh¡åSEÕ6\rVG!TI´ÂV±‘ÌĞÔ{Z‚L•¬éòÊ”i%QÏB×ØÜvUXh£ÚÊZk€Àé7*¦M)4â/ñ55”CBµh¥à´¹æ	 †È ÒHT6\\›hîœt¾vc ’lüV¾–ƒ¡Y…j¦ˆ×¶‰øÔ®pNUf@¦;I“fù«\r:bÕib’ï¾¦ƒÜü’jˆ iš%l»ôh%.Ê\n§Á°{à™;¨y×\$­CC Ië,•#DôÄ–\r£5·ĞŠX?ŠjªĞ²¥‚ÖH¦)Lxİ¦(kfB®Køç‰{–ª)æ‰)Æ¯óªFHm\\¢F ‰\$j¡H!d*’²¬B²ÙÂéƒ´Õ—.C¯\$.)D\næ‰™ÄlbÌ9­kjÄ·«ª\\»´­ÌÊ¾†D’¡Òå¶\rZ\rîqdéš…1#D£&Ï?l‹&@Ô1Á M1Ä\\÷¡É`hr@:¼®ÄâHÜ;#`Ò2#(ä;XÁ\0Ş9ä2Œƒ(Ü:\r6\r\04ÈTT MÊò4M2]+ÒìŠ4O²rÒŒF#EU8¾w:b^íÌ0ı.®„.ºÌÌ^«%	\" ¢v\$œ¥àHKƒ41…a˜EtßSpÁ ]#Iq,¨\\xøcy1CWŒFpL¾É¬P©ÅOKhPÜ2•ÉQÅ¦„dĞW\$ÜÔ5æ_«1­â\"…£hÂ4t¡µ*jI\0¤EDÿçeü•Ê+¥?œQ¤‹W©Éºå\nĞ¥ªVÍñÌ|ççäx\\­;”¤ìÚöĞ¤¤ûZËJ{¹¸î{¬²o\rŞÏ1o‹6ÃÕQÒ=Á±‹\\C•¡ I‡FKÏs¹¡B)… \\â—p·]`»¡–1¤7c@Pˆ4cÄ6³ı•fZ]×yßY}ğÊ<–æ4ãu®hf˜Éƒ å—ºé¾ö«^iX Ï~‡xg\$ÿÊ¨ÄuM»î¢N§MuW@;L—¶Wx›§<÷\nš\\[áìI\$Å(¦âÃP‹8}ğ\0ƒ3f“©ı)¢Å\n\nSRˆƒÄè˜’@ìPKä8ˆuÀWÖ„»&Ğ\\Ë¢²ìáN“ilĞƒµŒİàbH(°<›(%à¬?å>\r½áÓ‚rˆxæÂc\$¬T)mpXÙBä• 3nğ YÀ¤šB i1fPBAä`ÄDƒ‘Ä’aÛâ‰ÇİÅ%‰!ié!‡\0š¸ûájqOg¥;TØr(¸{Çİ}gøJÍé2EM1™™KŠL\r º¦Rl¹q:k©JM‹(z§¤A\\,±.–µ¬\ná¾¥,®TvªÍ„tK˜£	]ø „…è\"\rĞ:\0æx/óLÈCHnXÀ¹e†p^´¦ûÈyO07ğDYÁğĞ[1ˆç'˜Brà/ ø‚+‚hÓúf\"&	’ˆÌhaÂ~%÷˜u*oáC‘kêZ¶Èªw£)veh“74ZÎ9t—Ğ–¦r¦«T9¬>eF_¦õ/dü+©íEÙ\"«”Ò\\™²Ÿ!Oœ‰ ‚Ù9ƒœ«aiU:ÚD–´ng#2yOfÍ>”r4ošÂuC€€(€ jJzO„9?‚Î\ngÔü ©A)?T4_Rº”’LU\$\0¸Ûùq-b ¸=*¥ÚêB‰Y'¥§bo…Üú7J1UÏS“¨’ˆæÎI·ÊÑQ<¡.©*Â„0¦‚1æjµr\"‘ÆóVŠ1t­EÿW‰ö“œÀ·£A›¨º¡ĞÅ†’[®¶ğA\$¶7ªVMÖôÚjÈBJ‚Ô:ĞÌ\r&“\n§bäªLšş–ÓÑ]´eœµŠö/iä}ªT¡IHÄ„Ä1*ò=¿ 4ìf¼ÙX×4Ÿ¥8DxkD=êîY]x4ÔLnï†XKÇ×ª¢•P'…0¨Ë¤ˆ§I’æMhŠ==À%P‚öïsrëº8BM„²¼Ïºº+é\"¦å¸IL»¾¹gaí4ìÑ‡D®lBFAD¸Ø’*™ÈTz¿Ö‘A‹°@ÂˆL&Ñ>\0ŒæG‡8PgZ®™¼7 E6—HR„ø#¡*€D­é@vívY…ßD¢û1ŞRƒ™œ>J—×5æ×¤Yó¡¥é´˜º¸GÒîq}ålç@³\n¯#Òp­‹A0bpÜk~ÇOHh¼Ï£´.o¬IÊ†(OÖ\r€®åÜS*Æ¥#e`\$5Lgö4M«gš>áXªK”	nÈÍı\0•=\rœÜ¦Ån+,³ñ,¨TÀ´È¦ëMÒ:Yå²eMxşQ{iÍŒ@Üm–p¨æÕ7ÙUš¦ìw 6â»ÛÒGan•µ²´÷Üù±»ˆ6hhƒ)0vdh×èĞÁšf€˜òO`\$%Üé%ên‰KZB©R&rpqZ”Ï‰¾wÆ÷ñw[İ<cYhKëÆá±õ¸Kğ¥È~=&hÓœGhD9zIbØİ¸‘¡C|İmõH\$hÄgÆÒƒŒÂ0¡±”uî ˜.İI\rWtí@ºªŠ7ŠiØ9‡j4S˜•x+uáöå#W‡r&¦mÅ”h¨dûòıtØ±è4KØB‘¥…·û@]jë±@";break;case"vi":$g="Bp®”&á†³‚š *ó(J.™„0Q,ĞÃZŒâ¤)vƒ@Tf™\nípj£pº*ÃV˜ÍÃC`á]¦ÌrY<•#\$b\$L2–€@%9¥ÅIÄô×ŒÆÎ“„œ§4Ë…€¡€Äd3\rFÃqÀät9N1 QŠE3Ú¡±hÄj[—J;±ºŠo—ç\nÓ(©Ubµ´da¬®ÆIÂ¾Ri¦Då\0\0A)÷XŞ8@q:g!ÏC½_#yÃÌ¸™6:‚¶ëÑÚ‹Ì.—òŠšíK;×.ğ›­Àƒ}FÊÍ¼S06ÂÁ½†¡Œ÷\\İÅv¯ëàÄN5°ªn5›çx!”är7œ¥ÄC	ĞÂ1#˜Êõã(æÍã¢&:ƒóæ;¿#\"\\! %:8!KÚHÈ+°Úœ0RĞ7±®úwC(\$F]“áÒ]“+°æ0¡Ò9©jjP ˜eî„Fdš²c@êœãJ*Ì#ìÓŠX„\n\npEÉš44…K\nÁd‹Âñ”È@3Êè&È!\0Úï3ZŒì0ß9Ê¤ŒH	#pì0ƒHÈ‰¾Ã³ì?((ä2Œƒ(Ü:\r4xÏ)Z¬€•£ƒ\rK<©²pNÃæC:‰´Ä§ %Krb!¾Ã´È#Ê²ƒWVÂQÄ©¥>’MÜÃ1PKAŒCÈè2…˜R1ÀSF¨A b„°Óec¦5¸%û½°PÆœ3É†Q7.ë¾ô—EzP<:´Õhœi\$:BB‹,Ï1#¸2±Ud®¡¦IÁ`ƒÒ6LtñwPLì\$§>] UX˜`Y†T1B>,‡PhêmuHO1[#K«è	¢ht)Š`P¶<èÈº£hZ2€P±‚=l«.ÌB ÓŒCd¤Q–7?ú´w¬ëã(ñeÃ˜ÓRoæ\09ÅC@6-\0P²7³C\rDÃ57©tØPÌØIvSØñB:IFø1Ò°è7„€ä4»Z°ÏFr0|©ÁU\0006>tb\\Ğ s9†Z¢xr8¢¤Š|î½ C¾Íæ-[46E¡`@‹”s2:õw\nÇRÍXüŠ.]ACs*0¥Øü„ğĞPñép¡˜Ó‰Q@é»Jjw HPé~:w]äÍ[Õíb”x%R—EmOÕYgvêÁWÚZŠĞ¢Ã0=A :@àÁĞ/áŞàÂiÛ>À¸ü†p^£ »cQÍ™ğDRñ‡=DP“\"ˆöÁà/ ù’ĞÓ—:aci`4!tZñ‰\$/OÉB88KV\".1³@îÃÃay@aÀûcò\\ÀaË-­0êÃa˜:Ä—@š\"0i#¤Ñ£x ¢”bR\nH—B¢áÀºCI¸œ#fS© /…ÜPô.…º\n\n (EÂfˆğ—#ˆÍ!' R\nXh>È\rÎ0æ„bÈ ;q’MààP‚BÉA‡vc	 ˆg€‘*N4p€›òm\\àA2ĞPÂS\nAÔ†—ÊS2YWD¥9Ã¤  ÌÒ#B¬:ÉÂ‚\n™kë9epT–(.\0¡çæ\$(ĞT/'+é9¼¨dZqÅª?0€ĞäàÃ'ü\"\$H‚ƒÇ™\$f’\\Hyn‡­A9Õ™K1@ê,Ô dÁÓ0B	5¢:£ˆ+ @R¡.~Úr3\$…BXÂ€O\naPÓ‡Wfî	Ëû_Îõ3œF·É„&eDÜœ“³ŠOgyôúkR)d@ÃŒ\0;RLÍr;ŸÆ~rÇ~Gé!#'±N\"ì‚¤…9îÒaœ÷ Æ0¡\"qÕ¦vI¦k	µé÷›\\älÃ˜OÄ:WtÚtLLeÆ9¾h_:zbU#„ä:)H C-&±®G¸_é«³-	^Ö³”ó2>5i7¾^H±1©)T@ª0-ù!W¹¤	OY‘2t…™WÜãˆñ \r0öjE\\MŸP¼½3)5@PQ«	û’`rNXDTEôa¼‹<a,é±nÆYšÕfÅØ‹3eÚ´¦™`.u¼j\n±a4æ¦¥¹li-0¤à¨w…-ÈĞ·ñKI@æ@É'V0.ÄjÃ;œ‹Ï6”’ÅÒå</¯¿Cr*Rß\\7Æ·\\q”§©¥EV¡ØG’ŞS\0‘·84\0";break;case"zh":$g="æA*ês•\\šr¤îõâ|%ÌÂ:\$\nr.®„ö2Šr/d²È»[8Ğ S™8€r©!T¡\\¸s¦’I4¢b§r¬ñ•Ğ€Js!J¥“É:Ú2r«STâ¢”\n†Ìh5\rÇSRº9QÉ÷*-Y(eÈ—B†­+²¯Î…òFZI9PªYj^F•X9‘ªê¼Pæ¸ÜÜÉÔ¥2s&Ö’Eƒ¡~™Œª®·yc‘~¨¦#}K•r¶s®Ôûkõ|¿iµ-rÙÍ€Á)c(¸ÊC«İ¦#*ÛJ!A–R\nõk¡P€Œ/Wît¢¢ZœU9ÓêWJQ3ÓWãq¨*é'Os%îdbÊ¯C9Ô¿Mnr;NáPÁ)ÅÁZâ´'1Tœ¥‰*†J;’©§)nY5ªª®¨’ç9XS#%’ÊîœÄAns–%ÙÊO-ç30¥*\\OœÄ¹lt’å¢0]Œñ6r‘²Ê^’-‰8´å\0Jœ¤Ù|r—¥\$Ã°Â6\r# @9Œ£í.„xäcÊ2£pè4Êã˜\\¼¯kéÊL»ĞJ[¡\$jÒü?D\nÊLÅEé*ä>„	Ï@J8r—eÔ\\Ä±h|µR–LëI SA b@¥¤8s–’’N]œÄ\"†^‘§9zW,¥9vè%¤s]î‘AÉ±ÑÊEtIÌE•1j¨’IW)©i:R9TŒ¹DÕ2Ä%ªr‘ä‘?´™`@ÚV¢}Ü—1\0ş/9X*ğ\$Bhš\nb˜-8(ò.…ÃhÚƒ dYVeö,¥5î¨Ã˜A’ÈI_c8ÙKd0TCdA.ÑC`è9%¨	ÎSg9t_œ…ÑÆ“ŠPÎs­C­\n{š¦ìñ<sÅ,€XäIrÉg9VWÜ…¯CĞ2aHX¤dV.LC<C¦\$Ò•åºI‘1ÒI-„tèÙ^J±¤A!a“úáË¢*é	4éµ¾ÏíoöğF³œÂÛ¯»òıÂÅ—NêPx0„DÌ3¡Ğ:ƒ€æáxï×…ÃÈ6#tºLC8_4÷cÀé4cHŞ7á?Ù4J‡xÂd¤¶¦Y’©´Wg1`\\…É\nr‘„´6_§ICû»Ãq‹æú±¥iHsdmŒ ×ÌK¿‘Dü\0vÎèçbà„ˆÂr!­=I&7d)Ë¨Œ1¦DN,¤òËr‚¯¹BÀp@@Pcp].GÔ*`ˆ(ä0D˜Ò_™Á€îY>œ²æ‚Áá,ã˜PÇgá1£™Lqx¶E¢8Ã¥oÃ2Ö“E0È¸D\0†ÂFœR5\$JÜsyQk•sš1Ê#[áxØB¹²`Lš96'éa\\-T{xå(ÿQD'– c(lS!Ì'„á7¦B\r’N#‚³v©uxÆVÚ9…ˆ‚q­´Á4qŸ“æ£¤NŠ\"®xS\nŒlõ˜²b*‰ü|“‚G”\"ÄÌ[ïÇùÈGH…V*Ìr‰<.Å\$.@b<W’sÈ 8¿á*>HE?Eb,)…˜S	ñ¯‘ä¹Ÿ4é\n^8è>as\0Œaxs&dÍ‰aa;§„êFüÀ˜9ğ&År/¦-Ã™şADx—ié@XWêcDd¢<!²ğØoc:Lê°O‰B9DGânša\\|EÊ'¢Ør¾GÌ.ßú\n¡P#Ğpm„²}*ô¹™Ğ`Ü¡#¬AeŠ“¦¶±«¤âP\\°ñ2Tái¢Ìt(i‹S4àÜ˜\0@¹}\"L_4Ã„/êX¹¨ô€^!±(@½ˆfi´Ë…i k‰@Ì<PÊ9JwÉƒv%¢\$@3b\$ä:G§‚„F”.ÄYi…A §±xàËE?0‹äÑÃeLªv:U&¨ú•JB*E€";break;case"zh-tw":$g="ä^¨ê%Ó•\\šr¥ÑÎõâ|%ÌÂ:\$\ns¡.ešUÈ¸E9PK72©(æP¢h)Ê…@º:i	%“Êcè§Je åR)Ü«{º	Nd TâPˆ£\\ªÔÃ•8¨CˆÈf4†ãÌaS@/%Èäû•N‹¦¬’Ndâ%Ğ³C¹’É—B…Q+–¹Öê‡Bñ_MK,ª\$õÆçu»ŞowÔfš‚T9®WK´ÍÊW¹•ˆ§2mizX:P	—*‘½_/Ùg*eSLK¶Ûˆú™Î¹^9×HÌ\rºÛÕ7ºŒZz>‹ êÔ0)È¿Nï\nÙr!U=R\n¤ôÉÖ^¯ÜéJÅÑTçO©](ÅI–Ø^Ü«¥]EÌJ4\$yhr•ä2^?[ ô½eCr‘º^[#åk¢Ö‘g1'¤)ÌT'9jB)#›,§%')näªª»hV’èùdô=OaĞ@§IBO¤òàs¥Â¦K©¤¹Jºç12A\$±&ë8mQd€¨ÁlY»r—%ò\0JBHÜ;#`Ò2˜Ê9ÓX@7A\0Æ9£ Ê7ƒLÊ9…ÈÃÂ•ç)2¬¥Áft(t	KQÎL—iyJ¦–ÁÈ\\´}\"BÒnct”É6W!ó@Ä<ƒ(P9…*i1-’0!pHÖÁªšHŠàreÙÌBò¡Î^Ôˆ©vğ)¤q\$ı‘àRzŸ éq¤å¤@—Ñit‰ZH\$k`Î±|C9Të.¬'¤%Ğ—ä!ÊC—ItW_Wâ“4(d\rËs—e³,s‘åò¬¬	@t&‰¡Ğ¦)BØó\"è\\6¡pÈ2[vé&C¿\$Ê0S0lJÄA,r’¤ş\\¥f–_\rCôA¤\"¾«`è92åAÒM”L4rD3,r…Òè©PhÅ!}ßªŠ^˜¦mQFsÅ, XäIrÑ\$\$ùA…ÒôR2.Ñ#r	Ò@‘Ê4†‡D„t’\n©|F\$9t%4ND'äVm­ßŒ°¦2c˜Ò7Ü,W½‘ÒGÁ|iÔST–§xÑp<TYt’C\0!\0Ñ:ÁèD4ƒ à9‡Ax^;ùpÂ2\r£Hİ5…Ó€ÎÎş ñTÜ÷@„JP}Ôg‡)bJ‡xÂgd¶Öq&ƒg5+K§)Ks\\çµĞœ¥ür(@èB­š3cØ‰Åh¤CB4€+Ñ`!Ø{1r¢|€#QP9ÄÚB›a\$PĞšSMÈr¸±Ê'Å¹”adiğ¡Ô>ˆQ3‹\0]¥óş€E¡5D@\$`†É{>††‚”CJ'3!)ÈtìTj†bà@!ÎYÇ0 \0ÕÃ@:½Ê¼¡ˆåÚ€Ä¨GPq}ÁÊ&Ûy,#°JˆˆtS\nA@ŞÓ¹€u©Ö	‘xj‰‰~¢XWl[ã_&DĞ›\$1Ì+…ª@4¢ÁÑ9J	­A±ÔÑÊ\"…%6‚˜Aa<'1˜9flºÂQ<^cÎMj>Cˆb‚‡0±N‘.'h‰Ğ%P0a:(Œ°P	áL*RPQ@æ\0s6PÄ‹)f\"Y¿S)åK8‡DÈVbZbP¨3â½`!\0& F\n@’!g6‘è‹\naD&ƒ{-š£Vbyú§À©vŠ†\nçg\0 !ŞYÌÒšs¨TpÄœÚAEeTr¬×RuFgĞˆ1BôX‘>/Ñ8Œ\$\0G„6]::'<s	ò~k¥R2‡\\Wñr‰É3ıåAÀª0-›Eş}“„…QÈŒ‘²:ŞÙ3(¢L¥¢aSD ¹ZBd©aTC{ÓtMªÙŒ'@0ç@#Da3bDB@r.º™SÀ¼*J·æRx¬’’B«HP›'á(Œ:34¦ˆ‘\0g,\\®[T®k\n¿¢Ü³c R2F/Iu`_–å@©Â\\Uæ¹üÊñ_\"ğlki”“Uº¸”tğ";break;}$zg=array();foreach(explode("\n",lzw_decompress($g))as$X)$zg[]=(strpos($X,"\t")?explode("\t",$X):$X);return$zg;}if(!$zg){$zg=get_translations($ba);$_SESSION["translations"]=$zg;}if(extension_loaded('pdo')){class
Min_PDO{var$_result,$server_info,$affected_rows,$errno,$error,$pdo;function
__construct(){global$b;$Qe=array_search("SQL",$b->operators);if($Qe!==false)unset($b->operators[$Qe]);}function
dsn($Qb,$V,$E,$C=array()){$C[PDO::ATTR_ERRMODE]=PDO::ERRMODE_SILENT;$C[PDO::ATTR_STATEMENT_CLASS]=array('Min_PDOStatement');try{$this->pdo=new
PDO($Qb,$V,$E,$C);}catch(Exception$fc){auth_error(h($fc->getMessage()));}$this->server_info=@$this->pdo->getAttribute(PDO::ATTR_SERVER_VERSION);}function
quote($P){return$this->pdo->quote($P);}function
query($F,$Gg=false){$G=$this->pdo->query($F);$this->error="";if(!$G){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error=lang(21);return
false;}$this->store_result($G);return$G;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result($G=null){if(!$G){$G=$this->_result;if(!$G)return
false;}if($G->columnCount()){$G->num_rows=$G->rowCount();return$G;}$this->affected_rows=$G->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($F,$o=0){$G=$this->query($F);if(!$G)return
false;$I=$G->fetch();return$I[$o];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(PDO::FETCH_ASSOC);}function
fetch_row(){return$this->fetch(PDO::FETCH_NUM);}function
fetch_field(){$I=(object)$this->getColumnMeta($this->_offset++);$I->orgtable=$I->table;$I->orgname=$I->name;$I->charsetnr=(in_array("blob",(array)$I->flags)?63:0);return$I;}}}$Nb=array();function
add_driver($t,$B){global$Nb;$Nb[$t]=$B;}function
get_driver($t){global$Nb;return$Nb[$t];}class
Min_SQL{var$_conn;function
__construct($h){$this->_conn=$h;}function
select($Q,$K,$Z,$Lc,$we=array(),$y=1,$D=0,$Ve=false){global$b,$ud;$rd=(count($Lc)<count($K));$F=$b->selectQueryBuild($K,$Z,$Lc,$we,$y,$D);if(!$F)$F="SELECT".limit(($_GET["page"]!="last"&&$y!=""&&$Lc&&$rd&&$ud=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$K)."\nFROM ".table($Q),($Z?"\nWHERE ".implode(" AND ",$Z):"").($Lc&&$rd?"\nGROUP BY ".implode(", ",$Lc):"").($we?"\nORDER BY ".implode(", ",$we):""),($y!=""?+$y:null),($D?$y*$D:0),"\n");$Tf=microtime(true);$H=$this->_conn->query($F);if($Ve)echo$b->selectQuery($F,$Tf,!$H);return$H;}function
delete($Q,$bf,$y=0){$F="FROM ".table($Q);return
queries("DELETE".($y?limit1($Q,$F,$bf):" $F$bf"));}function
update($Q,$N,$bf,$y=0,$L="\n"){$Ug=array();foreach($N
as$x=>$X)$Ug[]="$x = $X";$F=table($Q)." SET$L".implode(",$L",$Ug);return
queries("UPDATE".($y?limit1($Q,$F,$bf,$L):" $F$bf"));}function
insert($Q,$N){return
queries("INSERT INTO ".table($Q).($N?" (".implode(", ",array_keys($N)).")\nVALUES (".implode(", ",$N).")":" DEFAULT VALUES"));}function
insertUpdate($Q,$J,$Te){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($F,$ng){}function
convertSearch($u,$X,$o){return$u;}function
value($X,$o){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$o):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($uf){return
q($uf);}function
warnings(){return'';}function
tableHelp($B){}}$Nb["sqlite"]="SQLite 3";$Nb["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($q){$this->_link=new
SQLite3($q);$Wg=$this->_link->version();$this->server_info=$Wg["versionString"];}function
query($F){$G=@$this->_link->query($F);$this->error="";if(!$G){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($G->numColumns())return
new
Min_Result($G);$this->affected_rows=$this->_link->changes();return
true;}function
quote($P){return(is_utf8($P)?"'".$this->_link->escapeString($P)."'":"x'".reset(unpack('H*',$P))."'");}function
store_result(){return$this->_result;}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->_result->fetchArray();return$I[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$e=$this->_offset++;$T=$this->_result->columnType($e);return(object)array("name"=>$this->_result->columnName($e),"type"=>$T,"charsetnr"=>($T==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($q){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($q);}function
query($F,$Gg=false){$Yd=($Gg?"unbufferedQuery":"query");$G=@$this->_link->$Yd($F,SQLITE_BOTH,$n);$this->error="";if(!$G){$this->error=$n;return
false;}elseif($G===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($G);}function
quote($P){return"'".sqlite_escape_string($P)."'";}function
store_result(){return$this->_result;}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->_result->fetch();return$I[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;if(method_exists($G,'numRows'))$this->num_rows=$G->numRows();}function
fetch_assoc(){$I=$this->_result->fetch(SQLITE_ASSOC);if(!$I)return
false;$H=array();foreach($I
as$x=>$X)$H[idf_unescape($x)]=$X;return$H;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$B=$this->_result->fieldName($this->_offset++);$Le='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Le\\.)?$Le\$~",$B,$_)){$Q=($_[3]!=""?$_[3]:idf_unescape($_[2]));$B=($_[5]!=""?$_[5]:idf_unescape($_[4]));}return(object)array("name"=>$B,"orgname"=>$B,"orgtable"=>$Q,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($q){$this->dsn(DRIVER.":$q","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($q){if(is_readable($q)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$q)?$q:dirname($_SERVER["SCRIPT_FILENAME"])."/$q")." AS a")){parent::__construct($q);$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return
true;}return
false;}function
multi_query($F){return$this->_result=$this->query($F);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$Te){$Ug=array();foreach($J
as$N)$Ug[]="(".implode(", ",$N).")";return
queries("REPLACE INTO ".table($Q)." (".implode(", ",array_keys(reset($J))).") VALUES\n".implode(",\n",$Ug));}function
tableHelp($B){if($B=="sqlite_sequence")return"fileformat2.html#seqtab";if($B=="sqlite_master")return"fileformat2.html#$B";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;list(,,$E)=$b->credentials();if($E!="")return
lang(22);return
new
Min_DB;}function
get_databases(){return
array();}function
limit($F,$Z,$y,$ke=0,$L=" "){return" $F$Z".($y!==null?$L."LIMIT $y".($ke?" OFFSET $ke":""):"");}function
limit1($Q,$F,$Z,$L="\n"){global$h;return(preg_match('~^INTO~',$F)||$h->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($F,$Z,1,0,$L):" $F WHERE rowid = (SELECT rowid FROM ".table($Q).$Z.$L."LIMIT 1)");}function
db_collation($l,$bb){global$h;return$h->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($k){return
array();}function
table_status($B=""){global$h;$H=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($B!=""?"AND name = ".q($B):"ORDER BY name"))as$I){$I["Rows"]=$h->result("SELECT COUNT(*) FROM ".idf_escape($I["Name"]));$H[$I["Name"]]=$I;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$I)$H[$I["name"]]["Auto_increment"]=$I["seq"];return($B!=""?$H[$B]:$H);}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){global$h;return!$h->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($Q){global$h;$H=array();$Te="";foreach(get_rows("PRAGMA table_info(".table($Q).")")as$I){$B=$I["name"];$T=strtolower($I["type"]);$Cb=$I["dflt_value"];$H[$B]=array("field"=>$B,"type"=>(preg_match('~int~i',$T)?"integer":(preg_match('~char|clob|text~i',$T)?"text":(preg_match('~blob~i',$T)?"blob":(preg_match('~real|floa|doub~i',$T)?"real":"numeric")))),"full_type"=>$T,"default"=>(preg_match("~'(.*)'~",$Cb,$_)?str_replace("''","'",$_[1]):($Cb=="NULL"?null:$Cb)),"null"=>!$I["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$I["pk"],);if($I["pk"]){if($Te!="")$H[$Te]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$T))$H[$B]["auto_increment"]=true;$Te=$B;}}$Qf=$h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Qf,$A,PREG_SET_ORDER);foreach($A
as$_){$B=str_replace('""','"',preg_replace('~^"|"$~','',$_[1]));if($H[$B])$H[$B]["collation"]=trim($_[3],"'");}return$H;}function
indexes($Q,$i=null){global$h;if(!is_object($i))$i=$h;$H=array();$Qf=$i->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Qf,$_)){$H[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$_[1],$A,PREG_SET_ORDER);foreach($A
as$_){$H[""]["columns"][]=idf_unescape($_[2]).$_[4];$H[""]["descs"][]=(preg_match('~DESC~i',$_[5])?'1':null);}}if(!$H){foreach(fields($Q)as$B=>$o){if($o["primary"])$H[""]=array("type"=>"PRIMARY","columns"=>array($B),"lengths"=>array(),"descs"=>array(null));}}$Rf=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($Q),$i);foreach(get_rows("PRAGMA index_list(".table($Q).")",$i)as$I){$B=$I["name"];$v=array("type"=>($I["unique"]?"UNIQUE":"INDEX"));$v["lengths"]=array();$v["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($B).")",$i)as$tf){$v["columns"][]=$tf["name"];$v["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($B).' ON '.idf_escape($Q),'~').' \((.*)\)$~i',$Rf[$B],$hf)){preg_match_all('/("[^"]*+")+( DESC)?/',$hf[2],$A);foreach($A[2]as$x=>$X){if($X)$v["descs"][$x]='1';}}if(!$H[""]||$v["type"]!="UNIQUE"||$v["columns"]!=$H[""]["columns"]||$v["descs"]!=$H[""]["descs"]||!preg_match("~^sqlite_~",$B))$H[$B]=$v;}return$H;}function
foreign_keys($Q){$H=array();foreach(get_rows("PRAGMA foreign_key_list(".table($Q).")")as$I){$Ec=&$H[$I["id"]];if(!$Ec)$Ec=$I;$Ec["source"][]=$I["from"];$Ec["target"][]=$I["to"];}return$H;}function
view($B){global$h;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$h->result("SELECT sql FROM sqlite_master WHERE name = ".q($B))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($l){return
false;}function
error(){global$h;return
h($h->error);}function
check_sqlite_name($B){global$h;$lc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($lc)\$~",$B)){$h->error=lang(23,str_replace("|",", ",$lc));return
false;}return
true;}function
create_database($l,$d){global$h;if(file_exists($l)){$h->error=lang(24);return
false;}if(!check_sqlite_name($l))return
false;try{$z=new
Min_SQLite($l);}catch(Exception$fc){$h->error=$fc->getMessage();return
false;}$z->query('PRAGMA encoding = "UTF-8"');$z->query('CREATE TABLE adminer (i)');$z->query('DROP TABLE adminer');return
true;}function
drop_databases($k){global$h;$h->__construct(":memory:");foreach($k
as$l){if(!@unlink($l)){$h->error=lang(24);return
false;}}return
true;}function
rename_database($B,$d){global$h;if(!check_sqlite_name($B))return
false;$h->__construct(":memory:");$h->error=lang(24);return@rename(DB,$B);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($Q,$B,$p,$Bc,$gb,$Zb,$d,$Ea,$Ie){global$h;$Qg=($Q==""||$Bc);foreach($p
as$o){if($o[0]!=""||!$o[1]||$o[2]){$Qg=true;break;}}$c=array();$Ae=array();foreach($p
as$o){if($o[1]){$c[]=($Qg?$o[1]:"ADD ".implode($o[1]));if($o[0]!="")$Ae[$o[0]]=$o[1][0];}}if(!$Qg){foreach($c
as$X){if(!queries("ALTER TABLE ".table($Q)." $X"))return
false;}if($Q!=$B&&!queries("ALTER TABLE ".table($Q)." RENAME TO ".table($B)))return
false;}elseif(!recreate_table($Q,$B,$c,$Ae,$Bc,$Ea))return
false;if($Ea){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $Ea WHERE name = ".q($B));if(!$h->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($B).", $Ea)");queries("COMMIT");}return
true;}function
recreate_table($Q,$B,$p,$Ae,$Bc,$Ea,$w=array()){global$h;if($Q!=""){if(!$p){foreach(fields($Q)as$x=>$o){if($w)$o["auto_increment"]=0;$p[]=process_field($o,$o);$Ae[$x]=idf_escape($x);}}$Ue=false;foreach($p
as$o){if($o[6])$Ue=true;}$Pb=array();foreach($w
as$x=>$X){if($X[2]=="DROP"){$Pb[$X[1]]=true;unset($w[$x]);}}foreach(indexes($Q)as$wd=>$v){$f=array();foreach($v["columns"]as$x=>$e){if(!$Ae[$e])continue
2;$f[]=$Ae[$e].($v["descs"][$x]?" DESC":"");}if(!$Pb[$wd]){if($v["type"]!="PRIMARY"||!$Ue)$w[]=array($v["type"],$wd,$f);}}foreach($w
as$x=>$X){if($X[0]=="PRIMARY"){unset($w[$x]);$Bc[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($Q)as$wd=>$Ec){foreach($Ec["source"]as$x=>$e){if(!$Ae[$e])continue
2;$Ec["source"][$x]=idf_unescape($Ae[$e]);}if(!isset($Bc[" $wd"]))$Bc[]=" ".format_foreign_key($Ec);}queries("BEGIN");}foreach($p
as$x=>$o)$p[$x]="  ".implode($o);$p=array_merge($p,array_filter($Bc));$hg=($Q==$B?"adminer_$B":$B);if(!queries("CREATE TABLE ".table($hg)." (\n".implode(",\n",$p)."\n)"))return
false;if($Q!=""){if($Ae&&!queries("INSERT INTO ".table($hg)." (".implode(", ",$Ae).") SELECT ".implode(", ",array_map('idf_escape',array_keys($Ae)))." FROM ".table($Q)))return
false;$Eg=array();foreach(triggers($Q)as$Cg=>$og){$Bg=trigger($Cg);$Eg[]="CREATE TRIGGER ".idf_escape($Cg)." ".implode(" ",$og)." ON ".table($B)."\n$Bg[Statement]";}$Ea=$Ea?0:$h->result("SELECT seq FROM sqlite_sequence WHERE name = ".q($Q));if(!queries("DROP TABLE ".table($Q))||($Q==$B&&!queries("ALTER TABLE ".table($hg)." RENAME TO ".table($B)))||!alter_indexes($B,$w))return
false;if($Ea)queries("UPDATE sqlite_sequence SET seq = $Ea WHERE name = ".q($B));foreach($Eg
as$Bg){if(!queries($Bg))return
false;}queries("COMMIT");}return
true;}function
index_sql($Q,$T,$B,$f){return"CREATE $T ".($T!="INDEX"?"INDEX ":"").idf_escape($B!=""?$B:uniqid($Q."_"))." ON ".table($Q)." $f";}function
alter_indexes($Q,$c){foreach($c
as$Te){if($Te[0]=="PRIMARY")return
recreate_table($Q,$Q,array(),array(),array(),0,$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($Q,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($S){return
apply_queries("DELETE FROM",$S);}function
drop_views($Yg){return
apply_queries("DROP VIEW",$Yg);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
move_tables($S,$Yg,$gg){return
false;}function
trigger($B){global$h;if($B=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$u='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$Dg=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$u\\s*(".implode("|",$Dg["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($u))?\\s+ON\\s*$u\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$h->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($B)),$_);$je=$_[3];return
array("Timing"=>strtoupper($_[1]),"Event"=>strtoupper($_[2]).($je?" OF":""),"Of"=>idf_unescape($je),"Trigger"=>$B,"Statement"=>$_[4],);}function
triggers($Q){$H=array();$Dg=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q))as$I){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$Dg["Timing"]).')\s*(.*?)\s+ON\b~i',$I["sql"],$_);$H[$I["name"]]=array($_[1],$_[2]);}return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$h;return$h->result("SELECT LAST_INSERT_ROWID()");}function
explain($h,$F){return$h->query("EXPLAIN QUERY PLAN $F");}function
found_rows($R,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($wf){return
true;}function
create_sql($Q,$Ea,$Xf){global$h;$H=$h->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($Q));foreach(indexes($Q)as$B=>$v){if($B=='')continue;$H.=";\n\n".index_sql($Q,$v['type'],$B,"(".implode(", ",array_map('idf_escape',$v['columns'])).")");}return$H;}function
truncate_sql($Q){return"DELETE FROM ".table($Q);}function
use_sql($j){}function
trigger_sql($Q){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q)));}function
show_variables(){global$h;$H=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$x)$H[$x]=$h->result("PRAGMA $x");return$H;}function
show_status(){$H=array();foreach(get_vals("PRAGMA compile_options")as$ue){list($x,$X)=explode("=",$ue,2);$H[$x]=$X;}return$H;}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($pc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$pc);}function
driver_config(){$U=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);return
array('possible_drivers'=>array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite"),'jush'=>"sqlite",'types'=>$U,'structured_types'=>array_keys($U),'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL"),'functions'=>array("distinct","hex","length","lower","round","unixepoch","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",)),);}}$Nb["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($cc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($M,$V,$E){global$b;$l=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($E,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$l!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Wg=pg_version($this->_link);$this->server_info=$Wg["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($P){return"'".pg_escape_string($this->_link,$P)."'";}function
value($X,$o){return($o["type"]=="bytea"&&$X!==null?pg_unescape_bytea($X):$X);}function
quoteBinary($P){return"'".pg_escape_bytea($this->_link,$P)."'";}function
select_db($j){global$b;if($j==$b->database())return$this->_database;$H=@pg_connect("$this->_string dbname='".addcslashes($j,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($H)$this->_link=$H;return$H;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($F,$Gg=false){$G=@pg_query($this->_link,$F);$this->error="";if(!$G){$this->error=pg_last_error($this->_link);$H=false;}elseif(!pg_num_fields($G)){$this->affected_rows=pg_affected_rows($G);$H=true;}else$H=new
Min_Result($G);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$H;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;return
pg_fetch_result($G->_result,0,$o);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;$this->num_rows=pg_num_rows($G);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$e=$this->_offset++;$H=new
stdClass;if(function_exists('pg_field_table'))$H->orgtable=pg_field_table($this->_result,$e);$H->name=pg_field_name($this->_result,$e);$H->orgname=$H->name;$H->type=pg_field_type($this->_result,$e);$H->charsetnr=($H->type=="bytea"?63:0);return$H;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($M,$V,$E){global$b;$l=$b->database();$this->dsn("pgsql:host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' client_encoding=utf8 dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",$V,$E);return
true;}function
select_db($j){global$b;return($b->database()==$j);}function
quoteBinary($uf){return
q($uf);}function
query($F,$Gg=false){$H=parent::query($F,$Gg);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$H;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$Te){global$h;foreach($J
as$N){$Ng=array();$Z=array();foreach($N
as$x=>$X){$Ng[]="$x = $X";if(isset($Te[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Ng)." WHERE ".implode(" AND ",$Z))&&$h->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}function
slowQuery($F,$ng){$this->_conn->query("SET statement_timeout = ".(1000*$ng));$this->_conn->timeout=1000*$ng;return$F;}function
convertSearch($u,$X,$o){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$o["type"])?$u:"CAST($u AS text)");}function
quoteBinary($uf){return$this->_conn->quoteBinary($uf);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($B){$Id=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$z=$Id[$_GET["ns"]];if($z)return"$z-".str_replace("_","-",$B).".html";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b,$U,$Wf;$h=new
Min_DB;$vb=$b->credentials();if($h->connect($vb[0],$vb[1],$vb[2])){if(min_version(9,0,$h)){$h->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$h)){$Wf[lang(25)][]="json";$U["json"]=4294967295;if(min_version(9.4,0,$h)){$Wf[lang(25)][]="jsonb";$U["jsonb"]=4294967295;}}}return$h;}return$h->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($F,$Z,$y,$ke=0,$L=" "){return" $F$Z".($y!==null?$L."LIMIT $y".($ke?" OFFSET $ke":""):"");}function
limit1($Q,$F,$Z,$L="\n"){return(preg_match('~^INTO~',$F)?limit($F,$Z,1,0,$L):" $F".(is_view(table_status1($Q))?$Z:$L."WHERE ctid = (SELECT ctid FROM ".table($Q).$Z.$L."LIMIT 1)"));}function
db_collation($l,$bb){global$h;return$h->result("SELECT datcollate FROM pg_database WHERE datname = ".q($l));}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT user");}function
tables_list(){$F="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$F.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$F.="
ORDER BY 1";return
get_key_vals($F);}function
count_tables($k){return
array();}function
table_status($B=""){$H=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", ".(min_version(12)?"''":"CASE WHEN c.relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f', 'p')
".($B!=""?"AND relname = ".q($B):"ORDER BY relname"))as$I)$H[$I["Name"]]=$I;return($B!=""?$H[$B]:$H);}function
is_view($R){return
in_array($R["Engine"],array("view","materialized view"));}function
fk_support($R){return
true;}function
fields($Q){$H=array();$wa=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, pg_get_expr(d.adbin, d.adrelid) AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment".(min_version(10)?", a.attidentity":"")."
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($Q)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$I){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$I["full_type"],$_);list(,$T,$Fd,$I["length"],$sa,$ya)=$_;$I["length"].=$ya;$Ta=$T.$sa;if(isset($wa[$Ta])){$I["type"]=$wa[$Ta];$I["full_type"]=$I["type"].$Fd.$ya;}else{$I["type"]=$T;$I["full_type"]=$I["type"].$Fd.$sa.$ya;}if(in_array($I['attidentity'],array('a','d')))$I['default']='GENERATED '.($I['attidentity']=='d'?'BY DEFAULT':'ALWAYS').' AS IDENTITY';$I["null"]=!$I["attnotnull"];$I["auto_increment"]=$I['attidentity']||preg_match('~^nextval\(~i',$I["default"]);$I["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^,)]+(.*)~',$I["default"],$_))$I["default"]=($_[1]=="NULL"?null:idf_unescape($_[1]).$_[2]);$H[$I["field"]]=$I;}return$H;}function
indexes($Q,$i=null){global$h;if(!is_object($i))$i=$h;$H=array();$eg=$i->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($Q));$f=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $eg AND attnum > 0",$i);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption, (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $eg AND ci.oid = i.indexrelid",$i)as$I){$if=$I["relname"];$H[$if]["type"]=($I["indispartial"]?"INDEX":($I["indisprimary"]?"PRIMARY":($I["indisunique"]?"UNIQUE":"INDEX")));$H[$if]["columns"]=array();foreach(explode(" ",$I["indkey"])as$id)$H[$if]["columns"][]=$f[$id];$H[$if]["descs"]=array();foreach(explode(" ",$I["indoption"])as$jd)$H[$if]["descs"][]=($jd&1?'1':null);$H[$if]["lengths"]=array();}return$H;}function
foreign_keys($Q){global$ne;$H=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($Q)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$I){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$I['definition'],$_)){$I['source']=array_map('idf_unescape',array_map('trim',explode(',',$_[1])));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$_[2],$Qd)){$I['ns']=idf_unescape($Qd[2]);$I['table']=idf_unescape($Qd[4]);}$I['target']=array_map('idf_unescape',array_map('trim',explode(',',$_[3])));$I['on_delete']=(preg_match("~ON DELETE ($ne)~",$_[4],$Qd)?$Qd[1]:'NO ACTION');$I['on_update']=(preg_match("~ON UPDATE ($ne)~",$_[4],$Qd)?$Qd[1]:'NO ACTION');$H[$I['conname']]=$I;}}return$H;}function
constraints($Q){global$ne;$H=array();foreach(get_rows("SELECT conname, consrc
FROM pg_catalog.pg_constraint
INNER JOIN pg_catalog.pg_namespace ON pg_constraint.connamespace = pg_namespace.oid
INNER JOIN pg_catalog.pg_class ON pg_constraint.conrelid = pg_class.oid AND pg_constraint.connamespace = pg_class.relnamespace
WHERE pg_constraint.contype = 'c'
AND conrelid != 0 -- handle only CONSTRAINTs here, not TYPES
AND nspname = current_schema()
AND relname = ".q($Q)."
ORDER BY connamespace, conname")as$I)$H[$I['conname']]=$I['consrc'];return$H;}function
view($B){global$h;return
array("select"=>trim($h->result("SELECT pg_get_viewdef(".$h->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($B)).")")));}function
collations(){return
array();}function
information_schema($l){return($l=="information_schema");}function
error(){global$h;$H=h($h->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$H,$_))$H=$_[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($_[3]).'})(.*)~','\1<b>\2</b>',$_[2]).$_[4];return
nl_br($H);}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" ENCODING ".idf_escape($d):""));}function
drop_databases($k){global$h;$h->close();return
apply_queries("DROP DATABASE",$k,'idf_escape');}function
rename_database($B,$d){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($B));}function
auto_increment(){return"";}function
alter_table($Q,$B,$p,$Bc,$gb,$Zb,$d,$Ea,$Ie){$c=array();$af=array();if($Q!=""&&$Q!=$B)$af[]="ALTER TABLE ".table($Q)." RENAME TO ".table($B);foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c[]="DROP $e";else{$Tg=$X[5];unset($X[5]);if($o[0]==""){if(isset($X[6]))$X[1]=($X[1]==" bigint"?" big":($X[1]==" smallint"?" small":" "))."serial";$c[]=($Q!=""?"ADD ":"  ").implode($X);if(isset($X[6]))$c[]=($Q!=""?"ADD":" ")." PRIMARY KEY ($X[0])";}else{if($e!=$X[0])$af[]="ALTER TABLE ".table($B)." RENAME $e TO $X[0]";$c[]="ALTER $e TYPE$X[1]";if(!$X[6]){$c[]="ALTER $e ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $e ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($o[0]!=""||$Tg!="")$af[]="COMMENT ON COLUMN ".table($B).".$X[0] IS ".($Tg!=""?substr($Tg,9):"''");}}$c=array_merge($c,$Bc);if($Q=="")array_unshift($af,"CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($af,"ALTER TABLE ".table($Q)."\n".implode(",\n",$c));if($gb!==null)$af[]="COMMENT ON TABLE ".table($B)." IS ".q($gb);if($Ea!=""){}foreach($af
as$F){if(!queries($F))return
false;}return
true;}function
alter_indexes($Q,$c){$tb=array();$Ob=array();$af=array();foreach($c
as$X){if($X[0]!="INDEX")$tb[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$Ob[]=idf_escape($X[1]);else$af[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($tb)array_unshift($af,"ALTER TABLE ".table($Q).implode(",",$tb));if($Ob)array_unshift($af,"DROP INDEX ".implode(", ",$Ob));foreach($af
as$F){if(!queries($F))return
false;}return
true;}function
truncate_tables($S){return
queries("TRUNCATE ".implode(", ",array_map('table',$S)));return
true;}function
drop_views($Yg){return
drop_tables($Yg);}function
drop_tables($S){foreach($S
as$Q){$O=table_status($Q);if(!queries("DROP ".strtoupper($O["Engine"])." ".table($Q)))return
false;}return
true;}function
move_tables($S,$Yg,$gg){foreach(array_merge($S,$Yg)as$Q){$O=table_status($Q);if(!queries("ALTER ".strtoupper($O["Engine"])." ".table($Q)." SET SCHEMA ".idf_escape($gg)))return
false;}return
true;}function
trigger($B,$Q){if($B=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");$f=array();$Z="WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q)." AND trigger_name = ".q($B);foreach(get_rows("SELECT * FROM information_schema.triggered_update_columns $Z")as$I)$f[]=$I["event_object_column"];$H=array();foreach(get_rows('SELECT trigger_name AS "Trigger", action_timing AS "Timing", event_manipulation AS "Event", \'FOR EACH \' || action_orientation AS "Type", action_statement AS "Statement" FROM information_schema.triggers '."$Z ORDER BY event_manipulation DESC")as$I){if($f&&$I["Event"]=="UPDATE")$I["Event"].=" OF";$I["Of"]=implode(", ",$f);if($H)$I["Event"].=" OR $H[Event]";$H=$I;}return$H;}function
triggers($Q){$H=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q))as$I){$Bg=trigger($I["trigger_name"],$Q);$H[$Bg["Trigger"]]=array($Bg["Timing"],$Bg["Event"]);}return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE","INSERT OR UPDATE","INSERT OR UPDATE OF","DELETE OR INSERT","DELETE OR UPDATE","DELETE OR UPDATE OF","DELETE OR INSERT OR UPDATE","DELETE OR INSERT OR UPDATE OF"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($B,$T){$J=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($B));$H=$J[0];$H["returns"]=array("type"=>$H["type_udt_name"]);$H["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($B).'
ORDER BY ordinal_position');return$H;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($B,$I){$H=array();foreach($I["fields"]as$o)$H[]=$o["type"];return
idf_escape($B)."(".implode(", ",$H).")";}function
last_id(){return
0;}function
explain($h,$F){return$h->query("EXPLAIN $F");}function
found_rows($R,$Z){global$h;if(preg_match("~ rows=([0-9]+)~",$h->result("EXPLAIN SELECT * FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$hf))return$hf[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$h;return$h->result("SELECT current_schema()");}function
set_schema($vf,$i=null){global$h,$U,$Wf;if(!$i)$i=$h;$H=$i->query("SET search_path TO ".idf_escape($vf));foreach(types()as$T){if(!isset($U[$T])){$U[$T]=0;$Wf[lang(26)][]=$T;}}return$H;}function
foreign_keys_sql($Q){$H="";$O=table_status($Q);$yc=foreign_keys($Q);ksort($yc);foreach($yc
as$xc=>$wc)$H.="ALTER TABLE ONLY ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." ADD CONSTRAINT ".idf_escape($xc)." $wc[definition] ".($wc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE').";\n";return($H?"$H\n":$H);}function
create_sql($Q,$Ea,$Xf){global$h;$H='';$rf=array();$Df=array();$O=table_status($Q);if(is_view($O)){$Xg=view($Q);return
rtrim("CREATE VIEW ".idf_escape($Q)." AS $Xg[select]",";");}$p=fields($Q);$w=indexes($Q);ksort($w);$ob=constraints($Q);if(!$O||empty($p))return
false;$H="CREATE TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." (\n    ";foreach($p
as$qc=>$o){$He=idf_escape($o['field']).' '.$o['full_type'].default_value($o).($o['attnotnull']?" NOT NULL":"");$rf[]=$He;if(preg_match('~nextval\(\'([^\']+)\'\)~',$o['default'],$A)){$Cf=$A[1];$Pf=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($Cf):"SELECT * FROM $Cf"));$Df[]=($Xf=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $Cf;\n":"")."CREATE SEQUENCE $Cf INCREMENT $Pf[increment_by] MINVALUE $Pf[min_value] MAXVALUE $Pf[max_value]".($Ea&&$Pf['last_value']?" START $Pf[last_value]":"")." CACHE $Pf[cache_value];";}}if(!empty($Df))$H=implode("\n\n",$Df)."\n\n$H";foreach($w
as$dd=>$v){switch($v['type']){case'UNIQUE':$rf[]="CONSTRAINT ".idf_escape($dd)." UNIQUE (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;case'PRIMARY':$rf[]="CONSTRAINT ".idf_escape($dd)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;}}foreach($ob
as$lb=>$nb)$rf[]="CONSTRAINT ".idf_escape($lb)." CHECK $nb";$H.=implode(",\n    ",$rf)."\n) WITH (oids = ".($O['Oid']?'true':'false').");";foreach($w
as$dd=>$v){if($v['type']=='INDEX'){$f=array();foreach($v['columns']as$x=>$X)$f[]=idf_escape($X).($v['descs'][$x]?" DESC":"");$H.="\n\nCREATE INDEX ".idf_escape($dd)." ON ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." USING btree (".implode(', ',$f).");";}}if($O['Comment'])$H.="\n\nCOMMENT ON TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." IS ".q($O['Comment']).";";foreach($p
as$qc=>$o){if($o['comment'])$H.="\n\nCOMMENT ON COLUMN ".idf_escape($O['nspname']).".".idf_escape($O['Name']).".".idf_escape($qc)." IS ".q($o['comment']).";";}return
rtrim($H,';');}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
trigger_sql($Q){$O=table_status($Q);$H="";foreach(triggers($Q)as$Ag=>$_g){$Bg=trigger($Ag,$O['Name']);$H.="\nCREATE TRIGGER ".idf_escape($Bg['Trigger'])." $Bg[Timing] $Bg[Event] ON ".idf_escape($O["nspname"]).".".idf_escape($O['Name'])." $Bg[Type] $Bg[Statement];;\n";}return$H;}function
use_sql($j){return"\connect ".idf_escape($j);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($pc){return
preg_match('~^(database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$pc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$h;return$h->result("SHOW max_connections");}function
driver_config(){$U=array();$Wf=array();foreach(array(lang(27)=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),lang(28)=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),lang(25)=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),lang(29)=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),lang(30)=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),lang(31)=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$x=>$X){$U+=$X;$Wf[$x]=array_keys($X);}return
array('possible_drivers'=>array("PgSQL","PDO_PgSQL"),'jush'=>"pgsql",'types'=>$U,'structured_types'=>$Wf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","~","~*","!~","!~*","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'operator_regexp'=>'~*','functions'=>array("char_length","distinct","lower","round","to_hex","to_timestamp","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",)),);}}$Nb["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;var$_current_db;function
_error($cc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($M,$V,$E){$this->_link=@oci_new_connect($V,$E,$M,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$n=oci_error();$this->error=$n["message"];return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){$this->_current_db=$j;return
true;}function
query($F,$Gg=false){$G=oci_parse($this->_link,$F);$this->error="";if(!$G){$n=oci_error($this->_link);$this->errno=$n["code"];$this->error=$n["message"];return
false;}set_error_handler(array($this,'_error'));$H=@oci_execute($G);restore_error_handler();if($H){if(oci_num_fields($G))return
new
Min_Result($G);$this->affected_rows=oci_num_rows($G);oci_free_statement($G);}return$H;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=1){$G=$this->query($F);if(!is_object($G)||!oci_fetch($G->_result))return
false;return
oci_result($G->_result,$o);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($G){$this->_result=$G;}function
_convert($I){foreach((array)$I
as$x=>$X){if(is_a($X,'OCI-Lob'))$I[$x]=$X->load();}return$I;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$e=$this->_offset++;$H=new
stdClass;$H->name=oci_field_name($this->_result,$e);$H->orgname=$H->name;$H->type=oci_field_type($this->_result,$e);$H->charsetnr=(preg_match("~raw|blob|bfile~",$H->type)?63:0);return$H;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";var$_current_db;function
connect($M,$V,$E){$this->dsn("oci:dbname=//$M;charset=AL32UTF8",$V,$E);return
true;}function
select_db($j){$this->_current_db=$j;return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}function
insertUpdate($Q,$J,$Te){global$h;foreach($J
as$N){$Ng=array();$Z=array();foreach($N
as$x=>$X){$Ng[]="$x = $X";if(isset($Te[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Ng)." WHERE ".implode(" AND ",$Z))&&$h->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;$h=new
Min_DB;$vb=$b->credentials();if($h->connect($vb[0],$vb[1],$vb[2]))return$h;return$h->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces ORDER BY 1");}function
limit($F,$Z,$y,$ke=0,$L=" "){return($ke?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $F$Z) t WHERE rownum <= ".($y+$ke).") WHERE rnum > $ke":($y!==null?" * FROM (SELECT $F$Z) WHERE rownum <= ".($y+$ke):" $F$Z"));}function
limit1($Q,$F,$Z,$L="\n"){return" $F$Z";}function
db_collation($l,$bb){global$h;return$h->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT USER FROM DUAL");}function
get_current_db(){global$h;$l=$h->_current_db?$h->_current_db:DB;unset($h->_current_db);return$l;}function
where_owner($Se,$Ce="owner"){if(!$_GET["ns"])return'';return"$Se$Ce = sys_context('USERENV', 'CURRENT_SCHEMA')";}function
views_table($f){$Ce=where_owner('');return"(SELECT $f FROM all_views WHERE ".($Ce?$Ce:"rownum < 0").")";}function
tables_list(){$Xg=views_table("view_name");$Ce=where_owner(" AND ");return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."$Ce
UNION SELECT view_name, 'view' FROM $Xg
ORDER BY 1");}function
count_tables($k){global$h;$H=array();foreach($k
as$l)$H[$l]=$h->result("SELECT COUNT(*) FROM all_tables WHERE tablespace_name = ".q($l));return$H;}function
table_status($B=""){$H=array();$xf=q($B);$l=get_current_db();$Xg=views_table("view_name");$Ce=where_owner(" AND ");foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q($l).$Ce.($B!=""?" AND table_name = $xf":"")."
UNION SELECT view_name, 'view', 0, 0 FROM $Xg".($B!=""?" WHERE view_name = $xf":"")."
ORDER BY 1")as$I){if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){return
true;}function
fields($Q){$H=array();$Ce=where_owner(" AND ");foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($Q)."$Ce ORDER BY column_id")as$I){$T=$I["DATA_TYPE"];$Fd="$I[DATA_PRECISION],$I[DATA_SCALE]";if($Fd==",")$Fd=$I["CHAR_COL_DECL_LENGTH"];$H[$I["COLUMN_NAME"]]=array("field"=>$I["COLUMN_NAME"],"full_type"=>$T.($Fd?"($Fd)":""),"type"=>strtolower($T),"length"=>$Fd,"default"=>$I["DATA_DEFAULT"],"null"=>($I["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$H;}function
indexes($Q,$i=null){$H=array();$Ce=where_owner(" AND ","aic.table_owner");foreach(get_rows("SELECT aic.*, ac.constraint_type, atc.data_default
FROM all_ind_columns aic
LEFT JOIN all_constraints ac ON aic.index_name = ac.constraint_name AND aic.table_name = ac.table_name AND aic.index_owner = ac.owner
LEFT JOIN all_tab_cols atc ON aic.column_name = atc.column_name AND aic.table_name = atc.table_name AND aic.index_owner = atc.owner
WHERE aic.table_name = ".q($Q)."$Ce
ORDER BY ac.constraint_type, aic.column_position",$i)as$I){$dd=$I["INDEX_NAME"];$eb=$I["DATA_DEFAULT"];$eb=($eb?trim($eb,'"'):$I["COLUMN_NAME"]);$H[$dd]["type"]=($I["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($I["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$H[$dd]["columns"][]=$eb;$H[$dd]["lengths"][]=($I["CHAR_LENGTH"]&&$I["CHAR_LENGTH"]!=$I["COLUMN_LENGTH"]?$I["CHAR_LENGTH"]:null);$H[$dd]["descs"][]=($I["DESCEND"]&&$I["DESCEND"]=="DESC"?'1':null);}return$H;}function
view($B){$Xg=views_table("view_name, text");$J=get_rows('SELECT text "select" FROM '.$Xg.' WHERE view_name = '.q($B));return
reset($J);}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$h;return
h($h->error);}function
explain($h,$F){$h->query("EXPLAIN PLAN FOR $F");return$h->query("SELECT * FROM plan_table");}function
found_rows($R,$Z){}function
auto_increment(){return"";}function
alter_table($Q,$B,$p,$Bc,$gb,$Zb,$d,$Ea,$Ie){$c=$Ob=array();$ze=($Q?fields($Q):array());foreach($p
as$o){$X=$o[1];if($X&&$o[0]!=""&&idf_escape($o[0])!=$X[0])queries("ALTER TABLE ".table($Q)." RENAME COLUMN ".idf_escape($o[0])." TO $X[0]");$ye=$ze[$o[0]];if($X&&$ye){$me=process_field($ye,$ye);if($X[2]==$me[2])$X[2]="";}if($X)$c[]=($Q!=""?($o[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($Q!=""?")":"");else$Ob[]=idf_escape($o[0]);}if($Q=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($Q)."\n".implode("\n",$c)))&&(!$Ob||queries("ALTER TABLE ".table($Q)." DROP (".implode(", ",$Ob).")"))&&($Q==$B||queries("ALTER TABLE ".table($Q)." RENAME TO ".table($B)));}function
alter_indexes($Q,$c){$Ob=array();$af=array();foreach($c
as$X){if($X[0]!="INDEX"){$X[2]=preg_replace('~ DESC$~','',$X[2]);$tb=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");array_unshift($af,"ALTER TABLE ".table($Q).$tb);}elseif($X[2]=="DROP")$Ob[]=idf_escape($X[1]);else$af[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($Ob)array_unshift($af,"DROP INDEX ".implode(", ",$Ob));foreach($af
as$F){if(!queries($F))return
false;}return
true;}function
foreign_keys($Q){$H=array();$F="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($Q);foreach(get_rows($F)as$I)$H[$I['NAME']]=array("db"=>$I['DEST_DB'],"table"=>$I['DEST_TABLE'],"source"=>array($I['SRC_COLUMN']),"target"=>array($I['DEST_COLUMN']),"on_delete"=>$I['ON_DELETE'],"on_update"=>null,);return$H;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Yg){return
apply_queries("DROP VIEW",$Yg);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
last_id(){return
0;}function
schemas(){$H=get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX')) ORDER BY 1");return($H?$H:get_vals("SELECT DISTINCT owner FROM all_tables WHERE tablespace_name = ".q(DB)." ORDER BY 1"));}function
get_schema(){global$h;return$h->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($wf,$i=null){global$h;if(!$i)$i=$h;return$i->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($wf));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$J=get_rows('SELECT * FROM v$instance');return
reset($J);}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($pc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view)$~',$pc);}function
driver_config(){$U=array();$Wf=array();foreach(array(lang(27)=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),lang(28)=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),lang(25)=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),lang(29)=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$x=>$X){$U+=$X;$Wf[$x]=array_keys($X);}return
array('possible_drivers'=>array("OCI8","PDO_OCI"),'jush'=>"oracle",'types'=>$U,'structured_types'=>$Wf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("distinct","length","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",)),);}}$Nb["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$n){$this->errno=$n["code"];$this->error.="$n[message]\n";}$this->error=rtrim($this->error);}function
connect($M,$V,$E){global$b;$l=$b->database();$mb=array("UID"=>$V,"PWD"=>$E,"CharacterSet"=>"UTF-8");if($l!="")$mb["Database"]=$l;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$M),$mb);if($this->_link){$kd=sqlsrv_server_info($this->_link);$this->server_info=$kd['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($F,$Gg=false){$G=sqlsrv_query($this->_link,$F);$this->error="";if(!$G){$this->_get_error();return
false;}return$this->store_result($G);}function
multi_query($F){$this->_result=sqlsrv_query($this->_link,$F);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($G=null){if(!$G)$G=$this->_result;if(!$G)return
false;if(sqlsrv_field_metadata($G))return
new
Min_Result($G);$this->affected_rows=sqlsrv_rows_affected($G);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->fetch_row();return$I[$o];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($G){$this->_result=$G;}function
_convert($I){foreach((array)$I
as$x=>$X){if(is_a($X,'DateTime'))$I[$x]=$X->format("Y-m-d H:i:s");}return$I;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$o=$this->_fields[$this->_offset++];$H=new
stdClass;$H->name=$o["Name"];$H->orgname=$o["Name"];$H->type=($o["Type"]==1?254:0);return$H;}function
seek($ke){for($s=0;$s<$ke;$s++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($M,$V,$E){$this->_link=@mssql_connect($M,$V,$E);if($this->_link){$G=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($G){$I=$G->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$I[0]] $I[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){return
mssql_select_db($j);}function
query($F,$Gg=false){$G=@mssql_query($F,$this->_link);$this->error="";if(!$G){$this->error=mssql_get_last_message();return
false;}if($G===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;return
mssql_result($G->_result,0,$o);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($G){$this->_result=$G;$this->num_rows=mssql_num_rows($G);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$H=mssql_fetch_field($this->_result);$H->orgtable=$H->table;$H->orgname=$H->name;return$H;}function
seek($ke){mssql_data_seek($this->_result,$ke);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($M,$V,$E){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$E);return
true;}function
select_db($j){return$this->query("USE ".idf_escape($j));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$Te){foreach($J
as$N){$Ng=array();$Z=array();foreach($N
as$x=>$X){$Ng[]="$x = $X";if(isset($Te[idf_unescape($x)]))$Z[]="$x = $X";}if(!queries("MERGE ".table($Q)." USING (VALUES(".implode(", ",$N).")) AS source (c".implode(", c",range(1,count($N))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Ng)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($u){return"[".str_replace("]","]]",$u)."]";}function
table($u){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($u);}function
connect(){global$b;$h=new
Min_DB;$vb=$b->credentials();if($h->connect($vb[0],$vb[1],$vb[2]))return$h;return$h->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($F,$Z,$y,$ke=0,$L=" "){return($y!==null?" TOP (".($y+$ke).")":"")." $F$Z";}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($l,$bb){global$h;return$h->result("SELECT collation_name FROM sys.databases WHERE name = ".q($l));}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($k){global$h;$H=array();foreach($k
as$l){$h->select_db($l);$H[$l]=$h->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$H;}function
table_status($B=""){$H=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment FROM sys.all_objects AS ao WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($B!=""?"AND name = ".q($B):"ORDER BY name"))as$I){if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]=="VIEW";}function
fk_support($R){return
true;}function
fields($Q){$hb=get_key_vals("SELECT objname, cast(value as varchar(max)) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($Q).", 'column', NULL)");$H=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($Q))as$I){$T=$I["type"];$Fd=(preg_match("~char|binary~",$T)?$I["max_length"]:($T=="decimal"?"$I[precision],$I[scale]":""));$H[$I["name"]]=array("field"=>$I["name"],"full_type"=>$T.($Fd?"($Fd)":""),"type"=>$T,"length"=>$Fd,"default"=>$I["default"],"null"=>$I["is_nullable"],"auto_increment"=>$I["is_identity"],"collation"=>$I["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$I["is_identity"],"comment"=>$hb[$I["name"]],);}return$H;}function
indexes($Q,$i=null){$H=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($Q),$i)as$I){$B=$I["name"];$H[$B]["type"]=($I["is_primary_key"]?"PRIMARY":($I["is_unique"]?"UNIQUE":"INDEX"));$H[$B]["lengths"]=array();$H[$B]["columns"][$I["key_ordinal"]]=$I["column_name"];$H[$B]["descs"][$I["key_ordinal"]]=($I["is_descending_key"]?'1':null);}return$H;}function
view($B){global$h;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$h->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($B))));}function
collations(){$H=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$d)$H[preg_replace('~_.*~','',$d)][]=$d;return$H;}function
information_schema($l){return
false;}function
error(){global$h;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$h->error)));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).(preg_match('~^[a-z0-9_]+$~i',$d)?" COLLATE $d":""));}function
drop_databases($k){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$k)));}function
rename_database($B,$d){if(preg_match('~^[a-z0-9_]+$~i',$d))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $d");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($B));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($Q,$B,$p,$Bc,$gb,$Zb,$d,$Ea,$Ie){$c=array();$hb=array();foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c["DROP"][]=" COLUMN $e";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$hb[$o[0]]=$X[5];unset($X[5]);if($o[0]=="")$c["ADD"][]="\n  ".implode("",$X).($Q==""?substr($Bc[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($e!=$X[0])queries("EXEC sp_rename ".q(table($Q).".$e").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($Q=="")return
queries("CREATE TABLE ".table($B)." (".implode(",",(array)$c["ADD"])."\n)");if($Q!=$B)queries("EXEC sp_rename ".q(table($Q)).", ".q($B));if($Bc)$c[""]=$Bc;foreach($c
as$x=>$X){if(!queries("ALTER TABLE ".idf_escape($B)." $x".implode(",",$X)))return
false;}foreach($hb
as$x=>$X){$gb=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($B).", @level2type = N'Column', @level2name = ".q($x));queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = ".$gb.", @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($B).", @level2type = N'Column', @level2name = ".q($x));}return
true;}function
alter_indexes($Q,$c){$v=array();$Ob=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$Ob[]=idf_escape($X[1]);else$v[]=idf_escape($X[1])." ON ".table($Q);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q):"ALTER TABLE ".table($Q)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$v||queries("DROP INDEX ".implode(", ",$v)))&&(!$Ob||queries("ALTER TABLE ".table($Q)." DROP ".implode(", ",$Ob)));}function
last_id(){global$h;return$h->result("SELECT SCOPE_IDENTITY()");}function
explain($h,$F){$h->query("SET SHOWPLAN_ALL ON");$H=$h->query($F);$h->query("SET SHOWPLAN_ALL OFF");return$H;}function
found_rows($R,$Z){}function
foreign_keys($Q){$H=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($Q))as$I){$Ec=&$H[$I["FK_NAME"]];$Ec["db"]=$I["PKTABLE_QUALIFIER"];$Ec["table"]=$I["PKTABLE_NAME"];$Ec["source"][]=$I["FKCOLUMN_NAME"];$Ec["target"][]=$I["PKCOLUMN_NAME"];}return$H;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Yg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Yg)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Yg,$gg){return
apply_queries("ALTER SCHEMA ".idf_escape($gg)." TRANSFER",array_merge($S,$Yg));}function
trigger($B){if($B=="")return
array();$J=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($B));$H=reset($J);if($H)$H["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$H["text"]);return$H;}function
triggers($Q){$H=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($Q))as$I)$H[$I["name"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$h;if($_GET["ns"]!="")return$_GET["ns"];return$h->result("SELECT SCHEMA_NAME()");}function
set_schema($vf){return
true;}function
use_sql($j){return"USE ".idf_escape($j);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($pc){return
preg_match('~^(comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$pc);}function
driver_config(){$U=array();$Wf=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),lang(28)=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),lang(25)=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),lang(29)=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$x=>$X){$U+=$X;$Wf[$x]=array_keys($X);}return
array('possible_drivers'=>array("SQLSRV","MSSQL","PDO_DBLIB"),'jush'=>"mssql",'types'=>$U,'structured_types'=>$Wf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("distinct","len","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",)),);}}$Nb["mongo"]="MongoDB (alpha)";if(isset($_GET["mongo"])){define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Og,$C){try{$this->_link=new
MongoClient($Og,$C);if($C["password"]!=""){$C["password"]="";try{new
MongoClient($Og,$C);$this->error=lang(22);}catch(Exception$Rb){}}}catch(Exception$Rb){$this->error=$Rb->getMessage();}}function
query($F){return
false;}function
select_db($j){try{$this->_db=$this->_link->selectDB($j);return
true;}catch(Exception$fc){$this->error=$fc->getMessage();return
false;}}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($G){foreach($G
as$td){$I=array();foreach($td
as$x=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$x]=63;$I[$x]=(is_a($X,'MongoId')?"ObjectId(\"$X\")":(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?"$X":(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$I;foreach($I
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$x=>$X)$H[$x]=$I[$x];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$xd=array_keys($this->_rows[0]);$B=$xd[$this->_offset++];return(object)array('name'=>$B,'charsetnr'=>$this->_charset[$B],);}}class
Min_Driver
extends
Min_SQL{public$Te="_id";function
select($Q,$K,$Z,$Lc,$we=array(),$y=1,$D=0,$Ve=false){$K=($K==array("*")?array():array_fill_keys($K,true));$Mf=array();foreach($we
as$X){$X=preg_replace('~ DESC$~','',$X,1,$rb);$Mf[$X]=($rb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($Q)->find(array(),$K)->sort($Mf)->limit($y!=""?+$y:0)->skip($D*$y));}function
insert($Q,$N){try{$H=$this->_conn->_db->selectCollection($Q)->insert($N);$this->_conn->errno=$H['code'];$this->_conn->error=$H['err'];$this->_conn->last_id=$N['_id'];return!$H['err'];}catch(Exception$fc){$this->_conn->error=$fc->getMessage();return
false;}}}function
get_databases($zc){global$h;$H=array();$Ab=$h->_link->listDBs();foreach($Ab['databases']as$l)$H[]=$l['name'];return$H;}function
count_tables($k){global$h;$H=array();foreach($k
as$l)$H[$l]=count($h->_link->selectDB($l)->getCollectionNames(true));return$H;}function
tables_list(){global$h;return
array_fill_keys($h->_db->getCollectionNames(true),'table');}function
drop_databases($k){global$h;foreach($k
as$l){$nf=$h->_link->selectDB($l)->drop();if(!$nf['ok'])return
false;}return
true;}function
indexes($Q,$i=null){global$h;$H=array();foreach($h->_db->selectCollection($Q)->getIndexInfo()as$v){$Ib=array();foreach($v["key"]as$e=>$T)$Ib[]=($T==-1?'1':null);$H[$v["name"]]=array("type"=>($v["name"]=="_id_"?"PRIMARY":($v["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($v["key"]),"lengths"=>array(),"descs"=>$Ib,);}return$H;}function
fields($Q){return
fields_from_edit();}function
found_rows($R,$Z){global$h;return$h->_db->selectCollection($_GET["select"])->count($Z);}$te=array("=");$se=null;}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$affected_rows,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Og,$C){$Xa='MongoDB\Driver\Manager';$this->_link=new$Xa($Og,$C);$this->executeCommand('admin',array('ping'=>1));}function
executeCommand($l,$fb){$Xa='MongoDB\Driver\Command';try{return$this->_link->executeCommand($l,new$Xa($fb));}catch(Exception$Rb){$this->error=$Rb->getMessage();return
array();}}function
executeBulkWrite($ee,$Qa,$sb){try{$qf=$this->_link->executeBulkWrite($ee,$Qa);$this->affected_rows=$qf->$sb();return
true;}catch(Exception$Rb){$this->error=$Rb->getMessage();return
false;}}function
query($F){return
false;}function
select_db($j){$this->_db_name=$j;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($G){foreach($G
as$td){$I=array();foreach($td
as$x=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$x]=63;$I[$x]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'."$X\")":(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->getData():(is_a($X,'MongoDB\BSON\Regex')?"$X":(is_object($X)||is_array($X)?json_encode($X,256):$X)))));}$this->_rows[]=$I;foreach($I
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$x=>$X)$H[$x]=$I[$x];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$xd=array_keys($this->_rows[0]);$B=$xd[$this->_offset++];return(object)array('name'=>$B,'charsetnr'=>$this->_charset[$B],);}}class
Min_Driver
extends
Min_SQL{public$Te="_id";function
select($Q,$K,$Z,$Lc,$we=array(),$y=1,$D=0,$Ve=false){global$h;$K=($K==array("*")?array():array_fill_keys($K,1));if(count($K)&&!isset($K['_id']))$K['_id']=0;$Z=where_to_query($Z);$Mf=array();foreach($we
as$X){$X=preg_replace('~ DESC$~','',$X,1,$rb);$Mf[$X]=($rb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$y=$_GET['limit'];$y=min(200,max(1,(int)$y));$Jf=$D*$y;$Xa='MongoDB\Driver\Query';try{return
new
Min_Result($h->_link->executeQuery("$h->_db_name.$Q",new$Xa($Z,array('projection'=>$K,'limit'=>$y,'skip'=>$Jf,'sort'=>$Mf))));}catch(Exception$Rb){$h->error=$Rb->getMessage();return
false;}}function
update($Q,$N,$bf,$y=0,$L="\n"){global$h;$l=$h->_db_name;$Z=sql_query_where_parser($bf);$Xa='MongoDB\Driver\BulkWrite';$Qa=new$Xa(array());if(isset($N['_id']))unset($N['_id']);$jf=array();foreach($N
as$x=>$Y){if($Y=='NULL'){$jf[$x]=1;unset($N[$x]);}}$Ng=array('$set'=>$N);if(count($jf))$Ng['$unset']=$jf;$Qa->update($Z,$Ng,array('upsert'=>false));return$h->executeBulkWrite("$l.$Q",$Qa,'getModifiedCount');}function
delete($Q,$bf,$y=0){global$h;$l=$h->_db_name;$Z=sql_query_where_parser($bf);$Xa='MongoDB\Driver\BulkWrite';$Qa=new$Xa(array());$Qa->delete($Z,array('limit'=>$y));return$h->executeBulkWrite("$l.$Q",$Qa,'getDeletedCount');}function
insert($Q,$N){global$h;$l=$h->_db_name;$Xa='MongoDB\Driver\BulkWrite';$Qa=new$Xa(array());if($N['_id']=='')unset($N['_id']);$Qa->insert($N);return$h->executeBulkWrite("$l.$Q",$Qa,'getInsertedCount');}}function
get_databases($zc){global$h;$H=array();foreach($h->executeCommand('admin',array('listDatabases'=>1))as$Ab){foreach($Ab->databases
as$l)$H[]=$l->name;}return$H;}function
count_tables($k){$H=array();return$H;}function
tables_list(){global$h;$cb=array();foreach($h->executeCommand($h->_db_name,array('listCollections'=>1))as$G)$cb[$G->name]='table';return$cb;}function
drop_databases($k){return
false;}function
indexes($Q,$i=null){global$h;$H=array();foreach($h->executeCommand($h->_db_name,array('listIndexes'=>$Q))as$v){$Ib=array();$f=array();foreach(get_object_vars($v->key)as$e=>$T){$Ib[]=($T==-1?'1':null);$f[]=$e;}$H[$v->name]=array("type"=>($v->name=="_id_"?"PRIMARY":(isset($v->unique)?"UNIQUE":"INDEX")),"columns"=>$f,"lengths"=>array(),"descs"=>$Ib,);}return$H;}function
fields($Q){global$m;$p=fields_from_edit();if(!$p){$G=$m->select($Q,array("*"),null,null,array(),10);if($G){while($I=$G->fetch_assoc()){foreach($I
as$x=>$X){$I[$x]=null;$p[$x]=array("field"=>$x,"type"=>"string","null"=>($x!=$m->primary),"auto_increment"=>($x==$m->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}}return$p;}function
found_rows($R,$Z){global$h;$Z=where_to_query($Z);$ug=$h->executeCommand($h->_db_name,array('count'=>$R['Name'],'query'=>$Z))->toArray();return$ug[0]->n;}function
sql_query_where_parser($bf){$bf=preg_replace('~^\sWHERE \(?\(?(.+?)\)?\)?$~','\1',$bf);$gh=explode(' AND ',$bf);$hh=explode(') OR (',$bf);$Z=array();foreach($gh
as$eh)$Z[]=trim($eh);if(count($hh)==1)$hh=array();elseif(count($hh)>1)$Z=array();return
where_to_query($Z,$hh);}function
where_to_query($ch=array(),$dh=array()){global$b;$zb=array();foreach(array('and'=>$ch,'or'=>$dh)as$T=>$Z){if(is_array($Z)){foreach($Z
as$ic){list($ab,$qe,$X)=explode(" ",$ic,3);if($ab=="_id"&&preg_match('~^(MongoDB\\\\BSON\\\\ObjectID)\("(.+)"\)$~',$X,$_)){list(,$Xa,$X)=$_;$X=new$Xa($X);}if(!in_array($qe,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$qe,$_)){$X=(float)$X;$qe=$_[1];}elseif(preg_match('~^\(date\)(.+)~',$qe,$_)){$_b=new
DateTime($X);$Xa='MongoDB\BSON\UTCDatetime';$X=new$Xa($_b->getTimestamp()*1000);$qe=$_[1];}switch($qe){case'=':$qe='$eq';break;case'!=':$qe='$ne';break;case'>':$qe='$gt';break;case'<':$qe='$lt';break;case'>=':$qe='$gte';break;case'<=':$qe='$lte';break;case'regex':$qe='$regex';break;default:continue
2;}if($T=='and')$zb['$and'][]=array($ab=>array($qe=>$X));elseif($T=='or')$zb['$or'][]=array($ab=>array($qe=>$X));}}}return$zb;}$te=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);$se='regex';}function
table($u){return$u;}function
idf_escape($u){return$u;}function
table_status($B="",$oc=false){$H=array();foreach(tables_list()as$Q=>$T){$H[$Q]=array("Name"=>$Q);if($B==$Q)return$H[$Q];}return$H;}function
create_database($l,$d){return
true;}function
last_id(){global$h;return$h->last_id;}function
error(){global$h;return
h($h->error);}function
collations(){return
array();}function
logged_user(){global$b;$vb=$b->credentials();return$vb[1];}function
connect(){global$b;$h=new
Min_DB;list($M,$V,$E)=$b->credentials();$C=array();if($V.$E!=""){$C["username"]=$V;$C["password"]=$E;}$l=$b->database();if($l!="")$C["db"]=$l;if(($Da=getenv("MONGO_AUTH_SOURCE")))$C["authSource"]=$Da;$h->connect("mongodb://$M",$C);if($h->error)return$h->error;return$h;}function
alter_indexes($Q,$c){global$h;foreach($c
as$X){list($T,$B,$N)=$X;if($N=="DROP")$H=$h->_db->command(array("deleteIndexes"=>$Q,"index"=>$B));else{$f=array();foreach($N
as$e){$e=preg_replace('~ DESC$~','',$e,1,$rb);$f[$e]=($rb?-1:1);}$H=$h->_db->selectCollection($Q)->ensureIndex($f,array("unique"=>($T=="UNIQUE"),"name"=>$B,));}if($H['errmsg']){$h->error=$H['errmsg'];return
false;}}return
true;}function
support($pc){return
preg_match("~database|indexes|descidx~",$pc);}function
db_collation($l,$bb){}function
information_schema(){}function
is_view($R){}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
foreign_keys($Q){return
array();}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$B,$p,$Bc,$gb,$Zb,$d,$Ea,$Ie){global$h;if($Q==""){$h->_db->createCollection($B);return
true;}}function
drop_tables($S){global$h;foreach($S
as$Q){$nf=$h->_db->selectCollection($Q)->drop();if(!$nf['ok'])return
false;}return
true;}function
truncate_tables($S){global$h;foreach($S
as$Q){$nf=$h->_db->selectCollection($Q)->remove();if(!$nf['ok'])return
false;}return
true;}function
driver_config(){global$te,$se;return
array('possible_drivers'=>array("mongo","mongodb"),'jush'=>"mongo",'operators'=>$te,'operator_regexp'=>$se,'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),);}}$Nb["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url,$_db;function
rootQuery($Ke,array$pb=null,$Yd='GET'){@ini_set('track_errors',1);$sc=@file_get_contents("$this->_url/".ltrim($Ke,'/'),false,stream_context_create(array('http'=>array('method'=>$Yd,'content'=>$pb!==null?json_encode($pb):null,'header'=>$pb!==null?'Content-Type: application/json':[],'ignore_errors'=>1,'follow_location'=>0,'max_redirects'=>0,))));if($sc===false){$this->error=lang(32);return
false;}$H=json_decode($sc,true);if($H===null){$this->error=lang(32);return
false;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){if(isset($H['error']['root_cause'][0]['type']))$this->error=$H['error']['root_cause'][0]['type'].": ".$H['error']['root_cause'][0]['reason'];else$this->error=lang(32);return
false;}return$H;}function
query($Ke,array$pb=null,$Yd='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($Ke,'/'),$pb,$Yd);}function
connect($M,$V,$E){$this->_url=build_http_url($M,$V,$E,"localhost",9200);$H=$this->query('');if(!$H)return
false;if(!isset($H['version']['number'])){$this->error=lang(32);return
false;}$this->server_info=$H['version']['number'];return
true;}function
select_db($j){$this->_db=$j;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows;function
__construct($J){$this->num_rows=count($J);$this->_rows=$J;reset($this->_rows);}function
fetch_assoc(){$H=current($this->_rows);next($this->_rows);return$H;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($Q,$K,$Z,$Lc,$we=array(),$y=1,$D=0,$Ve=false){global$b;$zb=array();$F="$Q/_search";if($K!=array("*"))$zb["fields"]=$K;if($we){$Mf=array();foreach($we
as$ab){$ab=preg_replace('~ DESC$~','',$ab,1,$rb);$Mf[]=($rb?array($ab=>"desc"):$ab);}$zb["sort"]=$Mf;}if($y){$zb["size"]=+$y;if($D)$zb["from"]=($D*$y);}foreach($Z
as$X){list($ab,$qe,$X)=explode(" ",$X,3);if($ab=="_id")$zb["query"]["ids"]["values"][]=$X;elseif($ab.$X!=""){$ig=array("term"=>array(($ab!=""?$ab:"_all")=>$X));if($qe=="=")$zb["query"]["filtered"]["filter"]["and"][]=$ig;else$zb["query"]["filtered"]["query"]["bool"]["must"][]=$ig;}}if($zb["query"]&&!$zb["query"]["filtered"]["query"]&&!$zb["query"]["ids"])$zb["query"]["filtered"]["query"]=array("match_all"=>array());$Tf=microtime(true);$xf=$this->_conn->query($F,$zb);if($Ve)echo$b->selectQuery("$F: ".json_encode($zb),$Tf,!$xf);if(!$xf)return
false;$H=array();foreach($xf['hits']['hits']as$Xc){$I=array();if($K==array("*"))$I["_id"]=$Xc["_id"];$p=$Xc['_source'];if($K!=array("*")){$p=array();foreach($K
as$x)$p[$x]=$Xc['fields'][$x];}foreach($p
as$x=>$X){if($zb["fields"])$X=$X[0];$I[$x]=(is_array($X)?json_encode($X):$X);}$H[]=$I;}return
new
Min_Result($H);}function
update($T,$ff,$bf,$y=0,$L="\n"){$Je=preg_split('~ *= *~',$bf);if(count($Je)==2){$t=trim($Je[1]);$F="$T/$t";return$this->_conn->query($F,$ff,'POST');}return
false;}function
insert($T,$ff){$t="";$F="$T/$t";$nf=$this->_conn->query($F,$ff,'POST');$this->_conn->last_id=$nf['_id'];return$nf['created'];}function
delete($T,$bf,$y=0){$bd=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$bd[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$Sa){$Je=preg_split('~ *= *~',$Sa);if(count($Je)==2)$bd[]=trim($Je[1]);}}$this->_conn->affected_rows=0;foreach($bd
as$t){$F="{$T}/{$t}";$nf=$this->_conn->query($F,'{}','DELETE');if(is_array($nf)&&$nf['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$h=new
Min_DB;list($M,$V,$E)=$b->credentials();if($E!=""&&$h->connect($M,$V,""))return
lang(22);if($h->connect($M,$V,$E))return$h;return$h->error;}function
support($pc){return
preg_match("~database|table|columns~",$pc);}function
logged_user(){global$b;$vb=$b->credentials();return$vb[1];}function
get_databases(){global$h;$H=$h->rootQuery('_aliases');if($H){$H=array_keys($H);sort($H,SORT_STRING);}return$H;}function
collations(){return
array();}function
db_collation($l,$bb){}function
engines(){return
array();}function
count_tables($k){global$h;$H=array();$G=$h->query('_stats');if($G&&$G['indices']){$hd=$G['indices'];foreach($hd
as$gd=>$Uf){$fd=$Uf['total']['indexing'];$H[$gd]=$fd['index_total'];}}return$H;}function
tables_list(){global$h;if(min_version(6))return
array('_doc'=>'table');$H=$h->query('_mapping');if($H)$H=array_fill_keys(array_keys($H[$h->_db]["mappings"]),'table');return$H;}function
table_status($B="",$oc=false){global$h;$xf=$h->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$H=array();if($xf){$S=$xf["aggregations"]["count_by_type"]["buckets"];foreach($S
as$Q){$H[$Q["key"]]=array("Name"=>$Q["key"],"Engine"=>"table","Rows"=>$Q["doc_count"],);if($B!=""&&$B==$Q["key"])return$H[$B];}}return$H;}function
error(){global$h;return
h($h->error);}function
information_schema(){}function
is_view($R){}function
indexes($Q,$i=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($Q){global$h;$Nd=array();if(min_version(6)){$G=$h->query("_mapping");if($G)$Nd=$G[$h->_db]['mappings']['properties'];}else{$G=$h->query("$Q/_mapping");if($G){$Nd=$G[$Q]['properties'];if(!$Nd)$Nd=$G[$h->_db]['mappings'][$Q]['properties'];}}$H=array();if($Nd){foreach($Nd
as$B=>$o){$H[$B]=array("field"=>$B,"full_type"=>$o["type"],"type"=>$o["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($o["properties"]){unset($H[$B]["privileges"]["insert"]);unset($H[$B]["privileges"]["update"]);}}}return$H;}function
foreign_keys($Q){return
array();}function
table($u){return$u;}function
idf_escape($u){return$u;}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
fk_support($R){}function
found_rows($R,$Z){return
null;}function
create_database($l){global$h;return$h->rootQuery(urlencode($l),null,'PUT');}function
drop_databases($k){global$h;return$h->rootQuery(urlencode(implode(',',$k)),array(),'DELETE');}function
alter_table($Q,$B,$p,$Bc,$gb,$Zb,$d,$Ea,$Ie){global$h;$Ye=array();foreach($p
as$mc){$qc=trim($mc[1][0]);$rc=trim($mc[1][1]?$mc[1][1]:"text");$Ye[$qc]=array('type'=>$rc);}if(!empty($Ye))$Ye=array('properties'=>$Ye);return$h->query("_mapping/{$B}",$Ye,'PUT');}function
drop_tables($S){global$h;$H=true;foreach($S
as$Q)$H=$H&&$h->query(urlencode($Q),array(),'DELETE');return$H;}function
last_id(){global$h;return$h->last_id;}function
driver_config(){$U=array();$Wf=array();foreach(array(lang(27)=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),lang(28)=>array("date"=>10),lang(25)=>array("string"=>65535,"text"=>65535),lang(29)=>array("binary"=>255),)as$x=>$X){$U+=$X;$Wf[$x]=array_keys($X);}return
array('possible_drivers'=>array("json + allow_url_fopen"),'jush'=>"elastic",'operators'=>array("=","query"),'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),'types'=>$U,'structured_types'=>$Wf,);}}class
Adminer{var$operators=array("<=",">=");var$_values=array();function
name(){return"<a href='https://www.adminerevo.org'".target_blank()." id='h1'>".lang(33)."</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($tb=false){return
password_file($tb);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($M){}function
database(){global$h;if($h){$k=$this->databases(false);return(!$k?$h->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1)"):$k[(information_schema($k[0])?1:0)]);}}function
schemas(){return
schemas();}function
databases($zc=true){return
get_databases($zc);}function
queryTimeout(){return
5;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$H=array();$q="adminer.css";if(file_exists($q))$H[]=$q;return$H;}function
loginForm(){echo"<table cellspacing='0' class='layout'>\n",$this->loginFormField('username','<tr><th>'.lang(34).'<td>','<input type="hidden" name="auth[driver]" value="server"><input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'.script("focus(qs('#username'));")),$this->loginFormField('password','<tr><th>'.lang(35).'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),"</table>\n","<p><input type='submit' value='".lang(36)."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],lang(37))."\n";}function
loginFormField($B,$Vc,$Y){return$Vc.$Y;}function
login($Ld,$E){return
true;}function
tableName($cg){return
h($cg["Comment"]!=""?$cg["Comment"]:$cg["Name"]);}function
fieldName($o,$we=0){return
h(preg_replace('~\s+\[.*\]$~','',($o["comment"]!=""?$o["comment"]:$o["field"])));}function
selectLinks($cg,$N=""){$a=$cg["Name"];if($N!==null)echo'<p class="tabs"><a href="'.h(ME.'edit='.urlencode($a).$N).'">'.lang(38)."</a>\n";}function
foreignKeys($Q){return
foreign_keys($Q);}function
backwardKeys($Q,$bg){$H=array();foreach(get_rows("SELECT TABLE_NAME, CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_NAME = ".q($Q)."
ORDER BY ORDINAL_POSITION",null,"")as$I)$H[$I["TABLE_NAME"]]["keys"][$I["CONSTRAINT_NAME"]][$I["COLUMN_NAME"]]=$I["REFERENCED_COLUMN_NAME"];foreach($H
as$x=>$X){$B=$this->tableName(table_status($x,true));if($B!=""){$xf=preg_quote($bg);$L="(:|\\s*-)?\\s+";$H[$x]["name"]=(preg_match("(^$xf$L(.+)|^(.+?)$L$xf\$)iu",$B,$_)?$_[2].$_[3]:$B);}else
unset($H[$x]);}return$H;}function
backwardKeysPrint($Ia,$I){foreach($Ia
as$Q=>$Ha){foreach($Ha["keys"]as$db){$z=ME.'select='.urlencode($Q);$s=0;foreach($db
as$e=>$X)$z.=where_link($s++,$e,$I[$X]);echo"<a href='".h($z)."'>".h($Ha["name"])."</a>";$z=ME.'edit='.urlencode($Q);foreach($db
as$e=>$X)$z.="&set".urlencode("[".bracket_escape($e)."]")."=".urlencode($I[$X]);echo"<a href='".h($z)."' title='".lang(38)."'>+</a> ";}}}function
selectQuery($F,$Tf,$nc=false){return"<!--\n".str_replace("--","--><!-- ",$F)."\n(".format_time($Tf).")\n-->\n";}function
rowDescription($Q){foreach(fields($Q)as$o){if(preg_match("~varchar|character varying~",$o["type"]))return
idf_escape($o["field"]);}return"";}function
rowDescriptions($J,$Dc){$H=$J;foreach($J[0]as$x=>$X){if(list($Q,$t,$B)=$this->_foreignColumn($Dc,$x)){$bd=array();foreach($J
as$I)$bd[$I[$x]]=q($I[$x]);$Hb=$this->_values[$Q];if(!$Hb)$Hb=get_key_vals("SELECT $t, $B FROM ".table($Q)." WHERE $t IN (".implode(", ",$bd).")");foreach($J
as$ce=>$I){if(isset($I[$x]))$H[$ce][$x]=(string)$Hb[$I[$x]];}}}return$H;}function
selectLink($X,$o){}function
selectVal($X,$z,$o,$_e){$H=$X;$z=h($z);if(preg_match('~blob|bytea~',$o["type"])&&!is_utf8($X)){$H=lang(39,strlen($_e));if(preg_match("~^(GIF|\xFF\xD8\xFF|\x89PNG\x0D\x0A\x1A\x0A)~",$_e))$H="<img src='$z' alt='$H'>";}if(like_bool($o)&&$H!="")$H=(preg_match('~^(1|t|true|y|yes|on)$~i',$X)?lang(40):lang(41));if($z)$H="<a href='$z'".(is_url($z)?target_blank():"").">$H</a>";if(!$z&&!like_bool($o)&&preg_match(number_type(),$o["type"]))$H="<div class='number'>$H</div>";elseif(preg_match('~date~',$o["type"]))$H="<div class='datetime'>$H</div>";return$H;}function
editVal($X,$o){if(preg_match('~date|timestamp~',$o["type"])&&$X!==null)return
preg_replace('~^(\d{2}(\d+))-(0?(\d+))-(0?(\d+))~',lang(42),$X);return$X;}function
selectColumnsPrint($K,$f){}function
selectSearchPrint($Z,$f,$w){$Z=(array)$_GET["where"];echo'<fieldset id="fieldset-search"><legend>'.lang(43)."</legend><div>\n";$xd=array();foreach($Z
as$x=>$X)$xd[$X["col"]]=$x;$s=0;$p=fields($_GET["select"]);foreach($f
as$B=>$Gb){$o=$p[$B];if(preg_match("~enum~",$o["type"])||like_bool($o)){$x=$xd[$B];$s--;echo"<div>".h($Gb)."<input type='hidden' name='where[$s][col]' value='".h($B)."'>:",(like_bool($o)?" <select name='where[$s][val]'>".optionlist(array(""=>"",lang(41),lang(40)),$Z[$x]["val"],true)."</select>":enum_input("checkbox"," name='where[$s][val][]'",$o,(array)$Z[$x]["val"],($o["null"]?0:null))),"</div>\n";unset($f[$B]);}elseif(is_array($C=$this->_foreignKeyOptions($_GET["select"],$B))){if($p[$B]["null"])$C[0]='('.lang(7).')';$x=$xd[$B];$s--;echo"<div>".h($Gb)."<input type='hidden' name='where[$s][col]' value='".h($B)."'><input type='hidden' name='where[$s][op]' value='='>: <select name='where[$s][val]'>".optionlist($C,$Z[$x]["val"],true)."</select></div>\n";unset($f[$B]);}}$s=0;foreach($Z
as$X){if(($X["col"]==""||$f[$X["col"]])&&"$X[col]$X[val]"!=""){echo"<div><select name='where[$s][col]'><option value=''>(".lang(44).")".optionlist($f,$X["col"],true)."</select>",html_select("where[$s][op]",array(-1=>"")+$this->operators,$X["op"]),"<input type='search' name='where[$s][val]' value='".h($X["val"])."'>".script("mixin(qsl('input'), {onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});",""),"<input type='image' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.8.4")."' class='jsonly icon' title='",h(lang(45)),"' alt='x'>".script('qsl(".icon").onclick = selectRemoveRow;',""),"</div>\n";$s++;}}echo"<div><select name='where[$s][col]'><option value=''>(".lang(44).")".optionlist($f,null,true)."</select>",script("qsl('select').onchange = selectAddRow;",""),html_select("where[$s][op]",array(-1=>"")+$this->operators),"<input type='search' name='where[$s][val]'>",script("mixin(qsl('input'), {onchange: function () { this.parentNode.firstChild.onchange(); }, onsearch: selectSearchSearch});"),"<input type='image' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.8.4")."' class='jsonly icon' title='",h(lang(45)),"' alt='x'>",script('qsl(".icon").onclick = selectRemoveRow;',""),"</div>","</div></fieldset>\n";}function
selectOrderPrint($we,$f,$w){$xe=array();foreach($w
as$x=>$v){$we=array();foreach($v["columns"]as$X)$we[]=$f[$X];if(count(array_filter($we,'strlen'))>1&&$x!="PRIMARY")$xe[$x]=implode(", ",$we);}if($xe){echo'<fieldset><legend>'.lang(46)."</legend><div>","<select name='index_order'>".optionlist(array(""=>"")+$xe,($_GET["order"][0]!=""?"":$_GET["index_order"]),true)."</select>","</div></fieldset>\n";}if($_GET["order"])echo"<div style='display: none;'>".hidden_fields(array("order"=>array(1=>reset($_GET["order"])),"desc"=>($_GET["desc"]?array(1=>1):array()),))."</div>\n";}function
selectLimitPrint($y){echo"<fieldset><legend>".lang(47)."</legend><div>";echo
html_select("limit",array("","50","100"),$y),"</div></fieldset>\n";}function
selectLengthPrint($kg){}function
selectActionPrint($w){echo"<fieldset><legend>".lang(48)."</legend><div>","<input type='submit' value='".lang(49)."'>","</div></fieldset>\n";}function
selectCommandPrint(){return
true;}function
selectImportPrint(){return
true;}function
selectEmailPrint($Wb,$f){if($Wb){print_fieldset("email",lang(50),$_POST["email_append"]);echo"<div>",script("qsl('div').onkeydown = partialArg(bodyKeydown, 'email');"),"<p>".lang(51).": <input name='email_from' value='".h($_POST?$_POST["email_from"]:$_COOKIE["adminer_email"])."'>\n",lang(52).": <input name='email_subject' value='".h($_POST["email_subject"])."'>\n","<p><textarea name='email_message' rows='15' cols='75'>".h($_POST["email_message"].($_POST["email_append"]?'{$'."$_POST[email_addition]}":""))."</textarea>\n","<p>".script("qsl('p').onkeydown = partialArg(bodyKeydown, 'email_append');","").html_select("email_addition",$f,$_POST["email_addition"])."<input type='submit' name='email_append' value='".lang(11)."'>\n";echo"<p>".lang(53).": <input type='file' name='email_files[]'>".script("qsl('input').onchange = emailFileChange;"),"<p>".(count($Wb)==1?'<input type="hidden" name="email_field" value="'.h(key($Wb)).'">':html_select("email_field",$Wb)),"<input type='submit' name='email' value='".lang(54)."'>".confirm(),"</div>\n","</div></fieldset>\n";}}function
selectColumnsProcess($f,$w){return
array(array(),array());}function
selectSearchProcess($p,$w){global$m;$H=array();foreach((array)$_GET["where"]as$x=>$Z){$ab=$Z["col"];$qe=$Z["op"];$X=$Z["val"];if(($x<0?"":$ab).$X!=""){$ib=array();foreach(($ab!=""?array($ab=>$p[$ab]):$p)as$B=>$o){if($ab!=""||is_numeric($X)||!preg_match(number_type(),$o["type"])){$B=idf_escape($B);if($ab!=""&&$o["type"]=="enum")$ib[]=(in_array(0,$X)?"$B IS NULL OR ":"")."$B IN (".implode(", ",array_map('intval',$X)).")";else{$lg=preg_match('~char|text|enum|set~',$o["type"]);$Y=$this->processInput($o,(!$qe&&$lg&&preg_match('~^[^%]+$~',$X)?"%$X%":$X));$ib[]=$m->convertSearch($B,$X,$o).($Y=="NULL"?" IS".($qe==">="?" NOT":"")." $Y":(in_array($qe,$this->operators)||$qe=="="?" $qe $Y":($lg?" LIKE $Y":" IN (".str_replace(",","', '",$Y).")")));if($x<0&&$X=="0")$ib[]="$B IS NULL";}}}$H[]=($ib?"(".implode(" OR ",$ib).")":"1 = 0");}}return$H;}function
selectOrderProcess($p,$w){$ed=$_GET["index_order"];if($ed!="")unset($_GET["order"][1]);if($_GET["order"])return
array(idf_escape(reset($_GET["order"])).($_GET["desc"]?" DESC":""));foreach(($ed!=""?array($w[$ed]):$w)as$v){if($ed!=""||$v["type"]=="INDEX"){$Qc=array_filter($v["descs"]);$Gb=false;foreach($v["columns"]as$X){if(preg_match('~date|timestamp~',$p[$X]["type"])){$Gb=true;break;}}$H=array();foreach($v["columns"]as$x=>$X)$H[]=idf_escape($X).(($Qc?$v["descs"][$x]:$Gb)?" DESC":"");return$H;}}return
array();}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return"100";}function
selectEmailProcess($Z,$Dc){if($_POST["email_append"])return
true;if($_POST["email"]){$Af=0;if($_POST["all"]||$_POST["check"]){$o=idf_escape($_POST["email_field"]);$Yf=$_POST["email_subject"];$Wd=$_POST["email_message"];preg_match_all('~\{\$([a-z0-9_]+)\}~i',"$Yf.$Wd",$A);$J=get_rows("SELECT DISTINCT $o".($A[1]?", ".implode(", ",array_map('idf_escape',array_unique($A[1]))):"")." FROM ".table($_GET["select"])." WHERE $o IS NOT NULL AND $o != ''".($Z?" AND ".implode(" AND ",$Z):"").($_POST["all"]?"":" AND ((".implode(") OR (",array_map('where_check',(array)$_POST["check"]))."))"));$p=fields($_GET["select"]);foreach($this->rowDescriptions($J,$Dc)as$I){$lf=array('{\\'=>'{');foreach($A[1]as$X)$lf['{$'."$X}"]=$this->editVal($I[$X],$p[$X]);$Vb=$I[$_POST["email_field"]];if(is_mail($Vb)&&send_mail($Vb,strtr($Yf,$lf),strtr($Wd,$lf),$_POST["email_from"],$_FILES["email_files"]))$Af++;}}cookie("adminer_email",$_POST["email_from"]);redirect(remove_from_uri(),lang(55,$Af));}return
false;}function
selectQueryBuild($K,$Z,$Lc,$we,$y,$D){return"";}function
messageQuery($F,$mg,$nc=false){return" <span class='time'>".@date("H:i:s")."</span><!--\n".str_replace("--","--><!-- ",$F)."\n".($mg?"($mg)\n":"")."-->";}function
editRowPrint($Q,$p,$I,$Ng){}function
editFunctions($o){$H=array();if($o["null"]&&preg_match('~blob~',$o["type"]))$H["NULL"]=lang(7);$H[""]=($o["null"]||$o["auto_increment"]||like_bool($o)?"":"*");if(preg_match('~date|time~',$o["type"]))$H["now"]=lang(56);if(preg_match('~_(md5|sha1)$~i',$o["field"],$_))$H[]=strtolower($_[1]);return$H;}function
editInput($Q,$o,$Ba,$Y){if($o["type"]=="enum"){$C=array();$zf=$Y;if(isset($_GET["select"])){$C[-1]=lang(8);if($zf===null)$zf=-1;}if($o["null"]){$C[""]="NULL";if($Y===null&&!isset($_GET["select"]))$zf="";}$C[0]=lang(7);preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$A);foreach($A[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$C[$s+1]=$X;if($Y===$X)$zf=$s+1;}return"<select$Ba>".optionlist($C,(string)$zf,1)."</select>";}$C=$this->_foreignKeyOptions($Q,$o["field"],$Y);if($C!==null)return(is_array($C)?"<select$Ba>".optionlist($C,$Y,true)."</select>":"<input value='".h($Y)."'$Ba class='hidden'>"."<input value='".h($C)."' class='jsonly'>"."<div></div>".script("qsl('input').oninput = partial(whisper, '".ME."script=complete&source=".urlencode($Q)."&field=".urlencode($o["field"])."&value=');
qsl('div').onclick = whisperClick;",""));if(like_bool($o))return'<input type="checkbox" value="1"'.(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?' checked':'')."$Ba>";$Wc="";if(preg_match('~time~',$o["type"]))$Wc=lang(57);if(preg_match('~date|timestamp~',$o["type"]))$Wc=lang(58).($Wc?" [$Wc]":"");if($Wc)return"<input value='".h($Y)."'$Ba> ($Wc)";if(preg_match('~_(md5|sha1)$~i',$o["field"]))return"<input type='password' value='".h($Y)."'$Ba>";return'';}function
editHint($Q,$o,$Y){return(preg_match('~\s+(\[.*\])$~',($o["comment"]!=""?$o["comment"]:$o["field"]),$_)?h(" $_[1]"):'');}function
processInput($o,$Y,$r=""){if($r=="now")return"$r()";$H=$Y;if(preg_match('~date|timestamp~',$o["type"])&&preg_match('(^'.str_replace('\$1','(?P<p1>\d*)',preg_replace('~(\\\\\\$([2-6]))~','(?P<p\2>\d{1,2})',preg_quote(lang(42)))).'(.*))',$Y,$_))$H=($_["p1"]!=""?$_["p1"]:($_["p2"]!=""?($_["p2"]<70?20:19).$_["p2"]:gmdate("Y")))."-$_[p3]$_[p4]-$_[p5]$_[p6]".end($_);$H=($o["type"]=="bit"&&preg_match('~^[0-9]+$~',$Y)?$H:q($H));if($Y==""&&like_bool($o))$H="'0'";elseif($Y==""&&($o["null"]||!preg_match('~char|text~',$o["type"])))$H="NULL";elseif(preg_match('~^(md5|sha1)$~',$r))$H="$r($H)";return
unconvert_field($o,$H);}function
dumpOutput(){return
array();}function
dumpFormat(){return
array('csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($l){}function
dumpTable($Q,$Xf,$sd=0){echo"\xef\xbb\xbf";}function
dumpData($Q,$Xf,$F){global$h;$G=$h->query($F,1);if($G){while($I=$G->fetch_assoc()){if($Xf=="table"){dump_csv(array_keys($I));$Xf="INSERT";}dump_csv($I);}}}function
dumpFilename($ad){return
friendly_url($ad);}function
dumpHeaders($ad,$ae=false){$jc="csv";header("Content-Type: text/csv; charset=utf-8");return$jc;}function
importServerPath(){}function
homepage(){return
true;}function
navigation($Zd){global$ca;echo'<h1>
',$this->name(),' <span class="version">',$ca,'</span>
<a href="https://www.adminerevo.org"',target_blank(),' id="version">',(version_compare($ca,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Zd=="auth"){$vc=true;foreach((array)$_SESSION["pwds"]as$Vg=>$Ff){foreach($Ff[""]as$V=>$E){if($E!==null){if($vc){echo"<ul id='logins'>",script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$vc=false;}echo"<li><a href='".h(auth_url($Vg,"",$V))."'>".($V!=""?h($V):"<i>".lang(7)."</i>")."</a>\n";}}}}else{$this->databasesPrint($Zd);if($Zd!="db"&&$Zd!="ns"){$R=table_status('',true);if(!$R)echo"<p class='message'>".lang(9)."\n";else$this->tablesPrint($R);}}}function
databasesPrint($Zd){}function
tablesPrint($S){echo"<ul id='tables'>",script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($S
as$I){echo'<li>';$B=$this->tableName($I);if(isset($I["Engine"])&&$B!=""){echo"<a href='".h(ME).'select='.urlencode($I["Name"])."'".bold($_GET["select"]==$I["Name"]||$_GET["edit"]==$I["Name"],"select")." title='".lang(59)."'>$B</a>\n","<a href='".h(ME).'select='.urlencode($I["Name"])."'".bold($_GET["select"]==$I["Name"]||$_GET["edit"]==$I["Name"],"")." title='".lang(59)."'>$B</a>\n";}}echo"</ul>\n";}function
_foreignColumn($Dc,$e){foreach((array)$Dc[$e]as$Cc){if(count($Cc["source"])==1){$B=$this->rowDescription($Cc["table"]);if($B!=""){$t=idf_escape($Cc["target"][0]);return
array($Cc["table"],$t,$B);}}}}function
_foreignKeyOptions($Q,$e,$Y=null){global$h;if(list($gg,$t,$B)=$this->_foreignColumn(column_foreign_keys($Q),$e)){$H=&$this->_values[$gg];if($H===null){$R=table_status($gg);$H=($R["Rows"]>1000?"":array(""=>"")+get_key_vals("SELECT $t, $B FROM ".table($gg)." ORDER BY 2"));}if(!$H&&$Y!==null)return$h->result("SELECT $B FROM ".table($gg)." WHERE $t = ".q($Y));return$H;}}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);$Nb=array("server"=>"MySQL")+$Nb;if(!defined("DRIVER")){define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($M="",$V="",$E="",$j=null,$Pe=null,$Lf=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Yc,$Pe)=explode(":",$M,2);$Sf=$b->connectSsl();if($Sf)$this->ssl_set($Sf['key'],$Sf['cert'],$Sf['ca'],'','');$H=@$this->real_connect(($M!=""?$Yc:ini_get("mysqli.default_host")),($M.$V!=""?$V:ini_get("mysqli.default_user")),($M.$V.$E!=""?$E:ini_get("mysqli.default_pw")),$j,(is_numeric($Pe)?$Pe:ini_get("mysqli.default_port")),(!is_numeric($Pe)?$Pe:$Lf),($Sf?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$H;}function
set_charset($Ra){if(parent::set_charset($Ra))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $Ra");}function
result($F,$o=0){$G=$this->query($F);if(!$G)return
false;$I=$G->fetch_array();return$I[$o];}function
quote($P){return"'".$this->escape_string($P)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($M,$V,$E){if(ini_bool("mysql.allow_local_infile")){$this->error=lang(60,"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($M!=""?$M:ini_get("mysql.default_host")),("$M$V"!=""?$V:ini_get("mysql.default_user")),("$M$V$E"!=""?$E:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($Ra){if(function_exists('mysql_set_charset')){if(mysql_set_charset($Ra,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $Ra");}function
quote($P){return"'".mysql_real_escape_string($P,$this->_link)."'";}function
select_db($j){return
mysql_select_db($j,$this->_link);}function
query($F,$Gg=false){$G=@($Gg?mysql_unbuffered_query($F,$this->_link):mysql_query($F,$this->_link));$this->error="";if(!$G){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($G===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;return
mysql_result($G->_result,0,$o);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($G){$this->_result=$G;$this->num_rows=mysql_num_rows($G);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$H=mysql_fetch_field($this->_result,$this->_offset++);$H->orgtable=$H->table;$H->orgname=$H->name;$H->charsetnr=($H->blob?63:0);return$H;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($M,$V,$E){global$b;$C=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$Sf=$b->connectSsl();if($Sf){if(!empty($Sf['key']))$C[PDO::MYSQL_ATTR_SSL_KEY]=$Sf['key'];if(!empty($Sf['cert']))$C[PDO::MYSQL_ATTR_SSL_CERT]=$Sf['cert'];if(!empty($Sf['ca']))$C[PDO::MYSQL_ATTR_SSL_CA]=$Sf['ca'];}$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$E,$C);return
true;}function
set_charset($Ra){$this->query("SET NAMES $Ra");}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($F,$Gg=false){$this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,!$Gg);return
parent::query($F,$Gg);}}}class
Min_Driver
extends
Min_SQL{function
insert($Q,$N){return($N?parent::insert($Q,$N):queries("INSERT INTO ".table($Q)." ()\nVALUES ()"));}function
insertUpdate($Q,$J,$Te){$f=array_keys(reset($J));$Se="INSERT INTO ".table($Q)." (".implode(", ",$f).") VALUES\n";$Ug=array();foreach($f
as$x)$Ug[$x]="$x = VALUES($x)";$Zf="\nON DUPLICATE KEY UPDATE ".implode(", ",$Ug);$Ug=array();$Fd=0;foreach($J
as$N){$Y="(".implode(", ",$N).")";if($Ug&&(strlen($Se)+$Fd+strlen($Y)+strlen($Zf)>1e6)){if(!queries($Se.implode(",\n",$Ug).$Zf))return
false;$Ug=array();$Fd=0;}$Ug[]=$Y;$Fd+=strlen($Y)+2;}return
queries($Se.implode(",\n",$Ug).$Zf);}function
slowQuery($F,$ng){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$ng FOR $F";elseif(preg_match('~^(SELECT\b)(.+)~is',$F,$_))return"$_[1] /*+ MAX_EXECUTION_TIME(".($ng*1000).") */ $_[2]";}}function
convertSearch($u,$X,$o){return(preg_match('~char|text|enum|set~',$o["type"])&&!preg_match("~^utf8~",$o["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($u USING ".charset($this->_conn).")":$u);}function
warnings(){$G=$this->_conn->query("SHOW WARNINGS");if($G&&$G->num_rows){ob_start();select($G);return
ob_get_clean();}}function
tableHelp($B){$Od=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($Od?"information-schema-$B-table/":str_replace("_","-",$B)."-table.html"));if(DB=="mysql")return($Od?"mysql$B-table/":"system-database.html");}}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
table($u){return
idf_escape($u);}function
connect(){global$b,$U,$Wf;$h=new
Min_DB;$vb=$b->credentials();if($h->connect($vb[0],$vb[1],$vb[2])){$h->set_charset(charset($h));$h->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$h)){$Wf[lang(25)][]="json";$U["json"]=4294967295;}return$h;}$H=$h->error;if(function_exists('iconv')&&!is_utf8($H)&&strlen($uf=iconv("windows-1250","utf-8",$H))>strlen($H))$H=$uf;return$H;}function
get_databases($zc){$H=get_session("dbs");if($H===null){$F=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$H=($zc?slow_query($F):get_vals($F));restart_session();set_session("dbs",$H);stop_session();}return$H;}function
limit($F,$Z,$y,$ke=0,$L=" "){return" $F$Z".($y!==null?$L."LIMIT $y".($ke?" OFFSET $ke":""):"");}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($l,$bb){global$h;$H=null;$tb=$h->result("SHOW CREATE DATABASE ".idf_escape($l),1);if(preg_match('~ COLLATE ([^ ]+)~',$tb,$_))$H=$_[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$tb,$_))$H=$bb[$_[1]][-1];return$H;}function
engines(){$H=array();foreach(get_rows("SHOW ENGINES")as$I){if(preg_match("~YES|DEFAULT~",$I["Support"]))$H[]=$I["Engine"];}return$H;}function
logged_user(){global$h;return$h->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($k){$H=array();foreach($k
as$l)$H[$l]=count(get_vals("SHOW TABLES IN ".idf_escape($l)));return$H;}function
table_status($B="",$oc=false){$H=array();foreach(get_rows($oc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($B!=""?"AND TABLE_NAME = ".q($B):"ORDER BY Name"):"SHOW TABLE STATUS".($B!=""?" LIKE ".q(addcslashes($B,"%_\\")):""))as$I){if($I["Engine"]=="InnoDB")$I["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$I["Comment"]);if(!isset($I["Engine"]))$I["Comment"]="";if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]===null;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"])||(preg_match('~NDB~i',$R["Engine"])&&min_version(5.6));}function
fields($Q){$H=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($Q))as$I){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$I["Type"],$_);$H[$I["Field"]]=array("field"=>$I["Field"],"full_type"=>$I["Type"],"type"=>$_[1],"length"=>$_[2],"unsigned"=>ltrim($_[3].$_[4]),"default"=>($I["Default"]!=""||preg_match("~char|set~",$_[1])?(preg_match('~text~',$_[1])?stripslashes(preg_replace("~^'(.*)'\$~",'\1',$I["Default"])):$I["Default"]):null),"null"=>($I["Null"]=="YES"),"auto_increment"=>($I["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$I["Extra"],$_)?$_[1]:""),"collation"=>$I["Collation"],"privileges"=>array_flip(preg_split('~, *~',$I["Privileges"])),"comment"=>$I["Comment"],"primary"=>($I["Key"]=="PRI"),"generated"=>preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$I["Extra"]),);}return$H;}function
indexes($Q,$i=null){$H=array();foreach(get_rows("SHOW INDEX FROM ".table($Q),$i)as$I){$B=$I["Key_name"];$H[$B]["type"]=($B=="PRIMARY"?"PRIMARY":($I["Index_type"]=="FULLTEXT"?"FULLTEXT":($I["Non_unique"]?($I["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$H[$B]["columns"][]=$I["Column_name"];$H[$B]["lengths"][]=($I["Index_type"]=="SPATIAL"?null:$I["Sub_part"]);$H[$B]["descs"][]=null;}return$H;}function
foreign_keys($Q){global$h,$ne;static$Le='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$H=array();$ub=$h->result("SHOW CREATE TABLE ".table($Q),1);if($ub){preg_match_all("~CONSTRAINT ($Le) FOREIGN KEY ?\\(((?:$Le,? ?)+)\\) REFERENCES ($Le)(?:\\.($Le))? \\(((?:$Le,? ?)+)\\)(?: ON DELETE ($ne))?(?: ON UPDATE ($ne))?~",$ub,$A,PREG_SET_ORDER);foreach($A
as$_){preg_match_all("~$Le~",$_[2],$Nf);preg_match_all("~$Le~",$_[5],$gg);$H[idf_unescape($_[1])]=array("db"=>idf_unescape($_[4]!=""?$_[3]:$_[4]),"table"=>idf_unescape($_[4]!=""?$_[4]:$_[3]),"source"=>array_map('idf_unescape',$Nf[0]),"target"=>array_map('idf_unescape',$gg[0]),"on_delete"=>($_[6]?$_[6]:"RESTRICT"),"on_update"=>($_[7]?$_[7]:"RESTRICT"),);}}return$H;}function
view($B){global$h;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$h->result("SHOW CREATE VIEW ".table($B),1)));}function
collations(){$H=array();foreach(get_rows("SHOW COLLATION")as$I){if($I["Default"])$H[$I["Charset"]][-1]=$I["Collation"];else$H[$I["Charset"]][]=$I["Collation"];}ksort($H);foreach($H
as$x=>$X)asort($H[$x]);return$H;}function
information_schema($l){return(min_version(5)&&$l=="information_schema")||(min_version(5.5)&&$l=="performance_schema");}function
error(){global$h;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$h->error));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" COLLATE ".q($d):""));}function
drop_databases($k){$H=apply_queries("DROP DATABASE",$k,'idf_escape');restart_session();set_session("dbs",null);return$H;}function
rename_database($B,$d){$H=false;if(create_database($B,$d)){$S=array();$Yg=array();foreach(tables_list()as$Q=>$T){if($T=='VIEW')$Yg[]=$Q;else$S[]=$Q;}$H=(!$S&&!$Yg)||move_tables($S,$Yg,$B);drop_databases($H?array(DB):array());}return$H;}function
auto_increment(){$Fa=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$v){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$v["columns"],true)){$Fa="";break;}if($v["type"]=="PRIMARY")$Fa=" UNIQUE";}}return" AUTO_INCREMENT$Fa";}function
alter_table($Q,$B,$p,$Bc,$gb,$Zb,$d,$Ea,$Ie){$c=array();foreach($p
as$o)$c[]=($o[1]?($Q!=""?($o[0]!=""?"CHANGE ".idf_escape($o[0]):"ADD"):" ")." ".implode($o[1]).($Q!=""?$o[2]:""):"DROP ".idf_escape($o[0]));$c=array_merge($c,$Bc);$O=($gb!==null?" COMMENT=".q($gb):"").($Zb?" ENGINE=".q($Zb):"").($d?" COLLATE ".q($d):"").($Ea!=""?" AUTO_INCREMENT=$Ea":"");if($Q=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)$O$Ie");if($Q!=$B)$c[]="RENAME TO ".table($B);if($O)$c[]=ltrim($O);return($c||$Ie?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$Ie):true);}function
alter_indexes($Q,$c){foreach($c
as$x=>$X)$c[$x]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($Q).implode(",",$c));}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Yg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Yg)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Yg,$gg){global$h;$kf=array();foreach($S
as$Q)$kf[]=table($Q)." TO ".idf_escape($gg).".".table($Q);if(!$kf||queries("RENAME TABLE ".implode(", ",$kf))){$Fb=array();foreach($Yg
as$Q)$Fb[table($Q)]=view($Q);$h->select_db($gg);$l=idf_escape(DB);foreach($Fb
as$B=>$Xg){if(!queries("CREATE VIEW $B AS ".str_replace(" $l."," ",$Xg["select"]))||!queries("DROP VIEW $l.$B"))return
false;}return
true;}return
false;}function
copy_tables($S,$Yg,$gg){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($S
as$Q){$B=($gg==DB?table("copy_$Q"):idf_escape($gg).".".table($Q));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $B"))||!queries("CREATE TABLE $B LIKE ".table($Q))||!queries("INSERT INTO $B SELECT * FROM ".table($Q)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$I){$Bg=$I["Trigger"];if(!queries("CREATE TRIGGER ".($gg==DB?idf_escape("copy_$Bg"):idf_escape($gg).".".idf_escape($Bg))." $I[Timing] $I[Event] ON $B FOR EACH ROW\n$I[Statement];"))return
false;}}foreach($Yg
as$Q){$B=($gg==DB?table("copy_$Q"):idf_escape($gg).".".table($Q));$Xg=view($Q);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $B"))||!queries("CREATE VIEW $B AS $Xg[select]"))return
false;}return
true;}function
trigger($B){if($B=="")return
array();$J=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($B));return
reset($J);}function
triggers($Q){$H=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$I)$H[$I["Trigger"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($B,$T){global$h,$ac,$md,$U;$wa=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$Of="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$Fg="((".implode("|",array_merge(array_keys($U),$wa)).")\\b(?:\\s*\\(((?:[^'\")]|$ac)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Le="$Of*(".($T=="FUNCTION"?"":$md).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$Fg";$tb=$h->result("SHOW CREATE $T ".idf_escape($B),2);preg_match("~\\(((?:$Le\\s*,?)*)\\)\\s*".($T=="FUNCTION"?"RETURNS\\s+$Fg\\s+":"")."(.*)~is",$tb,$_);$p=array();preg_match_all("~$Le\\s*,?~is",$_[1],$A,PREG_SET_ORDER);foreach($A
as$Fe)$p[]=array("field"=>str_replace("``","`",$Fe[2]).$Fe[3],"type"=>strtolower($Fe[5]),"length"=>preg_replace_callback("~$ac~s",'normalize_enum',$Fe[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Fe[8] $Fe[7]"))),"null"=>1,"full_type"=>$Fe[4],"inout"=>strtoupper($Fe[1]),"collation"=>strtolower($Fe[9]),);if($T!="FUNCTION")return
array("fields"=>$p,"definition"=>$_[11]);return
array("fields"=>$p,"returns"=>array("type"=>$_[12],"length"=>$_[13],"unsigned"=>$_[15],"collation"=>$_[16]),"definition"=>$_[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($B,$I){return
idf_escape($B);}function
last_id(){global$h;return$h->result("SELECT LAST_INSERT_ID()");}function
explain($h,$F){return$h->query("EXPLAIN ".(min_version(5.1)&&!min_version(5.7)?"PARTITIONS ":"").$F);}function
found_rows($R,$Z){return($Z||$R["Engine"]!="InnoDB"?null:$R["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($vf,$i=null){return
true;}function
create_sql($Q,$Ea,$Xf){global$h;$H=$h->result("SHOW CREATE TABLE ".table($Q),1);if(!$Ea)$H=preg_replace('~ AUTO_INCREMENT=\d+~','',$H);return$H;}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
use_sql($j){return"USE ".idf_escape($j);}function
trigger_sql($Q){$H="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")),null,"-- ")as$I)$H.="\nCREATE TRIGGER ".idf_escape($I["Trigger"])." $I[Timing] $I[Event] ON ".table($I["Table"])." FOR EACH ROW\n$I[Statement];;\n";return$H;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($o){if(preg_match("~binary~",$o["type"]))return"HEX(".idf_escape($o["field"]).")";if($o["type"]=="bit")return"BIN(".idf_escape($o["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($o["field"]).")";}function
unconvert_field($o,$H){if(preg_match("~binary~",$o["type"]??null))$H="UNHEX($H)";if(isset($o["type"])&&$o["type"]=="bit")$H="CONV($H, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]??null)){$Se=(min_version(8)?"ST_":"");$H=$Se."GeomFromText($H, $Se"."SRID($o[field]))";}return$H;}function
support($pc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view")))."~",$pc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$h;return$h->result("SELECT @@max_connections");}function
driver_config(){$U=array();$Wf=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),lang(28)=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),lang(25)=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),lang(61)=>array("enum"=>65535,"set"=>64),lang(29)=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),lang(31)=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$x=>$X){$U+=$X;$Wf[$x]=array_keys($X);}return
array('possible_drivers'=>array("MySQLi","MySQL","PDO_MySQL"),'jush'=>"sql",'types'=>$U,'structured_types'=>$Wf,'unsigned'=>array("unsigned","zerofill","unsigned zerofill"),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("char_length","date","distinct","from_unixtime","unix_timestamp","lower","round","floor","ceil","sec_to_time","time_to_sec","upper"),'operator_regexp'=>'REGEXP','grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",)),);}}$jb=driver_config();$Re=$jb['possible_drivers'];$ud=$jb['jush'];$U=$jb['types'];$Wf=$jb['structured_types'];$Mg=$jb['unsigned'];$te=$jb['operators'];$se=isset($jb['operator_regexp'])&&in_array($jb['operator_regexp'],$te)?$jb['operator_regexp']:null;$Kc=$jb['functions'];$Oc=$jb['grouping'];$Sb=$jb['edit_functions'];if($b->operators===null){$b->operators=$te;$b->operator_regexp=$se;}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ca="4.8.4";function
page_header($pg,$n="",$Pa=array(),$qg=""){global$ba,$ca,$b,$Nb,$ud;page_headers();if(is_ajax()&&$n){page_messages($n);exit;}$rg=$pg.($qg!=""?": $qg":"");$sg=strip_tags($rg.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="',$ba,'" dir="',lang(62),'">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$sg,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.8.4"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.8.4");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.8.4"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.8.4"),'">
';foreach($b->css()as$xb){echo'<link rel="stylesheet" type="text/css" href="',h($xb),'">
';}}echo'
<body class="',lang(62),' nojs editor">
';$q=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&file_exists($q)&&filemtime($q)+86400>time()){$Wg=unserialize(file_get_contents($q));$_COOKIE["adminer_version"]=$Wg["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ca', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape(lang(63)),'\';
var thousandsSeparator = \'',js_escape(lang(5)),'\';
</script>

<div id="help" class="jush-',$ud,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Pa!==null){$z=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($z?$z:".").'">'.$Nb[DRIVER].'</a> &raquo; ';$z=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$M=$b->serverName(SERVER);$M=($M!=""?$M:lang(64));if($Pa===false)echo"$M\n";else{echo"<a href='".h($z)."' accesskey='1' title='Alt+Shift+1'>$M</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Pa)))echo'<a href="'.h($z."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Pa)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Pa
as$x=>$X){$Gb=(is_array($X)?$X[1]:h($X));if($Gb!="")echo"<a href='".h(ME."$x=").urlencode(is_array($X)?$X[0]:$X)."'>$Gb</a> &raquo; ";}}echo"$pg\n";}}echo"<h2>$rg</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($n);$k=&get_session("dbs");if(DB!=""&&$k&&!in_array(DB,$k,true))$k=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$wb){$Tc=array();foreach($wb
as$x=>$X)$Tc[]="$x $X";header("Content-Security-Policy: ".implode("; ",$Tc));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self' https://api.github.com/repos/adminerevo/adminerevo/releases/latest","frame-src"=>"'self'","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$ge;if(!$ge)$ge=base64_encode(rand_string());return$ge;}function
page_messages($n){$Og=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Xd=[];if(isset($_SESSION["messages"][$Og]))$Xd=$_SESSION["messages"][$Og];if(count($Xd)>0){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Xd)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Og]);}if($n)echo"<div class='error'>$n</div>\n";}function
page_footer($Zd=""){global$b,$vg;echo'</div>

';switch_lang();if($Zd!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="',lang(65),'" id="logout">
<input type="hidden" name="token" value="',$vg,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Zd);echo'</div>
',script("setupSubmitHighlight(document);"),script("setupCopyToClipboard(document);"),"</body>\n</html>";}function
int32($ce){while($ce>=2147483648)$ce-=4294967296;while($ce<=-2147483649)$ce+=4294967296;return(int)$ce;}function
long2str($W,$ah){$uf='';foreach($W
as$X)$uf.=pack('V',$X);if($ah)return
substr($uf,0,end($W));return$uf;}function
str2long($uf,$ah){$W=array_values(unpack('V*',str_pad($uf,4*ceil(strlen($uf)/4),"\0")));if($ah)$W[]=strlen($uf);return$W;}function
xxtea_mx($kh,$jh,$ag,$vd){return
int32((($kh>>5&0x7FFFFFF)^$jh<<2)+(($jh>>3&0x1FFFFFFF)^$kh<<4))^int32(($ag^$jh)+($vd^$kh));}function
encrypt_string($Vf,$x){if($Vf=="")return"";$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($Vf,true);$ce=count($W)-1;$kh=$W[$ce];$jh=$W[0];$Ze=floor(6+52/($ce+1));$ag=0;while($Ze-->0){$ag=int32($ag+0x9E3779B9);$Rb=$ag>>2&3;for($De=0;$De<$ce;$De++){$jh=$W[$De+1];$be=xxtea_mx($kh,$jh,$ag,$x[$De&3^$Rb]);$kh=int32($W[$De]+$be);$W[$De]=$kh;}$jh=$W[0];$be=xxtea_mx($kh,$jh,$ag,$x[$De&3^$Rb]);$kh=int32($W[$ce]+$be);$W[$ce]=$kh;}return
long2str($W,false);}function
decrypt_string($Vf,$x){if($Vf=="")return"";if(!$x)return
false;$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($Vf,false);$ce=count($W)-1;$kh=$W[$ce];$jh=$W[0];$Ze=floor(6+52/($ce+1));$ag=int32($Ze*0x9E3779B9);while($ag){$Rb=$ag>>2&3;for($De=$ce;$De>0;$De--){$kh=$W[$De-1];$be=xxtea_mx($kh,$jh,$ag,$x[$De&3^$Rb]);$jh=int32($W[$De]-$be);$W[$De]=$jh;}$kh=$W[$ce];$be=xxtea_mx($kh,$jh,$ag,$x[$De&3^$Rb]);$jh=int32($W[0]-$be);$W[0]=$jh;$ag=int32($ag-0x9E3779B9);}return
long2str($W,true);}$h='';$Sc=$_SESSION["token"];if(!$Sc)$_SESSION["token"]=rand(1,1e6);$vg=get_token();$Ne=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($x)=explode(":",$X);$Ne[$x]=$X;}}function
validate_server_input(){if(SERVER=="")return;$Je=parse_url(SERVER);if(!$Je)auth_error(lang(32));if(isset($Je['user'])||isset($Je['pass'])||isset($Je['query'])||isset($Je['fragment']))auth_error(lang(32));if(isset($Je['scheme'])&&!preg_match('~^(https?)$~i',$Je['scheme']))auth_error(lang(32));$Yc=(isset($Je['host'])?$Je['host']:'').(isset($Je['path'])?$Je['path']:'');if(strpos(rtrim($Yc,'/'),'/')!==false)auth_error(lang(32));if(isset($Je['port'])&&($Je['port']<1024||$Je['port']>65535))auth_error(lang(66));}function
build_http_url($M,$V,$E,$Eb,$Db=null){if(!preg_match('~^(https?://)?([^:]*)(:\d+)?$~',rtrim($M,'/'),$A)){$this->error=lang(32);return
false;}return($A[1]?:"http://").($V!==""||$E!==""?"$V:$E@":"").($A[2]!==""?$A[2]:$Eb).(isset($A[3])?$A[3]:($Db?":$Db":""));}function
add_invalid_login(){global$b;$Ic=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$Ic)return;$pd=unserialize(stream_get_contents($Ic));$mg=time();if($pd){foreach($pd
as$qd=>$X){if($X[0]<$mg)unset($pd[$qd]);}}$od=&$pd[$b->bruteForceKey()];if(!$od)$od=array($mg+30*60,0);$od[1]++;file_write_unlock($Ic,serialize($pd));}function
check_invalid_login(){global$b;$pd=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$od=($pd?$pd[$b->bruteForceKey()]:array());if($od===null)return;$fe=($od[1]>29?$od[0]-time():0);if($fe>0)auth_error(lang(67,ceil($fe/60)));}$Ca=$_POST["auth"];if($Ca){session_regenerate_id();$Vg=$Ca["driver"];$M=trim($Ca["server"]);$V=$Ca["username"];$E=(string)$Ca["password"];$l=$Ca["db"];set_password($Vg,$M,$V,$E);$_SESSION["db"][$Vg][$M][$V][$l]=true;if($Ca["permanent"]){$x=base64_encode($Vg)."-".base64_encode($M)."-".base64_encode($V)."-".base64_encode($l);$We=$b->permanentLogin(true);$Ne[$x]="$x:".base64_encode($We?encrypt_string($E,$We):"");cookie("adminer_permanent",implode(" ",$Ne));}if(count($_POST)==1||DRIVER!=$Vg||SERVER!=$M||$_GET["username"]!==$V||DB!=$l)redirect(auth_url($Vg,$M,$V,$l));}elseif($_POST["logout"]&&(!$Sc||verify_token())){foreach(array("pwds","db","dbs","queries")as$x)set_session($x,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),lang(68));}elseif($Ne&&!$_SESSION["pwds"]){session_regenerate_id();$We=$b->permanentLogin();foreach($Ne
as$x=>$X){list(,$Wa)=explode(":",$X);list($Vg,$M,$V,$l)=array_map('base64_decode',explode("-",$x));set_password($Vg,$M,$V,decrypt_string(base64_decode($Wa),$We));$_SESSION["db"][$Vg][$M][$V][$l]=true;}}function
unset_permanent(){global$Ne;foreach($Ne
as$x=>$X){list($Vg,$M,$V,$l)=array_map('base64_decode',explode("-",$x));if($Vg==DRIVER&&$M==SERVER&&$V==$_GET["username"]&&$l==DB)unset($Ne[$x]);}cookie("adminer_permanent",implode(" ",$Ne));}function
auth_error($n){global$b,$Sc;$Gf=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$Gf]||$_GET[$Gf])&&!$Sc)$n=lang(69);else{restart_session();add_invalid_login();$E=get_password();if($E!==null){if($E===false)$n.=($n?'<br>':'').lang(70,target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$Gf]&&$_GET[$Gf]&&ini_bool("session.use_only_cookies"))$n=lang(71);$Ge=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$Ge["lifetime"]);page_header(lang(36),$n,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".lang(72)."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header(lang(73),lang(74,implode(", ",$Re)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])&&is_string(get_password())){validate_server_input();check_invalid_login();$h=connect();$m=new
Min_Driver($h);}$Ld=null;if(!is_object($h)||($Ld=$b->login($_GET["username"],get_password()))!==true){$n=(is_string($h)?h($h):(is_string($Ld)?$Ld:lang(32)));auth_error($n.(preg_match('~^ | $~',get_password())?'<br>'.lang(75):''));}if($_POST["logout"]&&$Sc&&!verify_token()){page_header(lang(65),lang(76));page_footer("db");exit;}if($Ca&&$_POST["token"])$_POST["token"]=$vg;$n='';if($_POST){if(!verify_token()){$ld="max_input_vars";$Ud=ini_get($ld);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$x){$X=ini_get($x);if($X&&(!$Ud||$X<$Ud)){$ld=$x;$Ud=$X;}}}$n=(!$_POST["token"]&&$Ud?lang(77,"'$ld'"):lang(76).' '.lang(78));}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$n=lang(79,"'post_max_size'");if(isset($_GET["sql"]))$n.=' '.lang(80);}function
email_header($Tc){return"=?UTF-8?B?".base64_encode($Tc)."?=";}function
send_mail($Vb,$Yf,$Wd,$Jc="",$tc=array()){$bc=(DIRECTORY_SEPARATOR=="/"?"\n":"\r\n");$Wd=str_replace("\n",$bc,wordwrap(str_replace("\r","","$Wd\n")));$Oa=uniqid("boundary");$Aa="";foreach((array)$tc["error"]as$x=>$X){if(!$X)$Aa.="--$Oa$bc"."Content-Type: ".str_replace("\n","",$tc["type"][$x]).$bc."Content-Disposition: attachment; filename=\"".preg_replace('~["\n]~','',$tc["name"][$x])."\"$bc"."Content-Transfer-Encoding: base64$bc$bc".chunk_split(base64_encode(file_get_contents($tc["tmp_name"][$x])),76,$bc).$bc;}$Ka="";$Uc="Content-Type: text/plain; charset=utf-8$bc"."Content-Transfer-Encoding: 8bit";if($Aa){$Aa.="--$Oa--$bc";$Ka="--$Oa$bc$Uc$bc$bc";$Uc="Content-Type: multipart/mixed; boundary=\"$Oa\"";}$Uc.=$bc."MIME-Version: 1.0$bc"."X-Mailer: Adminer Editor".($Jc?$bc."From: ".str_replace("\n","",$Jc):"");return
mail($Vb,email_header($Yf),$Ka.$Wd.$Aa,$Uc);}function
like_bool($o){return
preg_match("~bool|(tinyint|bit)\\(1\\)~",$o["full_type"]);}$h->select_db($b->database());$ne="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";$Nb[DRIVER]=lang(36);if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["download"])){$a=$_GET["download"];$p=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$K=array(idf_escape($_GET["field"]));$G=$m->select($a,$K,array(where($_GET,$p)),$K);$I=($G?$G->fetch_row():array());echo$m->value($I[0],$p[$_GET["field"]]);exit;}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$p=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$p):""):where($_GET,$p));$Ng=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($p
as$B=>$o){if(!isset($o["privileges"][$Ng?"update":"insert"])||$b->fieldName($o)==""||$o["generated"])unset($p[$B]);}if($_POST&&!$n&&!isset($_GET["select"])){$Kd=$_POST["referer"];if($_POST["insert"])$Kd=($Ng?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$Kd))$Kd=ME."select=".urlencode($a);$w=indexes($a);$Ig=unique_array($_GET["where"],$w);$cf="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($Kd,lang(81),$m->delete($a,$cf,!$Ig));else{$N=array();foreach($p
as$B=>$o){$X=process_input($o);if($X!==false&&$X!==null)$N[idf_escape($B)]=$X;}if($Ng){if(!$N)redirect($Kd);queries_redirect($Kd,lang(82),$m->update($a,$N,$cf,!$Ig));if(is_ajax()){page_headers();page_messages($n);exit;}}else{$G=$m->insert($a,$N);$Dd=($G?last_id():0);queries_redirect($Kd,lang(83,($Dd?" $Dd":"")),$G);}}}$I=null;if($_POST["save"])$I=(array)$_POST["fields"];elseif($Z){$K=array();foreach($p
as$B=>$o){if(isset($o["privileges"]["select"])){$za=convert_field($o);if($_POST["clone"]&&$o["auto_increment"])$za="''";if($ud=="sql"&&preg_match("~enum|set~",$o["type"]))$za="1*".idf_escape($B);$K[]=($za?"$za AS ":"").idf_escape($B);}}$I=array();if(!support("table"))$K=array("*");if($K){$G=$m->select($a,$K,array($Z),$K,array(),(isset($_GET["select"])?2:1));if(!$G)$n=error();else{$I=$G->fetch_assoc();if(!$I)$I=false;}if(isset($_GET["select"])&&(!$I||$G->fetch_assoc()))$I=null;}}if(!support("table")&&!$p){if(!$Z){$G=$m->select($a,array("*"),$Z,array("*"));$I=($G?$G->fetch_assoc():false);if(!$I)$I=array($m->primary=>"");}if($I){foreach($I
as$x=>$X){if(!$Z)$I[$x]=null;$p[$x]=array("field"=>$x,"null"=>($x!=$m->primary),"auto_increment"=>($x==$m->primary));}}}edit_form($a,$p,$I,$Ng);}elseif(isset($_GET["select"])){$a=$_GET["select"];$R=table_status1($a);$w=indexes($a);$p=fields($a);$Fc=column_foreign_keys($a);$le=$R["Oid"];parse_str($_COOKIE["adminer_import"],$ta);$sf=array();$f=array();$kg=null;foreach($p
as$x=>$o){$B=$b->fieldName($o);if(isset($o["privileges"]["select"])&&$B!=""){$f[$x]=html_entity_decode(strip_tags($B),ENT_QUOTES);if(is_shortable($o))$kg=$b->selectLengthProcess();}$sf+=$o["privileges"];}list($K,$Lc)=$b->selectColumnsProcess($f,$w);$rd=count($Lc)<count($K)||strstr($K[0],"DISTINCT");$Z=$b->selectSearchProcess($p,$w);$we=$b->selectOrderProcess($p,$w);$y=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Jg=>$I){$za=convert_field($p[key($I)]);$K=array($za?$za:idf_escape(key($I)));$Z[]=where_check($Jg,$p);$H=$m->select($a,$K,$Z,$K);if($H)echo
reset($H->fetch_row());}exit;}$Te=$Lg=null;foreach($w
as$v){if($v["type"]=="PRIMARY"){$Te=array_flip($v["columns"]);$Lg=($K?$Te:array());foreach($Lg
as$x=>$X){if(in_array(idf_escape($x),$K))unset($Lg[$x]);}break;}}if($le&&!$Te){$Te=$Lg=array($le=>0);$w[]=array("type"=>"PRIMARY","columns"=>array($le));}if($_POST&&!$n){$fh=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$Va=array();foreach($_POST["check"]as$Sa)$Va[]=where_check($Sa,$p);$fh[]="((".implode(") OR (",$Va)."))";}$fh=($fh?"\nWHERE ".implode(" AND ",$fh):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$Jc=($K?implode(", ",$K):"*").convert_fields($f,$p,$K)."\nFROM ".table($a);$Nc=($Lc&&$rd?"\nGROUP BY ".implode(", ",$Lc):"").($we?"\nORDER BY ".implode(", ",$we):"");if(!is_array($_POST["check"])||$Te)$F="SELECT $Jc$fh$Nc";else{$Hg=array();foreach($_POST["check"]as$X)$Hg[]="(SELECT".limit($Jc,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p).$Nc,1).")";$F=implode(" UNION ALL ",$Hg);}$b->dumpData($a,"table",$F);exit;}if(!$b->selectEmailProcess($Z,$Fc)){if($_POST["save"]||$_POST["delete"]){$G=true;$ua=0;$N=array();if(!$_POST["delete"]){foreach($f
as$B=>$X){$X=process_input($p[$B]);if($X!==null&&($_POST["clone"]||$X!==false))$N[idf_escape($B)]=($X!==false?$X:idf_escape($B));}}if($_POST["delete"]||$N){if($_POST["clone"])$F="INTO ".table($a)." (".implode(", ",array_keys($N)).")\nSELECT ".implode(", ",$N)."\nFROM ".table($a);if($_POST["all"]||($Te&&is_array($_POST["check"]))||$rd){$G=($_POST["delete"]?$m->delete($a,$fh):($_POST["clone"]?queries("INSERT $F$fh"):$m->update($a,$N,$fh)));$ua=$h->affected_rows;}else{foreach((array)$_POST["check"]as$X){$bh="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p);$G=($_POST["delete"]?$m->delete($a,$bh,1):($_POST["clone"]?queries("INSERT".limit1($a,$F,$bh)):$m->update($a,$N,$bh,1)));if(!$G)break;$ua+=$h->affected_rows;}}}$Wd=lang(84,$ua);if($_POST["clone"]&&$G&&$ua==1){$Dd=last_id();if($Dd)$Wd=lang(83," $Dd");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Wd,$G);if(!$_POST["delete"]){edit_form($a,$p,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$n=lang(85);else{$G=true;$ua=0;foreach($_POST["val"]as$Jg=>$I){$N=array();foreach($I
as$x=>$X){$x=bracket_escape($x,1);$N[idf_escape($x)]=(preg_match('~char|text~',$p[$x]["type"])||$X!=""?$b->processInput($p[$x],$X):"NULL");}$G=$m->update($a,$N," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Jg,$p),!$rd&&!$Te," ");if(!$G)break;$ua+=$h->affected_rows;}queries_redirect(remove_from_uri(),lang(84,$ua),$G);}}elseif(!is_string($sc=get_file("csv_file",true)))$n=upload_error($sc);elseif(!preg_match('~~u',$sc))$n=lang(86);else{cookie("adminer_import","output=".urlencode($ta["output"])."&format=".urlencode($_POST["separator"]));$G=true;$db=array_keys($p);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$sc,$A);$ua=count($A[0]);$m->begin();$L=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$J=array();foreach($A[0]as$x=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$L]*)$L~",$X.$L,$Rd);if(!$x&&!array_diff($Rd[1],$db)){$db=$Rd[1];$ua--;}else{$N=array();foreach($Rd[1]as$s=>$ab)$N[idf_escape($db[$s])]=($ab==""&&$p[$db[$s]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$ab))));$J[]=$N;}}$G=(!$J||$m->insertUpdate($a,$J,$Te));if($G)$G=$m->commit();queries_redirect(remove_from_uri("page"),lang(87,$ua),$G);$m->rollback();}}}$dg=$b->tableName($R);if(is_ajax()){page_headers();ob_start();}else
page_header(lang(49).": $dg",$n);$N=null;if(isset($sf["insert"])||!support("table")){$N="";foreach((array)$_GET["where"]as$X){if($Fc[$X["col"]]&&count($Fc[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$N.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($R,$N);if(!$f&&support("table"))echo"<p class='error'>".lang(88).($p?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">','<input type="submit" value="'.h(lang(49)).'">';echo"</div>\n";$b->selectColumnsPrint($K,$f);$b->selectSearchPrint($Z,$f,$w);$b->selectOrderPrint($we,$f,$w);$b->selectLimitPrint($y);$b->selectLengthPrint($kg);$b->selectActionPrint($w);echo"</form>\n";$D=$_GET["page"];if($D=="last"){$Hc=$h->result(count_rows($a,$Z,$rd,$Lc));$D=floor(max(0,$Hc-1)/$y);}$yf=$K;$Mc=$Lc;if(!$yf){$yf[]="*";$qb=convert_fields($f,$p,$K);if($qb)$yf[]=substr($qb,2);}foreach($K
as$x=>$X){$o=$p[idf_unescape($X)];if($o&&($za=convert_field($o)))$yf[$x]="$za AS $X";}if(!$rd&&$Lg){foreach($Lg
as$x=>$X){$yf[]=idf_escape($x);if($Mc)$Mc[]=idf_escape($x);}}$G=$m->select($a,$yf,$Z,$Mc,$we,$y,$D,true);if(!$G)echo"<p class='error'>".error()."\n";else{if($ud=="mssql"&&$D)$G->seek($y*$D);$Xb=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$J=array();while($I=$G->fetch_assoc()){if($D&&$ud=="oracle")unset($I["RNUM"]);$J[]=$I;}if($_GET["page"]!="last"&&$y!=""&&$Lc&&$rd&&$ud=="sql")$Hc=$h->result(" SELECT FOUND_ROWS()");if(!$J)echo"<p class='message'>".lang(12)."\n";else{$Ja=$b->backwardKeys($a,$dg);echo"<div class='scrollable'>","<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$Lc&&$K?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."' title='".lang(89)."' class='edit-all'>".lang(89)."</a>");$de=array();$Kc=array();reset($K);$ef=1;foreach($J[0]as$x=>$X){if(!isset($Lg[$x])){$X=$_GET["columns"][key($K)]??null;$o=$p[$K?($X?$X["col"]:current($K)):$x];$B=($o?$b->fieldName($o,$ef):($X["fun"]?"*":$x));if($B!=""){$ef++;$de[$x]=$B;$e=idf_escape($x);$Zc=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($x);$Gb="&desc%5B0%5D=1";echo"<th id='th[".h(bracket_escape($x))."]'>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Zc.($we[0]==$e||$we[0]==$x||(!$we&&$rd&&$Lc[0]==$e)?$Gb:'')).'">';echo
apply_sql_function($X["fun"]??null,$B)."</a>";echo"<span class='column hidden'>","<a href='".h($Zc.$Gb)."' title='".lang(90)."' class='text'> â†“</a>";if(isset($X["fun"])===false){echo'<a href="#fieldset-search" title="'.lang(43).'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($x)."');");}echo"</span>";}$Kc[$x]=$X["fun"]??null;next($K);}}$Gd=array();if($_GET["modify"]){foreach($J
as$I){foreach($I
as$x=>$X)$Gd[$x]=max($Gd[$x],min(40,strlen(utf8_decode($X))));}}echo($Ja?"<th>".lang(91):"")."</thead>\n";if(is_ajax()){if($y%2==1&&$D%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($J,$Fc)as$ce=>$I){$Ig=unique_array($J[$ce],$w);if(!$Ig){$Ig=array();foreach($J[$ce]as$x=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$x))$Ig[$x]=$X;}}$Jg="";foreach($Ig
as$x=>$X){if(($ud=="sql"||$ud=="pgsql")&&preg_match('~char|text|enum|set~',$p[$x]["type"])&&strlen($X)>64){$x=(strpos($x,'(')?$x:idf_escape($x));$x="MD5(".($ud!='sql'||preg_match("~^utf8~",$p[$x]["collation"])?$x:"CONVERT($x USING ".charset($h).")").")";$X=md5($X);}$Jg.="&".($X!==null?urlencode("where[".bracket_escape($x)."]")."=".urlencode($X===false?"f":$X):"null%5B%5D=".urlencode($x));}echo"<tr".odd().">".(!$Lc&&$K?"":"<td>".checkbox("check[]",substr($Jg,1),in_array(substr($Jg,1),(array)$_POST["check"])).($rd||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Jg)."' class='edit' title='".lang(92)."'>".lang(92)."</a>"));foreach($I
as$x=>$X){if(isset($de[$x])){$o=$p[$x];$X=$m->value($X,$o);if($X!=""&&(!isset($Xb[$x])||$Xb[$x]!=""))$Xb[$x]=(is_mail($X)?$de[$x]:"");$z="";if(preg_match('~blob|bytea|raw|file~',$o["type"]??null)&&$X!="")$z=ME.'download='.urlencode($a).'&field='.urlencode($x).$Jg;if(!$z&&$X!==null){foreach((array)$Fc[$x]as$Ec){if(count($Fc[$x])==1||end($Ec["source"])==$x){$z="";foreach($Ec["source"]as$s=>$Nf)$z.=where_link($s,$Ec["target"][$s],$J[$ce][$Nf]);$z=($Ec["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($Ec["db"]),ME):ME).'select='.urlencode($Ec["table"]).$z;if($Ec["ns"])$z=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($Ec["ns"]),$z);if(count($Ec["source"])==1)break;}}}if($x=="COUNT(*)"){$z=ME."select=".urlencode($a);$s=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Ig))$z.=where_link($s++,$W["col"],$W["val"],$W["op"]);}foreach($Ig
as$vd=>$W)$z.=where_link($s++,$vd,$W);}$X=select_value($X,$z,$o,$kg);$t=h("val[$Jg][".bracket_escape($x)."]");$Y=null;if(isset($_POST["val"][$Jg][bracket_escape($x)]))$_POST["val"][$Jg][bracket_escape($x)];$Tb=!is_array($I[$x])&&is_utf8($X)&&$J[$ce][$x]==$I[$x]&&!$Kc[$x];$jg=preg_match('~text|lob~',$o["type"]??null);echo"<td id='$t'";if(($_GET["modify"]&&$Tb)||$Y!==null){$Pc=h($Y!==null?$Y:$I[$x]);echo">".($jg?"<textarea name='$t' cols='30' rows='".(substr_count($I[$x],"\n")+1)."'>$Pc</textarea>":"<input name='$t' value='$Pc' size='$Gd[$x]'>");}else{$Md=strpos($X,"<i>â€¦</i>");echo" data-text='".($Md?2:($jg?1:0))."'".($Tb?"":" data-warning='".h(lang(93))."'").">$X</td>";}}}if($Ja)echo"<td>";$b->backwardKeysPrint($Ja,$J[$ce]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($J||$D){$gc=true;if($_GET["page"]!="last"){if($y==""||(count($J)<$y&&($J||!$D)))$Hc=($D?$D*$y:0)+count($J);elseif($ud!="sql"||!$rd){$Hc=($rd?false:found_rows($R,$Z));if($Hc<max(1e4,2*($D+1)*$y))$Hc=reset(slow_query(count_rows($a,$Z,$rd,$Lc)));else$gc=false;}}$Ee=($y!=""&&($Hc===false||$Hc>$y||$D));if($Ee){echo(($Hc===false?count($J)+1:$Hc-$D*$y)>$y?'<p><a href="'.h(remove_from_uri("page")."&page=".($D+1)).'" class="loadmore">'.lang(94).'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$y).", '".lang(95)."â€¦');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($J||$D){if($Ee){$Sd=($Hc===false?$D+(count($J)>=$y?2:1):floor(($Hc-1)/$y));echo"<fieldset>";if($ud!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".lang(96)."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".lang(96)."', '".($D+1)."')); return false; };"),pagination(0,$D).($D>5?" â€¦":"");for($s=max(1,$D-4);$s<min($Sd,$D+5);$s++)echo
pagination($s,$D);if($Sd>0){echo($D+5<$Sd?" â€¦":""),($gc&&$Hc!==false?pagination($Sd,$D):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Sd'>".lang(97)."</a>");}}else{echo"<legend>".lang(96)."</legend>",pagination(0,$D).($D>1?" â€¦":""),($D?pagination($D,$D):""),($Sd>$D?pagination($D+1,$D).($Sd>$D+1?" â€¦":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".lang(98)."</legend>";$Lb=($gc?"":"~ ").$Hc;echo
checkbox("all",1,0,($Hc!==false?($gc?"":"~ ").lang(99,$Hc):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Lb' : checked); selectCount('selected2', this.checked || !checked ? '$Lb' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>',lang(89),'</legend><div>
<input type="submit" value="',lang(14),'"',($_GET["modify"]?'':' title="'.lang(85).'"'),'>
</div></fieldset>
<fieldset><legend>',lang(100),' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="',lang(10),'">
<input type="submit" name="clone" value="',lang(101),'">
<input type="submit" name="delete" value="',lang(18),'">',confirm(),'</div></fieldset>
';}$Gc=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($Gc['sql']);break;}}if($Gc){print_fieldset("export",lang(102)." <span id='selected2'></span>");$Be=$b->dumpOutput();echo($Be?html_select("output",$Be,$ta["output"])." ":""),html_select("format",$Gc,$ta["format"])," <input type='submit' name='export' value='".lang(102)."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($Xb,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".lang(103)."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ta["format"],1);echo" <input type='submit' name='import' value='".lang(103)."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$vg'>\n","</form>\n",(!$Lc&&$K?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["script"])){if($_GET["script"]=="kill")$h->query("KILL ".number($_POST["kill"]));elseif(list($Q,$t,$B)=$b->_foreignColumn(column_foreign_keys($_GET["source"]),$_GET["field"])){$y=11;$G=$h->query("SELECT $t, $B FROM ".table($Q)." WHERE ".(preg_match('~^[0-9]+$~',$_GET["value"])?"$t = $_GET[value] OR ":"")."$B LIKE ".q("$_GET[value]%")." ORDER BY 2 LIMIT $y");for($s=1;($I=$G->fetch_row())&&$s<$y;$s++)echo"<a href='".h(ME."edit=".urlencode($Q)."&where".urlencode("[".bracket_escape(idf_unescape($t))."]")."=".urlencode($I[0]))."'>".h($I[1])."</a><br>\n";if($I)echo"...\n";}exit;}else{page_header(lang(64),"",false);if($b->homepage()){echo"<form action='' method='post'>\n","<p>".lang(104).": <input type='search' name='query' value='".h($_POST["query"])."'> <input type='submit' value='".lang(43)."'>\n";if($_POST["query"]!="")search_tables();echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^tables\[/);",""),'<th>'.lang(105),'<td>'.lang(106),"</thead>\n";foreach(table_status()as$Q=>$I){$B=$b->tableName($I);if(isset($I["Engine"])&&$B!=""){echo'<tr'.odd().'><td>'.checkbox("tables[]",$Q,in_array($Q,(array)$_POST["tables"],true)),"<th><a href='".h(ME).'select='.urlencode($Q)."'>$B</a>";$X=format_number($I["Rows"]);echo"<td align='right'><a href='".h(ME."edit=").urlencode($Q)."'>".($I["Engine"]=="InnoDB"&&$X?"~ $X":$X)."</a>";}}echo"</table>\n","</div>\n","</form>\n",script("tableCheck();");}}page_footer();