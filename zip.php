<?php
/*
ディレクトリをWEBサーバー上に圧縮するPHPスクリプトです。
まず、事前に同じ名前のzipファイル名、PHPスクリプトファイル名が、圧縮するWEBサーバーのディレクトリ上に無いことを確認して下さい。
このPHPファイルをWEBサーバーの圧縮するディレクトリがある場所にアップロードし、ブラウザで
https://WEBサーバーURL/zip.php
にアクセスすると指定した圧縮するディレクトリが指定したzipファイル名で圧縮されます。
*/

$zipdr = "testdr";	//圧縮するディレクトリ名
$zipdrpass = getcwd().'/'.$zipdr;	//このPHPスクリプト場所＋ディレクトリ名
$zipfilename = 'testdr.zip';	//圧縮後のzipファイ名
$zipfilepass = getcwd().'/'.$zipfilename;	//このPHPスクリプト場所＋圧縮後のzipファイル名

if(!is_dir($zipdrpass)){
	exit("圧縮するディレクトリ「".$zipdrpass."」がありません。");
}

function zip($zipdrpass, $zipfilepass){
	chdir($zipdrpass);
	return shell_exec("zip -r {$zipfilepass} .");
}

if($zip = zip($zipdrpass, $zipfilepass)){
	echo '<html lang="ja"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>ディレクトリが圧縮されました。</title></head><body>';
	echo "ディレクトリが圧縮されました。<br />\n";
	echo "圧縮ディレクトリ：$zipdrpass<br />\n";
	echo '<div style="overflow:auto; height:300px; border: #ccc 1px solid; margin:20px;">';
	echo "<pre>$zip</pre></div>\n";
	echo "$zipfilepass: は正常に圧縮されました。<br />\n";
	echo '</body></html>';
}else{
	echo("抽出に失敗しました: $zipdrpass\n");
}

?>