<?php

namespace potrans\translator;

use Gettext\Translation;
use Stichoza\GoogleTranslate\GoogleTranslate;

class FreeGoogleTranslator extends TranslatorAbstract
{
	private GoogleTranslate $translate;

	public function __construct(
		?GoogleTranslate $translate = null,
	) {
		$this->translate = $translate ?? new GoogleTranslate();
	}

	/**
	 * @param Translation $sentence
	 * @throws LargeTextException If the translation text is too large
	 * @throws RateLimitException If Google has blocked you for excessive requests
	 * @throws TranslationRequestException If any other HTTP-related error occurs
	 * @throws TranslationDecodingException If response JSON cannot be decoded
	 * @return string
	 */
	public function getTranslation(Translation $sentence): string
	{
		$this->translate->setSource($this->from);
		$this->translate->setTarget($this->to);

		return $this->translate->translate($sentence->getOriginal()) ?? "";
	}
}
