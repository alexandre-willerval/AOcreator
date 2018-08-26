<?php
require_once 'vendor/phpoffice/phpword/bootstrap.php';

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$source = 'bricks/1.docx';
$phpWord2 = \PhpOffice\PhpWord\IOFactory::load($source);
/* Note: any element you append to a document must reside inside of a Section. */

// Adding an empty Section to the document...
$section = $phpWord->addSection(array('orientation' => 'landscape'));
// Adding Text element to the Section having font styled by default...
$section->addText(
    '"Learn from yesterday, live for today, hope for tomorrow. '
        . 'The important thing is not to stop questioning." '
        . '(Albert Einstein)'
);
//var_dump($phpWord2->getSections());
$sectionList = $phpWord2->getSections();
foreach($sectionList as $section2) {
  $section = $phpWord->addSection($section2->getStyle());
  $elementList = $section2->getElements();
  foreach($elementList as $element) {
    switch(get_class($element)) {
      case "PhpOffice\PhpWord\Element\Text":
        $section->addText($element->getText(), $element->getFontStyle(), $element->getParagraphStyle());
        break;
      default:
        echo "non géré";
    }
  }
  //
}
/*
 * Note: it's possible to customize font style of the Text element you add in three ways:
 * - inline;
 * - using named font style (new font style object will be implicitly created);
 * - using explicitly created font style object.
 */
/*
// Adding Text element with font customized inline...
$section->addText(
    '"Great achievement is usually born of great sacrifice, '
        . 'and is never the result of selfishness." '
        . '(Napoleon Hill)',
    array('name' => 'Tahoma', 'size' => 10)
);

// Adding Text element with font customized using named font style...
$fontStyleName = 'oneUserDefinedStyle';
$phpWord->addFontStyle(
    $fontStyleName,
    array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
);
$section->addText(
    '"The greatest accomplishment is not in never falling, '
        . 'but in rising again after you fall." '
        . '(Vince Lombardi)',
    $fontStyleName
);

// Adding Text element with font customized using explicitly created font style object...
$fontStyle = new \PhpOffice\PhpWord\Style\Font();
$fontStyle->setBold(true);
$fontStyle->setName('Tahoma');
$fontStyle->setSize(13);
$myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
$myTextElement->setFontStyle($fontStyle);
*/
// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('docs/helloWorld.docx');

echo "ok";

?>
