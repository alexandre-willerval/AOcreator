<?php
require_once 'vendor/phpoffice/phpword/bootstrap.php';

class Doc {
  protected $phpWord;
  
  public static function analyse($file) {
    $titleList = [];
    $variableList = [];
    $brick = \PhpOffice\PhpWord\IOFactory::load($file);
    $titleList = $brick->getTitles()->getItems();
    $brick = new \PhpOffice\PhpWord\TemplateProcessor($file);
    $variableList = $brick->getVariables();
    return Array($titleList, $variableList);
  }
  
  public function __construct($username) { 
    $this->phpWord = new \PhpOffice\PhpWord\PhpWord();
    $this->phpWord->setDefaultFontName("Helvetica 55 Roman");
    $this->phpWord->setDefaultFontSize(10);
    $properties = $this->phpWord->getDocInfo();
    $properties->setCreator($username);
    $properties->setCompany("Orange");
    $properties->setTitle("Mémoire technique");
    $properties->setDescription("Appel d'offre");
    $properties->setCategory("Mémoire technique");
    $properties->setLastModifiedBy($username);
    $properties->setCreated(time());
    $properties->setModified(time());
    //$properties->setSubject('My subject');
    //$properties->setKeywords('my, key, word');
  }
  
  public function get() {
    return $this->phpWord;
  }
  
  public function save($filename) {
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->phpWord, "Word2007");
    $objWriter->save("docs/".$filename);
  }
  
  public function output($filename) {
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->phpWord, "Word2007");
    $objWriter->save("php://output");
  }
  
  public function merge($source) {
    $brick = \PhpOffice\PhpWord\IOFactory::load($source);
    $brickSectionList = $brick->getSections();
    foreach($brickSectionList as $brickSection) {
      $section = $this->phpWord->addSection($brickSection->getStyle());
      $this->copy($section, $brickSection->getElements());
    }
  }
    
  protected function copy($container, $elementList) {
    $lastElement = null;
    foreach($elementList as $element) {
      switch(get_class($element)) {
        case "PhpOffice\PhpWord\Element\Text":
          $lastElement = $container->addText($element->getText(), $element->getFontStyle(), $element->getParagraphStyle());
          break;
        case "PhpOffice\PhpWord\Element\TextBreak":
          $lastElement = $container->addTextBreak(null, $element->getFontStyle(), $element->getParagraphStyle());
          break;
        case "PhpOffice\PhpWord\Element\TextRun":
          if(get_class($lastElement) != "PhpOffice\PhpWord\Element\TextRun" ||
             json_encode($element->getParagraphStyle()->getStyleValues()) != json_encode($lastElement->getParagraphStyle()->getStyleValues())) {
            $lastElement = $container->addTextRun($element->getParagraphStyle());
          }
          $this->copy($lastElement, $element->getElements());
          break;
        case "PhpOffice\PhpWord\Element\ListItem":
          $lastElement = $container->addListItem($element->getText(), $element->getDepth(), null, $element->getStyle(), null);
          break;
        default:
          $container->addText(get_class($element)." non géré");
      }
    }
  }
  
}
?>