<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use VictorRayan\DropboxRayanVrsrb\Dropbox_AccessFile;
use VictorRayan\DropboxRayanVrsrb\Dropbox_FileDeletion;
use VictorRayan\DropboxRayanVrsrb\Dropbox_FileUpload;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class FileManager extends Controller
{
    public function uploadFile(Request $request){

        $file = $request->file('inpFile');
        $current_timestamp = Carbon::now()->timestamp;

        
        $filename = "/".hash('sha256', $file->getClientOriginalName().
            $file->getClientOriginalExtension().$file->getSize().$current_timestamp).".".
            $file->getClientOriginalExtension();

        $file->storeAs('/', $filename);
        
        $filepath = storage_path('app'.$filename);
        $filepath_destination = "/dropbox-test/";

        //This method will generate the full file path from a hash sha-256 from uploaded file again
        //but more acurrate, in addition to destination file path with the filepath passed to method. 
        $full_filepath = (new Dropbox_FileUpload())->upload($filepath, $filepath_destination);
        //$full_filepath = $dropbox_upload->upload($filepath, $filepath_destination);
        dd($full_filepath);

    }


    public function deleteFile(Request $request){

        $filepath = $request->post('txtFilename_delete');
        $dropbox_deleteFile = new Dropbox_FileDeletion();
        
        //This method will return a bool value from Http request of deletion function from Dropbox API 
        $delete = $dropbox_deleteFile->delete($filepath);

        if($delete){
            dd("File deleted with sucessfull");
        }
        else{
            dd("Error during file deletion, try again");
        }

    }

    public function getAccessFile(Request $request){

        
        $filepath = $request->post('txtFilename_access');

        $dropbox_accessFile = new Dropbox_AccessFile();

        //This method will return the file access link by provided file path
        //The file must follow the format: "/folder/filename.extension" begining with slash (/)

        $link = $dropbox_accessFile->getTemporaryLink($filepath);

        return redirect($link);

    }
}
