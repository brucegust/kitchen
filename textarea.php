<?php // demo/temp_brucegust.php
/**
 * http://www.experts-exchange.com/questions/28933347/Displaying-HTML-code-in-textarea-How.html
 *
 * References:
 * http://php.net/manual/en/faq.html.php (See #2)
 * http://php.net/manual/en/function.htmlspecialchars.php
 * http://php.net/manual/en/function.htmlspecialchars.php#112476 (Note on UTF-8)
 * http://php.net/manual/en/function.htmlspecialchars-decode.php
 */
error_reporting(E_ALL);

// SIMULATE THE TEST DATA
$row['metatags'] = <<<EOD
<META NAME="DESCRIPTION" CONTENT="RTA Kitchen Cabinets Online, Wholesale Kitchen Cabinets, Buy RTA Cabinets Online, Maple RTA Cabinets"> <META NAME="ABSTRACT" CONTENT="RTA Cabinets, Maple Cabinets, Wholesale Cabinets, Buy Cabinets Online"> <META NAME="KEYWORDS" CONTENT="RTA Cabinet,RTA Kitchen Cabinets, Maple Cabinets, Kitchen Cabinets, buy kitchen cabinets, buy cabinets online, cabinets, rta cabinets, cabinet maker">
EOD;

// SIMULATE THE HTML TEXTAREA(S)
?>
<h2>Clear Text</h2>
<textarea name="metatags"><?php echo $row['metatags']; ?></textarea>

<h2>Using htmlspecialchars()</h2>
<textarea name="metatags"><?php echo htmlspecialchars($row['metatags']); ?></textarea>

<h2>Using htmlspecialchars_decode()</h2>
<textarea name="metatags"><?php echo htmlspecialchars_decode($row['metatags']); ?></textarea>

                                          