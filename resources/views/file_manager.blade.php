<!DOCTYPE html>
<html>
    <head>
        <title>
            Dropbox file manager
        </title>
    </head>
    <body>
        <h1>Simple file handler - Dropbox (upload, delete, read or access file)</h1>
        <ul>
            <li>Upload - /upload </li>
            <li>Delete - /delete </li>
            <li>Access file - /get_temporary_link </li>

        </ul>
        <br>
        <form id="frmFileUpload" action="file/upload" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{{csrf_token()}}}">
            Upload file:
            <input type="file" name="inpFile">

            <input type="submit" value="Upload File">
            <br>
            <br>
        </form>

        <form id="frmFileDelete" action="file/delete" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{{csrf_token() }}}">
            File name to delete:
            <input type="text" name="txtFilename_delete">
            <input type="submit" value="Delete File">
            <br>
            <br>
        </form>

        <form id="frmAccessFile" action="file/access" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{{ csrf_token()}}}">
            File name to access:
            <input type="text" name="txtFilename_access">
            <input type="submit" value="Access File">
            <br>
            <br>
        </form>
    </body>






</html>