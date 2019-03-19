<?php

namespace stange\swampapp;

class Parser {

    const DOM_CONTENT_MAIN_ID = 'article';
    const DOM_CONTENT_CLASS = 'Theme-Layer-BodyText-Heading-xs h-align-center';

    private $contents;

    public function __construct(string $contents)
    {
        $this->contents = $contents;
    }

    public function parse() : array
    {
        $dom = new \DomDocument('1.0','utf8');
        \libxml_use_internal_errors(true);
        $dom->loadHTML($this->contents);
        \libxml_clear_errors();

        $article = $dom->getElementById(self::DOM_CONTENT_MAIN_ID);
        $sections = $article->getElementsByTagName('section');

        $questions = [];

        for($i=0; $i<$sections->length; $i++){
            $questions = array_merge($questions, $this->parseSection($sections->item($i)));
        }

        return $questions;
    }

    /**
     * Parse Question section
     *
     * @param \DomElement $section
     * @return array
     */
    private function parseSection(\DomElement $section) : array
    {
        $questions = [];

        $h4 = $section->getElementsByTagName('h4');

        for($i=0; $i < $h4->length; $i++){

            $element = $h4->item($i);

            for($z=0; $z<$element->childNodes->length; $z++) {
                /**
                 * @var \DomNode $prevNode
                 */
                $prevNode = $z > 0 ? $element->childNodes->item($z - 1) : null;
                /**
                 * @var \DomNode $node
                 */
                $node = $element->childNodes->item($z);

                if($node instanceof \DomText){
                    $currentQuestion[] = $node;
                }

                /**
                 * If it's a new question, parse the current accumulated question
                 */
                if (null !== $prevNode && ('br' === $node->nodeName && 'br' === $prevNode->nodeName) && count($currentQuestion) > 0) {
                    $questions[] = $this->parseQuestion($currentQuestion);
                    $currentQuestion = [];
                }
            }
        }

        return $questions;
    }

    /**
     * Parse question nodes
     *
     * @param array $nodes
     * @return array
     */
    private function parseQuestion(array $nodes){
        /**
         * @var \DomText $title
         */
        $title = array_shift($nodes);

        /**
         * @var \DomText $answer
         */
        $answer = array_pop($nodes);

        /**
         * @var string $answer
         */
        $content = '';

        foreach($nodes as $node){
            $content.=$node->textContent;
        }

        return [
            'title' => ucfirst(\mb_strtolower(trim($title->textContent))),
            'content' => ucfirst(\mb_strtolower(trim($content))),
            'answer' => ucfirst(\mb_strtolower(trim($answer->textContent))),
        ];
    }

}
