<?php

namespace KeywordExtractor\Modifiers\Filters;

class StopWordFilter extends AbstractFilter
{
    private $stopWordList;

    public function modifyToken($token)
    {
        if (in_array($token, $this->getStopWordList()) === true) {
            return '';
        }

        return $token;
    }

    /**
     * @return array
     */
    public function getStopWordList(): array
    {
        if (!isset($this->stopWordList)) {
            $stopWordsPath = dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'stopwords-en.json';
            $content = json_decode(file_get_contents($stopWordsPath), true);

            if (empty($content)) {
                $content = [];
            }

            $this->setStopWordList($content);
        }

        return $this->stopWordList;
    }

    /**
     * @param mixed $stopWordList
     */
    public function setStopWordList(array $stopWordList): void
    {
        $this->stopWordList = $stopWordList;
    }
}
