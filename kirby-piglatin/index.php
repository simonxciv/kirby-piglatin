<?php

class PigLatin {
	public static function translate(string $string) {
		// Replace new lines with new lines + space, to ensure the explode works
		$string = str_replace(array("\n\r", "\n", "\r"), PHP_EOL . ' ', $string);

		// Explode the string into an array
		$words = explode(" ", $string);

		// Pass the array to the translateWord function, and return the results imploded
		return implode(" ", array_map("PigLatin::translateWord", $words));
	}
	public static function translateWord(string $word)
	{
		// If a new line character exists in the word
		if(strstr($word, PHP_EOL)) {

			// Remove the new line
			$word = str_replace(PHP_EOL, "", $word);

			// Set $eol to true
			$eol = true;
		}

		// Define a list of vowels
		$vowels = ["a", "e", "i", "o", "u", "yt", "xr"];

		// Define weird pig latin exceptions
		$oddities = ["ch", "qu", "squ", "thr", "th", "sch"];

		// Define a list of consonants
		$consonants = ["b", "c", "d", "f", "g", "h", "j", "k", "l", "m", "n", "p", "q", "r", "s", "t", "v", "w", "x", "y", "z"];

		// A short list of some punctuation marks that words may end with. This is pretty messy, admittedly.
		$closingPunctuation = [".", "!", ",", "?"];

		// Okay, so now we need to get the first letter of the word
		$originalFirstLetter = substr($word, 0, 1);

		// Convert the first letter to lowercase, to compare against the above arrays
		$wordFirstLetter = strtolower($originalFirstLetter);

		// Define (and convert to lower) the first two letters of the word
		$wordFirstTwoLetters = strtolower(substr($word, 0, 2));

		// Define (and convert to lower) the first three letters of the word. This is getting hacky and gross.
		$wordFirstThreeLetters = strtolower(substr($word, 0, 3));

		// If the word begins with a vowel (one or two chars)
		if(in_array($wordFirstLetter,$vowels, TRUE) || in_array($wordFirstTwoLetters,$vowels, TRUE)) {

			// Simply add the 'ay' to the end and call it a day
			$result = $word . "ay";
		}

		// If the word begins with a 1 letter oddity or a consonant
		elseif(in_array($wordFirstLetter,$oddities, TRUE) || in_array($wordFirstLetter,$consonants, TRUE)) {

			// Take the first letter, stick it to the end, and prepend with 'ay'
			$result = substr($word, 1) . substr($word, 0, 1) . "ay";
		}

		// If the word begins with a 2 letter oddity
		elseif(in_array($wordFirstTwoLetters,$oddities, TRUE)) {

			// Take the first two letters, stick them to the end, and prepend with 'ay'
			$result = substr($word, 2) . substr($word, 0, 2) . "ay";
		}

		// If the word begins with a 3 letter oddity
		elseif(in_array($wordFirstThreeLetters,$oddities, TRUE)) {

			// Take the first three letters, stick them to the end, and prepend with 'ay'
			$result = substr($word, 3) . substr($word, 0, 3) . "ay";
		}

		// Otherwise, return the blank word just in case none of the above worked.
		else {

			// Fallback for when the if/elses above fail
			$result = $word;
		}

		// If the first letter is actually uppercase
		if($originalFirstLetter === strtoupper($originalFirstLetter)) {

			// Make the first letter of the result uppercase, force the rest into lowercase. Hacky, I know.
			$result = strtoupper(substr($result, 0, 1)) . strtolower(substr($result, 1));
		}

		// This is where things get ugly. Foreach of the punctuation marks in the array:
		foreach($closingPunctuation as $punct) {

			// If the result string contains the current punctuation mark
			if(strstr($result, $punct)) {

				// Remove the punctuation mark, and add it to the end. *throwing up noises*.
				// If you have any better ideas, please for the love of all that's good and pure in the world, tell me.
				$result = str_replace($punct,"",$result) . $punct;
			}
		}

		// If the $eol var is set
		if(isset($eol)) {

			// Add a new line to the end of the result string
			$result = $result . PHP_EOL;
		}

		// Return the result string
		return $result;
	}
}

Kirby::plugin('simonxciv/kirby-pigtext', [
	'fieldMethods' => [
		'toPiglatin' => function ($field) {
			$field->value = PigLatin::translate($field->value);
			return $field;
		}
	]
]);