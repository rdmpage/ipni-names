<?xml version='1.0' encoding='utf-8'?>
<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<xsl:output method='html' version='1.0' encoding='utf-8' indent='yes' />

<xsl:param name="imageUrl" />
<xsl:param name="widthpx" />
<xsl:param name="term" />

<xsl:variable name="scale" select="$widthpx div //OBJECT/@width" />


<xsl:template match="/">

	<!--
    <html>
    <head>
	<meta charset="utf-8" />
	<script src="js/jquery-1.4.4.min.js"></script>
	</head>
	<body>
	-->

	<xsl:apply-templates select="//OBJECT" />
	
    <script>
    
    var hits=['<xsl:value-of select="$term" />'];
    
    for (var i in hits) {
    	var text = hits[i].toLowerCase();
    	
    	var parts = text.match(/(\w+) (\w+)/);
    	if (parts) {
    		$('div[data-one-word="' + parts[1] + '"]').css("background-color","rgba(0,0,255,0.2)");
    	    $('div[data-two-words="' + (parts[1] + parts[2]) + '"]').css("background-color","rgba(0,0,255,0.2)");
    	    
    	    // Handle genus abbreviation
    	    var abbreviated = parts[1].charAt(0) + '.' + parts[2];
    	    $('div[data-one-word="' + parts[1].charAt(0) + '.' + '"]').css("background-color","rgba(0,0,255,0.2)");
    	    $('div[data-two-words="' + abbreviated + '"]').css("background-color","rgba(0,0,255,0.2)");

    	} else {
    		$('div[data-one-word="' + text + '"]').css("background-color","rgba(0,128,255,0.2)");
    	}
    }

	</script>
	
	<!--
	</body>
	</html>
	-->
</xsl:template>

<xsl:template match="//OBJECT">
	<div>

	<xsl:attribute name="id">
		<xsl:text>page</xsl:text>
	</xsl:attribute>



	<xsl:attribute name="style">
		<xsl:text>position:relative;</xsl:text>
		<xsl:text>border:1px solid rgb(228,228,228);</xsl:text>
		<xsl:variable name="height" select="@height" />
		<xsl:variable name="width" select="@width" />
		<xsl:text>width:</xsl:text><xsl:value-of select="$width * $scale" /><xsl:text>px;</xsl:text>
		<xsl:text>height:</xsl:text><xsl:value-of select="$height * $scale" /><xsl:text>px;</xsl:text>
	</xsl:attribute>


	<xsl:comment>Scanned image</xsl:comment>
<img>
	<xsl:attribute name="src">
		<xsl:value-of select="$imageUrl" />
	</xsl:attribute> 
	<xsl:attribute name="style">
		<xsl:variable name="height" select="@height" />
		<xsl:variable name="width" select="@width" />
		<xsl:text>margin:0px;padding:0px;</xsl:text>
		<xsl:text>width:</xsl:text><xsl:value-of select="$width * $scale" /><xsl:text>px;</xsl:text>
		<xsl:text>height:</xsl:text><xsl:value-of select="$height * $scale" /><xsl:text>px;</xsl:text>
	</xsl:attribute>
</img>

		<xsl:apply-templates select="//WORD" />

		<xsl:apply-templates select="//AREA" />

	
	</div>
</xsl:template>

<xsl:template match="//WORD">
	<div>
	<xsl:attribute name="id">
		<xsl:value-of select="position()"/>
	</xsl:attribute>


	<xsl:attribute name="style">
		<xsl:text>position:absolute;</xsl:text>
		<!-- <xsl:text>border:1px solid rgb(128,128,128);</xsl:text> -->
		<xsl:variable name="coords" select="@coords" />
		<xsl:variable name="minx" select="substring-before($coords,',')" />
		<xsl:variable name="afterminx" select="substring-after($coords,',')" />
		<xsl:variable name="maxy" select="substring-before($afterminx,',')" />
		<xsl:variable name="aftermaxy" select="substring-after($afterminx,',')" />
		<xsl:variable name="maxx" select="substring-before($aftermaxy,',')" />
		<xsl:variable name="aftermaxx" select="substring-after($aftermaxy,',')" />
		<xsl:variable name="miny" select="substring-after($aftermaxy,',')" />
		
		<!-- some DjVu files have five coordinates, some have four (sigh) -->
		<xsl:choose>
			<xsl:when test="contains($miny,',')">
				<!-- five numbers in coords -->
				<xsl:variable name="miny2" select="substring-before($miny,',')" />
				<xsl:text>top:</xsl:text><xsl:value-of select="$miny2 * $scale" /><xsl:text>px;</xsl:text>
				<xsl:text>height:</xsl:text><xsl:value-of select="($maxy - $miny2) * $scale" /><xsl:text>px;</xsl:text>				
			</xsl:when>
			<xsl:otherwise>
				<!-- four -->
				<xsl:text>top:</xsl:text><xsl:value-of select="$miny * $scale" /><xsl:text>px;</xsl:text>
				<xsl:text>height:</xsl:text><xsl:value-of select="($maxy - $miny) * $scale" /><xsl:text>px;</xsl:text>
			</xsl:otherwise>
		</xsl:choose>
		
		<xsl:text>left:</xsl:text><xsl:value-of select="$minx * $scale" /><xsl:text>px;</xsl:text>
		<xsl:text>width:</xsl:text><xsl:value-of select="($maxx - $minx) * $scale" /><xsl:text>px;</xsl:text>
		<!--
		<xsl:text>top:</xsl:text><xsl:value-of select="$miny * $scale" /><xsl:text>px;</xsl:text>
		<xsl:text>height:</xsl:text><xsl:value-of select="($maxy - $miny) * $scale" /><xsl:text>px;</xsl:text> -->
	</xsl:attribute>
	
	
	
	<xsl:attribute name="data-one-word">
		<xsl:value-of select="translate(.,'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz')" />
	</xsl:attribute>
	
	<xsl:if test="preceding-sibling::*[1]">
		<xsl:attribute name="data-two-words">
			<xsl:value-of select="translate(concat(preceding-sibling::*[1],.), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz')" />
		</xsl:attribute>
	</xsl:if>

	</div>
</xsl:template>


</xsl:stylesheet>