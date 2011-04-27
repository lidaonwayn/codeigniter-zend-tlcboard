<?php 
/**
* Output Filter for indent HTML code after sending it to the end user.
*
* @param string $output, the HTML code without proper indentation
* @return string, the HTML code with proper indentation
*/
function smarty_outputfilter_indent_html($output, &$smarty)
 {

     $config = array(
           'indent'         => true,
           'output-xhtml'   => true,
           'wrap'           => 200,
           'drop-proprietary-attributes'    =>    false,
           'indent-cdata' => true,
           'indent-spaces' => 4,
    );

    try {

        // Use tidy library to make up the HTML code
        $tidy = new tidy;
        $tidy->parseString($output, $config, 'utf8');
        $tidy->cleanRepair();

    } catch (Exception $e) {
        // If something went wrong just output the original HTML code
        $tidy = $output;
    }

    // Output the HTML code
    return $tidy;

 }
?>