<html>
<head>
        <style type="text/css">
        input{background-color: #FFCB43}
        </style>
       <title>DEMINEUR<-- </title>
    
</head>
<body bgcolor="#cccccc"><center>
<form name="form" method="post" action="#">
   <?
       // generer les mines :)
       $duplicate=0;
       //debug : echo "map_mines au debut :".$map_mines."<br>";
        if(empty($map_mines)){
            for ($a=1;$a<=10;$a++)
            {
                $duplicate=0;
                $array[$a]=rand(1,100);
                if($a>1)
                {
                     for ($e=($a-1);$e>0;$e--)
                    {
                        if($array[$a]==$array[$e])
                        {
                            $duplicate=1;
                        }
                    }
                 }
                 if ($duplicate==1)
                 $a=$a-1;
                 $map_mines="";
                for ($f=1;$f<=10;$f++)
                {
                    if($f >1)
                    {
                        $map_mines.="_";
                    }
                $map_mines .= $array[$f];
                }
            }
            
          }else{
              $map_mines_back = $map_mines;
            $count = 1;
            while(strlen($map_mines)!= 0)
            {
                $nbmines = strrpos($map_mines,"_")+1;
                $array[$count]= substr($map_mines,$nbmines,strlen($map_mines));
                if(strlen($map_mines)==2)
                  $array[$count]=$map_mines;
                $map_mines = substr($map_mines,0,$nbmines-1);
                $count++;
            }
            $countp= 1;
            if(!(empty($passed))){
                if(strlen($passed)>=289)
                {
                    die("BRAVO VOUS AVEZ GAGNEE !!!");
                }
                $passedback=$passed;
                if(strlen($passed)==2)
                {
                        $passedarray[$countp]=$passed;
                        $passed = "";
                }
                while(strlen($passed)!= 0)
                {
                    $nbmines = strpos($passed,"-")+1;
                    $passedarray[$countp] = substr($passed,0,($nbmines-1));
                    if(strlen($passed)<=2)
                    {
                        $passedarray[$countp]=$passed;
                        $countp++;
                        $passed = "";
                    }else{
                         $passed = substr($passed,$nbmines,strlen($passed));
                         $countp++;
                     }
                }
            }
            $map_mines = $map_mines_back;
            $passed = $passedback;
        }
    ?>
 <b>nom :<br><? echo "<input type=\"hidden\" name=\"map_mines\" value=\"".$map_mines."\">"; ?>
             
<input type="text" lenght=6 name ="name" value = "<? if(empty($name))$name="player"; echo $name; ?>"> <br><br>
Sélectionner une cellule : <br><br>
<table border=10 bgcolor=#888888 bordercolor="#543210">

<?
// faire le tableau :)
$incremente = 1;
$explosed = 0;
echo "<u>découvert :</u><br><h2>";
for ($i=1;$i<$countp;$i++)
{
    echo $passedarray[$i]."-";
}
echo "</h2><br>";

for($g=1;$g<=10;$g++)
{
    if($val == $array[$g])
    $explosed=1;
 }
for ($c = 1;$c <=10;$c++)
{
    echo "<tr>".chr(13);
    for($d=1;$d<=10;$d++)
    {
        if($val==$incremente)
        {
            if($explosed==0)// ok :)
            {
                if(strlen($passed)==0)
                {
                    $passed .= $incremente;
                }else{
                    $passed .="-".$incremente;
                }
                echo "    <td width = 150 align=\"center\" bgcolor=\"#543210\" >";
                echo "<input  type=\"submit\" value=\"".chr(246)."\" name=\"val\">";
            }else{
                echo "    <td width = 150 align=\"center\" bgcolor=red >";
                echo "<font-color=red>YOU DIED HERE !</font>";
            }
        }else{
            if($explosed==0)// ok :)
            {
                $isinliste=0;
                for($j=1;$j<$countp;$j++)
                {
                    if($passedarray[$j] == $incremente)
                    {
                        $isinliste=1;
                    }
                }
                if($isinliste==1)
                 {
                      echo "    <td width = 150 align=\"center\" bgcolor=\"#ffffff\" >";
                      echo "<input type=\"submit\" value=\"".$incremente."\" name=\"val\">";
                      $score ++;
                 }else{
                      echo "    <td width = 150 align=\"center\" bgcolor=\"#cccccc\" >";
                      echo "<input type=\"submit\" value=\"".$incremente."\" name=\"val\">";
                      $score ++;
                 }
            }else{// explosé :)
                $vartoadd="";
                for ($h=1;$h<=10;$h++)
                {
                        if($incremente == $array[$h])
                        {
                            $vartoadd = "x";
                        }
                }
                if($vartoadd=="")
                {
                    $isinliste=0;
                    for($j=1;$j<$countp;$j++)
                    {
                        if($passedarray[$j] == $incremente)
                        {
                            $isinliste=1;
                        }
                    }
                    if($isinliste==1)
                    {
                        echo "    <td bgcolor=white width = 150 align=\"center\">";
                        echo "<b>&nbsp;&nbsp;</b>";
                    }else{
                        echo "    <td bgcolor=yellow width = 150 align=\"center\">";
                        echo "<b>&nbsp;&nbsp;</b>";
                    }
                    
                }else{
                    echo "    <td bgcolor=red width = 150 align=\"center\">";
                    echo "<font color=white> X </font>";
                }
            }
           
        }
        echo "</td>".chr(13);
         $incremente++;
    }
    echo chr(13)."</tr>".chr(13);
}

if ($explosed == 1)
{
?>

<br><br><br>
<form method="post" action="#">
<input type="submit" name="retry" value="recommencer">
<input type="hidden" name="map_mines" value="">
</form>
<?
}
?>

</table><br>
score</b><br><? echo "<input type=\"hidden\" name=\"passed\" value=\"".$passed."\">"; ?>
<input type="text" lenght=6 name ="score" value = "<?if(empty($score))$score="0"; echo $score; ?>"> <br><br>
</form>

<? // debug: <? echo $map_mines; ?>
</center>
</form>
</body>
</html>
