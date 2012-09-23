<?php 


// 
// 
// function getDirectoryList ($directory) 
// {
// 
//   // create an array to hold directory list
//   $results = array();
// 
//   // create a handler for the directory
//   $handler = opendir($directory);
// 
//   // open directory and walk through the filenames
//   while ($file = readdir($handler)) {
// 
//     // if file isn't this directory or its parent, add it to the results
//     if ($file != "." && $file != "..") {
//       $results[] = $file;
//     }
// 
//   }
// 
//   // tidy up: close the handler
//   closedir($handler);
// 
//   // done!
//   return $results;
// 
// }
// 
// getDirectoryList('/home/epi/stateofworkingamerica.org/123/');


$dir = '/home/epi/stateofworkingamerica.org/cache/';

foreach(glob($dir.'*.spc*') as $file) {
	rename ( $file, $file.'.'.date("Y-m-j").'.old' );
}

// 
// if ($handle = opendir($dir)) {
// 
//     /* This is the correct way to loop over the directory. */
//     while ( ($file = readdir($handle)) !== false ) {
//         // echo "$entry <br/>";
// 		// if ( strpos( $file, '.' ) === 0 || strrpos( $file, '.spc', -4 ) === false ) {
// 		if ( strlen($file) < 4 || strrpos( $file, '.spc', -5 ) !== false ) {
// 			echo "Did not rename \"$file\" <br>";
// 			continue;
// 		} else {
// 			// $success = rename( $dir.$file, $dir.$file.'.old.'.date("Y-m-j") );
// 			$success = rename( $dir.$file, $dir.$file.'.old' );
// 			if ($success) echo "Renamed \"$file\" <br>";
// 		}
//     }
// 
//     closedir($handle);
// }
// 
// 
// $str = 'myfile.ext';
// 
// $strrpos = strrpos($str, '.ext', -1);
// 
// echo $strrpos;
// 





// 
// function my_emptySimplePieCache() {
// 	// check if this is an economic indicators page
// 	// $id = get_the_id();
// 	// if (is_page($id)) {
// 		
// 		// path to SimplePie cache
// 		$folder = '/home/epi/stateofworkingamerica.org/cache/';
// 		$handle = opendir($folder);
// 		
// 			
// 			
// 		if ( $handle ) {
// 			while ( $file = readdir($handle) !== false ) {
// 				rename( $file, $file . 'old' );
// 			}
// 		}
// 		
// 		return;	
// 			// 
// 			// } else {
// 			// 	return;
// 			// }
// 			// 
// 	// delete files in cache folder ending in .spc
// 			
// }
// 
// 
// my_emptySimplePieCache();
// 
// 
