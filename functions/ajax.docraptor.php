<?php 

/*
 * Doc Raptor simple PHP example
 * requires pecl_http extension
 *
 * This is a simple example of creating an excel file and saving it
 * using Doc Raptor
 *
 * For other usage and examples, visit:
 * http://docraptor.com/examples
 *
 * Doc Raptor        http://docraptor.com
 * Expected Behavior http://www.expectedbehavior.com
 */


// Makes Wordpress functions work
require_once('/home/epi/epi.org/wp-blog-header.php');

// You must include a header, or the ajax request will result in a 404
header("HTTP/1.1 200 OK");

// Include the email class if we want to send an email notification (functionality not yet built)
include_once('/home/epi/epi.org/wp-content/themes/epi-boilerplate/functions/class-AttachmentEmail/class-AttachmentEmail.php');

// DocRaptor API key and URL
$api_key = "6SW81duqCdvAR5K3NgYZ";
$url = "https://docraptor.com/docs?user_credentials=$api_key";

// Put the POST data into manageable variables
$doc = $_POST['doc'];
$content = $doc['document_content'];

// Get the post object from Wordpress if possible
$id = $_POST['postID'];
$post_object = get_post( $id );

// If we have a Wordpress post, use its slug as the document name
if ( $id && $post_object ) {
	$post_slug = $post_object->post_name;
	$doc['name'] = $post_slug;
}

// whether to save the PDF to a custom field
$savepdf = $_POST['savepdf'] == 'true' ? true : false;



// All quotes were escaped for some reason—probably PHP magic quotes being on in the server settings.
// If we turn magic quotes off (which we should, as it's deprecated) we can probably remove stripslashes.
$content = stripslashes($content);

// Set defaults
$r['success'] = false;
$r['url'] = false;
$r['error'] = false;

// If there's no content, throw an error
if (!$content) {
	// throw new Exception('Content is empty.');
	$r['error'] = 'No content submitted.';
	
} else {

$request = new HTTPRequest($url, HTTP_METH_POST);
$request->setPostFields(array('doc[document_content]' => $content, 
                              'doc[document_type]'    => $doc['document_type'],
                              'doc[name]'             => $doc['name'],
                              'doc[test]'             => $doc['test'],
                              'doc[strict]'           => $doc['strict'],
                              'doc[javascript]'       => $doc['javascript']));
$request->send();


// FUTURE: This should grab from the year of publication
$path = $savepdf ? 'files/'.date('Y').'/' : 'files/pdftest/';
$loc['absolute'] = '/home/epi/epi.org/' . $path;
$loc['url'] = 'http://www.epi.org/' . $path;

// Set the filename and extension
$ext = '.' . $doc['document_type'];
$filename = $doc['name'];

// Check if a file already exists by that name
// $filename = !file_exists($loc['absolute'].$filename.$ext) ? $filename.$ext : $filename.date('.Y-m-d-His').$ext;

// If the file already exists, rename the original file to $filename.{date modified}.$ext
if (file_exists($loc['absolute'].$filename.$ext)) {
	if ( $savepdf ) { // formerly !$doc['test'] 
		$modified = date('.Y-m-d-H:i:s', filemtime($loc['absolute'].$filename.$ext));
		rename($loc['absolute'].$filename.$ext, $loc['absolute'].$filename.$modified.$ext);
	} else {
		$filename = $filename.date('.Y-m-d-H:i:s');
	}
}

// After renaming, we can use the original filename
$filename = $filename.$ext;


// Check if the response is a DocRaptor error

$response = $request->getResponseBody();

if ( strpos( $response , '<errors>') ) {

	// Find errors in the XML 
	// @todo this will only get one error, but there could be multiple errors -- in the future try preg_match_all?
	preg_match('/<error>(.*)<\/error>/i', $response, $matches);

	// Log the errors
	$r['error'] = $matches[1];

} else {

	// Create the file
	$file = fopen ( $loc['absolute'].$filename, "w");
	if (fwrite($file, $response))
		$r['success'] = true;
	fclose ($file);
}


// Send the user to the PDF
// header( 'Location: '. $loc['url'].$filename ) ;

}

$response = array(
	"success" => $r['success'],
	"url" => $loc['url'].$filename,
	"error" => $r['error']
);

echo json_encode($response);

