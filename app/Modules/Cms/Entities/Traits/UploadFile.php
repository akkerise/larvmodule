<?php

namespace App\Modules\Cms\Entities\Traits;

trait UploadFile {
	protected function uploadFile($file, $rootPath, $folderName, &$msg = '')
	{
		if(!empty($file->getClientOriginalName())) {
			$nameFile = $file->getClientOriginalName();
			$nameFileToArr = explode(".", $nameFile);
			$tmpFile = $file->getRealPath();
			$typeFile = $file->getMimeType();

			// validate file
			if(self::validateFile($typeFile, $nameFileToArr)){

				// check path exists and make folder name : $request->slug
				$restPath = $rootPath . $folderName . '/';
				if(is_dir($restPath)){
					$this->recursiveDir($restPath);
				}
				mkdir($restPath, 0777);
				if(move_uploaded_file($tmpFile, $restPath . $nameFile)) {
					$zip = new \ZipArchive();
					$isOpen = $zip->open($restPath . $nameFile);
					if ($isOpen) {
						$zip->extractTo($restPath);
						$zip->close();
						unlink($restPath . $nameFile);
						return true;
					}else{
                        $msg = "Your .zip file was uploaded and unpacked.";
                        return false;
                    }
				} else {
					$msg = "There was a problem with the upload. Please try again.";
					return false;
				}
			}
			$msg = "Your .zip file is invalid. You need upload file again!";
			return false;
		}
	}

	private static function validateFile($type, array $name_file)
	{
		$accepted_types = [
			'application/zip',
			'application/x-zip-compressed',
			'multipart/x-zip',
			'application/x-compressed'
		];

		foreach($accepted_types as $mime_type) {
			if($mime_type == $type) {
				$okay = true;
				break;
			}
		}

		if(strtolower($name_file[count($name_file) - 1]) == 'zip'){
			return true;
		}else{
			return false;
		}
	}

	private function recursiveDir($dir)
	{
		foreach(scandir($dir) as $file) {

			if ($file == '.' || $file == '..'){
				continue;
			}
			if (is_dir($dir.'/'.$file)){
				self::recursiveDir($dir.'/'.$file);
			} else{
				unlink($dir.'/'.$file);
			}
		}

		rmdir($dir);
	}

    private static function deleteDir($dirPath) {
        if (!is_dir($dirPath)) {
            // check exists folder game path
            throw new \InvalidArgumentException("$dirPath must be a directory");
//            return false;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
        return true;
    }
}
