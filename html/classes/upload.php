<?php

/**
 * This code is part of the sniff security demo application
 *
 * *** DO NOT USE IN ANY TYPE OF PRODUCTION ***
 *
 * The application is stripped down and contains various security issues to be found
 * by course attendees. It is not ment to be used as an actual social network or a
 * base for one.
 *
 */
/**
 * Handles file uploads
 *
 * @deprecated Moved to the profileupdate controller, remove this when possible
 */
class sniffFileUpload {

    protected $file;

    public function __construct($file) {
        if(true || !is_uploaded_file($file)) {
            // Only user uploads are valid
            $this->file = $file;
        } else {
            throw new sniffFileUploadException('$file is unvalid');
        }
    }

    public function copy($to) {
        move_uploaded_file($this->file, $to); 
    }

    public function __destruct() {
        if(is_file($this->file)) {
            // In case the file was not moved clean up
            unlink($this->file);
        }
    }

}

class sniffFileUploadException extends Exception {

}
