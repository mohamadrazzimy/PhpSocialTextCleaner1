In the age of social media, vast amounts of text data are generated daily. Analyzing this data can provide valuable insights into public sentiment, trends, and user behavior. However, social media text often comes laden with noise that can complicate analysis. For developers, especially PHP enthusiasts, tackling this mess and extracting meaningful content is a rewarding challenge. In this tutorial, we will explore effective methods for cleaning social media text using PHP, a scripting language commonly used for web development.

Why Social Media Text Cleaning Matters
In the real world, raw text data is rarely clean. URLs, mentions (@user), hashtags (#Trending), and emoticons like :-) or emojis like 😊 are common. While these elements enhance online conversations, they complicate analysis. Social media text cleaning helps us:

Improve the readability of data.
Prepare text for machine learning or natural language processing (NLP) tasks.
Focus on the actual content rather than distracting noise.
[1] Create a PHP Project
Create a PHP project in Replit using the “PHP CLI” template. Give a suitable name to the project e.g. PHPSocialTextCleaner1

Refer the following short notes for detailed steps:

How to create PHP CLI project on Replit platform?
To create a PHP CLI project on Replit, follow these steps: Visit the Replit website at https://replit.com/ and log in…
shortnotes.razzi.my

[2] Create JSON data file
You may need some data files for your project. In this tutorial, I created JSON data files containing mappings of emoticons to emojis based on JoyPixels ASCII smiley conversation data.

JoyPixels Labs
It's turned off by default, but by flipping one simple switch you can enable ASCII smiley conversion. Type some ASCII…
demos.joypixels.com

Save the file as dict_joypixels_emoticon_emoji.json .

{
    "<3": "\u2764",
    "</3": "\ud83d\udc94",
    ":')": "\ud83d\ude02",
    ":'-)": "\ud83d\ude02",
    ":D": "\ud83d\ude03",
    ":-D": "\ud83d\ude03",
    "=D": "\ud83d\ude03",
    ":)": "\ud83d\ude42",
    ":-)": "\ud83d\ude42",
    "=]": "\ud83d\ude42",
    "=)": "\ud83d\ude42",
    ":]": "\ud83d\ude42",
    "':)": "\ud83d\ude05",
    "':-)": "\ud83d\ude05",
    "'=)": "\ud83d\ude05",
    "':D": "\ud83d\ude05",
    "':-D": "\ud83d\ude05",
    "'=D": "\ud83d\ude05",
    ">:)": "\ud83d\ude06",
    ">;)": "\ud83d\ude06",
    ">:-)": "\ud83d\ude06",
    ">=)": "\ud83d\ude06",
    ";)": "\ud83d\ude09",
    ";-)": "\ud83d\ude09",
    "*-)": "\ud83d\ude09",
    "*)": "\ud83d\ude09",
    ";-]": "\ud83d\ude09",
    ";]": "\ud83d\ude09",
    ";D": "\ud83d\ude09",
    ";^)": "\ud83d\ude09",
    "':(": "\ud83d\ude13",
    "':-(": "\ud83d\ude13",
    "'=(": "\ud83d\ude13",
    ":*": "\ud83d\ude18",
    ":-*": "\ud83d\ude18",
    "=*": "\ud83d\ude18",
    ":^*": "\ud83d\ude18",
    ">:P": "\ud83d\ude1c",
    "X-P": "\ud83d\ude1c",
    "x-p": "\ud83d\ude1c",
    ">:[": "\ud83d\ude1e",
    ":-(": "\ud83d\ude1e",
    ":(": "\ud83d\ude1e",
    ":-[": "\ud83d\ude1e",
    ":[": "\ud83d\ude1e",
    "=(": "\ud83d\ude1e",
    ">:(": "\ud83d\ude20",
    ">:-(": "\ud83d\ude20",
    ":@": "\ud83d\ude20",
    ":'(": "\ud83d\ude22",
    ":'-(": "\ud83d\ude22",
    ";(": "\ud83d\ude22",
    ";-(": "\ud83d\ude22",
    ">.<": "\ud83d\ude23",
    "D:": "\ud83d\ude28",
    ":$": "\ud83d\ude33",
    "=$": "\ud83d\ude33",
    "#-)": "\ud83d\ude35",
    "#)": "\ud83d\ude35",
    "%-)": "\ud83d\ude35",
    "%)": "\ud83d\ude35",
    "X)": "\ud83d\ude35",
    "X-)": "\ud83d\ude35",
    "*\\0/*": "\ud83d\ude46",
    "\\0/": "\ud83d\ude46",
    "*\\O/*": "\ud83d\ude46",
    "\\O/": "\ud83d\ude46",
    "O:-)": "\ud83d\ude07",
    "0:-3": "\ud83d\ude07",
    "0:3": "\ud83d\ude07",
    "0:-)": "\ud83d\ude07",
    "0:)": "\ud83d\ude07",
    "0;^)": "\ud83d\ude07",
    "O:)": "\ud83d\ude07",
    "O;-)": "\ud83d\ude07",
    "O=)": "\ud83d\ude07",
    "0;-)": "\ud83d\ude07",
    "O:-3": "\ud83d\ude07",
    "O:3": "\ud83d\ude07",
    "B-)": "\ud83d\ude0e",
    "B)": "\ud83d\ude0e",
    "8)": "\ud83d\ude0e",
    "8-)": "\ud83d\ude0e",
    "B-D": "\ud83d\ude0e",
    "8-D": "\ud83d\ude0e",
    "-_-": "\ud83d\ude11",
    "-__-": "\ud83d\ude11",
    "-___-": "\ud83d\ude11",
    ">:\\": "\ud83d\ude15",
    ">:/": "\ud83d\ude15",
    ":-/": "\ud83d\ude15",
    ":-.": "\ud83d\ude15",
    ":/": "\ud83d\ude15",
    ":\\": "\ud83d\ude15",
    "=/": "\ud83d\ude15",
    "=\\": "\ud83d\ude15",
    ":L": "\ud83d\ude15",
    "=L": "\ud83d\ude15",
    ":P": "\ud83d\ude1b",
    ":-P": "\ud83d\ude1b",
    "=P": "\ud83d\ude1b",
    ":-p": "\ud83d\ude1b",
    ":p": "\ud83d\ude1b",
    "=p": "\ud83d\ude1b",
    ":-\u00de": "\ud83d\ude1b",
    ":\u00de": "\ud83d\ude1b",
    ":\u00fe": "\ud83d\ude1b",
    ":-\u00fe": "\ud83d\ude1b",
    ":-b": "\ud83d\ude1b",
    ":b": "\ud83d\ude1b",
    "d:": "\ud83d\ude1b",
    ":-O": "\ud83d\ude2e",
    ":O": "\ud83d\ude2e",
    ":-o": "\ud83d\ude2e",
    ":o": "\ud83d\ude2e",
    "O_O": "\ud83d\ude2e",
    ">:O": "\ud83d\ude2e",
    ":-X": "\ud83d\ude36",
    ":X": "\ud83d\ude36",
    ":-#": "\ud83d\ude36",
    ":#": "\ud83d\ude36",
    "=X": "\ud83d\ude36",
    "=x": "\ud83d\ude36",
    ":x": "\ud83d\ude36",
    ":-x": "\ud83d\ude36",
    "=#": "\ud83d\ude36"
}
Later, our PHP code will convert emoticons to emojis to standardize the text data.

[3] Create PHP Script file
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
Code description:
The provided PHP code defines a class, SocialTextCleaner, which is designed to preprocess and clean social media text data. The constructor initializes the class by loading a JSON file containing emoticon-to-emoji mappings into a dictionary. The cleanSocialText method processes the input text by converting it to lowercase, removing URLs, user mentions, and hashtags (while preserving the words), and optionally mapping emoticons to their corresponding emojis using the loaded dictionary. It also strips HTML tags and normalizes whitespace.

To ensure that the findEmoji method captures all emojis from the input text, it uses the preg_match_all function with a comprehensive regex pattern covering various emoji ranges. The method returns a unique array of found emojis using array_unique() to eliminate duplicates. When outputting the results, the code checks if any emojis were found and displays them as a comma-separated string using implode(). If no emojis are detected, it provides a user-friendly message indicating that none were found. To troubleshoot, it's advisable to confirm that the input text contains multiple emojis and to print the raw matches for verification.

[4] Run
Run the script via shell command.

Pass a text string as an argument e.g.

Hello world! Visit <a href='http://example.com'>example.com</a>
Hello world! :-( ;-) 😊 Visit <a href='http://example.com'>example.com</a>
Output:

~/PhpSocialTextCleaner1$ php social_text_cleaner.php "Hello world! Visit <a href='http://example.com'>example.com</a>"
Original Text: Hello world! Visit <a href='http://example.com'>example.com</a>
Cleaned Text: hello world! visit
No emojis found.
~/PhpSocialTextCleaner1$ php social_text_cleaner.php "Hello world! :-( ;-) 😊 Visit <a href='http://example.com'>example.com</a>"
Original Text: Hello world! :-( ;-) 😊 Visit <a href='http://example.com'>example.com</a>
Cleaned Text: hello world! 😞 😉 😊 visit
Found Emojis: 😞, 😉, 😊
Conclusion:
Cleaning social media text using PHP is an essential process for enhancing data quality and ensuring effective analysis in web application projects. By implementing methods to remove noise such as URLs, user mentions, and irrelevant characters, and by mapping emoticons to their corresponding emojis, we can standardize text data for various applications like sentiment analysis and trend identification. The ability to extract and process emojis further enriches the data, providing deeper insights into user sentiment and engagement.

🤓

https://blog.devgenius.io/cleaning-social-media-text-with-php-a-practical-approach-e8fae6d4caab
