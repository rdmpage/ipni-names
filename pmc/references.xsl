<?xml version='1.0' encoding='utf-8'?>
<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:mml="http://www.w3.org/1998/Math/MathML" xmlns:tp="http://www.plazi.org/taxpub"
>


<!-- references -->
<xsl:template match="ref-list">
	<ol>
		<xsl:apply-templates select="ref"/>
	</ol>
</xsl:template>

<!-- Reference list -->
<xsl:template match="ref">
	<li>
		<a>
			<xsl:attribute name="name">
				<xsl:value-of select="@id" />
			</xsl:attribute>
		</a>
		
		<xsl:apply-templates select="mixed-citation"/>
		
		<!-- Hindawi -->
		<xsl:apply-templates select="nlm-citation"/>            
		
		<!-- Biodiversity Data Journal -->
		<xsl:apply-templates select="element-citation"/>
	</li>
</xsl:template>

<!-- authors -->
<xsl:template match="//person-group">
	<xsl:apply-templates select="name"/>
</xsl:template>

<xsl:template match="name">
	<xsl:if test="position() != 1"><xsl:text>, </xsl:text></xsl:if>
	<xsl:value-of select="surname" />
	<xsl:text>, </xsl:text>
	<xsl:value-of select="given-names" />
</xsl:template>

<!-- a citation -->
<xsl:template match="mixed-citation | element-citation | nlm-citation">
	<xsl:choose>
		<xsl:when test="person-group">
			<xsl:apply-templates select="person-group"/>
		</xsl:when>
		<xsl:otherwise>
			<xsl:apply-templates select="name"/>
		</xsl:otherwise>
	</xsl:choose>
	
	<xsl:text> (</xsl:text><xsl:value-of select="year" /><xsl:text>) </xsl:text>

	<xsl:choose>
		<xsl:when test="article-title and source and volume">
			<xsl:value-of select="article-title" />
			<xsl:text>. </xsl:text>							
			<xsl:value-of select="source" />
			<xsl:text> </xsl:text>
			<xsl:value-of select="volume" />
			<xsl:text>:</xsl:text>
			<xsl:value-of select="fpage" />
			<xsl:text>-</xsl:text>
			<xsl:value-of select="lpage" />
		</xsl:when>
	</xsl:choose>
	
	<!-- links -->
	<xsl:for-each select="uri">
		<xsl:choose>
			<xsl:when test="@xlink:type='simple'">
				<span style="background-color:blue;color:white;">
					<xsl:value-of select="." />
				</span>
			</xsl:when>
			<xsl:otherwise>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:for-each>

	<!-- identifiers -->
	<xsl:for-each select="ext-link">
		<xsl:choose>
			<xsl:when test="@ext-link-type='uri'">
				<span style="background-color:blue;color:white;">
					<xsl:value-of select="." />
				</span>
			</xsl:when>
			<xsl:when test="@ext-link-type='doi'">
				<span style="background-color:blue;color:white;">
					<xsl:text> DOI:</xsl:text>
					<xsl:value-of select="." />
				</span>
			</xsl:when>
			
			<xsl:otherwise>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:for-each>

	<xsl:for-each select="pub-id">
		<xsl:choose>
			<xsl:when test="@pub-id-type='pmid'">
				<span style="background-color:blue;color:white;">
					<xsl:text> PMID:</xsl:text>
					<xsl:value-of select="." />
				</span>
			</xsl:when>
			<xsl:when test="@pub-id-type='doi'">
				<span style="background-color:blue;color:white;">
					<xsl:text> DOI:</xsl:text>
					<xsl:value-of select="." />
				</span>
			</xsl:when>
			
			<xsl:otherwise>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:for-each>
			
</xsl:template>

</xsl:stylesheet>