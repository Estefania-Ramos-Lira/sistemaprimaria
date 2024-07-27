<?php
require('../public/fpdf181/fpdf.php');

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}




function HTML2RGB($c, &$r, &$g, &$b)
{
    static $colors = array('aliceblue'=>'#F0F8FF', 'antiquewhite'=>'#FAEBD7', 'aqua'=>'#00FFFF', 'aquamarine'=>'#7FFFD4', 'azure'=>'#F0FFFF',
        'beige'=>'#F5F5DC', 'bisque'=>'#FFE4C4', 'black'=>'#000000', 'blanchedalmond'=>'#FFEBCD', 'blue'=>'#0000FF', 'blueviolet'=>'#8A2BE2',
        'brown'=>'#A52A2A', 'burlywood'=>'#DEB887', 'cadetblue'=>'#5F9EA0', 'chartreuse'=>'#7FFF00', 'chocolate'=>'#D2691E', 'coral'=>'#FF7F50',
        'cornflowerblue'=>'#6495ED', 'cornsilk'=>'#FFF8DC', 'crimson'=>'#DC143C', 'cyan'=>'#00FFFF', 'darkblue'=>'#00008B', 'darkcyan'=>'#008B8B',
        'darkgoldenrod'=>'#B8860B', 'darkgray'=>'#A9A9A9', 'darkgreen'=>'#006400', 'darkkhaki'=>'#BDB76B', 'darkmagenta'=>'#8B008B',
        'darkolivegreen'=>'#556B2F', 'darkorange'=>'#FF8C00', 'darkorchid'=>'#9932CC', 'darkred'=>'#8B0000', 'darksalmon'=>'#E9967A',
        'darkseagreen'=>'#8DBC8F', 'darkslateblue'=>'#483D8B', 'darkslategray'=>'#2F4F4F', 'darkturquoise'=>'#00DED1', 'darkviolet'=>'#9400D3',
        'deeppink'=>'#FF1493', 'deepskyblue'=>'#00BFFF', 'dimgray'=>'#696969', 'dodgerblue'=>'#1E90FF', 'firebrick'=>'#B22222',
        'floralwhite'=>'#FFFAF0', 'forestgreen'=>'#228B22', 'fuchsia'=>'#FF00FF', 'gainsboro'=>'#DCDCDC', 'ghostwhite'=>'#F8F8FF',
        'gold'=>'#FFD700', 'goldenrod'=>'#DAA520', 'gray'=>'#808080', 'green'=>'#008000', 'greenyellow'=>'#ADFF2F', 'honeydew'=>'#F0FFF0',
        'hotpink'=>'#FF69B4', 'indianred'=>'#CD5C5C', 'indigo'=>'#4B0082', 'ivory'=>'#FFFFF0', 'khaki'=>'#F0E68C', 'lavender'=>'#E6E6FA',
        'lavenderblush'=>'#FFF0F5', 'lawngreen'=>'#7CFC00', 'lemonchiffon'=>'#FFFACD', 'lightblue'=>'#ADD8E6', 'lightcoral'=>'#F08080',
        'lightcyan'=>'#E0FFFF', 'lightgoldenrodyellow'=>'#FAFAD2', 'lightgreen'=>'#90EE90', 'lightgrey'=>'#D3D3D3', 'lightpink'=>'#FFB6C1',
        'lightsalmon'=>'#FFA07A', 'lightseagreen'=>'#20B2AA', 'lightskyblue'=>'#87CEFA', 'lightslategray'=>'#778899', 'lightsteelblue'=>'#B0C4DE',
        'lightyellow'=>'#FFFFE0', 'lime'=>'#00FF00', 'limegreen'=>'#32CD32', 'linen'=>'#FAF0E6', 'magenta'=>'#FF00FF', 'maroon'=>'#800000',
        'mediumaquamarine'=>'#66CDAA', 'mediumblue'=>'#0000CD', 'mediumorchid'=>'#BA55D3', 'mediumpurple'=>'#9370DB', 'mediumseagreen'=>'#3CB371',
        'mediumslateblue'=>'#7B68EE', 'mediumspringgreen'=>'#00FA9A', 'mediumturquoise'=>'#48D1CC', 'mediumvioletred'=>'#C71585',
        'midnightblue'=>'#191970', 'mintcream'=>'#F5FFFA', 'mistyrose'=>'#FFE4E1', 'moccasin'=>'#FFE4B5', 'navajowhite'=>'#FFDEAD',
        'navy'=>'#000080', 'oldlace'=>'#FDF5E6', 'olive'=>'#808000', 'orange'=>'#FFA500', 'orangered'=>'#FF4500', 'orchid'=>'#DA70D6',
        'palegoldenrod'=>'#EEE8AA', 'palegreen'=>'#98FB98', 'paleturquoise'=>'#AFEEEE', 'palevioletred'=>'#DB7093', 'papayawhip'=>'#FFEFD5',
        'peachpuff'=>'#FFDAB9', 'peru'=>'#CD853F', 'pink'=>'#FFC8CB', 'plum'=>'#DDA0DD', 'powderblue'=>'#B0E0E6', 'purple'=>'#800080',
        'red'=>'#FF0000', 'rosybrown'=>'#BC8F8F', 'royalblue'=>'#4169E1', 'saddlebrown'=>'#8B4513', 'salmon'=>'#FA8072', 'sandybrown'=>'#F4A460',
        'seagreen'=>'#2E8B57', 'seashell'=>'#FFF5EE', 'sienna'=>'#A0522D', 'silver'=>'#C0C0C0', 'skyblue'=>'#87CEEB', 'slateblue'=>'#6A5ACD',
        'snow'=>'#FFFAFA', 'springgreen'=>'#00FF7F', 'steelblue'=>'#4682B4', 'tan'=>'#D2B48C', 'teal'=>'#008080', 'thistle'=>'#D8BFD8',
        'tomato'=>'#FF6347', 'turquoise'=>'#40E0D0', 'violet'=>'#EE82EE', 'wheat'=>'#F5DEB3', 'white'=>'#FFFFFF', 'whitesmoke'=>'#F5F5F5',
        'yellow'=>'#FFFF00', 'yellowgreen'=>'#9ACD32');

    $c = strtolower($c);
    if(isset($colors[$c]))
        $c = $colors[$c];
    if($c[0]!='#')
        $this->Error('Incorrect color: '.$c);
    $r = hexdec(substr($c,1,2));
    $g = hexdec(substr($c,3,2));
    $b = hexdec(substr($c,5,2));
}

function SetDrawColor($r, $g=-1, $b=-1)
{
    if(is_string($r))
        $this->HTML2RGB($r,$r,$g,$b);
    parent::SetDrawColor($r,$g,$b);
}

function SetFillColor($r, $g=-1, $b=-1)
{
    if(is_string($r))
        $this->HTML2RGB($r,$r,$g,$b);
    parent::SetFillColor($r,$g,$b);
}

function SetTextColor($r, $g=-1, $b=-1)
{
    if(is_string($r))
        $this->HTML2RGB($r,$r,$g,$b);
    parent::SetTextColor($r,$g,$b);
}




function SetDash($black=null, $white=null)
    {
        if($black!==null)
            $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }
}
?>
