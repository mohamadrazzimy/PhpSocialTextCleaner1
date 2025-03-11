<?php

class SocialTextCleaner
{
    private $emojiCharDict = [];

    /**
     * Constructor to load the JSON files into dictionaries
     */
    public function __construct($emojiCharJsonPath)
    {

        if (file_exists($emojiCharJsonPath)) {
            $this->emojiCharDict = json_decode(file_get_contents($emojiCharJsonPath), true);
        } else {
            echo "Error: Emoji Char JSON file not found.\n";
        }
    }

    /**
     * Clean social text by removing noise and mapping emojis
     */
    public function cleanSocialText($text, $mapEmoticon = false)
    {
        // Convert text to lowercase
        $text = strtolower($text);

        // Remove URLs
        $text = preg_replace('/https?:\/\/\S+/', '', $text);

        // Remove user mentions
        $text = preg_replace('/@\w+/', '', $text);

        // Remove hashtags but keep the words
        $text = preg_replace('/#(\w+)/', '$1', $text);

        // Map emoticons to text if enabled
        if ($mapEmoticon) {
            $text = $this->mapEmoticons($text);
        }

        // Remove HTML tags
        $text = strip_tags($text);

        // Remove extra spaces
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);

        return $text;
    }

    /**
     * Map emoticons in text to their descriptive names using the emoji dictionary
     */
    private function mapEmoticons($text)
    {
        if (empty($this->emojiCharDict)) {
            return $text; // Skip mapping if dictionary is empty
        }

        return str_replace(array_keys($this->emojiCharDict), array_values($this->emojiCharDict), $text);
    }

    /**
     * Extract emojis from text
     */
    public function findEmoji($text)
    {
        $emojiPattern = '/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F700}-\x{1F77F}\x{2600}-\x{26FF}]/u';
        preg_match_all($emojiPattern, $text, $matches);

        // Return all found emojis as a unique array
        return array_unique($matches[0] ?? []);
    }
}

// Main script
$emojiCharJsonPath = 'dict_joypixels_emoticon_emoji.json';
$socialTextCleaner = new SocialTextCleaner($emojiCharJsonPath);

// Get input text from command line arguments
$inputText = $argv[1] ?? "RT @user: Hello world! :-( ;-) 😊 Visit <a href='http://example.com'>example.com</a>";
$cleanedText = $socialTextCleaner->cleanSocialText($inputText, true);
$foundEmojis = $socialTextCleaner->findEmoji($cleanedText);

// Output results
echo "Original Text: $inputText\n";
echo "Cleaned Text: $cleanedText\n";
if (!empty($foundEmojis)) {
    echo "Found Emojis: " . implode(", ", $foundEmojis) . "\n";
} else {
    echo "No emojis found.\n";
}
?>
