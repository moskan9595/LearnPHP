<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Changing Content in an XML File with the DOM Extension</title>
    <link rel="stylesheet" type="text/css" href="common.css" />
  </head>
  <body>
    <h1>Changing Content in an XML File with the DOM Extension</h1>
    <pre>

<?php

// Load the XML file
$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;
$doc->load( "./stock_list.xml" );
$doc->formatOutput = true;

// Get the stockList root element
$stockListElements = $doc->getElementsByTagName( "stockList" );
$stockList = $stockListElements->item(0);

// Get the "beetroot" item element
$itemElements = $doc->getElementsByTagName( "item" );
$beetroot = $itemElements->item(1);

// Change the element's "type" attribute
$beetroot->setAttribute( "type", "rootVegetable" );

// Change the unit price of beetroot
$children = $beetroot->childNodes;
for ( $i=0; $i<$children->length; $i++ ) {
  if ( $children->item($i)->tagName == "unitPrice" ) {
    $children->item($i)->firstChild->replaceData( 0, 10, "0.79" );
    break;
  }
}
  
// Output the XML document, encoding markup characters as needed
print htmlspecialchars( $doc->saveXML() );

?>
    </pre>
  </body>
</html>
