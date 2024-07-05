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
h($_[1]).$Zf.(isset($_[2])?"":"<i>…</i>");}function
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
as$B=>$o){echo"<tr><th>".$b->fieldName($o);$Cb=$_GET["set"][bracket_escape($B)]??null;if($Cb===null){$Cb=$o["default"];if($o["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Cb,$hf))$Cb=$hf[1];}$Y=($I!==null?($I[$B]!=""&&$ud=="sql"&&preg_match("~enum|set~",$o["type"])?(is_array($I[$B])?array_sum($I[$B]):+$I[$B]):(is_bool($I[$B])?+$I[$B]:$I[$B])):(!$Ng&&$o["auto_increment"]?"":(isset($_GET["select"])?false:$Cb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$o);$_c=null;if(isset($_POST["function"][$B]))$_c=(string)$_POST["function"][$B];$r=($_POST["save"]?$_c:($Ng&&preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(!$_POST&&!$Ng&&$Y==$o["default"]&&preg_match('~^[\w.]+\(~',$Y))$r="SQL";if(preg_match("~time~",$o["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$r="now";}input($o,$Y,$r);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($p){echo"<input type='submit' value='".lang(14)."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Ng?lang(15):lang(16))."' title='Ctrl+Shift+Enter'>\n",($Ng?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".lang(17)."…', this); };"):"");}}echo($Ng?"<input type='submit' name='delete' value='".lang(18)."'>".confirm()."\n":($_POST||!$p?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$vg,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` ��\0X\0Z\0\0C��>�� \r�9�\0�9\$�M'�JeR�d�]/�LfS9��m7�I[m���|:��(����nNiT�e6�+y<^�e(�,�E���Y\$�L\$u���D�K���}>�o�[������`*�������qJ������s5�ͅ�����m�rY<������+w�|�9��˷��M2}�_땢��\\\"��V\n�+��Mt����B��K�*3y�pl5���I`��V)�O��Ws��{O��I�A���s�۹��㉥��N&���c�O}~hH��@G��z���Jy�G��Cc��N���J��Ъ`귊�FC�{вU@�i>��YJ���E��iNR�(�9��A%�!���CQ�^�y�a�����t����:&��۝�Y�����G����H�/\ng��x��s�~��@�%�y8��ZU�EO�a�c��@:��\n�;G��>9�i�}�@p,����6�&���c ���F�ő^�%aR�AQ�h�I�ZԵ9z\\�š`V��5�Z����jo�T����������9!��^����O�)1�2���l����.I��~^��Q�t꒦u��s��I;Ol��B���\$�Q��9��q��	�\\e�Ts��ęU�q2H���֥J'�(E���v��T!ѐ%EQFP��v\\�o��'Jt���GI�I�D\"e����3-�	�o���j�&8E@uTIC�TUP�y3ڶ�>L^�j�����bK��#q��D�8�ʒ\\M�dq�l��\\�y^��]9���������4�hNk�_����g�^�GQ�1�)�PQ8��e�M��U�sոbRh�a��&]O5VUз-d�2��3����\\U���@kWg�+˷'�gZ��ٖE)KJ��|�qP���=�ҟ�O`[%w�O�g�N�M��Pc�S	������C!����p�������d����S��#�!�K�L=��}ߠt�p�4!����/k���6�uN��d�U2�8�X�DX��H�D��vOb4I�N<�+�q*?7W�M�!��X��,d���XN(�Ж=�����0�K�v��ǘ��25F����� #\$a&L�Sd\r����(З��FHИ�ᖒ߱2:'M��>��RX�cq���)�xd��Cp�\rah'�\0h�DȠ��`��l&&B8B�m.�rAeI�Q�2�@�)�. ��n������`���|�ًF<䤳��Z�J�[a(��KoP\"4D?T�R���gL���JU_#���8%��u\$���A���SʆK��JA�8��f����17��M]J�&1=��afK�<w�\$���	�MI�TT���H&�30�?��6ls�\$D�U���\$�Th��I�����[5*M�d�bD��P�L��s��F\0�'AJp�-\rG3�_k��]�|m��%`�_,�8����s��E<2r�!�;��|*�TT��Q-�t�ق�`<�Gl����J�i9���G�L�K�a����K{\n=M�+�1h��/��:�W\\[����q\\��Ka�le�ݲ�u�)�v-~5UL?�E�D��[1�\\V�6���6gĽf�Ϊ��8��Io�]��h[ݒ��� ��R)���!�Ι�����˕���W[��5��K��'�?�}��;�i�i����]�3�l�Fc�cL�|���^�5�;*����Ǹ�Q�博�&�<�Yu/��rٗ\n�-x�8'\r���1���)#n9���Vx%�YdI�\ntI�*��ȳs~m�7.�ǌ�RjX�+^P�eR�ײ��:J�e9�{�#';죥u�2��Rj]M��F��Z�Vj�]�����Z�Zk]m��Ʋ");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n��C���o6�C����(\"#H��a1���#y��d��1٘�n:�#(�b.\rDc)��a7E����l�ñ��i1Ύs����54��f�4�ngsI��hM��д�i:`�,��]�����Y��t�L0hD*B0\rF&3��x���s���'��[Ʉtv4��S%��0XL���W5���)�Y��f��\r^�=~9g0�\\@���r�Q�Nn�^��yN�j{�o�p�C%�ʋ�GS��Zh��5Z�|>:��'���b{�J)Ɠєt1�*uS=^���2*�8t(�0R,�8�j:�x����@9�\n�@�1\nJ��#��4��BR�J�����FƋ��>#�����J����`Ha�a�hbC0\r�4A�r�&���\nB��54�\$>�+Q�A2Do�MEL�\"��4�8��=��s5D�LW7��J��G��f�*��*Hj���E����K��1��6�ڸ�,��o�L�t�J�A�\\�\$Q�|�9-H@�0�\nxt�V��(��o�����.+�ܮ����;1D��8e*��c\rT䍣��B2܍�z��\n�83=���K�t��ƻ��u�(���km�ׅ����.���G;�+:�2)��c�n<�s��5�:�6���\n�ԡ)_�\\�6���YL�\"VV`c\$L����;��k&���\$�?�XAW�U��4��8���	�B�ޡ�ڮ���z�����*��[O�24�<?{3�6%;V���V�:\\A�䎈	x�np�x��F�<�[x����oW.����U[��Ãsd7��r���F�&	���b�Ò����]t*7ji�=�dZֹ�Yy�4�:�i���e&����P�g\\1C0�:����;��;ٹ�5�C�n��à\\܎#��ܳ���4{^����g�7u�6�NJ6O��C#�{�!�?f��xw!�7�0���JJL�48�dp�L�����ày��p�C[��.����AltPQ'�z���l�=N7���@m\n/���cTc�]t��הxia�D+p�P���p�x�ׅ�UJ%�����Da���`@^���O����E�c)�Ň@@�A'��)�h�Ub��!�AƸڠ�T~���P�\\*��9Gi��};`�ˠh\r1��Z�lx��9H�I)�Aj�R�WI9!#̆��[�ys�Zb��-���-�q؇h7➀LjQ���ʻ\"#lU`��ׄ^Ar�\r�ff�V.�Q���snh�Gg�N�����@e��%?���\$ᰂ�I����;T\0`�]���B\r�8�[��r2��`\rҢ\rCKeF2ٺ�\r'[t����()����,��M)ڸ� Se=*��N@+�9�%Pi����n�:�܋T}�ԎM��C\r�Nt���g%VÕ]��V6Hʒ�l��?Մ_V�hee,3�ھF� n�����%^k�a���M)��_��a-�N��B�-���v�����)r�J�1�N��Uly�\0�#Y�M˵����Y`�E�M��֭\"�UH-_�������� #���ܹ�E\"��\rv42���FL�8�wZ0]5Sw.���!�0ʴQ�͏3E|�%}����A��C�0t�Lk3��Pj/���kb�N�`Q����Q7�x�����_�僧��B�<�A�8��@%>�\n��x[�&\r�fy� ��!S��L�sV��G(�¹�	�B\$�a�[��F\\A�8G�&r;���or�>�b��i�RZMm��,���d�\"�<��;��\"�Q���?1�uV�~G,\0�գ�0c��`��I��ϣE��PR^fBhU���uɔ��3��CH�(& �i�:\rt�.�W&5}��U�mߗpQ���Ni�`\ndi#(1Q�K����Ғ��\n�I,�Yf`�����'�(�p7�`��q�\rt\0����U��\rs���r:ħ0و;A��,��v0�p��\r�BPcr��R��^m�.���o\n=��\\9��%F��7��Z���V�#����0|Y�ygf��?/\"���a�Mܿ����H�n�Ь�D�d����j���l\0��n�Axs�����P(3}d#u`�'����p@[[���T*`Z?\\�!��>��˄��vl����}��z�����f3�;� �!(6��/&A\08\0��\0r\r�p4��{�TT/������!\r�u��A�t�H��8JU��`r��9`���j\r��-H\"Ճ��A��TH �?����� }�q�A�3��l�~�a�~�2I^���`Z�\0004� �̓eP��&\0p`n��8�p��d���%�f\0s��O��`hD0\0�p,��� i\$����\\\0mO�[ nD�&��`aP\\�p2�.�0/0��P0\n�bV�D���d��&�����&�j�d�\"ioB0\$�&\0a��GJ& @���&O7@i\$%��\n�0/�bd�o��.\r�ro<�\rP��^��Q\n��	�o`���/�\r�^P}O6@n�������D ��d��@���0����	�^���s\0#\0�\$��zIQj��o���c�0�M�0O���C [0��@�Q�@�`p�f�/�P�,A�Np|�PNF�:�������o��l@��p��P��o@I`c	\$��p�/��%\0�Hњ��pu��P�!�h�+�\"��A�\$�\"a�_����'/?U�6��DّCq� fdiP\n%�u�Q�\0�e@p�p�#q�\0���\$�o�\np�DB���\0ϓ\0��0��^�P\"oB�0Z�O����1	�a*�%�V���j�҄����?/-!���B��,�W\"ϑP\nP�E��F�k�/p_\r�c+/\$�S/7+/4�_L�q���'�`D2%ύų#��\r nב�7p1#p�7�`��O0�\$o-!2�Pѽ'�&02�	�N�v/��1\$��io�5�\nO� ip�<���23�Q�D1���</��1-�W\r�CҍS�ٓ\n��	\0����\r�؄�J��d���r��P#�����(J�^�n��A N�4\$�(���?\"CtH\r�*�\"�1ep���tox\r|�9ӰA� ���\rADtKB�@���\0OCor�sG`�/�k�����ԍE�,�@O(�K��F���,���R�+0���A��!/�P��\0�%��#s���}PP�;\rET�E�6\r@�*�h�UK�0�1uI�8�@^�:`�p�R\0���'�� T@b\"UaU�����dhi1�SR��+�K	O�tmJGT�G�E��\0q��q�\n�����/��j�Q�\0R��A�3�s.��N�a\\��@��\n��*1/\"a�[/��ϛ0N����ك<����aR�0QUa/�-P\\Hoap-%/�\ns���kU�Ѽ��	���\\�#]6M!T�fr^\r*%PIZ��oKQ�\"VE95�2�S�\$i+6���O�HѶZ��O'Z�p2�U� �M0<��,��Y1�[��U�i96-�P�R�8p\r3?7��O'cҳ`r;ӝ``�%�31���A4�%�Wh��Yq�oG��7oa,�[Q�7o��� sk�_�gi�i,��r�O�i��j1CqI��\0/�!��ғ]�^TP�H��w�M!w��mQ�01�+��mR},�����O?+T���5pN��K^���Sf��hssv�k71�f/5cg�\0�n@��1zҴ�\0koPI#\0i'�E{�G��Z\r��V�xR�`0#!/�\nq��c!1�g?�2�n�Oj����@pД�@j\r�<�9O�q�~�@e0�!3P#����?YqلҸ�5�/?\0/��6tIu���s c�Di7���n���W�\$�UmA3k�R?u�\0r�}W�t�_bct�ō2�3p�0����1r�����;b�V�v�6;%1����7/�)�(�]1W��'��Q�U�1� ���v0\0g�����tAD�A�WBt�W��X\"aXu9I�<5CC�T��EE�KATE4!W�6) �Rc���cR\$�k�cL3:�#T4���'�s��O���c���V/��\0�3\"T�4���j)�P��P�%�r;��oLՏJT�\$�r�nt�6��N��e9��5�+#�a2\r'�MPo����9U�UmQ��X�{Y ۛqu��\0g��&Z���O�������-[����IZ:�:?S�A�\0��ڂ�` D\"���B����m�*��ePS���j��`J�X�\"�ɍK�FY�>0�nz���\r:���\0004�3,b,f�(���hޚ���L�G���3�I�CG��.X�.����,���7.j�{\$]�m�r�m�V.��Ξ��\0N��*�������vu����X��H`zON�/V��^� ��dɨ�D\0Ƙ�hI�\"��˨pi�ERV��c�9�.�O-�.��k������\0D�ϻ�aE��[���HL��\"�b�[�C�j�;�E�F9�����Q�\"��E��|���[�2{�M\0D	�F�i�\0h	\0`[痠E��\n�s������\r��0nsid�C��I�����@eŶ#e�Riv�ŜK��n�\\-�|;������7`qH`E���܇�����B�ɚC�Ӯܢ�9�|���|��z�^'p	�c8-	b��ҕIP!G*�@�%���:�@�C[�	�+�; �\0�i��(�,�L��C!��1�[H��P��V�[W`�{d��K��)�X�\\���i����k������=d�.Е{�C������כ�񛿶��<�ɿ-I;��Խ���7\"Q�?���#�ٛ�9��jE�-�%ۃ��<����<����-�\\)�ͣ����Y���`\r�����IN�!�lHp�I8!�d��]�ܽ���ٔ���<�yẉ����f	��/��j‘	g�ɵ�<�-DǛ��>葱\r���N]�{юq��d2]1�t�HFi����[C�c��L��\$_��]Ӯ�{k��t�]K��y��՛�����i�{�\$��S�i� ��=��������o���f{��Ֆ[��ݜ�ݠ��!]�A=�����4e�=�#��F������;׾���ĉ��¿���ܜ��+ȓv��ƜM��n�s�NH�q��w��\\�V�?E�<>	�!��'=����|R�w��d�6�ϊ��\rw���I?���_yɾ!�)f�w˞3����匥w�~�F�#�ɅxWt��1�(ɇRe�r�W���!���I���[�ʤp���)��K1@Hf���I��:Q S	�r;5��nbkqTʒ�����; ����� o���*�@r&��Glq<\0�.�w6����V���ckBh�H(��jOC7y�C(mp�V\n*1#����n�<�[B�R��9�2�E���@&��F�(�\n?J͐�[��AR�Wa����ػ���v8�W�f#P��:��k�{�d`����a'���t�����#�tB�mC�����Xdr+sP,Adhw�b?�`�`b[ʡ\\+HXD90���Ö]C���Y�\$/Xk`�/�\"�5��|Q`�Q��\r��j\\'C�B?�����U��ҏ�,��F��4�><�a��goA,(�M�Nr�Hke�I�,T���*��}òp8���oPi�� ������yp�\\��'?9�I��&�JN�ه�:͏<���.�c0�1� 3hB�*a�����Ezkh���L����mSԝ8��:��Ym˩�vꗯ����{	^�^���U�QI{H�[�����!\"��ە��^���N�{�x�4��;!��|�������}��|����nŵ��v�b���9ݎ<������9q���aY��`�c�8�;�o�\0f�1\$��o@5�`��} �7��@h��� �+�((wq4i��6�x=ѣq;���'9�Q�d#��� ſ�N���iyq%>��/��ãb�7ډ\r���C��l��FT��qTa���xˀ��/���N��t��_�^e�\"�6<1�S��Ƽ<G_+AWc��h��=�x����������L}��G�C�8�{�Po�,��>9[�]٘h@PÇ=���4H��~B\$���N&4���ѰPD,� ��\0�����V�@��rj���\$�>�:D\$	_Z�#���r;����z��4�'��|A �H�API�}�Dq�*�J�8p\n� EQ����8\n��  \$m`)���W�0�ZI&�ji��2J���²�[Q\n~���b�����@xk�X��rQAzb�\$�+ 	\"��搐D��\niC�>\nҊ�4��)���T�{�d��Q�h�`{���&oBr��,��B(��JjF���ād�!\\jZQAO��+�2�T��,��@");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:��gCI��\n8��3)��7���81��x:\nOg#)��r7\n\"��`�|2�gSi�H)N�S��\r��\"0��@�)�`(\$s6O!��V/=��' T4�=��iS��6IO�G#�X�VC��s��Z1.�hp8,�[�H�~Cz���2�l�c3���s���I�b�4\n�F8T��I���U*fz��r0�E����y���f�Y.:��I��(�c��΋!�_l��^�^(��N{S��)r�q�Y��l٦3�3�\n�+G���y���i���xV3w�uh�^r����a۔���c��\r���(.��Ch�<\r)�ѣ�`�7���43'm5���\n�P�:2�P����q ���C�}ī�����38�B�0�hR��r(�0��b\\0�Hr44��B�!�p�\$�rZZ�2܉.Ƀ(\\�5�|\nC(�\"��P���.��N�RT�Γ��>�HN��8HP�\\�7Jp~���2%��OC�1�.��C8·H��*�j����S(�/��6KU����<2�pOI���`���ⳈdO�H��5�-��4��pX25-Ң�ۈ�z7��\"(�P�\\32:]U����߅!]�<�A�ۤ���iڰ�l\r�\0v��#J8��wm��ɤ�<�ɠ��%m;p#�`X�D���iZ��N0����9��占��`��v0�C�9���8a�^��M�4���Ł\r�|�7�zF[\n��(�7��v���IĈ2�,9��Ì�#��ȨDW���R;��P�'�������m���3샂�\n�\0u�3����9�Cw��2��f�p{�и�/�	o4�ax�/� \\.��=NJ�G@��YE�9��a��߉mg[�ӹ��=z���{��4\0�1�CH�:�>����X�>�~]\0d�w�����s�!�:�%��9�~�a\n��j0�X�uS���6��dI�V3�̼r`A�D�@��x9'�A@\\T�a3((�\nP�`�o{e�9��=	`�\"����	�[B{!�:�x?�)'|f�8���C ?���Pu��|�@�xR;�U\0(�.5��joN)�/97L�A#8�eA��CA0&#����wKդRG����Za��H�	�U��ݑ�pR�b`W���ްJ\n�!�MD�xkV�nO�(#���yN#�h���\"@�1�\0Ɖ#8L2�\\r�Q\0r\r��`��Y��vb+��1�Hl�`��%�z�.�� �M �5l��N�b\$��2�TxH����`XH�S�W�mb)�'>'z�P�!�и�@?V��=�8\n�+�da�0��7;��ɹ���*�~�W�wܕR��*�T8CҮ]�Xn���'I2�n\$��p4�J�tX��<���>�yK)qi%Ű4>�V\n��H{�J����j��1}�6���JS�P�C��a2�\"��}�s(���ڙ�^���m*�D9ͩ��ɸu�:�A�y����T��˩L͜:+p�^��V�JG��ff���5��%�y	�ܞ����Y��[댝��[�\$EUYZ�u��J��dA��6�[-CHl���)ʃm�=G�f���c�l���R�V���xU U�XR��\$i�j�˻G	�2����[T�'\n5s��FY��h��i\0�X�%_��!�����\r��E���44����l�tm����93l���S�{�S������*g8��\$�\"k�HO)�J��bʵ�p�%\\��P��s�#��)���B:a�i���� Z^����\nk�����v2����F��P��J���ʘnB��,��ܧf���X�5�pB�`�oo����I�!=8�)�c�a��H㨬���b(���JG�aʏ��\"��B�F ��T��{��R��p*�e~2�^ �>v>����%�^1�3�w�CX=�!�g�T�e=9�p>��5;��u����+�����hM�WZA\r�ė�\\M\\�3gМ��[Y�v�qX[�b�)�2�\r��W��L+Ŋ���ez����A|e�d9A�e���\\ap.�@_��긳�~cp��%-��Z�W[�QI�7��E5��u�Ȕ[6%PCio����[1A4��KD�\$�i.	?V�{�/��_y]��@��^��q&#�\0�O<���/�����q\"�檭\\W���UH��y��Wtj���V��{�n�V��f�+μt��,�Ċ^g:�L�Ui����ݻ�e*ǏW���/-�%��嬍\"8C^��&(E\\6�����ZN�9y��s�v��^/B��0�RZ����O\0��;`N� &Q���;�P2�Β+����=M��t�Z472�hLW����o�K'�&��� z�H��ܧ��j��?\nRDG*�Ӊ�-�#�<����I����,P��,Z;h���\0�#����N�M>I`�(E���4\r�T]\"��V��\0�XQ�j~ bR`M���N-�RSN,�\"�0��	�d�~�����y\r��\r@�`�Q-\\s\n.P��)���]��\0�p�\r��]�T�����*}\rp�#����-�jE���mp!ɨf@�@�W�<cmX��v��	�z|KJm\0�@��W��������X\0��Kl<��!�N���*���G�E��C�Z���o��B��z��Т��\r�x����Ge����H�N�H(gj񂰯�\0x���o���K@�1�1lD�\$Р��`����Dv V�� bS�гH`��2��p�n�.�q��Q�J���+��*f�Mp���\r ��/D*��\"��w\$o2��[Q��F��`M�|�1�R�h�o'&�5#%j���>��j�M�گ��t��@&rpGdD�btsR�\$r�!�N�2�qo����{*,D�ɯbrM����`�.Q��q���D%ј�G	!�J���-����+�EDE`{0�䧩0DE�#���p(7��#2�ܳb�d���73M���&�ysH�\"74r�L�9-f*܋�/r�����R�Ř�R��Bn*ij�@�n�B茴�\\FI�X%x f\$�9J}9�a�0qsnF���H�|@���E3};)k7�|H����KK5���SdvR�@� �� �(� �\r����&����*Ja@fp��+J�k�,�w _?\"X\r�N��3'5&�t%�;A�8Lrn���?E�Q�\0%�NSka��8\0Ю�<��DU�G��F8VTDWe7`�����H�t����H��n ��GJl;HTjN`��@H�Ds���[t���Ύ((�H��ex��m7v�yIҾ#T�=��>(�)�\$_ԧO�OQ�-e�(*GKd�K�����t��`DV!C�8���s�D��i<)3��B���KU;8S��ZB�(��.�G����D�c�,��E�uT�p�dl�7J���3�8�D�K�\nbtNS�HUt#�{VluV��ZuF\r@�`��]6�Zǌ�ǀ][��\\\rf(0�S��S�4�3�D��'��W�:S��c:����ǅ��b)�f�����Ģ#��w5�v�s�,��r�w6&����\\m0�\0ڜ\n�J��v6�6Kd�)cu&���R�37N�S�X��5>DU�Z�:���Z'rT�7S�k_G[Ĩ�\$KU��\\�x��<m5�#�[E��\\ɞ��0W��J*.\ro�]�#��C�*��5k��g��|��<���-u��S��O7TS�^���h�o�sp f��֍8�I\\��#����8��_R{pe'2�=��S@�[�:�e8ҕ�d3�5�]r�֪��ֈ�&D�e\$�n�W[3�^���v�TԖ�w)vܭ���X0cmasZ �xm��׌�בPy�yz:��^2�b᎗9���U�qo �of>�\";�K|3yVh��l����	0N�o.�����%���@OGvJ��7M(�A���,��\"[\0��/, %����Ī���σ*��2x}˦�����g��A�!�,��,��ǖ�:&\r,�3_-�ԇl�H�o�8vwSj)V)�(��N��S�XH�XM�XC�x�'/A�XZ^��|f҃i,����ʸ�g؎��[���ڭ��@QbLxJ�����\0��j�S �Z��	�VB�\"��Ћc<Т�tP5u��P\r�ܬ����m��\"�y�B��C������M�n��w�^��1� ��N�j�x.���/*n�tI�\"�2���\"��=r���\$:kwba.�1>3h(K�om�5;�2g�|B\"i�D�\rg�B�X%����r��V�\0n�\\�F�M��m\0~\\�͞���������4`�.�*\0�@�'9��� ��� d�	�{�6�瞠�\n��P놾I���n˛��Y��[�VXm^o�Ԣ��?g���<��P�@N��/K�s�D���e�P\0x�Ǥg�}[�sG俥����S5��u���%�%E���@���/���O�Ze{��LY)�)���B�R`�	�\n�����QCL��yh7�8�3\0˲\0�6�!�N�\"�\$�[�h�@�a������Z��Zd\"\\\"���Vg�9�[)��hN`��m�L��-�՟��fЍ�d �oX�h\"�kӸ�s�J���\"m��2�N2T.����u���ǜy�p�'�c)(�ݦ������[ɶ[�`�g;�SZ�Jz�K��&�jZ�Op���	�ɧ@˪Z�Jz�(Ӯ�@{����8\0_�Ł��\n3����/|u�0K��:�I��V��:YņEm�R�f�n��4f�o�w���1��r�N���2sb0�ق<�d������/�e���Gf���ZXɌ<I��<��,b\r�ǖ�K\r��J��\"H���+q�-w��P,�\$߫%U����,՘@�ӮLiT0K2yiĳ=|\\9wā�2�B���5\n�\r��ef���J]��ѳ�WG��yb'H���Q�\\��\n@�� �s#p��8P���}�}j\r�o���`\rE R�MMHJ�W �nt��\r�*No���C�MC���B�\"�_�H�k�R��N#]�d<.��\\X�e&_G�_��n%��9�ƛ�m�4�\\Veg��1��'a������o�\r5�p|[\0М@�h �t�P�bgӦ|)������l��{)��~��|��̙קsz1vt�FF)�X�A4y/�g�!g�hN�q��h�_j̏���k+�`�0�wo��SkW~,��~��P<3�h�����~�~DXE�	\"ɺ��kR�b�\$��B�I�!IYx��F%FTg�6�-X/�\"�Rmd��kXQ�`�FS���?V�7Uв�p�&��إ�sx@o��|��?MW�`�i�����HBC�9꥚�e�;���3�;HP\"L�5	��#���^��S�,����5`�#\"Nɢ��B,\$���o�&������n�;xZ-�]�>���q1 h�e:�\0\r�[\"���*�bw�&����6�Vr����\n�>�󹑭@�S��Ț��܋�>,�43�Y���\r*�=|�Rڍ0��9�il��!SL����\$��`dN �d�����%�2�5���2��(�V������BA ]�E ���x*�	dF�3���8�	{f(^����>�H&Mf�^M��ҙ�\0]�B�����\r	��U�����*���n���Pt���`'?\n�|,`:���{���x=��8��nHrFƧ�Z�psO\n|�	QN���,�O\\)�+\n���� �.�)��\nhY�0�,_�\\�n/\$�CۄX\nP(\n�`X,�͹��MpҬ��+�+@��ƌ8�V�5y�N@��'�#�dH��\0X���=	�k�V�� ��	��BA�P�ѝ��\r(��Y��dh~��q�b	���6����AR\0X���g�|���\r`�\\�8�H�.�� NJ���q�2�\r�ԉ2�[P� �C�J�	�V�'���K�[�����H@�K�Mt��T ��	�V��=!�%'� \n�V@��!S�~�ug���DWmɗ��Z�R-�kbr� ��iƬ=���08A�d�L�����YRS��!�\"rx�Y�C�\0�CF����^�{xȐ�Ÿ������\r\"��K��=;A��\0t �L���\"ו�Eѧ�X#\n��Ƶ/�|��<CW�t^��4�v�6�R\"�te�d)��^f6���l.��&��`G5�%RJ�MIB���#��9�T���-���D\"F�Xڍ1�����~ߪJ�.-jb�`�{�h�X�'��Q�HtzV��2G��!��|K*��#Gխ��~c��H1\n%�`�d3����bYx���nIȕ`Ƿ�y�I�LhB\0�=�l!A�zS��\r�MH�b\$�E6F�~I�ȵ^����aK���O�j*a�*�ϓt��0-2�\r|2�@�~��N���F6�Ě('`\"CPE\$�ep7��R^�@��&�/\$�Rz\r\\vL���?m��\"6����-��\n`q\$���@�I�!҄C움�'	9jK�v����(�6��\$�?[�5�ʒ#��D�C%)7Ŧ܂r�5��N�*A��̎2�쩘<Bc-I�R�8^��!QV]CFBS�/�zc�&�@yI\$��35�Ո�l��.HlK1� s�\"���5�\rҶ���\$�)�k�QjJ܀E�.�7�v^\"� �Rn%�=\n�t�o�8�^68@ħɦQ �M��xK8`0%�T3 ����i�qɠ�:��E��\\�d2��I�>p��\r�8�Y���i��]�UE��d��`��ԧ^#2���dE�b\0c�L/Y�!�O�T���ĸ˦���� ��eh���\n`j�ypxB`ð+�@4T؀ig����o\0��^P���SRum�ҏ�(��gߙܥ�;5y�̴9�,�Q�4�J��9q�'X�ݼP#�	���q8�?�%�4&��q.Yͤ:q�����)v�5�!��!ȅ�k8�ʀ� �{���\$I�KخQґٖж��'t�0~�K���Y��cH) |+&Z\"�@\nB �DE{�#eHL\"V���\"���y1 ����j)9ب��6�i�Y�>��s�-h�Ѓϱ�\0^m�d���9iz#'E��A@)�aX �Q0:F�0⷟C�Un���[b��ʳ��+iHL9c�v�-�!P��F�+d(K\"����b���d��Ƅ�@���_�C� %|�;Pxu�,�Y�<�	�Qpbє�W��|b\"c�!Z�s���U?��[Jٶ]�-'�x_9�0�vŗ��F�\n��ʤXB��	q]֗FQ�JB����k�b(=XG��֐�v\"����	C�T��̵H�6R4�i�h��!^Q��\0{�j�(���B�C�xk�i:��<�8���HRp\"!�Ҝ#�[ԍ�d`0�����++���;*MѶ��]%Y�,X�E�P�,�Rb����8a�`=w�I�ڡ�Z���Q1 ��!Fb\"�T�t\n����*b���nY��h��ْ,�F�ZpV��E¾�T�|NC�@�zբ�5q��9�*^\rʎtq��h�Zc�=��]!H��w�N���K�'�Ԉ�N���T��E���US%��8��(��UE������dC�\r�N���\r�C��&iz9�");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress('');}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo'';break;case"cross.gif":echo'';break;case"up.gif":echo'';break;case"down.gif":echo'';break;case"arrow.gif":echo'';break;}}exit;}if($_GET["script"]=="version"){$Ic=file_open_lock(get_temp_dir()."/adminer.version");if($Ic)file_write_unlock($Ic,serialize(array("version"=>$_POST["version"])));exit;}global$b,$h,$m,$Nb,$Sb,$ac,$n,$Kc,$Oc,$aa,$md,$ud,$ba,$Bd,$ne,$Ne,$Wf,$Sc,$vg,$zg,$U,$Mg,$ca;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$aa=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$Ge=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$aa);if(version_compare(PHP_VERSION,'5.2.0')>=0)$Ge[]=true;call_user_func_array('session_set_cookie_params',$Ge);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$uc);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);$Bd=array('en'=>'English','ar'=>'العربية','bg'=>'Български','bn'=>'বাংলা','bs'=>'Bosanski','ca'=>'Català','cs'=>'Čeština','da'=>'Dansk','de'=>'Deutsch','el'=>'Ελληνικά','es'=>'Español','et'=>'Eesti','fa'=>'فارسی','fi'=>'Suomi','fr'=>'Français','gl'=>'Galego','he'=>'עברית','hu'=>'Magyar','id'=>'Bahasa Indonesia','it'=>'Italiano','ja'=>'日本語','ka'=>'ქართული','ko'=>'한국어','lv'=>'Latviešu','lt'=>'Lietuvių','ms'=>'Bahasa Melayu','nl'=>'Nederlands','no'=>'Norsk','pl'=>'Polski','pt'=>'Português','pt-br'=>'Português (Brazil)','ro'=>'Limba Română','ru'=>'Русский','sk'=>'Slovenčina','sl'=>'Slovenski','sr'=>'Српски','sv'=>'Svenska','ta'=>'த‌மிழ்','th'=>'ภาษาไทย','tr'=>'Türkçe','uk'=>'Українська','vi'=>'Tiếng Việt','zh'=>'简体中文','zh-tw'=>'繁體中文',);function
get_lang(){global$ba;return$ba;}function
lang($u,$ie=null){if(is_string($u)){$Qe=array_search($u,get_translations("en"));if($Qe!==false)$u=$Qe;}global$ba,$zg;$yg=($zg[$u]?$zg[$u]:$u);if(is_array($yg)){$Qe=($ie==1?0:($ba=='cs'||$ba=='sk'?($ie&&$ie<5?1:2):($ba=='fr'?(!$ie?0:1):($ba=='pl'?($ie%10>1&&$ie%10<5&&$ie/10%10!=1?1:2):($ba=='sl'?($ie%100==1?0:($ie%100==2?1:($ie%100==3||$ie%100==4?2:3))):($ba=='lt'?($ie%10==1&&$ie%100!=11?0:($ie%10>1&&$ie/10%10!=1?1:2)):($ba=='bs'||$ba=='ru'||$ba=='sr'||$ba=='uk'?($ie%10==1&&$ie%100!=11?0:($ie%10>1&&$ie%10<5&&$ie/10%10!=1?1:2)):1)))))));$yg=$yg[$Qe];}$xa=func_get_args();array_shift($xa);$Gc=str_replace("%d","%s",$yg);if($Gc!=$yg)$xa[0]=format_number($ie);return
vsprintf($Gc,$xa);}function
switch_lang(){global$ba,$Bd;echo"<form action='' method='post'>\n<div id='lang'>",lang(19).": ".html_select("lang",$Bd,$ba,"this.form.submit();")," <input type='submit' value='".lang(20)."' class='hidden'>\n","<input type='hidden' name='token' value='".get_token()."'>\n";echo"</div>\n</form>\n";}if(isset($_POST["lang"])&&verify_token()){cookie("adminer_lang",$_POST["lang"]);$_SESSION["lang"]=$_POST["lang"];$_SESSION["translations"]=array();redirect(remove_from_uri());}$ba="en";if(isset($Bd[$_COOKIE["adminer_lang"]])){cookie("adminer_lang",$_COOKIE["adminer_lang"]);$ba=$_COOKIE["adminer_lang"];}elseif(isset($Bd[$_SESSION["lang"]]))$ba=$_SESSION["lang"];else{$ra=array();preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',str_replace("_","-",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])),$A,PREG_SET_ORDER);foreach($A
as$_)$ra[$_[1]]=(isset($_[3])?$_[3]:1);arsort($ra);foreach($ra
as$x=>$Ze){if(isset($Bd[$x])){$ba=$x;break;}$x=preg_replace('~-.*~','',$x);if(!isset($ra[$x])&&isset($Bd[$x])){$ba=$x;break;}}}$zg=$_SESSION["translations"];if($_SESSION["translations_version"]!=2085034197){$zg=array();$_SESSION["translations_version"]=2085034197;}function
get_translations($Ad){switch($Ad){case"en":$g="A9D�y�@s:�G�(�ff�����	��:�S���a2\"1�..L'�I��m�#�s,�K��OP#I�@%9��i4�o2ύ���,9�%�P�b2��a��r\n2�NC�(�r4��1C`(�:Eb�9A�i:�&㙔�y��F��Y��\r�\n� 8Z�S=\$A����`�=�܌���0�\n��dF�	��n:Zΰ)��Q���mw����O��mfpQ�΂��q��a�į�#q��w7S�X3������o�\n>Z�M�zi��s;�̒��_�:���#|@�46��:�\r-z|�(j*���0�:-h��/̸�8)+r^1/Л�η,�ZӈKX�9,�p�:>#���(�6�qB�7��4�-�98@1�# ��\r1��/<(9\"��(=�h��\r�P�)��k�#�������@�,(bB1,��sl2<�*X!hH�A�P2���9���\0  P����kP�9Ikl �m�_?���\"���L�����2�B��Q�a	�r<�8)��1OAH�<�M��[\$���W����%�\$	К&�B��cʹ<�������cL����⧭~�HR=ԠH2��H�\n�%b{�Cd ñ1;�3��~�/���3��Ȇ׷���ˣL��ɢ�B����@�)�j�\n�z5/\r��6��Ƥ�c0�6v2�BD3���֟�#kd��.OB�hF]�fY�l�g�T�g�;�ZhCp�ΰ�d����n^9�9��^�X�4ȹ�;@<z~w��	R�\n��\$��m�@\$cB3��U��t��\$��,�8_#���{���	+/W��^0��XA?�zB�K�Zx�˲��?�\r~��=�[�Êr(�d`P�\0\$X�t;�٧�C2�\$#���Vǲ����?쿐9�1��\"�H��07�	K�����|h�8Τ\"��(Ap쁁\0((\0��D�I1�d� ��F�s/jψ����̂U>@�C����K�Wfx�0�~M7G(쐄0��3vA�bk �\$zm̵�RVKIy�ChT��MI i8ᐟ�^M[��nU\"E5�JI ���@��y�'�8�2�I !��\$��C<g���*�2�- �(�!���,22�I K��j�T�Õ�k�q%9���6��@X��% �Bc�G� \$Q�3�`�\"I82d�#G�s\r�bw��4#5|��X3��œ�y:+x�&]��|U�\\�]�	{��/���+D�/Կz��TME�����7i�M׊Ѐlq���vI+6lQպ���QxA\$��Fw��¨T��<#\\]�l�\$&\r3L�~K_�#��2q,��ϥ�x�Mu���!�qx��{O����/5�\rEy*��w/!T�T�Z�s����:��\nZ��\r����H)bT:!����y8 \$!&�a(��VJ�P��Sa����2pT\0r�똑��D\\�1�QUj�FR�ʊz�kq '����+�h2��1ײC_Ap";break;case"ar":$g="�C�P���l*�\r�,&\n�A���(J.��0Se\\�\r��b�@�0�,\nQ,l)���µ���A��j_1�C�M��e��S�\ng@�Og���X�DM�)��0��cA��n8�e*y#au4�� �Ir*;rS�U�dJ	}���*z�U�@��X;ai1l(n������[�y�d�u'c(��oF����e3�Nb���p2N�S��ӳ:LZ�z�P�\\b�u�.�[�Q`u	!��Jy��&2��(gT��SњM�x�5g5�K�K�¦����0ʀ(�7\rm8�7(�9\r�f\"7N�9�� ��4�x荶��x�;�#\"�������2ɰW\"J\nB��'hk�ūb�Di�\\@���p���yf���9����V�?�TXW���F��{�3)\"�W9�|��eRhU��Ҫ�1��P�>���\"o{�\$�ð�6\r#\"74��A��2��(�:\r3���1�LX��<_(=�t�*�	��1D��(�=�î�1i\\�;5Jĺh�V��,�M*�Lij�&�\$�O�r�����d4�PH�� gf�)�Q�kR<�J�\"���k��!�2���	�m-:�-{</�Yq�Si���_1b|���;&��b-�J�m'=�� �T\$	���*}�=�h�������v(�b2ٰQ`b@�	�ht)�`P�5�h��cl0���C��ޏۘX\"7�^��t%�4�eAi�(�ݍØ�7꩞��\nC��3�\0�C�c0�>\r�-!���R+U=�_ɸ!�h�F=m�P�5�saD50�f�°��6\r������S [��! �z���n\$� M�.S��F*�2����	+�7�/X_�XB&bl��P���0(�8\r4<D�CC���D4���9�Ax^;��p�2\r�TA#8_E|���kxD��H�85�m:�x�i�oCz~6��0��JP�\r������~���fT����cE�.t����fA�-���@�k�` F�8 `̂_�~!��!��͐s���\0�z�'7�������+�~�46(�⍑�~-�T��TN����F�Ņ���\r\"g����RA\n����!�&�a����4;@7�7\0�� I�;����i�RȊ�uB<���dS\nA4EB��K��%�!�>���c�O�U>\\��FkD���c�\nزt�Q��%RA�E(���'v�\\j+H�T�x*�ZA3	\$h<��@�O��f�Èu6H\\3 ���|J\n=�@���Dq�tص�a\rG@�(�Yg�3��2ڗZe�cA�A	�8R�{���HyϘ�(l\"�[#y��^3?�P��]-��O���֒۹�pb�@�)��3���`�)�܏/�\rǙ�9��rP&�a`O�I�!\n�X�E.~������U�`D�a7_h�VVt�]�YM5�����Pc9\0;��7���`+��1���rz\r���?�C0y���#T �\$��+�(*�@�A�\r��Ǟ�̊HLTn,t��oJ���0䎺���J��A0��d\\�-�z������J��J��\n\riZb�+��K���rD@#?��&�nPJA�*���{�)&ɲ_ҙ�}�!/��m���_�ߵ�P)�S^��BL[⹋�ۖI.j�+�i�aV��B�0ZKw�N�W��@";break;case"bg":$g="�P�\r�E�@4�!Awh�Z(&��~\n��fa��N�`���D��4���\"�]4\r;Ae2��a�������.a���rp��@ד�|.W.X4��FP�����\$�hR�s���}@�Зp�Д�B�4�sE�΢7f�&E�,��i�X\nFC1��l7c��MEo)_G����_<�Gӭ}���,k놊qPX�}F�+9���7i��Z贚i�Q��_a���Z��*�n^���S��9���Y�V��~�]�X\\R�6���}�j�}	�l�4�v��=��3	�\0�@D|�¤���[�����^]#�s.�3d\0*��X�7��p@2�C��9(� �:#�9��\0�7���A����8\\z8Fc�������m X���4�;��r�'HS���2�6A>�¦�6��5	�ܸ�kJ��&�j�\"K������9�{.��-�^�:�*U?�+*>S�3z>J&SK�&���hR����&�:��ɒ>I�J���L�H	#p�0��HȎ��PEa\0�9� �7�Mh9�\r�h�C��?CմKT�Q�	�g�hL�X7&�\n��=��p�K*�i�Y-���U�D1[�KJ&���U{+h���a b������@\$����0H�J�N:+g8�}�	b��\"�+���\r��u㴢�+�)��Y�Jb�c�����6#��'��~0��y�i3 P̢�/��'|������J��(2�+j��u�z>pS���-&6� zΙ�5�V�ۆ� S�F��Nn�	Bj�=���kL^pM��k�ٜ��;�&,�TB �9�#dj�W��N7r��u^�(�:Xc��7��B>��+��\r���Ae���/'�|��.%�����M�!�p�1أp��x@8CH흌�=���Q�'���h6D�\n�O��R�%Hj��3ڣ���I6�����琺�3��N:OJ,����~ݲ�8���b�H��^Z臘4������//�C?t�CNK�@�X��(\0- !����hI\\���-vB\\PѫB̌�5B�Aߩ'3���!���iK�\0v���M�����!�;Jx����a	�H�Ĺm�RD��ayAg���\\�a�``z�@t��9��^ü���2���b+�a��F�]8n���熆��K\0��}ѦU��BGO�ye>GM�@ef�ɛ4�.7,��q�A�T��ʨ�	y�Q��~�I�*rh����B5/2H�\0���` H�8\"�̊�k�!��9��CcG!�3Y��<����:��4H�a�*�`,%���c�\$\r�̢���Jgc�����p�%{��R��tB�H\n	��Pt��� ����VM[Gk�*h\"�j��sH��O)�K�pp�\r\"�p�øh\r!�{H`�f�5���0�Th�J�U��͇��O�!�/�4���M#{��&�(��I%mu�軔:n��R*d�E�T���\n)PU3�F�VE�QJr��%��TP���%�X�O��q�)�&�>\$\r��ݬV�*mMY�LP�J�szW,9RB�tQ)Zل��#/0�ӯ��4�>�-���/�E��\\y)L����H+m!U8����H�H�*���ڎ�Z*1T�)R�z&=,!��W�-Д�y�RkE���ń0�9t-d��p@��@� ��J����!�t=�;��L*�K�^ăT���Z*,��Xc�0�BK�*�0�K��1�s��-��nة1�0�y��O�h���d�6�=���\rQ� ?����SE�#�pQ�\r����2b���/k1ݔ�ƚm�\\���*��~f4�Fb��a]� \n�P#�qW%�eP��5�-&*J/2�o�J���;���ͭ�m����;A�u���-���Ң�)��-��-�w,�3�x����24��=Ľ��6���ު?�)��H��0\"��a@E�����\r�8��r���R�%R�s�u��h�go?��.�w؎�j��T1��)�1Xb/S	X*u�4���E�_�.?bcCn/H��+�&��v:�JDAC�����0���\nx-�o�\r�ɵ�*'�԰�9)<�}�1m�*���q�2�";break;case"bn":$g="�S!�\n��\0�@�xJ��_��:6\0�����P�\\33`��\0��!�(l	MS,����S,\$���]�)��d5s�@qD<6(R�\$�i�撦VI�\nxʙ+\rB�b���\0���!�e4�M*��+V�p@%9���;e��2S'�	��`�Ob��M^�bS�%UP�H��)�x2�S�)��zʞ������4��\0���h3��Q����L<��We�+l�����qr���'��PP~9��.-Z!N���E�y�@h0���q�@p9NƓa��e9�����0��X�4\r/��0�O���Λ��(%�\0Q���N�!Ί6��	Т�'P�\n����5*\n`�9�z�;�{���b껥D5đ�;h&��\r��(%\"(@;�s�ݮ�<GC��#pΩ�0ȭjbV������Ҩ1䖣���*��[�;��\0�9Cx佈�0�oX�7�`�:\$O��AR�9������zSE-���<�7�3�S\"l:������N�s	+Ĳˎ�\$�\nV����r���\r9m�f��Sz�9V��;i0hj��q�ֹq���N��-EDYY�s��)�\n ����SwE�咪��n�i�!p6H�;#`�2\$S��9@1�C(�2�àӂ�t��nj��L�pؕ�V�͊�ޥ=�[*�\n���42�e*��I�ni�G�\$�S�Z\"SBY�gT9z��R��!.���uPS50qr/���A l�����40N*r��!7�.���Q�0M,u^؉����ks��7vA\0���˖�h���h�*�%�Ѥ|q_8��k��%j�ub7D=գ�\$���<��ٮ��yS�P.q����\rOH��m5�L����A�^�%�]꺿�U/�/k��>_wަ~�M�zS3�P \rl2\$	К&�B���p�cW�5��f�Ӊ�v�Y��>N+��R�~Xs���W��^C�\r��4��6��nFʉ7���Q�<�������0n�i{�֭��� ����2lY/��|��>�H��C�Tr�`��7�v\$^��l0��D���	\0��}�3��p9�.\n�x�B���4��An��!pX����Rrϡ�t�����TBa�X9��4���p\r,EM�\0xO;�����s@��yL�d\r�u?���{�0e�A�<�x�\$6��X�t��0��&\r� �̀��XiR��6�d�a�č��&�݊��r�\n�A}Z\\uN(��@�z�C���;�@��	�3()��f�JD1�3��0u��P3��A=P���0�%&\r�e�7UȧJ	U7밉;�_��'\n (M�)��G-J�!RR�|���1Ӻ�Yz;gq��59�;�lP��KP`AC��\r��:�U.�C��1���C<��\n��0�TJ�,*�S���S\nA���x�KQL�u�*����&E�����Y�C���e^�;�(\$ښG�K��[+�}-���5kvmq�����g<F �Gl��2t4(p���M��3%k��p�l9R	\$�<�P@<Qa!�f C��C�u?\n@3(����2����M�\nX��Ÿ�{K(�\0�¡\r�gu����\\�\r���|��\"5i�ݬo.b۪\"[;5d��+*�*U��kVس�{{��*a�Xة*A�U�0�\0f�@��ɀ�)l�a�^�J�u.�	L-N4k�ҒY�I��7�Ռ�\\\r�(�=>ex��a^y�����,�F���ZFR�s���M�d6��ȣ^J.��8v�2VRUOL�;��o��cEY�!w���Qs����j��'\r����j}�6](�2&Xi�������mhR槧Ъ0-	�7=2���vkYળ ��@�k��A/�Bo)}DTS�/g<��k�A��_냕�������,�V�L��'���\\\\�ԏ�k.46�ho�H'�L�l�K��\\#�8s+��A���۪�T��_�;�����{���XSf垹�^�F6����g+d�ij�7[�\ne`o��A(���K�}��{r�J\r�G�b��m�U��D5�������-wkM��\0PS��!�-ޙ��T�\\��:�뙶�0�����;��量����UW_G�3}析";break;case"bs":$g="D0�\r����e��L�S���?	E�34S6MƨA��t7��p�tp@u9���x�N0���V\"d7����dp���؈�L�A�H�a)̅.�RL��	�p7���L�X\nFC1��l7AG���n7���(U�l�����b��eēѴ�>4����)�y��FY��\n,�΢A�f �-�����e3�Nw�|��H�\r�]�ŧ��43�X�ݣw��A!�D��6e�o7�Y>9���q�\$���iM�pV�tb�q\$�٤�\n%���LIT�k���)�乪��0�h���4	\n\n:�\n��:4P �;�c\"\\&��H�\ro�4����x��@��,�\nl�E��j�+)��\n���C�r�5����ү/�~����;.�����j�&�f)|0�B8�7����,	#s,���(䙎Q,�1�n���.�\\*�f!\"�81��9��l:���br���P�/��P���J3F53���7��,UB��8Ę��M2ScR�OST�),#�R���\\uxb�P�j�3�L֌�\"8�\ric(.nbc,��p�,#X�������\"(�F�J�	�\"_%���%��b=+�����p�%v±m)j�����uIWzx�%B9�jô����?w^���5�C��o	@t&��Ц)�C\$,6��p�<�Ⱥ��L�)	\"6��O�k�����B�5g����Ø�7�p���d��3A\0��ģ0́����4[��\"zB�1��X�.�+N�ݫ��ն�L ����(�1IH����5 �%°�t��U�!e�0��E���w�����K��p�+�L�l��Ɍ��D4���9�Ax^;�v.�*Ð\\���{��hnv����	#h�ӱ�xx�!��.�6�6�)�%C���M��D�hޅ������5�v��#��Є;&����0�P*���\\�b'!������a�:��X�( &Ⱦ�2\nL` M�P�'\0؜��|'!�#e#�}�+����H\n \$XIP1A�i��j�	)~�\$��(���BHP9\"p�l�/0���?�*BY(a\$�2�d�w� C\naH#!�L�:���9%(k_����ɽC�s�@ z���=@�C�F����^V	�`���zw��>�\$����9pB7\"sd�L�q��c���dv�^#��K,n!�0���IY� �@'�0��!��C���\n���!}��4h����!	25�\r�pf!D1��r:犙�3蹨��~�a,b�IP�@Li��R��3#H�\r � �'��p�����.@I0iG����g�e	0�����/A�	&�Qދ)����J�1������`�J��E��iB� �����H�X�CK���܊�;�Y>�u�tsA���J��8��*�@�A�;h���r\\��ly��|70�N�b	��b��Rz�e=b&u������ơKN:�զ��0����hG�Pu&�An�cQ衉>)��T��H\r�'�mJM4�e*!]1E\r)6�y��B�[H���Y)a�MU �ْ��8���t�h�5�D�B�N�餦����b�r�V����P���ٶ0/QEW���\"X";break;case"ca":$g="E9�j���e3�NC�P�\\33A�D�i��s9�LF�(��d5M�C	�@e6Ɠ���r����d�`g�I�hp��L�9��Q*�K��5L� ��S,�W-��\r��<�e4�&\"�P�b2��a��r\n1e��y��g4��&�Q:�h4�\rC�� �M���Xa����+�����\\>R��LK&��v������3��é�pt��0Y\$l�1\"P� ���d��\$�Ě`o9>U��^y�==��\n)�n�+Oo���M|���*��u���Nr9]x��{d���3j�P(��c��2&\"�:���:��\0��\r�rh�(��8����p�\r#{\$�j����#Ri�*��h����B��8B�D�J4��h��n{��K� !/28,\$�� #��@�:.̀�7��n�%�BL��l����+�Z�b�\$� �#.�P�L�<�Cp�1�!4#I�Y�\n3G�j�7;C�.ҥ*��� @1-�P�u,x<Ǌ��xH�A�����Rh8��b;\r�H�6\r���'��'�S{ &ejmM#G�(��S���S���a�T5���B\n0:���Ґ\$TDU&��\$���Ӵ�?��D1��-�2�w�C��H�|��=�~��D��r\\ӚJ�	@t&��Ц)�C ���h^-�9h�.�8%�@Ԛ\"F�}c��#��ب��:3y�\"d:�ɣd�4m*J���0���қ��&\0007S+!?�#�7�Vֵ�@�QA��C|\n�؃�ޘ���L'��\$�lZJh�Ѵ��<H��C#��:74�9��4�&\"k��\$�Z1Y��7�\0x�\r���C@�:�t��t#�0�.�8^�xq3����xD��Ȥ-OS!�^0����\r�\$��#Z:�R��}L\$q��W���!,\n��eB\n6OR�Nb�Ў�8-���%!�����]J�!�� e���1�QA��hn�C� ���&�ަS��|��e��3&�?dF�^:� �@\$�Y� D�jE�1�&/藽�\n��Xc{���D����c�TA��0�MK��Tf�\rT(o��o{��!�0��2d hu\0��ɢ3a䘣�w�b�:a�x�,�Q��J2�ԝ���aH�-	�1�E>Ia1	\$D<�H|��\"h\r�h݂(�H	*?!����M>��b�t�Y�i&ȜhfT �<��0M;�2N�)6��r�|�6Ep��נHɢ�1��&Y��Y	q�\\Y��%�)�6����F]�\0S\n!0�4�0T��]Q��q�(f�i�9&��f�٬'���)�?�W�y�R9A���:d��P�OA��Q��솒VaP*����0�{Gh�TT���l� i�6�X��51L�Е��J9%��6�j�,� �*�@�A�`9�Q��]h����!�IL���&�U�?W���\"�e��u���*�&�\$ŀ��J�%o�i7���bٚMm�<�!�<���nXa�a�t�`��ᣆ:��`�(-;?D�7�Z ͺϳ�P��I�q�u}V��N?�5T�e:��Ɓ5:�[z~X�t\"�ʰ����V��³YlÔQ����*��3mI�";break;case"cs":$g="O8�'c!�~\n��fa�N2�\r�C2i6�Q��h90�'Hi��b7����i��i6ȍ���A;͆Y��@v2�\r&�y�Hs�JGQ�8%9��e:L�:e2���Zt�@\nFC1��l7AP��4T�ت�;j\nb�dWeH��a1M��̬���N���e���^/J��-{�J�p�lP���D��le2b��c��u:F���\r��bʻ�P��77��LDn�[?j1F��7�����I61T7r���{�F�E3i����Ǔ^0�b�b���p@c4{�2�&�\0���r\"��JZ�\r(挥b�䢦�k�:�CP�)�z�=\n �1�c(�*\n��99*�^����:4���2��Y����a����8 Q�F&�X�?�|\$߸�\n!\r)���<i��R�B8�7��x�4ƈ��65��z��JQ%	�,4�#��i�@a�H�X\"�-�����	R2\n|�m��\n�H�ﯣ��.�x���[7\\���\0�0��MISU�UR���#p�@@PH� i^�/t��=X�'CH�	�;��\nc*,0ϠP��2\"��À���kʌY�8�̑��5kH��\$��7�7-�C��\"t2D7D�(�q(�\\�#`�~\\��݅�xǅ`�J5~�w�5�������!B	К&�B���p�c�d9����P�0�L|/j�ڜ'Y�=;R�3M�ʆ���j���#l�6����3�0̡@Z��2��mPѷ�މ\rT�B�C���;#(��LД\n:.p��h��m��j��ml4#H��:�k��7\"�=4��\0����4�5p�U���`�7��4�U�Ƹ<�%���.��<�!��<�l;tX�G�?U�u��]�8�g�N�nV�<�y���I�%{7�P雐�14��4;8�)��C�7��~9SS'3Kr��:��W9Z���A��[d�\r5y�%#���O� ���P�Ah��o�^ü!�QҠ\"TJC8/a���.�xn�����SeK���px�>q(��� �LLf����L�+�/�wR��\\�vC^�G��I+[H�SU����#�;���\r!�.\r�ک���y\rB᩼����H��N�F?'��IYy/q]���Z��n������|�G�h�D\n�\"��@\$\0A#N܏im�\0R�PxbR�H6�3G\"�]s2ܦ���yȤsA\n�%����\"0.9��O\0C\naH#�@�V��'l�3��`���w΄���(��yĚ����f���f8�/�k5���;L�����k�T�����zD�z� h���\$�P��A��d9����{�(ą���4@�bp���8��`�P	�L*(_��;SL���������q��7��:�0i����&C�\"�)�5PQ�g\naD&RNU�������E=ChoN��#ILoɃ{8đ�LtК���'GD_*%L���s<��̐�\\�}vU���^��Hzm�z���Ӭd'���L��j��4�U��B�{_L.�,�FiX���ր��\"2����ln��=VIXCk!���i��T��G3a�\$�?͟����R&��o��M	#�Gb�Je����T��NU�+I)67y��+Wmح����X�R歳U��Z�֫ح�u��(�D�k���[�٘'ήy�Q�nK�C����!���G.u�4��;�v���B����\$9��3D~�3��*is9	�Б^�����TE�����+@PC(36��jT��c��^e���9_*�fڤ�.\0(%��~��{P�5`��~9/�#ҁB~\0PT09#�Q0f�K3���z]��\r�";break;case"da":$g="E9�Q��k5�NC�P�\\33AAD����eA�\"���o0�#cI�\\\n&�Mpci�� :IM���Js:0�#���s�B�S�\nNF��M�,��8�P�FY8�0��cA��n8����h(�r4��&�	�I7�S	�|l�I�FS%�o7l51�r������(�6�n7���13�/�)��@a:0��\n��]���t��e�����8��g:`�	���h���B\r�g�Л����)�0�3��h\n!��pQT�k7���WX�'\"h.��e9�<:�t�=�3��ȓ�.�@;)CbҜ)�X��bD��MB���*ZH��	8�:'����;M��<����9��\r�#j������EBp�:Ѡ�欑����h�2 �T���\0�ީI��9�K���;�~��r&7�O�&8�\\b(!L�.74(��-	��B�\"�l�1M�(�s��\rC��@PH� h��)�N��;,���'�0�5B4[p���H�4��C\$2@���\r����)(#S�P'�P��\r ��Q��U�����t�\"6\no\"؉8�:�B@�	�ht)�`P���نR��	J.��Cj2=Lr���\n�\$�Wb0�8�\r�2�	�܃\r��ON�P�B�ނ-(�3�*�E���:�\"���i��E���;)+����M�2��l�V�/�<���p�<��. 9ߓ:���bt�4!hA06� ��DČ�	:S���\\�2�Ѿv�T��n��\r	���CC.8a�^��h\\���γ��z��_*Vr�J |\$���a&�A�^0��H@�im\$ލ��:tҤMJ9L�l4�g(+��cZ�ƈ����:����?��7�@;�A���\\��\"Ai���c@3��Ե��\0ИvC����Rd�4��:��k�0�c�\"��'L�6\n@���|� !B����,SC�F�J�'3��<c���k����� w\r�1��>fM���1��P	8U��6�BR������ЍxnLK\r\";�ӉQ,%�}4:p�O��X5�#�T��M�h��&[Ȉy`�	!� �}��)��2��|\rf:ļ �F�g�Kd|����~��8%o�'�0�@�SW��*#���x�6�0�H�Q]ѯ�r��H)9'd��һ���\$��:�b�a�� �����>HJ	K'	\$)��Pj{\0�#@���ˁSn`��&��<�������t��6�s=	TfT����D�I��p#�o�\0�BV*�X\r�����7��\nhp6�ց�\\��)�h!%ܑ�4&�2K�Z�Щt�zz�Y.B�F�2�s��Xg�	�\nc���\$xMnqQS@J��d�@���\$Fh��U\$bF�X��4�|3�H�Q{&r}�\0�z������Y�>\\����X�PR���>�������Y�gA!��`���'�`��Vh�r7�,����_±m�%���I]-��(�!U�ɩ�Ȩ*Uj�B*";break;case"de":$g="S4����@s4��S��%��pQ �\n6L�Sp��o��'C)�@f2�\r�s)�0a����i��i6�M�dd�b�\$RCI���[0��cI�� ��S:�y7�a��t\$�t��C��f4����(�e���*,t\n%�M�b���e6[�@���r��d��Qfa�&7���n9�ԇCіg/���* )aRA`��m+G;�=DY��:�֎Q���K\n�c\n|j�']�C�������\\�<,�:�\r٨U;Iz�d���g#��7%�_,�a�a#�\\��\n�p�7\r�:�Cx�\$k���6#zZ@�x�:����x�;�C\"f!1J*��n���.2:����8�QZ����,�\$	��0��0�s�ΎH�̀�K�Z��C\nT��m{����S��C�'��9\r`P�2��lº�\0�3�#dr� �`�|R#t�6#ah�7�Rs�����S�#Fr�D��	�x΀�T���h;��1�\0�<2�F=!��<��HKWV	h5 R�N��\\��b펮C����Ģ�����c\"��0�28���P�ލ)j�����#�`���H�\n��\n:8c0�m\r�C57͢ė\rKL�Va�t�k�Y~_�d��c\r�9�c�a)��0�T��\$Bh�\nb��\r�p�5eP�o�m���R�\")��ިbRx7f�4a�F(�š	\0晉���9K��\r�������}O��!�������u�b\rR؂�\n\r�zt6@�,DM��� �e\n�3M��h��B�@\\D�\r���Z�4�� bj� �\"� )��;�<�f����\r�4���E���|j��rN;���3�����O��g�0#��[���3�U�3�c �S��3�s[e��b��7s��\$X�j�Am=PR�q�����Ň�Cx����s@��x��m \$0 ����/hMn��^��>	!�8��|N��0��V��(F50���MjVBg9��S�� '+���S���\$�D�\0�hS%��C�^�\r�9oo��fY�k�T订v_�#����݆c�A�(c�a�:����\"�txqȃ*���kH�4s)�r:F(��H@JssGQ����xa�t2&q��h�dӐ������\n_�N#�(�\$i��7j���;�n���*@ú�s�(3��bآ�cz�Й�0��0 \n�����/�Ev���\"�4m0�Y����_�@c_�R�n�a>(>���N��F|�U�����tq���MFp���!f+��w\n&�O����B�j�!������)房��F\n�Jr� ِh�!	�P	�L*�.A�	�%7��j^Pz�4j�Q�IKO)�;�\"�R)߄�T�PW��{	d�%�p�}�A�4����54�D(��\\�	44*BE�Q4����j�(̈́JU�A�7N�cDUgF���@�JB�,��*�9aMa��صR�рw������[*X4�h��ڋ�A\rx�V�L���S�&�B�Ē?3C-Z\"r�T*`Z\r*zGD�6e�}��5��#���.z�3i��u+��[L�;��uK��f䠕1:�d����|N�LC \n5\$f����b-H�֒���V��B\"�J�-�-&p�4\"���ZS��ɢ��	\"f%��6�BX��sU�\n�X����cD��v�2XيrM��D�`�ui�\n�yɜ�g+�Q�0@*���c.ٛƌ�\0";break;case"el":$g="�J����=�Z� �&r͜�g�Y�{=;	E�30��\ng\$Y�H�9z�X���ň�U�J�fz2'g�akx��c7C�!�(�@��˥j�k9s����Vz�8�UYz�MI��!���U>�P��T-N'��DS�\n�ΤT�H}�k�-(K�TJ���ח4j0�b2��a��s ]`株��t���0���s�Oj��C;3TA]Һ���a�O�r������4�v�O���x�B�-wJ`�����#�k��4L�[_��\"�h�������-2_ɡUk]ô���u*���\"M�n�?O3���)�\\̮(R\nB�\\�\n�hg6ʣp�7kZ~A@�ٝ��L���&��.WB�����\"@I����1H�@&tg:0�Z�'�1����vg�ʃ���C�B��5��x�7(�9\r㒌\"#��1#���x�9������2���9��(Ȼ��[�y�J��x�[ʇ�+�����\\��FOz���\n��]&,Cv�,������[WBk�4�F�9~���lD�/��/!D(�(��H@K��C╖��=A��PX��J��P�HF[(eH�Bܚ�;�\\t�C�P�7��4����;LA�c��2�p�4�C�e�-Csa���N�\\�\"��c!�N��48qG^���,�⸓�2]���\na��r���s�\$&rZ3z�C��2�!.y�Ni�\\�������^zxc<qm%���8�%%�^�2RR��:��ֶЦ��2mc4�#�BiCz��)�B(Z6�#H��I1�;�?\$��V��\"*��Nu�L;�6S�}K��v�z�����|��G��ꌜJ2B@T��Htg}�n蒉�[��yx�j�㋻�������+���.\0P�4�sX�7����0��׹:_~��<g�p�4��R�ܠ|�a\r���Wb�N�FN	�� ����\"vs�\nF;OLߓ䈄e̍b7��(c`a�3�\0��\0pA�;8 ���!O���'PޝאlK����¾b��z�̟Cv�h��j5El�Ad�۩�Â��E�a.zGi��g�m����8�4���\0tD\0�Řp���L\$�)֪��\"\n�9Q��r�\"QP��B�(�v�����ł��\\^%��0�qX~O�Pq�B\$���R1��\$����%�\\�z+�\n��Іb�eZ��D�	C�B�S�CyHD9C\$��1�|���c'u����a�`z�@t��9��^ü���2��2eཀ�G��_[������ۢ�>(Q�)�x�>S�ܥ8��|^��)�l�)��aЬ��̕2s���!�B訸��Kt�Cs���w?R	<�0�!Cm?\$�7\$t�(b�Bo0i�&\0����bM��1d�aHa���0��sa�:��d�� ���4A�bG�\r@_���0&1 V䤕�8�U�b�C�gV2_Y���&%<�8�A��p�quC�@V�jTȬ��\0�\0(.��)%p��l\n,�9H�B��bM�e4�RAQ��l7\0�S��K�;������DS����a�����HD�*((�u��@R����b��!Dѷ�\$1e�����AeZ��!�4�4S�eFJ�*Ӳ���>e��\\K�)?I�E��=b�j�!�D�1sɕ'簚�hz@��֮84��\0�7f�b�'�癙j_����.��Z��\$\n�����SrT(�.c%�D��¨�)0J����T`L����%��\"�uH:�Id(�2��o�Vd�D���EVj;g\$@����|j���P��^��qVL(���e	� �R�J�(�p�+7t(���&{�%&f0�>[���g9E�PbR�5�<�ip��9^q�4�葦�F�f�[O������A,�^�������.k�N��e�#�*��k��+#�׬�_�(3�*��!�`�\n��a���7\\�~G�r����x���k�L*���Uy�>tIQ\\j��z*T����DZ�d�\n�P#�pQ�\"�9e\\�c�n�F�HN��p��Eu*�B �4YK����UI&O�>G��_|辋n��gI��0��^�1���y0�<X�\0mM�M7F�g1H�eT���x:=A2���HC](��m�w�-�<}�yw2�e\"���cC�M:'���7Jӻ�/���g^�u��*i��bs��.t�A(�#<߃��# �3��V�8���i��_7�^Q���;�5n���d!���tZw[�r���`3Z��ExAXǽ=N���dC5���b��}�/�9�c�NkH��O�&�_R1\n";break;case"es":$g="�_�NgF�@s2�Χ#x�%��pQ8� 2��y��b6D�lp�t0�����h4����QY(6�Xk��\nx�E̒)t�e�	Nd)�\n�r��b�蹖�2�\0���d3\rF�q��n4��U@Q��i3�L&ȭV�t2�����4&�̆�1��)L�(N\"-��DˌM�Q��v�U#v�Bg����S���x��#W�Ўu��@���R <�f�q�Ӹ�pr�q�߼�n�3t\"O��B�7��(������%�vI��� ���U7�{є�9M��	���9�J�: �bM��;��\"h(-�\0�ϭ�`@:���0�\n@6/̂��.#R�)�ʊ�8�4�	��0�p�*\r(�4���C��\$�\\.9�**a�Ck쎁B0ʗÎз P��H���P�:F[*�#p칍#\"�4	T\"1������+��=�\"S#n\$���r��7�#s��%N�9P��'�*�-2���C�4�AM/�<�+;��xH�A�>��0�a�t3��HD��<��v'�Q�&<��1�u�j0,�\"�-0\"�L����5��D\"��KO��X����gN�W(��#WE����FB@�	�ht)�`P�2�h��c0��P�7 ���Q�爑����\nPA�8�E�B8���#1b k�6L�6�����3<�r��M��v!��bT�#ե\rXgC��5Mb�!.R6���`@ih�6\r㻔�g�-k	.X�iQA�T��g��K�2���H0�d�s�?H�@�C�\r\"�0��A#����8��\0y\r`��C@�:�t��LF�j���p��=��D�p^)A𒒤2S��}��RP�)�[p@��i�>��t�C(��#)BT�M7���Q5�v��h*\r\n&�ڄ�L�z���3-�T�0��\\d##��Ic\\P��熃b�C\nJ8I��. �fy�8,���%�\n�C�y�\"(*�H�P	@����\0()@��B`Ù-������ӀA!����C�uA),�L	{�.yO�(~p�\n���无�F:�؂�C��B��\r������o��;5�u���l\0Om�\"��x`�rm�⦔h���\$�d�ÒX���b��!Tސ�Qw��\0��D��3�\r`7�BsM�W1��H�4\$Ch [N���~ܣLN6Dl0��TC���<�����\rʥ���:B'�1�Zd�\"Duɤ��0�)F,���	��3��ƹ�����)�����*BI�H�1'\$h3J���i4R��K�z��	��1�#a�@\n�fX7���u�D_!�ޝ�.�&�]��r��r�\n�U�6��y%L�2����a)E�,���h���C���@B�F��33Z���2�,��HO�S��Z|ђ:My�GD}��B��hC��*���#0�X�Ū���Dʈ6��\na��U8���SX�^P�0sy���d�*hbj&�ھ������0ѡ�A@��T���A�Df\0U�z��!m�n�)RVhU[g���E^��5�����ŀ�m�x��6˂�ϵv�&\0";break;case"et":$g="K0���a�� 5�M�C)�~\n��fa�F0�M��\ry9�&!��\n2�IIن��cf�p(�a5��3#t����ΧS��%9�����p���N�S\$�X\nFC1��l7AGH��\n7��&xT��\n*LP�|� ���j��\n)�NfS����9��f\\U}:���Rɼ� 4Nғq�Uj;F��| ��:�/�II�����R��7���a�ýa�����t��p���Aߚ�'#<�{�Л��]���a��	��U7�sp��r9Zf�C�)2��ӤWR��O����c�ҽ�	����jx����2�n�v)\nZ�ގ�~2�,X��#j*D(�2<�p��,��<1E`P�:��Ԡ���88#(��!jD0�`P���#�+%��	��JAH#��x���R�\$�̒6��c�69 s`�9 Р�4�C�j) ��O' s|7\$�<���P�7�����BS��:�<����3ߡ#��2�<<�!-<��`P��L��pHU��'����\r,�B(�6�K�\0��kP(\r#H��\r �G̕z�nP�#!���2�T�Λ��4zڤ��I]*�E�5��0����=	@t&��Ц)�J��c�<��zF�1�\$����d��k�7.H,0�-8��<5�rt7�ɨ�F�d�2������0̍����5��B8��c|yz1�n�L�\rD� �j0A�&C`�;�ɬ���I�l�%)xܞ��6dč#~@���@���bU=����\nv�'LHʚ��+߷�2��<V����8��D4���9�Ax^;�rI�Ar�3��C�B����J@|\$���/�àx�!�5/��zӸ��R�%O}���;?�E~4� }{����O\\�������.~�3-2�0��dءc9�ï��!A��4ޠ�0���8�3�؝��P)���(�fh���,�\r4���p��BhU�T�RK�=������SL=��߆��y�@�ȳ0�qK[�{���0¸��oF�\0��\0�Fm�6 �T�Q�n���P����8'K\0�ְo�cPMDt��B��	����H[�A\$��,	)i���V���W������@XQ(M����6�`��\r�\r�c��k	w�`C��F�����v4�\0@���m@���K����Ҫ8���i�\\���Gx|{MKRy��p@L��Jt�0T�,%�:Ո��K�V��|�L3\\#�կ�����W�S��6�\0Z��E��`�b�1xR���a�\"�Sh�w*\"j�!ӝ�p㜔S�la�����\n\\�8�y��0-L1��ɫ�@�9��@Z��'.D5��%OOr�����L��\n1fd��e���E���B�š�\n����o�a�0L��� ��ii?Կ�rII�0eW!��öhI��\n�	�5�T�z�E�����]=	mI�+�sJ�=*@�Z��T��x��\"�L�xREa�\0";break;case"fa":$g="�B����6P텛aT�F6��(J.��0Se�SěaQ\n��\$6�Ma+X�!(A������t�^.�2�[\"S��-�\\�J���)Cfh��!(i�2o	D6��\n�sRXĨ\0Sm`ۘ��k6�Ѷ�m��kv�ᶹ6�	�C!Z�Q�dJɊ�X��+<NCiW�Q�Mb\"����*�5o#�d�v\\��%�ZA���#��g+���>m�c���[��P�vr��s��\r�ZU��s��/��H�r���%�)�NƓq�GXU�+)6\r��*��<�7\rcp�;��\0�9Cx���0�C�2� �2�a:#c��8AP��	c�2+d\"�����%e�_!�y�!m��*�Tڤ%Br� ��9�j�����S&�%hiT�-%���,:ɤ%�@�5�Qb�<̳^�&	�\\�z���\" �7�2��J�&Y��H�;#`�2#p8��P@1�C(�2�à�@��t�7�jF���/�l�꘱s��o*L��ud��\$rzK3 �+Q'o�>����-B>��T��Ua0)=NC�.k���Zv�j�?,���e��Ɣ�{�� �L!L���*;���,	r됉�BUKQ�#������~X��qR���L�=Oj�[2l�_&�\r��\$����|��[\\��	��ؖ<�dUH�J��;�Ѱ\$	К&�B��c΄<��h�6�� �|��Y�o�\"\r#� 6B�9@�v���4V�2�� 9�#x�J�O�1p�C���6I)D�&��&F;x䴵��1��\"��{P�2�t���x@8CK׬�w'�:�47Ô����8�-M:�d\n<����dl]���X��IC�FSI\$�\$-�7Nh�QW,�T�a���3����v�-f�w��{�4I+��7��Fp�����\"U\$�s�V\$��\0��ؼiLG�knW�v�䁕w�X[�:ip�bvKQ�`�٘� �Q[&f.��� \\I\\3�kH���B������s@��xl�d\r�����z��-������C�M{#�J�\n���0��A]�?GM��֠HU�0����h��yX�d���S	HԓC��R��\$L�*�(\\lF�4���3 ���fl�p9�P���s��C�0�{\$i���G�6dz�Q�=H�0���62�EO*�Φ�R.!	��+���	�T8l���n@PFi�4����9(����;}%f�����A����ɉe=��:�\$H�����4�9I�<.�Rt���P�@aL)g �Z�,���Kw�Ht8PbD��L���v�\$��ׄ��+Q&eeԘpe�ۃ	y����!^0�ݛ�p�I!�:�U���\r�Q��C�C����@a�<k���7F��+�Dnd�rƮ�3R6�m�͢�,�i���^�����\n���I#G�q��LĒ��cČ�1�\$�v6���+�����77ɠ~�\n=��(���Bel&��R�N�xF\n�*�)�j �z�\n18\"���+��\\>�\0�ψ�~�Dl[T����vu�g۶e��j����z�m��E0�R�Rݮ���D��\\c���2r;T��<'jRmz&\n,: �\n��\rj�g���q3oL�c�`�0-ɿط�O,��TP8�]|k�\r��t��˪I�J=i��!+�N/�tyJZ�؅8T��t3�ԁ�V3x���?�z��R��%v*�����[��%��%r�[�M�fV���uHm�������c�od��b���&�����\na��M�k�LLi��\r#��`��!ɀU���)+4���.�}��5h°��cWy7[E�������Ke�\\�";break;case"fi":$g="O6N��x��a9L#�P�\\33`����d7�Ά���i��&H��\$:GNa��l4�e�p(�u:��&蔲`t:DH�b4o�A����B��b��v?K������d3\rF�q��t<�\rL5 *Xk:��+d��nd����j0�I�ZA��a\r';e�� �K�jI�Nw}�G��\r,�k2�h����@Ʃ(vå��a��p1I��݈*mM�qza��M�C^�m��v���;��c�㞄凃�����P�F����K�u�ҡ��t2£s�1��e�ţxo}Z�:���L9�-�f��S\\5\r�Jv)�jL0�M��5�nKf�(�ږ�3���9����0`���KPR2i��<�\r8'���\n\r+�9��\0�ϱvԧN��+D� #��zd:'L@�7 �ȉ.ip���䋮�\"X9��(�Ӎ��[��b4��dG�cH��� �		cd���<��\\�>(.���\n��2��P-�#������M1X��1���pH�A�\0000��S��Ic��CLL(Ӿ)B��D�\rѨ�X��cN��h�N�b���,p�4��H�^�i�LpJ�ZcY�[Y�����S\\6\\��<����R\r5�h]�sUx_�&�s�@	К&�B���\\���틎��d��@�1��\\Ӆ΍5�s^ͥ9\$\\֖�:y	­�%Hvp�����Ńd� �3Ƀ���J\n	b]�<�[a?�2#C�<��<��ME����g�Y�Ԟ#�X�@0#�^/�4��\0ڦe�(�)�s��4Yl2�-�u=�\n�C�KFPR�\"����Ŏ�o���˴Pz�(\r������pe'Í�J;ŵ<v��G,X����_2��=v�=��v�*y��=P*���Fw�T?�#[Jj\$��z\n��ϻ���w�x�e�70Q�9����*�\n<75)\nb��( �t4&0�A^��9��^üĝ�0\\�C8/.�h<\0܆J`/E8DhIH<�3�Z��zkK��2�'\rT��P��R!����	(*)��2i��T�P�,2v����r�u��Rxd�a�.��DWf�]K\$wnH���Nad����5�a�ik)����H�<@(&�wrP��ida@\$\$a٬pql��Rf��.N�dH[�y/��bDVʇ\\��C\$��D\$��`@�=������L˱<aL)`ZA�:E\0�-&z��!F�9�w�]ɨKL���\"~P_�1\r��9͸�]\rR�4�\rz\0���;-!x���j��lLj�؏\\�\nM�\0@C\$'G���؅MX��HeM3ŷI�:@'�0�Y�-��b,���8��I�H�r������C99\$R�j!�2�±\"�d��Es5B�Q	�0��B�0T\n\0��Zo�!\$�dIn(F�Kɉ/%'� 	�xW�D'up��b��@[o��)P�ʎ���U�%��К�� tSR���޽k�wp��LV��4\0PCJ���x�H��#���0l�C�\"�5(�U\n��B�Q�{�2'�ֵ�j�A�l�̨�����K&��3Db	aw�\0�`�ז�tGtނ�U�8�	�Pk����UI���d��#\$�-��)��/YM\0�MVe��)��R'l\r2�Kv��1�Nh�;�)�8+Q��{\\tP(��b�MɱW�Ķ�\n\$+,�52��W�oP �(�?d���wЄCg�\0�\$�*@�!��vP\\9A�6J� wM��BC�+�\\*���";break;case"fr":$g="�E�1i��u9�fS���i7\n��\0�%���(�m8�g3I��e��I�cI��i��D��i6L��İ�22@�sY�2:JeS�\ntL�M&Ӄ��� �Ps��Le�C��f4����(�i���Ɠ<B�\n �LgSt�g�M�CL�7�j��?�7Y3���:N��xI�Na;OB��'��,f��&Bu��L�K������^�\rf�Έ����9�g!uz�c7�����'���z\\ή�����k��n��M<����3�0����3��P�퍏�\"�L�p�p�\0��\0��%\nJR�̚�£������c\\��Ch�ڪQF2�B��:�	;V:��2�6�\$*���ȍ.��*�ʘ�+�+��B�0�es\n�����F��0�M�'\r�h�ʣ�\$��<�D^ʁB�4̀P������ɬI� ���\"8�5*�\\�2�K�4��ta�/�F���/1J�,��li5QjԹ ��P;u���㒆»Qd�:�#`@ɍ���:\"��1�C���v���H7<A j�����C*l�Z�L�D@7�e���?�P�9+��X�E�\r�RB�qkUl+�!�w@�6B\$X)��Sv\nI�T!hK���o<�� @�\$cΔ'��&�\r�{&Xt)Kb�K���EN9�4p��p���@t&��Ц)�CP���h^-�:(�.�ʘ�6�\rL����С�o���4꺽�Ǳ�I!*����F�V�V�\r	s^�0�ЧBRb#'��+���I���X�Ef��2k�84��9���\$Tɗ8�8E<����Jl��b���\r[�,���2frD� Y5�B��H��{������S[�ei�%=�����:t��C*\r8\r��l�z8N�L��\nT �d�S������L�\"�q<SNxē�3eK�'�C*��\"\r�80t�xw�@�0�@�D	�.���D|�^�/EP��EJ�5@��|LI�mO��5p�M�&FT7\"P�U{�4(����ګM~��ݓ��n��[;*9�z�ѢkG�����	�n2�)/F6j�\$!0�U1F��\\��%�율.�\"Ya,j��.����O��d��\0��q\r@��E��%'̐��JrH�-hGNkH[�t	�)�\\�X�bca�8sqM�m�����I�T\r��\0�F<�\0��@��\n2z,t7�nVIpm3�<ʿ����C(�(6�ԞH\n|��M�1�_�N��Ԉ�CK�4�@Ӛ�V��K,!Q �YIV�I�����(�ș��tj�*�5�\\�D1!�O\naP�78�l5 gU9���?l'���G��!;���ꐓ�\0��KWvl���h�\"j�E1�()�m�t����	-F	K+d�)�����F\n�\0�A�`����q�}O�I�'q`T�w%L�qP��V5p���h!э�cM�n����B�C]Qr��1*�k��u�Ř���������c+��e���V�,�|ft�Ǌ^�ͺ7�64�V\"�BJ�MF�7���>\"��;m�ʠ�0-A P·,U�,����@Į2S[�Z�ի�I�\$D����.I�|]�D�:��fC�<V�1�6*}��FE���Ҁ���5d��PE]�qR���baBIE��I80�&.z�clB���Ɣ���peWl�\"�sM�tΙ��(WM�n������*�T��2���\nRhl;(<-�v�yѾ+elɣ^R�9�\\ה&b�;?�z�r���\"^����a�*�G��)>4�ǔ���7���?�������r���P7���pd�Pr�\"V�4ɾp��";break;case"gl":$g="E9�j��g:����P�\\33AAD�y�@�T���l2�\r&����a9\r�1��h2�aB�Q<A'6�XkY�x��̒l�c\n�NF�I��d��1\0��B�M��	���h,�@\nFC1��l7AF#��\n7��4u�&e7B\rƃ�b7�f�S%6P\n\$��ף���]E�FS���'�M\"�c�r5z;d�jQ�0�·[���(��p�% �\n#���	ˇ)�A`�Y��'7T8N6�Bi�R��hGcK��z&�Q\n�rǓ;��T�*��u�Z�\n9M�=Ӓ�4��肎��K��9���Ț\n�X0�А�䎬\n�k�ҲCI�Y�J�欥�r��*�4����0�m��4�pꆖ��{Z���\\.�\r/ ��\r�R8?i:�\r�~!;	D�\nC*�(�\$����V���ڌ�P�;)IRR1�jܧ.�8�)���H� ���0T�6S��2�Lx��'48�6�h��H�|*��L���H�<��M:S�(�#�R�7A j���`����Ǣ��\r��bG*��{��=3��#�D�P�2�T����*r�I�( ��ݶ2��%��sR��c-�6,70�\r�uE4�CU�:�;#<�	@t&��Ц)�C ���h^-�8��.�օe��Çq��\$`0��\n�7]�Ad��#����7U;>ʴi�MH��GVY�\\|��i{p�#��\n���s��c�P� ��4����`@A� ����z����9�⦐�~v\$[\$�0�I\n�K�\n�Ҧ\rí����}�̪m9�I�;�.���W��{��%�2�.���%��g�R�\\q�h:�#���h�>���Ф\$�����)�A�P(��vi�ŗݕ���\r�\\�(�͌��D4���9�Ax^;�ti�)Ar�3����h��J�|\$����|�	�Sq�D�Bt|�RJY�l��m��4���eM��rRa�1�p�B`֍����.�\01yI)�0�cJr\"�Aa�����)����sޒ]�ql��6'fj��,sdL���T�TA|�m�\0�(o@��\$���\nMɼ*h����<H �03d�����l5:�87�\\��iƃa�?P�ނ�\$!��w/Cxkn�)� ��C�WƄ.Y+I	Tv���Z�a	K3�YڄP��Jy�+�!%?R~P\\b�\$��F�|��u����ꦍ*&&�=Ɵe�lI��7E\$�,�v�Ή!%a2=�R�f8pQ�P�)��L��4'�0����a!��L�`�^���!�<V�-��1�n�yREIi=K��J�D���RQ�� \naD&8��x��a'\$���\n��P:�V�2_��5%Aj����NK�}�l���cJ-(�Jau6WjdL�cr�ыK��U���k��e&��B��n2�e�ђa\r��1���Cc��x���\\s��(+e��\0�I�M��4�U���\0U\n����Ihl0��)�:�^\rTI��R*C�FQ�_\$\$h������T���@T|�l�ah���ю2���B��C��*��~j��ken��&t�~T)(���\n���Z3V�����o���(6pΙ�ޤ_he\\u�ץ�uPS��!�����S2���+P��M�_�Ø�N/i��S�0���r";break;case"he":$g="�J5�\rt��U@ ��a��k���(�ff�P��������<=�R��\rt�]S�F�Rd�~�k�T-t�^q ��`�z�\0�2nI&�A�-yZV\r%��S��`(`1ƃQ��p9��'����K�&cu4���Q��� ��K*�u\r��u�I�Ќ4� MH㖩|���Bjs���=5��.��-���uF�}��D 3�~G=��`1:�F�9�k�)\\���N5�������%�(�n5���sp��r9�B�Q�t0��'3(��o2����d�p8x��Y����\"O��{J�!\ryR���i&���J ��\nҔ�'*����*���-� ӯH�v�&j�\n�A\n7t��.|��Ģ6�'�\\h�-,J�k�(;���)��7��4��˾;;��c��2�p�4�Ü�.\\��n�]-i�qB1\n��h\n��j�S5��\$��jL �t��04(ڀ��Zt�j����S�D� ����v��>��k�6�L��K��Zj�>��HڪĒ�J�O��_>L��B���)D�(�kV�F�f�V��dD\$�6���ؐ\$Bh�\nb�-�7H�.��h���%9X�PJ ��� �9�#cڥ�Ó�7_���+�(�:K���7������Z�9�c�Ɂ!O�ȅNĭS���%8!�p�1��p��x@8CH�4��<���O����﬜6;r���Md ���RV��:��	�����**L>��H5[�2kPdӴ�!���'�l���\r:p� (\rX�l<|�N�z�\$�c���-����;������\r���C@�:�t��L# �4���3���c��x��JX}8��D���a�^0��2l������6�O�V� [0��o���0P:���8�4=�a��x6�8;�3�6��͆`C��1�o�����i��>��C4|�d0�D����^L��sA���f��&�2(�\0P	@��\nM2}��%�@�ܸs?����{]`p������C�h\r!�����i��`0�S؀���!��㚴YA&_u���.]�1�\$��\"��q&�8rK֛�5��C)\n#�̚�bH�Y�M�Ǩ����z\0� ��X�H�6�����H	�3.\nWB�R�*�#�>e�(Z����,�\0�¤v#������L�kY�IZ)J�e�{�IБ��`���6�Ϋ��Z�@��*BBL@Ĳz8����Л�\"�yj\rz���ʞ�IP��g&G8�Z�`q̢@[�!GM�@Ω�/|�QȄ��\0��Zz9��>-<KSɷ1fؾ�מ_9O��m��;\"^���3�p��!�\$�E��3P�[%2F��/X�Q(�M��7O��`c�5+q�� �Ԃ�!k��8�QY)�a/G���v�e�M7��W��j�~�\"D*�5bL�+L��j�m�A>c?*ZtWT¡�Zt���\n� 5z�T�O�B�SD��,rp�4�LT��";break;case"hu":$g="B4�����e7���P�\\33\r�5	��d8NF0Q8�m�C|��e6kiL � 0��CT�\\\n Č'�LMBl4�fj�MRr2�X)\no9��D����:OF�\\�@\nFC1��l7AL5� �\n�L��Lt�n1�eJ��7)��F�)�\n!aOL5���x��L�sT��V�\r�*DAq2Q�Ǚ�d�u'c-L� 8�'cI�'���Χ!��!4Pd&�nM�J�6�A����p�<W>do6N����\n���\"a�}�c1�=]��\n*J�Un\\t�(;�1�(6B��5��x�73��7�I���8��Z�7*�9�c����;��\"n����̘�R���XҬ�L�玊zd�\r�謫j���mc�#%\rTJ��e�^��������D�<cH�α�(�-�C�\$�M�#��*��;�H�;*\0�h�X9`@1���4�#�\0�L\$g.H�d�=?�Af	IC\r\$�	B�8: P�6�� �=�))�d�Ԑ���\0�ch:5b\rW�5m^>�|\n��\\��b	k��L���4;�R���0��`Ę�r�ž�\\�#��b�-cmq	m��� N�4��jQ#�J>6P�<�B�����Gb-�e���C-�yG)@ׂ��`]Z��[jύ�yy�bX�x��v!�Cj	qI2Ht8��)�c�d<��p����9;cbK*(.#mO3��5�f���²7cHߨ&�b��IK�5�Z7��2��Ps�5b6��2!�hP�:=��`�6��ι6�\n�Bɀٟ�o��0A>�Ö㎰��!JSl5K�X2���OT;�]\rC���?��aD�禎L��b4)0z\r��8a�^��]{\r��4A�8^�yzr��axD��H�86܀��}�2L�/�^, A���9Ѱ�ƍ|z���'����\r�Z��9�+F�Ò�r�pi8��͓�Ԑ@w6������a�Na�3:d0��a�:�p�˸ �Fh�Ӽd��}9*\0006(#^\\:/#H�v�P�]���,`���8g��&��7��@@P�(�`PSZuf�0��r\nLC��/��Z]�ru���i���B��R|b\$9b�h�Q)� �L�S �M\$�\0����tR .C�P�5'��dJѝRiJ&�B�VQ 	��'3\$���0��\"�nH�y4��2%�\\��Bs3G��aJPfAd� ���#2l�:���[�7>\"��`�L\"xO\naP���d��������<���,��*r��N�A��V3'vM5��\r�>^Ӏ1G @L&F�֛Bb��R+i�t6��L�N��ɹ�J@�TD���N�fQAX�e�4�^z��N�YSx�]�˺bt�TҊ~s�J5b����\n�M�t>`�i���7ڜ�N�c�B.C4CE��#QB\$��S��!T*`Z�x��3���E��=CL��Ӷ)^(�{/a��++^��}tdx�\"HHt~'�����^��V<~����J�aK�IK\n�T��P�T�.�?c�P����\"�(�H(�r��d���B(��U\r�-��x�\0PL�r��\0��oP\0u`G�1,��4��Vs����A���ޣ�e�yrX�XY�P���łOZ�&2*�1�&6ap����/�|)����P";break;case"id":$g="A7\"Ʉ�i7�BQp�� 9�����A8N�i��g:���@��e9�'1p(�e9�NRiD��0���I�*70#d�@%9����L�@t�A�P)l�`1ƃQ��p9��3||+6bU�t0�͒Ҝ��f)�Nf������S+Դ�o:�\r��@n7�#I��l2������:c����>㘺M��p*���4Sq�����7hA�]��l�7���c'������'�D�\$��H�4�U7�z��o9KH����d7����x���Ng3��Ȗ�C��\$s��**J���H�5�mܽ��b\\��Ϫ��ˠ��,�R<Ҏ����\0Ε\"I�O�A\0�A�r�BS���8�7����\$�ô�\"	C��\0�9�\"<�A0��2\r#��\n4P� +P����X1���J9\r��<�t��&C�2\$�˚<�\0S ��Ztjqİ�'(�ֺN�\"*�M����&����.4�\rp�(\r�S��G#��:Ԣ`�Ս0Z%�-T�Tc(ؚLZ�]�;(6���\$Bh�\nb�-�6��.��h���%<����\"/M;�j=qB�*gr��\$�����3.�6C�SĦLp�3�H�2��RP	u��Q.1��;8�2��0�O��:&�+�\r�`�;�)l/^�l�@5�I�\n1c�\"�FM!�3�)l�Цo���h�X�\0x�����C@�:�t�㾴(cj��@���%܏^p^)�ճ\r���}t�#@�<KTfXK,�Q6�s��2�)��\r,T�ƃH̖��C0�J�2��O�C3Ў�\r�WƘc5Y�\r��;�)+F�&(�(JS��*��,!w�\0�N�Ɗ@��'R�V�'AB���c�r҇�\"�W�(=���?)^�9O�H1���ϩ&�-'.��\r�b�R�d����X`�V\"�@�b�V%�Uc0̖�u\r�()R��P���OA�%�zO��@(\r��P�-	\$<<��v��s#���t�C�0#a���@C#^`d�۔�ȡ��D������O\naP����I'&'��4\\�V�B.%5�\"dNҀk*<���IB� �C`�lL�\"(e	<� �Bd2�8�0�y9O\0�8�RHrIo9Ex��RX1jJN'3�(|%\rJ���'CJ��T�B�P	h%O	NO4J��Q|6��Csd\r#FDdCk{rA�KЍ\"���#n|�\0�0-\r79�G��x���Y��w%H\n�Qּ�\r1rL�H3�nU!AI]2�}]�f;h5QU�	qP19&R8����\$���8�+�`o�sE�-�HJ�:E�\0��A�\"�\nl*`��~��Y�fa�%�\$���lh6���d�i(��|��[>���\" ";break;case"it":$g="S4�Χ#x�%���(�a9@L&�)��o����l2�\r��p�\"u9��1qp(�a��b�㙦I!6�NsY�f7��Xj�\0��B��c���H 2�NgC,�Z0��cA��n8���S|\\o���&��N�&(܂ZM7�\r1��I�b2�M��s:�\$Ɠ9�[p��&�P�;PmB�@a3ڭÔ��u�܄+��َ�k��ٴ�rC�����\$6��ӄbs�äc��hf��)�ek�-f}�(�s�NPM,3w#�lԨɇY:��七��Ѫ8N�g{A�Z�J`�5�R���#(�)*Z��*J�@�eZ)����2�B��82��<7%q\n�6�R*�-�(��B#��B�!;��2ł8�7���j���01����=\r+k(�\r���%�*�N�C����C  �H�%&&�p޵\$��䜍�\\8',��0�������\0�<��L�?P\n���I�xH����/�:�74�ङN�(�0�	s�3D���3��(�b�	�x�0+ޯ�s2�Pc-Xɣ�]v���_U�\ru&��h'cx\$	К&�B��� ^6��x�<܃Ⱥ\n�;~�C��0�#����Z`�F���z�W����i\r����H��J�8�K\"����<�h��#�0�p��\$��8����K2�-Os⧘eK8�\"��`* ��)-�M�2ʍ�0���\"j��dֵ��c,ұ�\"\"ˍ�ʵ�����%�Ni�\r\\Wxgk^}�hX�����N�ˌ�j�������z���\r/���0�Y��SΆ��Í��w�\$)M��:H�2��������ĥɃ���J7%Oʛ���}����Ҍ��D4���9�Ax^;��u��0Ar�3��X^2��>�J0|\$���A=\"(x�!�9㈠A �(�ܓ\"������x�8˘G����;\$p���ގ�r���LHR)�b�6�꽈��#)�&Ģ��\"G)�5��B�*JI�9*��\n��rm4�3bv���B)��\0���>�ݕ\0PQ�I1g�/���:1\$b��H���?A�г��dG42�\"���!}��30�Ȩ aL)hCқ��a\$֊L�Q\r&���V�_^�y��x3��s_<�1TFs\$e#i�.!�7���\rXr\"d�������,�R9W��Rl��qԣ��O\naPF��S=���97�y_Az4�Փ 98I�ܒO��С&��\"G��y\$��@)�L(��#\$АF\n���X����#����,���Ei��7i:S��3�H���:��o_���Gu9�)�0V��P�\rd�PE�*nt%<'���1��G46��u�kp�\$��\"���m/%�e�d4�	H�~\0�zV_	�U\n���Z��I0&G�p#5�PdR�p�f��A1#�5�&3�v�_��z�q��T��ٯT��U�\$w��#�X7R*�K��{��e�cPT��&4����<F��f��\$�����Tޓ�rU!�1=iT���XgCu82����1lc���\r�r�)�U4\n�K�I�%R捀";break;case"ja":$g="�W'�\nc���/�ɘ2-޼O���ᙘ@�S��N4UƂP�ԑ�\\}%QGq�B\r[^G0e<	�&��0S�8�r�&����#A�PKY}t ��Q�\$��I�+ܪ�Õ8��B0��<���h5\r��S�R�9P�:�aKI �T\n\n>��Ygn4\n�T:Shi�1zR��xL&���g`�ɼ� 4N�Q�� 8�'cI��g2��My��d0�5�CA�tt0����S�~���9�����s��=��O�\\�������t\\��m��t�T��BЪOsW��:QP\n�p���p@2�C��99�#��#�X2\r��Z7��\0��\\28B#����bB ��>�h1\\se	�^�1R�e�Lr?h1F��zP ��B*���*�;@��1.��%[��,;L������)K��2�Aɂ\0M��Rr��ZzJ�zK��12�#����eR���iYD#�|έN(�\\#�R8����U8NBH�;#`�2CPCV9X@1�C(�2�à�N�q1�d:?�E��3��) F���>\\�+�D��yX*�zX��ME�9eY�qg%\ns�et]�1H\"U����EH�u�jݡ b�����!8s���]�g1G�O�H���ttA�4:�D���d�Ʉ�%��E?4��U�%�\\r����]/J	_X1n]���0�I�2��\$�7HA�bIg��~��M����y},EҔ�=���u1��0�c��<��p�6�� ȪV�-r�3��I5-IVnmb��n�(��\rØ�7�15a��h�:M#L5MJ3���2�Jf�A��?l�\$͉|'.1��p�ݵ�fڶ�Sa7N4/ӣ`�;�Ne�ϥ�Gv���T����Y��>��lA �o=e٫\r�Z:��@�D�@�ظ��U\$@9�Q\$<MS����U#0z\r���:�;�P\\C m\r.] ���do��8@^��>	!�8`ګ�<�7X>qz�7��6��kJA�˪�d�+�yDq�4r|\"O2�Z�5���@PT\r�0������\r��1���2��0�g҆��cf�9�`���g�`�(�Cw��a����^�=F(��qЎL3ƀ�bx@Pj��#dp/Hx�*\$<����Ԩ�%0�A�\$�a�Ր��% �`n��sD�F��pp�}�0���a����b�Î�0�T\$sX�µ�TR�%E�� �(��%�=؊��*'/\"�6&��#�|GS8����#&C�:a�-��iňO�v�I�(�!	j�)���\nG��(\$�`���\"�v�7B��n�Hq���dA\0A�0-F�X��������xS\n�q��r`�	5\$�@��#��צ��_�򘓄����g�C-\"-���P+S]\0��� ��B\$�4��b c|�C����0�\0fv\0��?p������!�[Gh��J��-վ�h�aOt�O�����lZa,�m� �D��k\"I�1�31����d쭗��<7XcS��5�T���l�n�B����9���ٌ�b��@�T*`Z8nv���J��&{\"N�i�X�Ё\"\$p�9�V8�c�|OBlbd1�E�1����(�����d��R�XA(��̉�!d}9���Ϲ/\"�t�c��Ъ�XSa~z�iEM�\\�~9ũ�/B�	�'��B3lq�2�.&s�mg����Ļ�yG������V��/�\0�*�r���C7=�\n";break;case"ka":$g="�A� 	n\0��%`	�j���ᙘ@s@��1��#�		�(�0��\0���T0��V�����4��]A�����C%�P�jX�P����\n9��=A�`�h�Js!O���­A�G�	�,�I#�� 	itA�g�\0P�b2��a��s@U\\)�]�'V@�h]�'�I��.%��ڳ��:Bă�� �UM@T��z�ƕ�duS�*w����y��yO��d�(��OƐNo�<�h�t�2>\\r��֥����;�7HP<�6�%�I��m�s�wi\\�:���\r�P���3ZH>���{�A��:���P\"9 jt�>���M�s��<�.ΚJ��l��*-;.���J��AJK�� ��Z��m�O1K��ӿ��2m�p����vK��^��(��.��䯴�O!F��L��ڪ��R���k��j�A���/9+�e��|�#�w/\n❓�K�+��!L��n=�,�J\0�ͭu4A����ݥN:<�#p�0��Hȋ����X�x�c��2�p�4Ճ�OCǪS�R���J�M�xݯ�:�H�����b�֤J�%/���=���	,#t�2�����p�h�|��HH�� g��*�h^�:2���)Md��HP�5øU͌�\r�+�g��6٧/���\\��H��ArJ�.�uK�&�CB(2s\n6h���X���v�JT�D(�A)Mk���8�I�蒷R�셸0e��%��\0��1�tRR���^�.�kw���U2�E���9�\$��-�����o�O1*���4�uN\r��弥�v��ۊ\"O�#�nuSj�_E��S�C�)V�3j4)��ϣ�*��I-�d�2O�n�l_gQ�;����3w>��29�=�-���e|����ȩ#�&k�n5��f\r���H��eo��>T��׮�3R���d�t�J#�r�}R�����7p\r�*w�L\0a5b��\"�H�:��9➳҂ZG=�ְ�O3.��v�`	o�k\$c�z*s�)�C�d \r\n�3�D�t��^�.!�6��ܬAr��^����s\r!�7�DW��;6e؏\$�>nĸ<�@��O�l+�t��4u#��>%\$���ӗcR���8��)�7�&)T�`cэl���&V� YUw�O�F(�c��|�)>@�b�@2���q���E�@8�)��)N@�('���Y�(�z�V�G��\\��v|Ɣ��T�F��p |�u����L���Ԕ�;�2��r�<�ϻΙ���/D�Q�|�2�d�KeF�0��2U��U}��0���)���}���x&lńD6�V�Nq��b\r�5֎��Ty�NZ&W�>N��\\jp�.2�hI)��Y�O8=I��qK�Oɺ �1�.�eG�	8�^%VL�D���p��=T^�@�����6z@���M!A��=����P	�L*R<n�U\\j0w�ުŭp�P��a<!'�1<:�b��G�U�/q����aQ̉�h]�(��d�ۊ|yfmVkH�'eWĆ*���`�(��y64���%�;��vu��voT�;y�V	�N��Z��\r�CSa��9�r�*h<�P�����5�:�ͩ�ש\n��<k!*_~�`��T�x��������(=�DJ\r��V�	9��I��2&*��@���H�	(S�k5\$��G�����!\n�R���O\0��R����[�12j�۫s,�'v��[�S�3NWԜ߃\\�8�JV��\nH�\\Ψ������QB8Q���gvV����h�d��H>R��?DRi� Lf�0��*?�2���F�m���*\\&��D�Ѱ�,7�\$��ɖR��N�C��qL�wI�MV(�:��7��q<���p�c2w�\n1�9	|)�<q��FĖo��6__��JO��";break;case"ko":$g="�E��dH�ڕL@����؊Z��h�R�?	E�30�شD���c�:��!#�t+�B�u�Ӑd��<�LJ����N\$�H��iBvr�Z��2X�\\,S�\n�%�ɖ��\n�؞VA�*zc�*��D���0��cA��n8��k�#�-^O\"\$��S�6�u��\$-ah�\\%+S�L�Av���:G\n�^�в(&Mؗ��-V�*v���ֲ\$�O-F�+N�R�6u-��t�Q����}K�槔�'Rπ�����l�q#Ԩ�9�N���Ӥ#�d��`��'cI�ϟV�	�*[6���a�M P�7\rcp�;��\0�9Cx䠈��0�C�2� �2�a:��8�H8CC��	��2J�ʜBv��hLdxR���@�\0��n)0�*�#L�eyp�0.CXu���<H4�\r\r�A\0�<�\nDj� ��/q֫�<�u��z�8jrL�R�X,S��\$�ð�6\r#\$K��xA	�2��(�:\r48栽'Y(J�!a\0�eL��Ӛ�u��YdD���!e�6N�ga0@�E�P'a8^V�2^uV�3���YTT��9����3EU��h�Vs�A b�����œ�A�+�TT&%���5�J�eYy���؁ �)P�:�-�x�ly)���O0��ag����[)����8qik�#ܙ�xL�ڼ�i�A�MS-&V+���M��ޅGYlBH�B-�:(�.��h���\"�ܷu� #�\nN��\\�%I� �9�d8�Q�\r-��q\r!����KcH�7SwqR�`�`�90�Y�J�Z�\\4M[�v��e9��I*��d!�cp�1���7���4���Js�TC��C|IC��](��\\k7ǰ�S��.�j��)�&q�\n��֍�Q�d�K��2�� (U�Z���#�UԘ&�[|�qta��I�!\0x0�E&3��:����x�����O��H3��-�spnA��\"��Hm\r�6�`�xa��AP�z��p6�ևJ+A��)u8!G,�.2�\"�I+�Ub-\"h�ٙA\n��1�\0w\r!�6\0ć(r�J\n�����%��1�\0���Mu���ĘRDD��\n����ln����j]�\n (h�t�AT&�:��r�Q~+e|�B<Yұʈh>\"��d]���+E��9(��Hc�\0003�8��\$�!�\r��<�P�b@��0��1�@��<Kb��I��Ҽ(�CZ{)-N\nhQ���E1*L�AJc�<��p��B:���I�UA)3���x)��I/h���:CxuC�%ԢD6��D*L8�T@�2\r�� ���d�\rn�\rƗP�A\n<)�C��\rr�h�B�+\rx��8RsuJUM)�Fz#��k�R�G��8��5��ܞ����E1A\0S\n!0�7S0T\n�v�gv�ĸ�%d���T�XZ��/�].8��{�ћ�v���b	\"�5g�v\"~O��fN��W����a�\$�	j�a�!Y��E`���d���W�J�U���ɷ��\n�ܩ\rj=��(s����4�`�&áA�-�h�\"|�A�T*`Zpnv��6,	�.�mW<&L��5���:�՘1�&��ݧN����D��-�M�d͙��[ĕ~�X�/�H�My�3�D@�ҝOR�k56j4�(�Dq&)���-�rϦإdg�53\"�z83�e�'�:�<��b�v���\$�\0��bͅ����\\C`��T0�jŋЂ1�!-k�(�KZ�p�͐��Q*D1u�ܘ���]�";break;case"lv":$g="V0�DC���s�����e1�Mг��~\n��fa�N2�OFC)�sC͐�#&t�&�)��2��ӓ�F��D�	�m�� 2�!&r�8�	A\0��B�P\r&�A��e�NgIt�@\nFC1��l7AGC������F�\"�%I�7C,�.�'a��b:�'�#)����D�,<�o��bٸ�u������2��2�Q�@ ������S0���M����M�ө�_�i2�|����9R��?0��&�[�w0�DL:N�\n�\r�C(���Ģ���\rf!xb�o�|�0�0�Č��0��p@8#�އ'�H��\"Cx��@	b\n77P��.��T6��j�9�)�P�!��\r#�֯#ϻ��!mS4����4������mZP�CJ�O��2�B��U�j�bC(�6���d͍ô 4���t���@1�L��7�L!L��5����,�ԏ\n�/,3�� ��r̡�B�7IbP��)�⌊�l\$`HKQ 3�MTI����PH�� gZ� P��%d���\rC(�5��X@;3�x�7��0�6�BZ93����ŕ90�\\͏I1'^�(8\"=e�)r�\n	T���b��m�9���*�ͣ-Ҋ��M�~_7�S��ӂ�����8r|���	@t&��Ц)�C �\r�h\\-��h�.��J�����Lx��ӈ�1Cw�� �<��7���9(��6��%@���O��٩k!&�\ni�v����x��&��r�JY��r��S��T��m�L�_��\\��MZ\n9���)���+\$	�pΉDQ&1�\n%{��/����©�C��|jQǄ�'ʒ|�0�Biw9�E�u�I�@OG��΅-ï�_��М+إMG)�s�5�ͽ��j�͏�jAW˥#�� �1\":�lJ&���-�h���N�͏�Bt���Q�9E	��O�i�i!���bM\$Im���@\nhN��� ��p`����	�sw����Ӽ0i\r(4��^��>	!����ؐ����0�↏̲/�E�H&��)�y�����AS!�2͑�\$\$��r.\rD,1/s���g�(\n���ߪ��=vj����y�8AJ *��|�NQK�]�d4�@@P1&�/��b\n.DȠP��X�AAV0@���x��B�\r��F~`�5������y����z~��%)� �n�?i�Y��7p��m ��c���AS�\"a�9�xԥ��i)(�2��UIB�����Q|��tQ.���O��a�1��)��VKn�I�\0�!Xr�96��N\\��\r��;���P	�L*Dx�A��6t\r'	��y���)	��\n!�4V��8�C�s��I�\0�0i�L@����\0j���3/I� \naD&fMI�sl����Ja�w��}����C�`�n�/�\0�%k3�AO�\$�EH|�;�m\r!�&�IC��E�\0��@k�ys���[_؝���l&�_���%�Q-��SOI�\r���@\nЛ��	u�Ao6��J�Q�3P��h8��I��Ɔk\r�%�	�T\ra�b1�6�cgc�I��W�D�\r�J���؞3�c�K%+e�fI���]F6`):�f�K������-��뽖y�}V�\0Ex�\"���@��a5�um7���*�\0S����2P�CёP���`ª�%�6x��VbK��X	gȉ�\0�Q��wm7\$�+��X��'K7d��,DG�=	A�VX�Ą�I�ga��A�A�,�ЂBHM\n!Q����^�C�w/A�ÔԎHXk%!�h)�z�Aw\$!�!�P\\";break;case"lt":$g="T4��FH�%���(�e8NǓY�@�W�̦á�@f�\r��Q4�k9�M�a���Ō��!�^-	Nd)!Ba����S9�lt:��F �0��cA��n8��Ui0���#I��n�P!�D�@l2����Kg\$)L�=&:\nb+�u����l�F0j���o:�\r#(��8Yƛ���/:E����@t4M���HI��'S9���P춛h��b&Nq���|�J��PV�u��o���^<k4�9`��\$�g,�#H(�,1XI�3&�U7��sp��r9X�C	�X�2�k>�6�cF8,c�@��c��#�:���Lͮ.X@��0Xض#�r�Y�#�z���\"��*ZH*�C�����д#R�Ӎ(��)�h\"��<���\r��b	 �� �2�C+����\n�5�Hh�2��l��)nh�;%�HȆ>�{~���2.(�YK��5�+\"\\F��l�-B��8?�)|7��h��%#P��₀Ў�tF\r4s��-P����C\n���;��\0MJT�:	UT� �C�>2�PH�� g^��hʮ\"��69���ITcbο�Hҿ<�bUTF�*9�hh�:<s��\"��tQ1���B\n�ŻD���8��FἮu��3<�I�p}.������\"	�`���0����ƁK��e	@t&��Ц)�B��\"�Z6��h�2]����L�I��X�D�ظ��u�7���<.crR7�� ��h �YL{#2�x�3Y��4��F��:�!�\n���;0�3�\"��){T��IbD;�I %�Z^���@ʍ�J���h�:\nl�3ńu��S�}Z�%75�S4|,�Ì�f5\$i-&���l9L���o!\0y�\r0��C@�:�t�㿄# ڳ��r�3�돛�.:8��I�|\$���ᙎ��^0��̼�QP@��P�8>�Z��ktlv���X�n��J<1o�\"0��@E�ʆ�Z@ �p6*�*��f,iy3��\\���a�χ0�`i\",����O`aKɵ7����-�A�\"\0�\\32�h!�.����~�u�\0��6DH��S\0ϻ�o�0���6}MC�\r��:������\n5!�4>r��t'2��ه0ʄ���%'|�\0�FmDh�\"`@�n&n}ðS����%��.�T^��AF�,�c|a��%\$�������1`\r���س���F\$��<T̕��>N�\$��� 	�gn��ABsTq��u3�(3���y�,�P�H�t�%�D�@��ٴ@'�0�.�q1��)�RW(O���47J�ҌH� Fǥs˙`i��nŕ��0���	.?�����tc��l>���<Y�,�\n!0���zX\0F\n�\"@�rT���#�4\$�IMnEq�(`莤D�z_Ji�sg� 5��g5�<r_��P�4LT�5`��S ���MB��0ű@��`+��1��t}X�d%�TоuC0y}D���K8 \n�P#�p}�pc��|�UJrt��)����<F,	`U��#�F��p#�.���N!p.Dm�Z�Z@T�Ű5�, rH)�<�Ĉ�y|Z�8������)�/��ܐ�N�B��B[\\f�Q�)'�2I@}qG\\��t%q�Yd�A�TOQ\nU��ȗ�`�(�L�P��{CM����Ɨ�^�1\"p��\"��@����-A%a��G�c3Gvh���/�zq��ʜ*3�";break;case"ms":$g="A7\"���t4��BQp�� 9���S	�@n0�Mb4d� 3�d&�p(�=G#�i��s4�N����n3����0r5����h	Nd))W�F��SQ��%���h5\r��Q��s7�Pca�T4� f�\$RH\n*���(1��A7[�0!��i9�`J��Xe6��鱤@k2�!�)��Bɝ/���Bk4���C%�A�4�Js.g��@��	�œ��oF�6�sB�������e9NyCJ|y�`J#h(�G�uH�>�T�k7������r��\"����:7�Nqs|[�8z,��c�����*��<�⌤h���7���)�Z���\"��íBR|� ���3��P�7��z�0��Z��%����p����\n����,X�0�P�7�\n�29����x@1�C(ȟ!S���	��8D�B0	o�@�\r��&\r�˒�S�侣l6H�zh��\\�1.x�t+�&�S5�A b���(�Br'q�0��8�7�3�ɁBB�)z�(\r+k�\"����\"�n�2�cz8\r#�oT��aA�ʏ��zt4�,`���\r��	@t&��Ц)�B��q�\"�@6�� �V�t��B#�\r���(�VJ01^�K�)^�(��ɂ�-�i�`��Cd?V (��'#x�3-�pʒ�XM�/e����뷭�p�3\$�Ǎz���g���\0�����	�N�72C�ϷcfE9�yr��ab!X�z2�5�L���ư��&\r������0���6O�-f��X����a�S��<��ڒ�66���c������6�p@ cD�3��:����x�υ�&Í>x���F�`�p^)A�ƌ0�^0�Ҟ\rF�4��\0�6Cz͕�o�a�Sm��!6v����1�H@;�(�{��{9&#3�|�C��c0��-O�4��G���,�*��t��p.HQ�l�P��\n (3pAJ+<�<rr���Vg�U*�\"�D+�5����6�A2Al4��Rgr�ĽWtt��ox��0��3�\r%D��l�Z�͠1�b�RQ�(��أr��z4qF=z�%�e��Li��oڤB':�0�Q d��D3�!��_-Ѭb�ly�2:4��ٳ�n`�h�eC��pA@'�0��Y�Jh�i�\0�C�9�	�4&B#Y9�=cU�b���\r��B,F�*V �)����=B+�Zɣ,��\rF�ї�T�e�!Fd�\$��0��� A���S!5ۉ;3\$������['m1騃_5���We�-�4>Xc-����3TQ���#fqѐ\$3.��3]�9�ލ�T��Y�a�\$�\r30966N�U�B5�������Ϊ�b )�S�`BA )��Gf���4\r޿�~d\rI���fH6@�QXe���x'�jU*����B�M'ۡ�e����(�g��`+\$�ҌE%���c\"���9]�	��JF���u�|Ñ��U٪`";break;case"nl":$g="W2�N�������)�~\n��fa�O7M�s)��j5�FS���n2�X!��o0���p(�a<M�Sl��e�2�t�I&���#y��+Nb)̅5!Q��q�;�9��`1ƃQ��p9 &pQ��i3�M�`(��ɤf˔�Y;�M`����@�߰���\n*э�:�|�m0��KĤ�=�B�F��'�K��.O8�Rx��wE���ّʍ�9C\r��ֿ�E��#�9���o�Ehi�?�ȕ5�����u4��>T�@f7�N��%Y��X��S)�6�!�Bю�h�+âj��H@�M����(�j��*����%\n2Jנc�2C�b��O3ІJPʙ���a�n\"X:#�H�\$�#\"����@ഃP�ïC������r�1k�N�.�(\$�ð%-���˰@1�ɓ64�qH�2\r#������75�h+�c�\n�Ib\nN6��s�\rH���Qd�'+ès�J��C�V�i=�C��! j���X�B�~�.�D���Ȋk�W9j�|�B��G�\\4�k@4���x�8�@�&\rJ��HR���#-�'\r�=?K%@��Vxة�E���è\$	К&�B���%�6���Ճ�B�%)�ʛl�X�ۖ)�C\nr��\$�MC�+���\rC��)��I�����X�:L�4���0̏/i����(�H�V�ĽN�s�O�����h(\n�t2���l�;2N�������6C��P�N���ɘY�)���,�/KڋP������N�᣻#�l�v���N�ߦ���ӺҴ��7oJ�S�ު&t:�cH9�-p�HQ)��K�ͪ��\\Ò_&���l[��K�͈A�2���@M%3Gf��D�0z4c�r�x��ɏ8��˰��&E��+^*��6���f����^0��݌����q�@\ra����a�9L�ѲB4@�	4&�� rG�0D��	������t,� TpS�\"���:@޹\\R�8/��A�:�qEǤ��&E���B�`�(\"�K�,\n (2�I�=!�ל`PUAI5��3&͚�*%��7��Co@D\r��X�p`	v��Y�R0PS�g)� �O�X [����h���;wMݓRnNI�=9�s)#�H�1�AR���6�I�A]��Ŏ����N\0� �G�!�(b dp2��P\\A,5&�0�ǟ-L	,7G��\0��T�ԓ;�R�l�[����jA�q| ᤔ�Ǟ�]���O쩆2čC8uE�:�@́��80�i#Dh�:��`��S��R&�N��rW������_S.��\$��MBMQ�ْZ0�X�\\�e\0002UB�L�hm�u.�0gʝ���!�\0�\n�\r��#�Ҡ	�������.D�)l���B�F��#���q\\l\rE��Út�1)2����80�{�W��Bei�:(���З�[H�#dt���J��E`,ROGM��,ޝ�4����G��'�_5��!VP�&9P�U?�������a�mlG�1�%��!��D(KԚ\\Q!�;p��G�(I�/D�B��]\\Y�LD�I�G�\rY��1\$�Z�U�VD,��i�\r��5�t\">dJ�&9@";break;case"no":$g="E9�Q��k5�NC�P�\\33AAD����eA�\"a��t����l��\\�u6��x��A%���k����l9�!B)̅)#I̦��Zi�¨q�,�@\nFC1��l7AGCy�o9L�q��\n\$�������?6B�%#)��\n̳h�Z�r��&K�(�6�nW��mj4`�q���e>�䶁\rKM7'�*\\^�w6^MҒa��>mv�>��t��4�	����j���	�L��w;i��y�`N-1�B9{�Sq��o;�!G+D��a:]�у!�ˢ��gY��8#Ø��H�֍�R>O���6Lb�ͨ����)�2,��\"���8�������	ɀ��=� @�CH�צּL�	��;!N��2���Î�tl��R�n*������8�R�3�����p(@0#r巫d�(!L�.79�c��Bp��1hh�)\0�c���CP�\"�H�xH b��n��;-��̨�#\rR��0���<�(\$2C\$�P8�.�h�7���\n�Jl��+��3ˌS=)����#�]?�c-�� 6`�gQ\r5V\$Bh�\nb�2鈶�]+L.�5��P�\"��/0�f��w�0�����<\$r7�M��jR��jf6�Bv<��ނ.P�3U�&�d�����\"�f�&Cx@�#����u�~�*��/B���B��9X��A 6#���&05��(؝�p[��T��Y{�7O��V��U��9Z(��Y�\0x0�B|3�Л�t���1cjؽ-8^�������xD���H�8/1|���x�Bz��7װ��8c8ԝ�lc�6�R�����jt\\W�\0����V9��ɚ��H���9Pӂ�i#X�юQ|�0�֢\n:�c�9�è؎Njg�:\r	��9�1xA(����*�+��d��,����#	��~��H\n\0���b~��((�����YsA%���V�[�s@h¾b0[�%e����Hc|�3�w��Xa���P�Ca~e�)� �Ãy	)�]c'���	�0df2TK	q0B)��=��Oâ`)��';Ĥ՚�n�h-J���DC� I-��g��I�q���c�LBdpD^��ӑA��\0AE>i�����w@H(k�!�����>24��XSM�C��̞�r�E���`�LPs\rL9��|��L1�5�\"8G��\"\$��D��B`-\$�}�7\0��3M.MR:���� 4�ŗB��� [Jn���H��(���~M��s�Q)P	��\nVd�J�ZСʉ�gĺh�6�ւHC^4��'�Bp�Y�>�-\r�'l��T*`pÃ(g<��y��Si#3P�Ω�JJS��Ql�|U³#�� MI��q�%r~G��|G��c�x�!}����H�0�\r-�4L��h��Ah��ɥm[!���(� �O��>?a���%�Ji|�:�X�u<Ӓb���)�%aU,e��dח�\0�xJ��\0";break;case"pl":$g="C=D�)��eb��)��e7�BQp�� 9���s�����\r&����yb������ob�\$Gs(�M0��g�i��n0�!�Sa�`�b!�29)�V%9���	�Y 4���I��0��cA��n8��X1�b2���i�<\n!Gj�C\r��6\"�'C��D7�8k��@r2юFF��6�Վ���Z�B��.�j4� �U��i�'\n���v7v;=��SF7&�A�<�؉����r���Z��p��k'��z\n*�κ\0Q+�5Ə&(y���7�����r7���C\r��0�c+D7��`�:#�����\09���ȩ�{�<e��m(�2��Z��Nx��! t*\n����-򴇫�P�ȠϢ�*#��j3<�� P�:��;�=C�;���#�\0/J�9I����B8�7�#��BH�;'�HȌD�N?!\0�����\r��\0�)Ó���/�>�R7�c`�3�Ø�幣\n�寍d9�T��� L�\$2\"s[�5�HKQ1nMTT���/�JZ��\\��b\nc��5�`P�2Hz�6(oK���B`Һ��R\0�hL��	�\"����6H�;�r,n�ڭ�Rb���\n�A6�0ר攣�|�2�#\r�7���ŗ�q��(�}�W���il���x�\$Bh�\nb�	��p�����(\r��x�#�p����d�N���Y�X9�9��< �u7�ɵ��7Cd��:8�2E�N�O׭F0�)xJH�@ѡpe]3�\n�\rO�<�����x��Z�v�C)ZZ:�M�Ǻ����k��>0���Y�N4��p���� �����\0��H	���X��q�_�r#�'ʵ���su8AΎ�B�������GW�u����=�-�v�҃�w��m�u�ZW���~��((Ԡ����Cb<���Ѵy3��	o�0�6ʐ�\rB�3�5t>�J�@��f��4@��:�;�P\\���'��3���xeh�A���^��>6KN���aA�/ ��/������82!r��K�? ���!�K\nC%\$����P�\rቈWΛ����(��M��h@A�1�v�P�l\$�� �~RJk!�� ���(s��55���u�(9�\$��*vO	��ޑ2(q�(b��̇˜�D����A\"�%�ę�e2�[�i]��N�0����P��ʐPTKx�(�	��#\n'@EdD�\r�n5Q�d���Љ�(A�4����lk�r0�Ș�y����C�ST�H� aL)h�q�|�@0����l|'��=)'Y�JOAݓ�vOI�9\$IH1!p�eK� QL���Z�15����ڙ�#	��\"�C\$#��I �k\nrp>A��V��:x.��<X�i[9��1)�2S��J���6W��u.eԈC�\n\0f\r*0��0���?z�E��jB�Q	���\n\\����*( ��Km. �#@���kJp�:�\\M���BE�7ġ�R���X���i|%%̜�D�f]�V%O��1c��&�\0�����t5R�0�ae�����צ�bd�q6i�6��UH��u!��N@���)�t��`�bl5f\$��Gd6R�a|!�!E\0�0-�۩�j,mAa��6	{P�&�/�ARf|�+�a���k�f�U�����7Bm8�P�E2:�*[u.G�כ�y(@e��DX�� \n�K@*�X��!�4Ƣb��nِ�}�wT������.<�2F��yg|)�B���t#��I҄s�xt��EVc��y����cv�#%�I�͕U�I��Z�'\0_C�s��B&�\\��j��p�'p���bu�5C���\n}Wa�'�p";break;case"pt":$g="T2�D��r:OF�(J.��0Q9��7�j���s9�էc)�@e7�&��2f4��SI��.&�	��6��'�I�2d��fsX�l@%9��jT�l 7E�&Z!�8���h5\r��Q��z4��F��i7M�ZԞ�	�&))��8&�̆���X\n\$��py��1~4נ\"���^��&��a�V#'��ٞ2��H���d0�vf�����β�����K\$�Sy��x��`�\\[\rOZ��x���N�-�&�����gM�[�<��7�ES�<�n5���st��I��ܰl0�)\r�T:\"m�<�#�0�;��\"p(.�\0��C#�&���/�K\$a��R����`@5(L�4�cȚ)�ҏ6Q�`7\r*Cd8\$�����jC��Cj��P��r!/\n�\nN��㌯���%l�R�H(��<	h����rV60�K�Is��8�\$��\"Pӽ.t��	�\n�?�H#&�G\"p�;#2�>�!� @1(H�T��-��A j���X�B�l1��88�cep��`��/r�6Bx�8��c؄�B��\ni(�1�+ˌ\"���ҽ������r� ���\"�)[�P\$��L�%Q�oO�H�m�W�W!'κG\"@�	�ht)�`P�2�h��c\$0��_j9�Sq!J,��	rZ�c�{e�*�L9ڳ���0�P��MJ�@�x�3=w*qh�IT����kږ�i�!��(���;fյ��aMA�d޿Pb�_�qAiL�9h��p� C��\$	�Ȑ�������X��0�)���<n�R�C\r��))c�ۼ��43�0z\r��8a�^��]m(8\\��zQ�]��J�|\$���_'9��^0��0A'��4�w���0d��'�@�[�V�ǣ*H�6,��Ө���z}���L�#�8̺I���3qpǸc0�W˻���-�}RqN99�R,e�B1eD�� ���	7����P���H\n5���d\n\n�)\$�y���G�\$\r���w�l�pp\$��\rCppO�%	�W�o	��.�eM�w���r��7�s�R��;#�R��^'�\r>��K��'o:%���pӓ@���X%	�<}-��>_�1�_�����C\n!�����\$M\"M-u5�o\r��Wey\rbC#�%���5|��	��A�2�\0�¢#Jhܞ2��:V��,%��HY.7��� ]���D�1��ܞ�`n&�Z��e�[5�&8��e|���.��)����� ^ �#H6OT�Ek0�i,���JX̼BJ{Sr���ߘ�LW�8�fѐ��)��3o�1��B���5~\0��x�`+���]�\"���oFv]�|Ka�V\$��0��|�\r{�C�1�C`�0-�79��I��3�\\�΢�`���s�;�b��1})��B���֪����rbLXf,)i���A�r_K�yg�@Q�\r\08�U?�r�K�k����R�XA�g%��&��Q�!�0@*£cάJ�G#]32��\r���f�;S^�*���*�(�X�	�Y_-c� ��v��X�pǉk����U�\nE-�^�v��@";break;case"pt-br":$g="V7��j���m̧(1��?	E�30��\n'0�f�\rR 8�g6��e6�㱤�rG%����o��i��h�Xj���2L�SI�p�6�N��Lv>%9��\$\\�n 7F��Z)�\r9���h5\r��Q��z4��F��i7M�����&)A��9\"�*R�Q\$�s��NXH��f��F[���\"��M�Q��'�S���f��s���!�\r4g฽�䧂�f���L�o7T��Y|�%�7RA\\�i�A��_f�������DIA��\$���QT�*��f�y�ܕM8䜈���;�Kn؎��v���9���Ȝ��@35�����z7��ȃ2�k�\nں��R��43����Ґ� �30\n�D�%\r��:�k��Cj�=p3��C!0J�\nC,|�+��/��,�\r��,���`1�q�\r�xȪK��#�KЦ��ӻ�*�b`޿��x䞍�Z�\r���Ҽ��J2�4�3M��P�P��PH�� gT� P�ӌc�&�h��b�K�=\"��Bx�92�b���P�a�����k�͈�jz4�oe������ ѣĠ\"��s7O �\r�\r��JUr�*H]N�M����yw���P#=�	@t&��Ц)�C ���h^-�8��.���:�ꒋ�����+	�`��aK\rd�:V9�S���1�P��MSX���x�3M4k�6HNU�͈n�1�C;r�6v�mLB�p�?�k]��r��2���S\$��i\n���0��5&�t3��([?���茩Ț� ɀ�	¶\r��!p@-kF3��:����x�υ׊�F�k���}@�f�^+�6�\r��:�x�eMĜ:(�蠌#[��H�Z}G8�����,��ǣ+`۽�kl2w�t4;��i�����M�E��\0�3p�pƅ\$c0���ʩ\r�}�q	N*9:'b2gCB3e�]i�\0���%0α ���j�����\nIQfFfH9��I�A9\n��ѝ�p�\\9\n;���<p��\rp�ĩ��pC�*!�˶7�BC\np\$�7�c�R��;4Ҽ��_��v(��M�~Q�,(�D�ǎ�B(����O��*%M��f̐�x C\$��!����\"v	\$T<��H���k;'\0�5nY�٧!2:5q\rO�cWH��'�XP	�L*\"D����0_��3�S��A]�ԇ��\n1gh�1��hʙvD���\$�Va�E��CF��n������\0�Bbj@�~�\0� �>S�����kI����bi��]��S��r��&�y���uI��JvJ�Wq�3/yO,�Bpf=��y��YW��l|��3�\\�\r*܋��H�hCN*�c&U�9�l6���_�U\n�����y�\r�����GAH���>�/CE<\r2C}k���)nM��0Ɩ��r\$��Ĭji�円T�m�S�W��d�@����\n�N���r`].{4�Ȕs\$�#{'4p��r���G����\0�!P�PP(j!+1t��1zK��ʺ��'��S}���k*�O�h�@���N��\r�iS�BC�&SGSn+!�G&,ƫڐE�";break;case"ro":$g="S:���VBl� 9�L�S������BQp����	�@p:�\$\"��c���f���L�L�#��>e�L��1p(�/���i��i�L��I�@-	Nd���e9�%�	��@n��h��|�X\nFC1��l7AFsy�o9B�&�\rن�7F԰�82`u���Z:LFSa�zE2`xHx(�n9�̹�g��I�f;���=,��f��o��NƜ��� :n�N,�h��2YY�N�;���΁� �A�f����2�r'-K��� �!�{��:<�ٸ�\nd& g-�(��0`P�ތ�P�7\rcp�;�)��'�#�-@2\r���1À�+C�*9���Ȟ�˨ބ��:�/a6����2�ā�J�E\nℛ,Jh���P�#Jh����V9#���JA(0���\r,+���ѡ9P�\"����ڐ.����/q�) ���#��x�2��k<7���2'#�v�/X�����9���2�	�C0LT����\r@��`�3�������u##���@�+��ﴡ-7��\0]��CʰA@PH�� gf� P���5J,;��&o�Z���:@CZ����(2׮��7�]�+A�pҔ4�\"p6TB�^�'�Ȏ2)�,/7\n ��[!��6���H����s��Bؓ�6�c^J���	@t&��Ц)�C\$N6��p�<�Ⱥ�^l��4��Zp�X*�#�**u�Gt��R����أuM�3�b��g�Rf� ���i;�t����p87M���Q��:)�L6�\r�d�Z&Nʴ1�����3z�С(|�GC��'1A`A��;:��Ղ�мc[��l*���J9Q.�D�\0x�\r ��C@�:�t�㿌)Je\\9����>��i�p^*A�7����}���\0�7��5��n9U�{��\r<�s@���!�\\���� d�*�p�R����c&����<\$p3:���s�\r�tc9��� ��'h��J�'�i�p�Q���`śXR���^�����`BI�\\\n���\n`\$`g\$�4DU�!�8�7B�49�4B�8�j80�SBOBS\nA�>�R�	���JA�'D�¶LJJE(�y.�UfkR�MC��9�vVX!����5�����\"���:e��n}' �@�a�-A�x ���W���m�s����+�50�T��-�3�y#�Tb\rұ2>Qj�B���^\\\"J��@�7DK�ZTE���������?j-b2�ߊS��\r�)��V�ɻ%�*9(�\"oD�iV�TY=VG�����c��ч'< �Q������\$V�2\n3E�P��GHah�E�fb�#����\\J�\"��ƮDf,��m���jS�T�\rthP!��5�ɺ�\nx05V@���7��D��Clf+P=�P��h8GD���bz���Q�!�Z�\\�n�F�b8G��#4&U+i�fb��2�(&�0��J5h�K����CH\n<&ikb�������U��LS�#��1�7�pK\0l`�a\n��M��B잪i�P��TV��u?��\n&��Q@�V� z�f(��5N�A�W�^�ȋ2��!�I�*�\\� 3�	��Їb\$�9FLʀ��b�񀧅v̀";break;case"ru":$g="�I4Qb�\r��h-Z(KA{���ᙘ@s4��\$h�X4m�E�FyAg�����\nQBKW2)R�A@�apz\0]NKWRi�Ay-]�!�&��	���p�CE#���yl��\n@N'R)��\0�	Nd*;AEJ�K����F���\$�V�&�'AA�0�@\nFC1��l7c+�&\"I�Iз��>Ĺ���K,q��ϴ�.��u�9�꠆��L���,&��NsD�M�����e!_��Z��G*�r�;i��9X��p�d����'ˌ6ky�}�V��\n�P����ػN�3\0\$�,�:)�f�(nB>�\$e�\n��mz������!0<=�����S<��lP�*�E�i�䦖�;�(P1�W�j�t�E���k�!S<�9DzT��\nkX]\$������ٶ�j�4��y>����N:D�.�����1ܧ\r=�T��>�+h�<F����.�\"�]���-1�d\nþ����\\�,���3��:M�bd�����5�N�(+�2JU����C%�G��#���\n�T����,��`	#p�0��Hȋ����n�x�c��2�p�4��~��lJJ@#\$_̓�T�U�S�*6�Oճr���8���rZ�������\r\\��7��������f�X���N@էO�M��j����%���A j��p�8%��HoL�GdK�x�Z,�rhr��\$BaAM؄|M��{�`�t[�\n���jjD_&��a��D�������Z�;*���*��r���^{\0ֵ͘H��})��>W�^O���R�_�I��,\\W���g!>�n�*�K<�8�qpA�oI���ڜ���͊�#5�N\nI9�@\n2���wP^���Y��쉑H����\n��@���??�������\$�<3J^���.7tEڨ5\06����W�PHϛ�1F�	�QC�O'��'����5������k�C���b��D��鈕!5Ng_!Yd�G�cx���iD�:�lLM��L���^p��K͡���r2xOE0���Q���Ő�������s-E��T��DMzء�Z�a�9\n��H�E�DgН7D�\\��4<1>�(�ϡ��� _�43�E�1C��XTj��� ����ԉQ�&!�P�SrqZA)��\n�\\r0�PEw��Xq�W�i)�JCSɞE���2�}�~9�x��zLP�}������E�yb��{�G��ZQ�u6��0�D�M�@0f��4@��:�;�P\\C m\r!�n����z�!�:.��Cxn����p�!7�M��x�>�f0�?�ڡ�F e0����i3ĔG�Ҩ�T�)�\r!E\$XMYD���	uW\rv]#�s����y1J��S�Ne	*ȷZ���<JX�R�n�)RuJ(x<֥�_��̺�Sʑ�I�n�X�Zk0�1�O�1=�R��!�}U��>�\$�DM%�S�j\n�).���\$��\r<ܓ5EL(*{h���F9znu�;��ib�#�j�e����C\naH#���#׵n��7�C%�*FyB���CД����/�E���1�\$�Q݋�>��Sք���/�\\DF�e�{k��F�+T&��<��Ҡ�ƍ�\$��ð�I5�|ϵ�1��vaRq@�R���!����H��k�0���#���O\naRm�&��,�J�><:��J!��ăDELK3���a>����Y�1�lAkD��bT���%�Y�b�r\r���� ᬊ��l��u!I��##���\n�0�Be�o�T�F�@��PWg]�����r�٦�X/HbM@e�K���#5vId��ӰǑDH�N�J\r\r,��}Ԉ��4��!�,Č���a��MJ��h��r)Iz�S�'����&Fk�Ϭ�޿�����;؉��C!��Sh^�ȍ����#���w��>�ד�T�r��ͤ�r�Q�ޛ)2Na��hW������U\n��'Q�!T�z�?�5>�F����I�>��M/*�-�*��t�;��)�]f���EKZ�U� ��O��ݝ�@��2��Af'E#�8��ʹĞ�`�U�\nC'�r�����{\0���w����d��\$�����_lE@�������.�a-%����]r���4��4�?�ɉ,K\r�P�4r�r��U�XJNC�;��rۙ?\$�D���2�<�8oM���^�Ӭ��V����u��n�<�(�#t��?ěF�~��G\\km\"+��}f��rhh��щ;`�";break;case"sk":$g="N0��FP�%���(��]��(a�@n2�\r�C	��l7��&�����������P�\r�h���l2������5��rxdB\$r:�\rFQ\0��B���18���-9���H�0��cA��n8��)���D�&sL�b\nb�M&}0�a1g�̤�k0��2pQZ@�_bԷ���0 �_0��q�^�:S\r����0n4�&b	��a6OS���5\$7�\n\n*��8�	�!��#F�+o;I���Cv�8.DX�ܢ1�*����͗����\n-L0<a+�y5�O&).3:=.ϐ@1����x����42#JB�\r(�%\"��<�jx����B��z�=\n�1�\rH֦�j���*�J����H�2���2����)��5�eH@:#���c���\"`�Cȳ�0���K��Ա�8�7��(�́L������z�D)�(�����\rX��-���#��\"��Kt9B��:�El���P�\$l�6&���B���ӒR�4ϴ�r�ͮ�v�8C[���\0Ă�Mi[W�uZ��ˠ&p�5\0H� if�/�П���5��*����Ȟ2\r��-\r�[SD��b]EB�ڽⴛ)��(Z�#�U��53�)MD�H�M<�}\\�!&�6�=s��Z�����N���N#\$�a+|\r�.4��8|�9@�G���RФ��,\$Bh�\nb�2�h\\-�Z(�.�C�����-5��!��bq=&�z�c���UZ���Ҝ�ܐ\0�6��dևDcx�36(£:�8ERP��d44�J]��cK���B-�=��z�p�0��V�/*yJ&�x�:����c��!�At���@B6������X+P�v���t�GS��?R�u�_]c:=�-]��wm�w<�wޗ��?��t�Ud�?��]���v^��]�M���k\\�2ϩE�c'?��t����k<��0�����#=��\n�<�ΊN��4�b\\�h\$(U*@�\0�X.\0��@���\"\r�:\0��x/��Ǣ�Aq�1�0^U�n���\"��HmM�x���rA�/ �0\"6RJs�0��'>HI�kT���D4�s������`�Q�9I\$�w/*��R�\$/ 8#�B��c�o��V��0t	�H���'�\0��i:��B�BR^_ɗk�|V���MJ\$\$��q̱LE=���/Yl�<�vB\0PS�I)\n�8�H(�\nbM!�=\"\n�TY;%�����Ι��8���8F`��yA���\0�F�K��F��m� �A��g9�hF�\$�|�i�&Qp����ɳ���XxD���<�����<��k�/d��>H�HHԨ#����Tz��(!��WP@á6DE��>R�[#��`�Y����O\naRQ���Cq�QE1��,�]u	�e2\r��RQPf.a���P�(�Ka5�.Q\0��\$P \naD&�Q�Ù��5�Ff�h\r谤�`�I.q�\0�A�bH]2���e�d����'ȁ�k�H�=f��S`l�p�����d��Vh��Uagu�\$8;&��i��%!\r5��Vz�Hk5���Y�#J�5�M� D~���@2Hȩ�I��<n(��\$5�tIԅ\n�P#�pJg�z\"f��M�vl�jhL��^\$E+�U�-�Ͷ1�6Hou�,�42�z��)\n�\0���q#�~\0��&|UY�E\nR�\0�ׅ)#I���&\0�j��	\n�����2-��0A�	)�\$�r��#�x� ��5���j(^j�\ni�b�\"��*rA2���BP�%s֔�?�<��W��̿���T�r�(%��c(xq�*\$����i�8��\n�\nT8����L!��4��N";break;case"sl":$g="S:D��ib#L&�H�%���(�6�����l7�WƓ��@d0�\r�Y�]0���XI�� ��\r&�y��'��̲��%9���J�nn��S鉆^ #!��j6� �!��n7��F�9�<l�I����/*�L��QZ�v���c���c��M�Q��3���g#N\0�e3�Nb	P��p�@s��Nn�b���f��.������Pl5MB�z67Q�����fn�_�T9�n3��'�Q�������(�p�]/�Sq��w�NG(�.St0��FC~k#?9��)���9���ȗ�`�4��c<��Mʨ��2\$�R����%Jp@�*��^�;��1!��ֹ\r#��b�,0�J`�:�����B�0�H`&���#��x�2���!\"��l��	�_!�X@���+\0001���~2����<1@�2P@�I�@@�L��>@P�֍H�';1�7�( �2Ic�\nI����e0��ԒҡKЀP��K@�pHT����+�֣I�t	�\$��8��K>Bd�F� ��(Γ��/�(Z6�#J�Z�B�m2F������BP��9!j*�\n�]���6�؅��5r\\�r�t��[d9�T�Arٖp�^�4\\W}�x��^=%P\$	К&�B��@ch\\-�oX�c.���ljҮ��4ͣW�<�(�`��c�7@�~p�;h�ھ\r�h�1��3�Ҡ�I�,��ֳ�)7�yҠ1��p��2H;,�P��ʹ���6\$��Ό�������(�x�`�Yu��\n��|kЋF�?��\n^&�(f�p�����&�`�3��:����x�ӅͶ~�Ar43��c�A����J@|\$���/%�àx�!�iD���Y�\"H��Vb������]�0��I\"M%\r�8ބ���4 C�4�A\0�g\r����C25%��\"��Ƙ�f�ĐӐ�ã�\$9��zA䔏�2^�)�>��b����<��V	к�{\r�\$\0@\n\n@)#��?`�ny/\n����36�O�`8持��O��@!�\nsH�#?�}�DH [�aJ%�)�TKN@C\naH#7մu��~��6�4��A�ևDFLI�5 G],�\$}!��A᥂	�H)�\$H>���\\�&�)K�^H�y1d�4�B�~z�-����f��f=�p ���z�!�d��6��� �䝵�H�!XP	�L*7д�Q�Q��P��@���*K��<�CDG�R2�hm�ɰƸL� 6�m�B` �8�n��.!hQ�~��RJjaș��ڡ�K\r'P�@��.�Lo\$�	�)A���I�!��b�C�R�x�f���v!N� �8�K�/J%y�B7I�_0�����H�)��l�/�@�T!/i46��N��5/E��B��o�YF%�v<��OˬC\n�P#�p˃:�H��OP��0�}�Z�/���_U���:o[�\rp*ɃWCK�Mx����3]Q�#f΂��]�o	��3��m�����)gԝ��+U=C�4NI�X��I�@�q�E�ՙ��R��%%�07�23M\n4����D�B։�8(�!�`@kC�.j*�V�)uk�iS5�0]�a�%�k\n�@C�ӆȖ�\"P��,��B���Y���F�Z�0";break;case"sr":$g="�J4��4P-Ak	@��6�\r��h/`��P�\\33`���h���E����C��\\f�LJⰦ��e_���D�eh��RƂ���hQ�	��jQ����*�1a1�CV�9��%9��P	u6cc�U�P��/�A�B�P�b2��a��s\$_��T���I0�.\"u�Z�H��-�0ՃAcYXZ�5�V\$Q�4�Y�iq���c9m:��M�Q��v2�\r����i;M�S9�� :q�!���:\r<��˵ɫ�x�b���x�>D�q�M��|];ٴRT�R�Ҕ=�q0�!/kV֠�N�)\nS�)��H�3��<��Ӛ�ƨ2E�H�2	��׊�p���p@2�C��9(B#��#��2\r�s�7���8Fr��c�f2-d⚓�E��D��N��+1�������\"��&,�n� kBր����4 �;XM���`�&	�p��I�u2Q�ȧ�sֲ>�k%;+\ry�H�S�I6!�,��,R�ն�ƌ#Lq�NSF�l�\$��d�@�0��\0P�7��4��`�Afc��2�p�4�Ú�Q�O�\$۽t�B�K!|�5HrH�)�l����^���A�Q1O;�:�o�̢6�]w\\-r�(�`{ ���2�w���,2I.\$���pH����q?5r0Ζw3>�(&2��ƃR�(	�O�jC���7NLh��1 ��	��\n���>�2)!*��Ӫ�DL�!=-�iB#��W0�۰�P�Cj���ߋ� �(\"�]�:�5,/+�� �j`:���������\"Ĉ\"�vж��f���▟�ȳoZZڠ�I�:ZB@�	�ht)�`P�&\r�h\\-�=�.�Y��Sd��� P���X@�W��ظ=���î7cH��-jT���C`�97-�@0�U��3V�p�������a�~�1���8�C��Xn,��q��[\r�x�a�MBx�5�ں�ţ�6孕���DMaC+�,�W���!��B.E� Cn1�a��ru��Gi%%���J�I��z��0=A�:@���/����jF\0��p^�b;�X���DZ�I\r���Պ�/ �ٜ��vCz�: �6��pCJFF��,d��[QtU�<�g�LO��\"�?�2T<�,؇ �a|�	s�\0b8!�dg��aЁ!0�s��f�A��t\$\$q�: ���!TWY�e>Sm3��hHL��K�n\r@0���7��(��.ܺN��M�Oi>K�D=���G���S�����uH�!%%r��c\r�4�xi\$NĬa�:���QgT���0��2S�\r��d4P�wkPl���E�bj�ҕ�=0�)���-�:A�r�R'�k¤4J�cP�-�CBAqN �E���ۺjVD�<��Ȯ��\rш���C��H!��@bBW��7ꎥ[�H�6��:|�D�	�L*LY�.�\r9])bh�#GII7�N����w��J��Y*RZ�T\n)��h�s%k�12V,���3Y�����t��y>�q�~������Q	��3>�@rapF\n�<0Թ��,�uU]%xxS)Xk���b�Ȍ�7���{�5L��?�������6��2�%���-�&�1���L�[m����D�*ν\r��Kn%�-לƔ ���`+,�왦'ak5�.�2?�;��i�A����d��E�T*`Zxnq�	{��l4\r!�9*b�߱F	���*|����	<��{�q�����Ҕ��W�Āt�p͘�vAH�\n	��3�]\\z���hh4|���5l�i\\��L�yg9'�ԼK��v!��DWq�JE�V��.�2�+y�r�ҥX��18�J�F��Ux��Qv�Ha�3�c!a�q��V!L2��Ȱԙ�'������O5sY\r\nk��T��\0��rk:4��'݄��0��,";break;case"sv":$g="�B�C����R̧!�(J.����!�� 3�԰#I��eL�A�Dd0�����i6M��Q!��3�Β����:�3�y�bkB BS�\nhF�L���q�A������d3\rF�q��t7�ATSI�:a6�&�<��b2�&')�H�d���7#q��u�]D).hD��1ˤ��r4��6�\\�o0�\"򳄢?��ԍ���z�M\ng�g��f�u�Rh�<#���m���w\r�7B'[m�0�\n*JL[�N^4kM�hA��\n'���s5����Nu)���j��\$���ܢ�����ܐ�o*H�#�����2���J@�)���ʫ��)��:O*��O\$\"�C��8!`P�:��lb\"41�rݵ�K�!#�P�!�셼8ʴ���;.�����n(ș'��澸�;�0LVɨCh�	���\0M�;��B�6�2�7\r��܎���/\0J�C�>����`P����(���Zt�j��o*�d������0@P�2��,\"9��a���2RO<R\r���<&\0P���Z5�r`0��+�5�#��ѣ-�6�1@��.9ږ�BQ�]�n�tu�4�w-�-��pꚉК&�B��8�ơjFW�\n�Dq2C)���*.8#P������z�!<�	�J���λ �׍��3@��e*F\"d䔎��9���j3ǫ�@˳,���Kz}v��ւ����觳�\0ڍ2��M�76��Ϲ~Ʌ��l9 岑7#l.�\r��stڮ�d�[��k��?P&ʹT*�G�����ӱ�+Y{%C�º�.H˽�#|o\$���ю�,U>m��R��͊j:�è��M��-v O�?ȅ�\0x��(��CCD8a�^��H\\�n4�����ze���̍�xD��H�8&1�<��x�cX�-	 ͪ�(�3��2�/;�(�d�7���ѝn��%P�)4W\n�%��J64	������1�}D���4����V/��t���s4�������dF\$���R�H\n\0���I�ث��\nYa�*� R�cݚC�X��b�Y��*�t��\$\0E�0!D]k�x\r\rS�g�'��L[A\0C\naH#C��B�� \nkȔ�`�C�8�]BlN� ^����֢��z�\"�Q���f��W�Ú�l��4	�'�>A��I*PX9e�]P��@�2<�:A�( ����T\"b�r�5��\"hxS\n�� sY+\"Ew!4��G�����Ҁ�0`�qCY=H�L�YvI�8%�m�Ǡ�i/[�h��`���{��?b],��rJ��\"�p�]��Z���ZM(*�)q�~l�+s�X�QrI(=]�����?EI�Q��ι�H��(^�(!�@�\n�Z\\�\r��@@����~,��O�,�X���-�P�A��(��r(�I�i�h��Qu�b�l�]�h8O�B��PK�JS@R�K��&+(BTS�*!K`(�b{\0N�Z8�\r��>`��(@7G��p�E?��6rS�Y;����9��!:&�䔜XT��	���2U���B�p<�->� C�e��!�[�Nm�)�t�*�#�\\��aV��2�\\\0";break;case"ta":$g="�W* �i��F�\\Hd_�����+�BQp�� 9���t\\U�����@�W��(<�\\��@1	|�@(:�\r��	�S.WA��ht�]�R&����\\�����I`�D�J�\$��:��TϠX��`�*���rj1k�,�Յz@%9���5|�Ud�ߠj䦸��C��f4����~�L��g�����p:E5�e&���@.�����qu����W[��\"�+@�m��\0��,-��һ[�׋&��a;D�x��r4��&�)��s<�!���:\r?����8\nRl�������[zR.�<���\n��8N\"��0���AN�*�Åq`��	�&�B��%0dB���Bʳ�(B�ֶnK��*���9Q�āB��4��:�����Nr\$��Ţ��)2��0�\n*��[�;��\0�9Cx����0�o�7���:\$\n�5O��9��P��EȊ����R����Zĩ�\0�Bnz��A����J<>�p�4��r��K)T��B�|%(D��FF��\r,t�]T�jr�����D���:=KW-D4:\0��ȩ]_�4�b��-�,�W�B�G \r�z��6�O&�r̤ʲp���Պ�I��G��=��:2��F6Jr�Z�{<���CM,�s|�8�7��-��BH�;#`�2\$;�9P@1�C(�2�àӎ�t\$� �u�^�IC�-�ֆo~��@�8�VZ����t�%*T,�_��]+%�].�I�m�|\"�ڣ��Z��iU���]XlTґ�k\r�+�\n���W6dh�FW���W\"#sC��<�PH�� gƆ*���G6�\0L��\r���q.u��н�\"-��#y��=0_��\r�ӱ�P���!^� ��\n?)��R�˫_ߵ�����V������ݕ�����Y�Ǳ�o�W��x�7l��O��.8C{��H]��h�xq�ޮ�=ƷC�jM���ƐS��\"0�g��P��A \$��A�S\n`(2@^Ch/a���䐉��y��z�JAJQ��\"��{��d̲�%<ɔ�eT�Q�Vb��;�-�8�Ő���,���`�ǃpe8(��B���M�&v�g��K��x����b�ce�\$��S�zOY�eG�>����(aݕ�<�Wy)'\n�� ����DhZq.ȶ�]��\$��;3@-���sKH�9���d��sB�H����%A}˰���JQʳ)	1����U�^	����D���L��8�R��\0<'y��`z�@t��9��^ü��6����Pg�u�5D�p/F\0�N{�-��0��r��\r��P\0��iO��6���P����q\\h*�iEIڑ^׈�i4�in��(+�P4 ��� �6\0�x��gɩ��\0��*ya���0�i�C�\"�P��|ii ,U���X˙�[R�%H���C��RE��*s�oq�\0((��R(č*��V��\0h&�szo�U,L�\$�M0柪  ��愆��S�P!ɐs��|��f����uN%x!�0��A�0�}�����AZ��0�3,Ty�4r�9�l^+\$��\"�+CcpW��U�f���.i�m4�f7�#\nB�W\$� Z������\\T������SI����˞���t�6���h�SĽw��.���:�H���syՃ��x\$���w\0dc����~��)!����̚Ch !�rŖIc(c(iƨG��{�,�	���%4@'�0��!Kx�\"Y�:=\n����(aw�{Y���ƴƕW�~��؀�ݮ˶݉�cT��4�p���1�L��́��B)�\"c��-e(%��	��( \naD&�T��R���@M:|�X{2���l}hi���@����&�eq�T���w[O!�tsr���{Q]W�o��U��\\�+@I>ᶳ x\\�.b/�z�� �NF߮�׺�N��'��}�ݬ�e��\nF�yz�Vc:�E��ؑ[j\$��yE��Y����[%L�M��9h\r!�<�2���\0�I�ؤ�B�F��3�ń�I^|2��:��	�!���l	�Ðtخ�GQ�b�6d���ύ��R�Φ�\\�s9��3��b����~ZS�n�o�~À� FH\\2����xJa���f�C�F�ܛV\nA�U��P���!_����W��\$�K�:#�\r��@R��4�f���R&�t����K;�x'Wt��Cbf~��JL��U�:���_�W�vM����jjNI���t���VO�{P�6�A�)������Ls��`����pnwZZ�{/kG	dreI/ �O�C�-Gr|Gj���~\rsд�)��W���`O�7�s䉍(�����\"z�Z�o����g@";break;case"th":$g="�\\! �M��@�0tD\0�� \nX:&\0��*�\n8�\0�	E�30�/\0ZB�(^\0�A�K�2\0���&��b�8�KG�n����	I�?J\\�)��b�.��)�\\�S��\"��s\0C�WJ��_6\\+eV�6r�Jé5k���]�8��@%9��9��4��fv2� #!��j6�5��:�i\\�(�zʳy�W e�j�\0MLrS��{q\0�ק�|\\Iq	�n�[�R�|��馛��7;Z��4	=j����.����Y7�D�	�� 7����i6L�S�������0��x�4\r/��0�O�ڶ�p��\0@�-�p�BP�,�JQpXD1���jCb�2�α;�󤅗\$3��\$\r�6��мJ���+��.�6��Q󄟨1���`P���#pά����P.�JV�!��\0�0@P�7\ro��7(�9\r㒰\"@�`�9�� ��>x�p�8���9����i�؃+��¿�)ä�6MJԟ�1lY\$�O*U�@���,�����8n�x\\5�T(�6/\n5��8����BN�H\\I1rl�H��Ô�Y;r�|��ՌIM�&��3I �h��_�Q�B1��,�nm1,��;�,�d��E�;��&i�d��(UZ�b����!N��P�7��4����A�c��2�p�4�U��p�NK��\"�U�r����q94��t!J�]Õ��P�7�1�����'�\$!-\"\n�h�rRz�[�Si��~�CN�*���#�VK����۬�㪜4�* P��O��xH�A���6*�w|��L�N�7:Ub��`\\k+l������ʙ�[��:����,��d0���jvʫ8gf\\h���u���V�+.���,�ma�2l^���'����S�������H\$	К&�B��xI��)c-��(P^-�e�j.��ϰ��9;E�D�ʾdL�����b \\\n�����C|A�R��\\�rG��Lȃ0fca�2�S�\"��ZI���d�N� \rI\r��a`ceiX�#�}���d��B��S�\r��;�r�VQd7t\$�\"6����Y(i�E>���X\ng���Rܚ�,'�\$�,Ƕ�b�'-u���ء�_\\���\$X��6����Y\n�j!E&��K&Q`��Ƀ0=A�:@���/��V��jUM��8�p^�e�e1�7�Db�I\r�����R�/ �Ld����0���T*n����=Վjj�S�U�+�#\\����@�{�B�`�;����	�3'��Cf�\n\0:�0�0u��L3�Y�6A���\0000�fI&�;,\r����t�Uk�V\np�< t�\n�.�nR2P���@\$\0@\n@)U/��+zNہܐk��.��UJ�\n�ɺk��<�59�p���P�\$91���!�RO�\rD�a��0F�����Vq�0��1&9GX�=\$�l#1hU/T���\0��a������A�=Ε�CJ�S�V���4XT�Y*���]���K�杷WdzR)�҇h���X	\$�<��@�Pc��h���Ƀ�u?��3'\0���L�������������,C���J�9k\rO�i[+��r�p]�2ܵ�)T�;eO��l���+*PQ�.w���;�\" UntVa\\���U��g��P�{}ZSb�r�I��C<�\n!0h����R��T���w2�1��� �H��ƿX�m���{�b�#�����s69�d��	|m���7���5�H��d,���Z��M���ܰv�;Yu4�	a��ryY����Wu�Hc\rw�����N34*em�Ұ�8m�i�|�4�B�F��6���4�g+\0���d��1��+����xї�5|��%�e����85Q���n����s�ڕ�a�)Lj�`�Nz+�`���t��(L�إ�:x\\@��[A���s�͌�	��BZ��*V`oÁ�8�������%e]�F���`qΕ�)�v� &��y�\\\nt�O�Bd�e\n9�`lE�Y��]��Gy�c�Ln*=�����F���9=<E�P";break;case"tr":$g="E6�M�	�i=�BQp�� 9������ 3����!��i6`'�y�\\\nb,P!�= 2�̑H���o<�N�X�bn���)̅'��b��)��:GX���@\nFC1��l7ASv*|%4��F`(�a1\r�	!���^�2Q�|%�O3���v��K��s��fSd��kXjya��t5��XlF�:�ډi��x���\\�F�a6�3���]7��F	�Ӻ��AE=�� 4�\\�K�K:�L&�QT�k7��8��KH0�F��fe9�<8S���p��NÙ�J2\$�(@:�N��\r�\n�����l4��0@5�0J���	�/�����㢐��S��B��:/�B��l-�P�45�\n6�iA`Ѝ�H �`P�2��`�	#p�\r#\" �%Ð@����&#�Ҷk�򽶃H�!D�} P�\r�L�\r++���CҠ�B��	�E�R�OX�:4\"l�5*kw=0e���pHR����CC4S�P��#���)�+`�	�Jԥ++,匬����##H�<��N꾹.��^���2���#vJ@��L�0��esg�6�^6Z�R�W9�X�� t9�\"��w�\"�Z0�!h�3�B�_)�� �9��t,&8\n����<C�r��5e���P�%�F���hȟ,���B��N)��p��\$:|5�0�<�cٗ��֩��9b�0�d�ȾvO���j�%��@���k������:�#76�rD�8��c卫E� �5�㛂��������<�I8��k�Z�'�α�6N�ӿp\r��슌�2�`@6/��n��1:,��ó��\\c4�� |yy-�ܕ�:����3d�6G�O���.4Kc0z\r��8a�^���]l ;L���zc�a��7��@Jbg�eA�^0�М*��`뭷(�t2�n;>��q�p�I2>VD��\$.��rA3\n�6r`G�1�=n\r�b.�h k�2��[�D��͆S�YR�\$&L5NP(ngƐ��H[\n (�p��yo@�PR�T\$}��T��l\$�P4+�2|[��2fd��H��P?k��\$���cG3��lk��f����t�	C�4`�!�0��8j3�	ڄbJL\\&sĐ�rRJ�N�聵V�E�S�P.�\r2b�	�	�e͐4�ABH)�4BNb�� � �G�G�<C[��9>c�{N1�D����T�g��������y/`(�\ri �Y�7�4�X�\$tED��#����#Ȕ�! �C;)wh(�:'H���A*C�;����H^@�DLrE*NPC�g�b�7�Օ�@���8�0����M�>�@��Ni�!��H�C��J\n94�\0�&�H�Ѡ&�kA�YM�K��k�!*)Q\"�u�˙�6K\r�/l@�!���\n��P30�!�@B�F��	��Ȃ]�\$A����MT8�12��I>����3�Ɣ�3�]P\\�mHԸ�3�S͚��D���8�)H%� �,a|��O���\n�Mx�̶5�3\"d�\r\n\"���S�Tj�a�N�\n_�ӇD�����An/9a+ePy��ԅ5jgh\r���' ��k����Дǃ�n��-��ֻk=,!r�&��'^^\r����";break;case"uk":$g="�I4�ɠ�h-`��&�K�BQp�� 9��	�r�h-��-}[��Z����H`R������db��rb�h�d��Z��G��H�����\r�Ms6@Se+ȃE6�J�Td�Jsh\$g�\$�G��f�j>���C��f4����j��SdR�B�\rh��SE�6\rV�G!TI��V�����{Z�L����ʔi%Q�B���vUXh���Zk���7*�M)4�/�55�CB�h�ഹ�	 �� �HT6\\��h�t�vc��l�V����Y�j��׶��ԮpNUf@�;I�f��\r:b�ib�ﾦ����j� �i�%l��h%.�\n���{��;�y�\$�CC�I�,�#D�Ė\r�5���X?�j�в���H�)Lxݦ(kfB�K���{��)�)Ư�FHm\\�F �\$j�H!d*���B���郴՗.C�\$.)D\n����lb�9�kjķ��\\���̐ʾ��D����\rZ\r��qd�隅1#D�&�?l�&@�1���M1�\\���`�hr@�:����H�;#`�2#(�;X�\0�9�2��(�:\r6\r\0�4�TT�M��4M2]+��4O�rҌF#EU8�w:b^��0�.��.���^�%	�\"��v\$���HK�41�a�Et�Sp��]#Iq,��\\x�cy1CW�FpL���P��OKhP�2��QŦ�d�W\$��5�_�1��\"��h�4��t��*jI\0�ED��e���+�?�Q��W�ɺ�\nХ�V���|���x\\�;�����Ф��Z�J{���{��o\r��1o�6��Q�=���\\�C���I�F�K�s��B�)��\\◁p�]�`���1�7c@P�4�c�6���fZ]�y�Y}��<���4��u�hf�����嗺����^iX �~�xg\$�ʨ�uM��N�MuW�@;L��Wx��<�\n�\\[��I\$�(���P�8}�\0�3f���)��\n�\nSR���蘒@�PK�8�u�Wք��&�\\ˢ���N�il������bH(�<�(%�?�>\r��ӂr�x��c\$�T)mpX�B� 3n� Y���B�i1fPBA�`�D��Ēa������%�!i�!�\0�����jqOg�;T�r(�{��}�g�J��2EM1��K�L\r���Rl�q:k�JM�(z��A\\,�.���\n��,��Tv�̈́tK��	]�� ������\"\r�:\0��x/�L�CHnX��e�p^����yO07�DY���[1��'�Br�/ ��+�h��f\"&	���ha�~�%��u*o��C�k�Z�Ȫw��)veh�74Z�9t�Ё��r��T9�>eF_��/d�+��E�\"���\\���!O�� ��9����aiU:��D��ng#2yOf�>�r4o��uC��(��jJzO�9?��\ng����A)?T4_R���LU\$\0���q-b� �=*���B�Y'��bo���7J1U�S������I���Q�<�.�*0��1�j�r\"���V�1t�E��W�������A�����ņ�[���A\$��7�VM���j�BJ��:��\r&�\n�b�L�����]�e����/i�}�T�IHĄ�1*�=��4�f��X�4��8DxkD=���Y]x4�Ln�XK�ת��P'�0�����I���Mh�==�%P���s�r�8BM����Ϻ�+�\"��IL���ga�4�я��D�lBFAD�ؒ*��Tz�֑A��@L&�>\0���G�8�PgZ���7�E6�HR��#�*�D��@v�vY��D��1�R���>J��5�פY󁡥鴘���G��q}�l�@�\n�#�p��A0bp�k~�OH�h�ϣ�.o�Iʆ(O�\r����S*ƥ#e`\$5Lg�4M�g�>�X�K�	n���\0�=\r�ܦ�n+,��,�T��Ȧ�M�:Y�eMx�Q{i͌@�m�p���7�U���w�6���Gan����������6hh��)0vdh�����f���O`\$%��%�n�KZB�R&rpqZ�ω�w���w[�<cYhK�ƍ����K��~=&hӜGhD9zIb�ݸ��C|�m�H\$h�g�҃��0���u� �.�I\rWt�@���7�i�9�j4S��x�+u���#W�r&�mŔh�d����tر�4K�B�����@�]j�@";break;case"vi":$g="Bp��&������ *�(J.��0Q,��Z���)v��@Tf�\n�pj�p�*�V���C`�]��rY<�#\$b\$L2��@%9���I�����Γ���4˅����d3\rF�q��t9N1�Q�E3ڡ�h�j[�J;���o��\n�(�Ub��da���I¾Ri��D�\0\0�A)�X�8@q:�g!�C�_#y�̸�6:����ڋ�.���K;�.���}F��ͼS0��6�������\\��v����N5��n5���x!��r7���C	��1#�����(�͍�&:����;�#\"\\!�%:8!K�H�+�ڜ0R�7���wC(\$F]���]�+��0��Ҏ9�jjP��e�Fd��c@��J*�#�ӊX�\n\npE�ɚ44�K\n�d����@3��&�!\0��3Z���0�9ʤ�H	#p�0��Hȉ�ó�?((�2��(�:\r4xύ)Z�����\rK<��pN��C:�����%Krb!�ô�#���WV�Qĩ�>�M��1PKA�C��2��R1�SF��A b�����ec�5�%���PƜ3ɆQ7.���EzP<:��h�i\$:��BB�,�1#�2�Ud���I�`��6Lt�wPL��\$�>]� UX�`Y�T1B>,�Ph�muHO1[#��K��	�ht)�`P�<�Ⱥ��hZ2�P��=l�.́B ��Cd�Q�7?��w���(�e�Ø�Ro�\09�C@6-\0P�7�C\rD�57�t�P��IvS؎�B:IF�1���7���4�Z��Fr0|��U\0006>tb\\� s9�Z�xr8���|�C���-[46E�`@��s2:�w\n�R�X��.]ACs*0�������P��p��ӉQ@�Jjw HP�~:w]��[��b�x%�R�EmO�Ygv��W�Z�Т�0=A�:@���/����i�>����p^���cQ͙�DR�=DP�\"����/ ����ӗ:aci`4!tZ�\$/O�B88KV\".1��@���ay@a��c�\\�a�-�0��a�:ė@�\"0i#���x���b�R\nH�B�����CI��#f�S��/��P�.��\n\n (E�f��#��!' R\nXh>�\r�0�b� ;q�M��P�B��A�vc	��g��*N4p���m\\�A�2�P�S\nAԆ�ʐS2YWD�9ä� ��#B�:��\n�k�9epT�(.\0���\$(�T/'+�9��dZ��qŪ?0�����'�\"\$H��Ǚ\$f�\\H�yn��A9��K1@�,� d���0B	5�:��+�@R�.~�r�3\$�BXO\naPӇWf�	��_��3�F�Ʉ&eDܜ���Ogy��k�R)d@��\0;RL�r;��~r�~G�!#'��N\"����9��a�� �0�\"qզ�v�I�k	����\\�lØO�:Wt�tLL�e�9�h_:zbU#��:)H C-&��G�_髳-	^ֳ��2>�5i7�^H�1�)T�@�0-�!W��	OY�2t��W��� \r0�jE\\M�P���3)5@PQ�	��`rNXDTE�a��<a,��n�Y��f�؋3eڴ��`.u�j\n�a4榥�li-0��w�-����KI@�@�'V0.�j�;���6�����</��Cr*R�\\7Ʒ\\q����EV��G�ޝS\0��84\0";break;case"zh":$g="�A*�s�\\�r����|%��:�\$\nr.���2�r/d�Ȼ[8� S�8�r�!T�\\�s���I4�b�r��ЀJs!J���:�2�r�ST⢔\n���h5\r��S�R�9Q��*�-Y(eȗB��+��΅�FZ�I9P�Yj^F�X9���P������2�s&֒E��~�����yc�~���#}K�r�s���k��|�i�-r�̀�)c(��C�ݦ#*�J!A�R�\n�k�P��/W�t��Z�U9��WJQ3�W�q�*�'Os%�dbʯC9��Mnr;N�P�)��Z�'1T���*�J;���)nY5������9XS#%����Ans�%��O-�30�*\\O�Ĺlt��0]��6r���^�-�8���\0J���|r��\$�ð�6\r# @9����.�x�c��2�p�4��\\��k��L��J[�\$j��?D\n�L�E�*�>�	�@J8r�e�\\ıh|�R�L�I SA b��@���8s���N]��\"�^��9zW,�9v�%�s]�Aɱ��E�t�I�E�1j��IW)�i:R�9T��D�2�%�r�䍑?��`@�V�}ܗ1\0�/9X*��\$Bh�\nb�-�8(�.��h�� dYVe�,�5�ØA��I_c8�Kd0TCdA.сC`�9%�	�Sg9t_���Ɠ��P�s�C�\n{����<s�,�X�Irɐg9VW܅�C�2aHX��dV.LC<C�\$��庍I�1�I-��t���^J��A!a���ˢ*�	4����o��F���ۯ����ŗN�Px0�D�3��:����x�ׅ��6�#t�LC8_4�c��4�cH�7��?�4J��x�d���Y���Wg1`\\��\nr���6_��IC���q�����iHsdm�����K��D�\0v���b����r!�=�I&7d)˨�1�DN,��ˁr���B�p@@Pcp].G�*`�(�0D��_����Y>�����,�P�g�1��Lqx�E�8åo�2֓E�0ȸD\0�F�R5\$J�syQk�s�1�#[�x�B��`L�96'�a\\-T{x�(�QD'��c(lS!�'��7�B\r�N#��v�ux�V�9���q���4q�����N�\"�xS\n�l���b*��|��G�\"��[����GH�V*�r�<.�\$.@b<W�s� 8��*>HE?Eb,)��S	�也4��\n^8�>as\0�axs&d͉aa;���F���9�&�r/�-Ù�ADx�i�@X�W�cDd��<!���oc:L�O�B9DG�n�a\\|E�'��r�G�.��\n�P#�pm��}*����`ܡ#�Ae��������P\\��2T�i��t(i���S4���\0@��}\"L_4Ä/�X���^!�(@��fi�˅i k�@�<P�9JwɃv%�\$@3b\$�:G���F�.�Yi�A ��x��E?0����eL�v:U&���JB*E�";break;case"zh-tw":$g="�^��%ӕ\\�r�����|%��:�\$\ns�.e�UȸE9PK72�(�P�h)ʅ@�:i	%��c�Je �R)ܫ{��	Nd T�P���\\��Õ8�C��f4����aS@/%����N����Nd�%гC��ɗB�Q+����B�_MK,�\$���u��ow�f��T9�WK��ʏW����2mizX:P	�*��_/�g*eSLK�ۈ��ι^9�H�\r���7��Zz>�����0)ȿN�\n�r!U=R�\n����^���J��T�O�](��I��^ܫ�]E�J4\$yhr��2^?[���eC�r��^[#�k�֑g1'��)�T'9jB)#�,�%')n䪪�hV���d�=Oa�@�IBO���s�¦K���J��12A\$�&�8mQd���lY�r�%�\0J�BH�;#`�2��9�X@7�A\0�9� �7�L�9����)2���ft(t	KQ�L�iyJ����\\��}\"B�nct��6W!�@�<��(P9�*i1-�0!pH����H��re��B��^Ԉ�v�)�q\$���Rz���q���@��it�ZH\$k`α|C9T�.�'�%З�!�C�ItW_W�4(d\r�s�e�,s���	@t&��Ц)�B��\"�\\6��p�2[v�&C�\$�0S0lJ�A,r���\\�f�_\rC��A��\"��`�92�A�M�L4rD3,r���Ph�!}ߪ�^��mQFs�, X�Ir�\$\$�A����R2.�#r	�@��4��D���t�\n�|F\$9t%4ND'�Vm�ߌ��2�c��7��,W���G�|i�ST��x�p<TYt�C\0!\0�:��D4���9�Ax^;�p�2\r�H�5�Ӏ�����T���@�JP}�g�)bJ��x�gd�֎�q&�g5+K��)Ks\\�М��r(@�B��3c؉�h�CB4�+�`!�{1r�|�#QP9��B�a\$PКSM�r���'Ź�adi��>�Q�3�\0]����E�5D�@\$`��{>����CJ'3!)�t�Tj�b�@!��Y�0��\0��@:�ʼ���ڀĨ�GPq}��&�y,#�J��tS\nA@�ӹ�u��	�xj��~�XW�l�[�_&DЛ\$1�+��@4���9J	�A����\"�%6��Aa<'1�9fl��Q<^c�Mj>C�b��0�N��.'h��%P0a:(��P	�L*RPQ@�\0s�6Pċ)f\"Y�S)�K8�D�V�bZbP�3�`!\0&� F\n�@��!g6��\naD&�{-��V�by����v��\n�g\0�!�Y��Қs���TpĜ�AEeTr��RuFgА�1B�X��>/�8�\$\0G�6�]::'<s	�~k�R2�\\W�r��3��A��0-�E�}���QȌ��:��3(�L��aSD��ZBd�aTC{�tM�ٌ'@�0�@#Da3bDB@r.��S���*J���Rx���B�HP�'�(�:34���\0g,\\�[T�k\n���ܳc�R2�F/Iu`_��@��\\U����_\"�lki��U���t��";break;}$zg=array();foreach(explode("\n",lzw_decompress($g))as$X)$zg[]=(strpos($X,"\t")?explode("\t",$X):$X);return$zg;}if(!$zg){$zg=get_translations($ba);$_SESSION["translations"]=$zg;}if(extension_loaded('pdo')){class
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
apply_sql_function($X["fun"]??null,$B)."</a>";echo"<span class='column hidden'>","<a href='".h($Zc.$Gb)."' title='".lang(90)."' class='text'> ↓</a>";if(isset($X["fun"])===false){echo'<a href="#fieldset-search" title="'.lang(43).'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($x)."');");}echo"</span>";}$Kc[$x]=$X["fun"]??null;next($K);}}$Gd=array();if($_GET["modify"]){foreach($J
as$I){foreach($I
as$x=>$X)$Gd[$x]=max($Gd[$x],min(40,strlen(utf8_decode($X))));}}echo($Ja?"<th>".lang(91):"")."</thead>\n";if(is_ajax()){if($y%2==1&&$D%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($J,$Fc)as$ce=>$I){$Ig=unique_array($J[$ce],$w);if(!$Ig){$Ig=array();foreach($J[$ce]as$x=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$x))$Ig[$x]=$X;}}$Jg="";foreach($Ig
as$x=>$X){if(($ud=="sql"||$ud=="pgsql")&&preg_match('~char|text|enum|set~',$p[$x]["type"])&&strlen($X)>64){$x=(strpos($x,'(')?$x:idf_escape($x));$x="MD5(".($ud!='sql'||preg_match("~^utf8~",$p[$x]["collation"])?$x:"CONVERT($x USING ".charset($h).")").")";$X=md5($X);}$Jg.="&".($X!==null?urlencode("where[".bracket_escape($x)."]")."=".urlencode($X===false?"f":$X):"null%5B%5D=".urlencode($x));}echo"<tr".odd().">".(!$Lc&&$K?"":"<td>".checkbox("check[]",substr($Jg,1),in_array(substr($Jg,1),(array)$_POST["check"])).($rd||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Jg)."' class='edit' title='".lang(92)."'>".lang(92)."</a>"));foreach($I
as$x=>$X){if(isset($de[$x])){$o=$p[$x];$X=$m->value($X,$o);if($X!=""&&(!isset($Xb[$x])||$Xb[$x]!=""))$Xb[$x]=(is_mail($X)?$de[$x]:"");$z="";if(preg_match('~blob|bytea|raw|file~',$o["type"]??null)&&$X!="")$z=ME.'download='.urlencode($a).'&field='.urlencode($x).$Jg;if(!$z&&$X!==null){foreach((array)$Fc[$x]as$Ec){if(count($Fc[$x])==1||end($Ec["source"])==$x){$z="";foreach($Ec["source"]as$s=>$Nf)$z.=where_link($s,$Ec["target"][$s],$J[$ce][$Nf]);$z=($Ec["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($Ec["db"]),ME):ME).'select='.urlencode($Ec["table"]).$z;if($Ec["ns"])$z=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($Ec["ns"]),$z);if(count($Ec["source"])==1)break;}}}if($x=="COUNT(*)"){$z=ME."select=".urlencode($a);$s=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Ig))$z.=where_link($s++,$W["col"],$W["val"],$W["op"]);}foreach($Ig
as$vd=>$W)$z.=where_link($s++,$vd,$W);}$X=select_value($X,$z,$o,$kg);$t=h("val[$Jg][".bracket_escape($x)."]");$Y=null;if(isset($_POST["val"][$Jg][bracket_escape($x)]))$_POST["val"][$Jg][bracket_escape($x)];$Tb=!is_array($I[$x])&&is_utf8($X)&&$J[$ce][$x]==$I[$x]&&!$Kc[$x];$jg=preg_match('~text|lob~',$o["type"]??null);echo"<td id='$t'";if(($_GET["modify"]&&$Tb)||$Y!==null){$Pc=h($Y!==null?$Y:$I[$x]);echo">".($jg?"<textarea name='$t' cols='30' rows='".(substr_count($I[$x],"\n")+1)."'>$Pc</textarea>":"<input name='$t' value='$Pc' size='$Gd[$x]'>");}else{$Md=strpos($X,"<i>…</i>");echo" data-text='".($Md?2:($jg?1:0))."'".($Tb?"":" data-warning='".h(lang(93))."'").">$X</td>";}}}if($Ja)echo"<td>";$b->backwardKeysPrint($Ja,$J[$ce]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($J||$D){$gc=true;if($_GET["page"]!="last"){if($y==""||(count($J)<$y&&($J||!$D)))$Hc=($D?$D*$y:0)+count($J);elseif($ud!="sql"||!$rd){$Hc=($rd?false:found_rows($R,$Z));if($Hc<max(1e4,2*($D+1)*$y))$Hc=reset(slow_query(count_rows($a,$Z,$rd,$Lc)));else$gc=false;}}$Ee=($y!=""&&($Hc===false||$Hc>$y||$D));if($Ee){echo(($Hc===false?count($J)+1:$Hc-$D*$y)>$y?'<p><a href="'.h(remove_from_uri("page")."&page=".($D+1)).'" class="loadmore">'.lang(94).'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$y).", '".lang(95)."…');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($J||$D){if($Ee){$Sd=($Hc===false?$D+(count($J)>=$y?2:1):floor(($Hc-1)/$y));echo"<fieldset>";if($ud!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".lang(96)."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".lang(96)."', '".($D+1)."')); return false; };"),pagination(0,$D).($D>5?" …":"");for($s=max(1,$D-4);$s<min($Sd,$D+5);$s++)echo
pagination($s,$D);if($Sd>0){echo($D+5<$Sd?" …":""),($gc&&$Hc!==false?pagination($Sd,$D):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Sd'>".lang(97)."</a>");}}else{echo"<legend>".lang(96)."</legend>",pagination(0,$D).($D>1?" …":""),($D?pagination($D,$D):""),($Sd>$D?pagination($D+1,$D).($Sd>$D+1?" …":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".lang(98)."</legend>";$Lb=($gc?"":"~ ").$Hc;echo
checkbox("all",1,0,($Hc!==false?($gc?"":"~ ").lang(99,$Hc):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Lb' : checked); selectCount('selected2', this.checked || !checked ? '$Lb' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>',lang(89),'</legend><div>
<input type="submit" value="',lang(14),'"',($_GET["modify"]?'':' title="'.lang(85).'"'),'>
</div></fieldset>
<fieldset><legend>',lang(100),' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="',lang(10),'">
<input type="submit" name="clone" value="',lang(101),'">
<input type="submit" name="delete" value="',lang(18),'">',confirm(),'</div></fieldset>
';}$Gc=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($Gc['sql']);break;}}if($Gc){print_fieldset("export",lang(102)." <span id='selected2'></span>");$Be=$b->dumpOutput();echo($Be?html_select("output",$Be,$ta["output"])." ":""),html_select("format",$Gc,$ta["format"])," <input type='submit' name='export' value='".lang(102)."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($Xb,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".lang(103)."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ta["format"],1);echo" <input type='submit' name='import' value='".lang(103)."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$vg'>\n","</form>\n",(!$Lc&&$K?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["script"])){if($_GET["script"]=="kill")$h->query("KILL ".number($_POST["kill"]));elseif(list($Q,$t,$B)=$b->_foreignColumn(column_foreign_keys($_GET["source"]),$_GET["field"])){$y=11;$G=$h->query("SELECT $t, $B FROM ".table($Q)." WHERE ".(preg_match('~^[0-9]+$~',$_GET["value"])?"$t = $_GET[value] OR ":"")."$B LIKE ".q("$_GET[value]%")." ORDER BY 2 LIMIT $y");for($s=1;($I=$G->fetch_row())&&$s<$y;$s++)echo"<a href='".h(ME."edit=".urlencode($Q)."&where".urlencode("[".bracket_escape(idf_unescape($t))."]")."=".urlencode($I[0]))."'>".h($I[1])."</a><br>\n";if($I)echo"...\n";}exit;}else{page_header(lang(64),"",false);if($b->homepage()){echo"<form action='' method='post'>\n","<p>".lang(104).": <input type='search' name='query' value='".h($_POST["query"])."'> <input type='submit' value='".lang(43)."'>\n";if($_POST["query"]!="")search_tables();echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^tables\[/);",""),'<th>'.lang(105),'<td>'.lang(106),"</thead>\n";foreach(table_status()as$Q=>$I){$B=$b->tableName($I);if(isset($I["Engine"])&&$B!=""){echo'<tr'.odd().'><td>'.checkbox("tables[]",$Q,in_array($Q,(array)$_POST["tables"],true)),"<th><a href='".h(ME).'select='.urlencode($Q)."'>$B</a>";$X=format_number($I["Rows"]);echo"<td align='right'><a href='".h(ME."edit=").urlencode($Q)."'>".($I["Engine"]=="InnoDB"&&$X?"~ $X":$X)."</a>";}}echo"</table>\n","</div>\n","</form>\n",script("tableCheck();");}}page_footer();