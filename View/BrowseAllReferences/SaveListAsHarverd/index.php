<?php
/**
 * User: Marcin
 * Date: 03/12/2012
 * Time: 12:56
 * File name: index.php
 */

session_start();

header('Content-type: text/plain');
header('Content-disposition: attachment; filename="referencesHarvardList.txt"');


/*Creating textual representation of book references*/
$bModel = new ModelBook();
foreach ($bModel->getAllIds() as $key => $value) {
    foreach ($bModel->returnArrayOfBookElementsAsHarvardList($value) as $key2 => $value2) {
        echo strip_tags($value2);
    }
    echo "\n";
}
echo "\n";


/*Creating textual representation of journal references*/
$jjModel = new ModelJournal();
foreach ($jjModel->getAllIds() as $key3 => $value3) {
    foreach ($jjModel->returnArrayOfJournalElementsAsHarvardList($value3) as $key4 => $value4) {
        echo strip_tags($value4);
    }
    echo "\n";
}
echo "\n";


/*Creating textual representation of newspaper references*/
$nModel = new ModelNewspaper();

foreach ($nModel->getAllIds() as $key5 => $value5) {
    foreach ($nModel->returnArrayOfNewspaperElementsAsHarvardList($value5) as $key6 => $value6) {
        echo strip_tags($value6);
    }

    echo "\n";

}
echo "\n";

/*Creating textual representation of websites references*/
$wModel = new ModelWebsite();

foreach ($wModel->getAllIds() as $key5 => $value5) {
    foreach ($wModel->returnArrayOfWebsiteElementsAsHarvardList($value5) as $key6 => $value6) {
        echo strip_tags($value6);
    }

    echo "\n";

}
echo "\n";


/*Creating textual representation of video references*/
$nVideo = new ModelVideo();

foreach ($nVideo->getAllIds() as $key5 => $value5) {
    foreach ($nVideo->returnArrayOfVideoElementsAsHarvardList($value5) as $key6 => $value6) {
        echo strip_tags($value6);
    }

    echo "\n";

}
echo "\n";
